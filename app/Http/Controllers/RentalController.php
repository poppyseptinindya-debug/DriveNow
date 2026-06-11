<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rental;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RentalController extends Controller
{
    /**
     * Customer rental history page.
     */
    public function history()
    {
        $rentals = Rental::where('user_id', auth()->id())
            ->with('car')
            ->latest()
            ->paginate(10);
            
        return view('rentals.history', compact('rentals'));
    }

    /**
     * Customer booking form.
     */
    public function create(Request $request)
    {
        $cars = Car::where('status', 'Tersedia')->get();
        $selectedCarId = $request->query('car_id');
        return view('rentals.create', compact('cars', 'selectedCarId'));
    }

    /**
     * Customer store booking request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'tanggal_sewa' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $date = Carbon::parse($value);
                    if ($date->isBefore(Carbon::today())) {
                        $fail('Tanggal sewa tidak boleh sebelum hari ini.');
                    }
                },
            ],
            'lama_sewa' => 'required|integer|min:1',
            'metode_pembayaran' => 'required|in:Transfer Bank,Cash',
            'bukti_transfer' => 'required_if:metode_pembayaran,Transfer Bank|nullable|image|mimes:jpeg,png,jpg|max:10240',
        ], [
            'car_id.required' => 'Pilih mobil terlebih dahulu.',
            'tanggal_sewa.required' => 'Tanggal sewa wajib diisi.',
            'lama_sewa.required' => 'Lama sewa wajib diisi.',
            'lama_sewa.min' => 'Lama sewa minimal 1 hari.',
            'metode_pembayaran.required' => 'Metode pembayaran wajib dipilih.',
            'metode_pembayaran.in' => 'Metode pembayaran tidak valid.',
            'bukti_transfer.required_if' => 'Bukti transfer wajib diunggah untuk metode Transfer Bank.',
            'bukti_transfer.image' => 'Bukti transfer harus berupa gambar.',
            'bukti_transfer.mimes' => 'Bukti transfer harus berformat jpeg, png, atau jpg.',
            'bukti_transfer.max' => 'Ukuran bukti transfer maksimal 10MB.',
        ]);

        $car = Car::findOrFail($request->car_id);

        if ($car->status !== 'Tersedia') {
            return back()->with('error', 'Mobil tidak tersedia!');
        }

        $total_harga = $car->harga_sewa_per_hari * $request->lama_sewa;

        $buktiPath = null;
        if ($request->hasFile('bukti_transfer') && $request->metode_pembayaran === 'Transfer Bank') {
            $buktiPath = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
        }

        Rental::create([
            'car_id' => $request->car_id,
            'user_id' => auth()->id(),
            'tanggal_sewa' => $request->tanggal_sewa,
            'lama_sewa' => $request->lama_sewa,
            'total_harga' => $total_harga,
            'status_penyewaan' => 'menunggu_konfirmasi',
            'metode_pembayaran' => $request->metode_pembayaran,
            'bukti_transfer' => $buktiPath,
        ]);

        // Catatan: Status mobil tetap 'Tersedia' saat pending pengajuan (sesuai alur permintaan user)
        // Status mobil baru berubah menjadi Disewa ('Disewakan') saat admin menyetujui transaksi.

        return redirect()->route('rentals.history')->with('success', 'Penyewaan berhasil diajukan! Menunggu konfirmasi admin.');
    }

    /**
     * Customer AJAX cancellation of a pending rental.
     */
    public function cancel(Rental $rental)
    {
        if ($rental->user_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses untuk membatalkan penyewaan ini.'
            ], 403);
        }

        if (!in_array($rental->status_penyewaan, ['menunggu_konfirmasi', 'menunggu_pembayaran'])) {
            return response()->json([
                'success' => false,
                'message' => 'Penyewaan tidak dapat dibatalkan pada status ini.'
            ], 400);
        }

        // Update rental status to ditolak (cancelled/rejected)
        $rental->update(['status_penyewaan' => 'ditolak']);

        // Set car back to Available (Tersedia)
        $rental->car->update(['status' => 'Tersedia']);

        return response()->json([
            'success' => true,
            'message' => 'Penyewaan berhasil dibatalkan.'
        ]);
    }

    /**
     * Admin view of all rentals.
     */
    public function adminIndex(Request $request)
    {
        $tab = $request->query('tab', 'transaksi');
        $status = $request->query('status', 'semua');

        if ($tab === 'penyewaan') {
            $query = Rental::whereIn('status_penyewaan', ['menunggu_pengambilan', 'sedang_disewa', 'selesai']);
            
            if ($status !== 'semua' && in_array($status, ['menunggu_pengambilan', 'sedang_disewa', 'selesai'])) {
                $query->where('status_penyewaan', $status);
            }
        } else {
            // tab === 'transaksi' (All rentals logged in a single list)
            $query = Rental::query();
            
            if ($status !== 'semua' && in_array($status, ['menunggu_konfirmasi', 'menunggu_pembayaran', 'menunggu_pengambilan', 'sedang_disewa', 'selesai', 'ditolak'])) {
                if ($status === 'selesai') {
                    $query->whereIn('status_penyewaan', ['menunggu_pengambilan', 'sedang_disewa', 'selesai']);
                } else {
                    $query->where('status_penyewaan', $status);
                }
            }
        }

        $rentals = $query->with(['car', 'user'])
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('rentals.index', compact('rentals', 'tab', 'status'));
    }

    /**
     * Admin AJAX status update.
     */
    public function updateStatus(Request $request, Rental $rental)
    {
        $request->validate([
            'status_penyewaan' => 'required|in:menunggu_pembayaran,menunggu_pengambilan,sedang_disewa,selesai,ditolak'
        ]);

        $newStatus = $request->status_penyewaan;

        // Update rental status
        $rental->update(['status_penyewaan' => $newStatus]);

        // Adjust car status based on new rental status:
        // - 'menunggu_pengambilan', 'sedang_disewa' -> Car status becomes 'Disewakan' (Disewa)
        // - 'selesai', 'ditolak', 'menunggu_pembayaran' -> Car status becomes 'Tersedia'
        if (in_array($newStatus, ['menunggu_pengambilan', 'sedang_disewa'])) {
            $rental->car->update(['status' => 'Disewakan']);
        } elseif (in_array($newStatus, ['selesai', 'ditolak', 'menunggu_pembayaran'])) {
            $rental->car->update(['status' => 'Tersedia']);
        }

        return response()->json([
            'success' => true,
            'message' => 'Status penyewaan berhasil diubah menjadi ' . str_replace('_', ' ', $newStatus) . '.'
        ]);
    }

    /**
     * Submit review (optional extension to use the rating/review columns).
     */
    public function submitReview(Request $request, Rental $rental)
    {
        if ($rental->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        $rental->update([
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return back()->with('success', 'Ulasan berhasil dikirim!');
    }

    /**
     * Admin delete transaction history.
     */
    public function destroy(Rental $rental)
    {
        // If active, release the car status
        if (in_array($rental->status_penyewaan, ['menunggu_pengambilan', 'sedang_disewa'])) {
            $rental->car->update(['status' => 'Tersedia']);
        }

        $rental->delete();

        return response()->json([
            'success' => true,
            'message' => 'Riwayat transaksi berhasil dihapus.'
        ]);
    }
}
