# DriveNow - Sistem Booking Rental Mobil Berbasis Website

DriveNow adalah platform reservasi rental mobil berbasis web yang dirancang untuk mempermudah proses pemesanan kendaraan secara online. Sistem ini memungkinkan pelanggan untuk mengeksplorasi katalog mobil yang tersedia secara real-time, melakukan booking dengan menentukan tanggal dan durasi sewa, memilih metode pembayaran (Transfer Bank atau Cash), mengunggah bukti pembayaran, serta memberikan rating dan ulasan setelah penyewaan selesai.

Selain memudahkan pelanggan, DriveNow juga menyediakan panel manajemen terpadu bagi administrator untuk mengelola unit armada mobil, memantau riwayat transaksi penyewaan, memproses perubahan status sewa, melihat daftar pelanggan yang terdaftar, serta menerima saran dan masukan yang dikirimkan langsung oleh pelanggan demi peningkatan kualitas pelayanan.

Dibuat oleh: **Poppy Septi Nindya**

Program Studi Sistem Informasi Fakultas Ilmu Komputer - Universitas Jember

Demo Video: *https://youtu.be/SoxV-tCwr2I*

**Tujuan Pengembangan**

DriveNow dikembangkan untuk:
- Mempermudah pelanggan dalam mencari dan melakukan pemesanan mobil secara online dari mana saja dan kapan saja.
- Mengotomatisasi pemantauan status ketersediaan armada kendaraan secara transparan.
- Membantu administrator dalam mengelola data unit mobil (inventaris) dan transaksi penyewaan secara terpusat.
- Mengurangi proses koordinasi manual dengan alur persetujuan status sewa yang terintegrasi (menunggu konfirmasi, menunggu pembayaran, menunggu pengambilan, sedang disewa, selesai, ditolak).
- Menyediakan sarana feedback (rating & ulasan) dari pelanggan pasca penyewaan untuk terus meningkatkan kualitas armada.
- Mendukung digitalisasi dan modernisasi layanan jasa transportasi mandiri agar lebih efisien dan terstruktur.

**Fitur Utama**

Fitur Pelanggan 

* **Autentikasi**
  * Registrasi
  * Login akun
  * Logout akun
  * Remember Me
* **Dashboard Customer**
  * Melihat ringkasan data statistik (total armada, unit tersedia, unit sedang disewa, total sewa pribadi)
  * Rekomendasi mobil populer yang tersedia
* **Katalog Mobil**
  * Fitur pencarian mobil (*live search* real-time berbasis AJAX)
  * Melihat daftar mobil beserta informasi detail (jenis, warna, tahun, harga sewa per hari, dan status ketersediaan)
* **Pemesanan (Booking)**
  * Memesan unit mobil berdasarkan tanggal mulai sewa dan durasi sewa (hari)
  * Perhitungan total harga sewa secara otomatis
  * Pemilihan metode pembayaran (Transfer Bank atau Cash)
  * Upload bukti pembayaran (bukti transfer) untuk metode Transfer Bank
* **Riwayat Penyewaan (History)**
  * Melihat daftar transaksi aktif, pending, maupun riwayat sewa yang telah selesai
  * Pembatalan transaksi pengajuan sewa yang masih berstatus pending (*menunggu konfirmasi* / *menunggu pembayaran*)
  * Mengirimkan rating (1 - 5 bintang) beserta ulasan tertulis setelah penyewaan selesai
* **Profil Pengguna**
  * Melihat data profil akun
  * Mengubah data profil (nama, email, password)
  * Menghapus akun secara mandiri (*Delete Account*)
* **Kontak & Saran**
  * Mengirim pesan saran, kritik, atau masukan langsung ke admin melalui form kontak

Fitur Admin

* **Autentikasi**
  * Login khusus admin
  * Logout akun
* **Dashboard Admin**
  * Melihat total armada mobil keseluruhan
  * Melihat jumlah unit mobil yang berstatus tersedia (*Tersedia*)
  * Melihat jumlah unit mobil yang sedang disewa (*Disewakan*)
  * Melihat total pelanggan terdaftar
  * Melihat total transaksi penyewaan
* **Pengelolaan Mobil**
  * Menambah unit mobil baru beserta upload gambar
  * Mengubah data informasi mobil (nama mobil, jenis mobil, harga sewa, warna, tahun, dan status ketersediaan)
  * Menghapus unit mobil dari sistem
* **Pengelolaan Transaksi Penyewaan**
  * Memantau daftar semua transaksi penyewaan pelanggan (terbagi dalam tab transaksi & penyewaan)
  * Mengubah status penyewaan (*menunggu pembayaran*, *menunggu pengambilan*, *sedang disewa*, *selesai*, atau *ditolak*)
  * Sinkronisasi otomatis status ketersediaan mobil berdasarkan status sewa (status mobil otomatis berubah menjadi *Disewakan* ketika sewa aktif, dan otomatis kembali *Tersedia* ketika sewa telah selesai atau ditolak)
  * Menghapus data riwayat transaksi
* **Pengelolaan Customer**
  * Melihat daftar lengkap pelanggan yang terdaftar di sistem
* **Pengelolaan Kotak Saran**
  * Membaca seluruh pesan saran/kritik dari pelanggan
  * Menghapus pesan saran/kritik

**Struktur Database**

Database DriveNow terdiri dari beberapa tabel utama berikut:
- **`users`** : Menyimpan data akun pengguna dengan peran (*role*) sebagai `admin` atau `customer`.
- **`cars`** : Menyimpan data unit mobil (nama mobil, jenis mobil seperti MPV/SUV/Sedan/City Car, harga sewa per hari, warna, tahun, gambar, dan status ketersediaan).
- **`rentals`** : Mencatat seluruh transaksi pemesanan sewa mobil (ID mobil, ID user, tanggal sewa, durasi sewa, total harga, metode pembayaran, bukti transfer, rating, ulasan, dan status penyewaan).
- **`contacts`** : Menyimpan pesan masukan, saran, dan kritik yang dikirimkan oleh pengunjung/pelanggan.

**Status Penyewaan**

Sistem menggunakan beberapa status transaksi penyewaan untuk memantau proses rental mobil:
- **`menunggu_konfirmasi`** : Tahap awal setelah customer mengajukan pemesanan sewa.
- **`menunggu_pembayaran`** : Permintaan disetujui admin dan menunggu customer melakukan pembayaran (jika Transfer Bank).
- **`menunggu_pengambilan`** : Pembayaran terverifikasi dan menunggu kendaraan diambil oleh customer.
- **`sedang_disewa`** : Mobil telah diambil dan saat ini sedang dalam masa sewa aktif oleh customer.
- **`selesai`** : Masa sewa berakhir, mobil telah dikembalikan dalam kondisi baik, dan transaksi selesai.
- **`ditolak`** : Pengajuan sewa ditolak oleh admin atau dibatalkan langsung oleh customer saat statusnya masih pending.

🔐 Akun Akses Default
* **Admin**
  * Email: `admin@gmail.com`
  * Password: `password`
