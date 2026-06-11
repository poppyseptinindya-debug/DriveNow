import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// ==========================================
// Custom Alert & Confirm Modals (Navy Theme)
// ==========================================
function showCustomAlert(message) {
    let alertEl = document.getElementById('customAlertModal');
    if (alertEl) alertEl.remove();

    alertEl = document.createElement('div');
    alertEl.id = 'customAlertModal';
    alertEl.className = 'fixed inset-0 z-[100] flex items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4 animate-fade-in';
    alertEl.innerHTML = `
        <div class="bg-white dark:bg-slate-900 max-w-sm w-full rounded-3xl overflow-hidden border border-slate-200 dark:border-slate-800 shadow-2xl p-6 space-y-4 transform scale-95 transition-all duration-300">
            <div class="flex items-center gap-3 text-indigo-600 dark:text-indigo-400">
                <div class="h-10 w-10 rounded-xl bg-indigo-50 dark:bg-indigo-950/40 flex items-center justify-center text-lg">
                    <i class="fas fa-info-circle"></i>
                </div>
                <h4 class="font-bold text-slate-900 dark:text-white">Pemberitahuan</h4>
            </div>
            <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">${message}</p>
            <div class="flex justify-end">
                <button id="customAlertOkBtn" class="px-5 py-2.5 text-xs font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl transition-all shadow-md shadow-indigo-600/10">
                    OK
                </button>
            </div>
        </div>
    `;

    document.body.appendChild(alertEl);
    
    setTimeout(() => {
        alertEl.querySelector('div').classList.remove('scale-95');
    }, 10);

    return new Promise((resolve) => {
        document.getElementById('customAlertOkBtn').addEventListener('click', () => {
            alertEl.querySelector('div').classList.add('scale-95');
            alertEl.classList.add('opacity-0');
            setTimeout(() => {
                alertEl.remove();
                resolve();
            }, 300);
        });
    });
}

function showCustomConfirm(message) {
    let confirmEl = document.getElementById('customConfirmModal');
    if (confirmEl) confirmEl.remove();

    confirmEl = document.createElement('div');
    confirmEl.id = 'customConfirmModal';
    confirmEl.className = 'fixed inset-0 z-[100] flex items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4 animate-fade-in';
    confirmEl.innerHTML = `
        <div class="bg-white dark:bg-slate-900 max-w-sm w-full rounded-3xl overflow-hidden border border-slate-200 dark:border-slate-800 shadow-2xl p-6 space-y-4 transform scale-95 transition-all duration-300">
            <div class="flex items-center gap-3 text-rose-500 dark:text-rose-400">
                <div class="h-10 w-10 rounded-xl bg-rose-50 dark:bg-rose-950/40 flex items-center justify-center text-lg">
                    <i class="fas fa-question-circle"></i>
                </div>
                <h4 class="font-bold text-slate-900 dark:text-white">Konfirmasi</h4>
            </div>
            <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">${message}</p>
            <div class="flex justify-end gap-3">
                <button id="customConfirmCancelBtn" class="px-4 py-2.5 text-xs font-semibold text-slate-700 dark:text-slate-300 bg-slate-50 dark:bg-slate-800 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-xl transition-all border border-slate-200/50 dark:border-slate-700/50">
                    Batal
                </button>
                <button id="customConfirmOkBtn" class="px-5 py-2.5 text-xs font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl transition-all shadow-md shadow-indigo-600/10">
                    Konfirmasi
                </button>
            </div>
        </div>
    `;

    document.body.appendChild(confirmEl);

    setTimeout(() => {
        confirmEl.querySelector('div').classList.remove('scale-95');
    }, 10);

    return new Promise((resolve) => {
        document.getElementById('customConfirmOkBtn').addEventListener('click', () => {
            confirmEl.querySelector('div').classList.add('scale-95');
            confirmEl.classList.add('opacity-0');
            setTimeout(() => {
                confirmEl.remove();
                resolve(true);
            }, 300);
        });

        document.getElementById('customConfirmCancelBtn').addEventListener('click', () => {
            confirmEl.querySelector('div').classList.add('scale-95');
            confirmEl.classList.add('opacity-0');
            setTimeout(() => {
                confirmEl.remove();
                resolve(false);
            }, 300);
        });
    });
}

// Override native alert globally
window.alert = function(msg) {
    showCustomAlert(msg);
};

// Global confirm form submit helper
async function confirmDeleteForm(e, message) {
    e.preventDefault();
    const confirmed = await showCustomConfirm(message);
    if (confirmed) {
        e.target.submit();
    }
}

window.showCustomAlert = showCustomAlert;
window.showCustomConfirm = showCustomConfirm;
window.confirmDeleteForm = confirmDeleteForm;


// ==========================================
// Theme Controller
// ==========================================
function setCookie(name, value, days = 365) {
    const expires = new Date();
    expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
    document.cookie = `${name}=${encodeURIComponent(value)};expires=${expires.toUTCString()};path=/;SameSite=Lax`;
}

function toggleTheme() {
    const html = document.documentElement;
    const isDark = html.classList.contains('dark');
    const newTheme = isDark ? 'light' : 'dark';

    if (newTheme === 'dark') {
        html.classList.add('dark');
        setCookie('theme', 'dark', 365);
    } else {
        html.classList.remove('dark');
        setCookie('theme', 'light', 365);
    }
    updateThemeIcons(newTheme);
}

function updateThemeIcons(theme) {
    const icon = document.getElementById('themeToggleIcon');
    if (icon) {
        if (theme === 'dark') {
            icon.className = 'fas fa-sun text-amber-400';
        } else {
            icon.className = 'fas fa-moon';
        }
    }
}

window.toggleTheme = toggleTheme;
window.updateThemeIcons = updateThemeIcons;

document.addEventListener('DOMContentLoaded', () => {
    const isDark = document.documentElement.classList.contains('dark');
    updateThemeIcons(isDark ? 'dark' : 'light');
});


// ==========================================
// Admin - Kelola Kontak
// ==========================================
async function deleteContact(id, button) {
    const confirmed = await showCustomConfirm('Apakah Anda yakin ingin menghapus saran dari pelanggan ini?');
    if (!confirmed) {
        return;
    }

    button.disabled = true;
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

    try {
        const response = await fetch(`/admin/contacts/${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });

        const result = await response.json();

        if (result.success) {
            const tr = button.closest('tr');
            tr.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
            setTimeout(() => {
                tr.remove();
            }, 500);
            showCustomAlert(result.message);
        } else {
            button.disabled = false;
            button.innerHTML = originalText;
            showCustomAlert(result.message);
        }
    } catch (err) {
        button.disabled = false;
        button.innerHTML = originalText;
        console.error(err);
        showCustomAlert('Terjadi kesalahan saat menghapus saran.');
    }
}
window.deleteContact = deleteContact;


// ==========================================
// Pelanggan - Live Search Katalog
// ==========================================
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('searchInput');
    const catalogContainer = document.getElementById('catalogContainer');
    const paginationContainer = document.getElementById('paginationContainer');

    if (searchInput && catalogContainer) {
        function debounce(func, delay) {
            let timeout;
            return function(...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(this, args), delay);
            };
        }

        const performSearch = async (query) => {
            try {
                const response = await fetch(`/api/cars/search?q=${encodeURIComponent(query)}`);
                const result = await response.json();
                
                if (result.success && result.data) {
                    renderCatalog(result.data);
                    if (paginationContainer) {
                        if (query.trim() !== '') {
                            paginationContainer.style.display = 'none';
                        } else {
                            paginationContainer.style.display = 'flex';
                        }
                    }
                }
            } catch (err) {
                console.error("Gagal melakukan pencarian:", err);
            }
        };

        const renderCatalog = (cars) => {
            catalogContainer.innerHTML = '';
            
            if (cars.length === 0) {
                catalogContainer.innerHTML = `
                    <div class="col-span-full py-16 text-center text-slate-500 dark:text-slate-400 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl mx-auto w-full">
                        <i class="fas fa-car-crash text-5xl text-slate-300 dark:text-slate-700 mb-3"></i>
                        <p class="text-lg font-semibold">Armada tidak ditemukan</p>
                        <p class="text-sm mt-1 text-slate-400">Silakan gunakan kata kunci pencarian yang lain.</p>
                    </div>
                `;
                return;
            }

            cars.forEach(car => {
                const badgeClass = car.status === 'Tersedia' 
                    ? 'bg-emerald-100/90 text-emerald-800 dark:bg-emerald-950/80 dark:text-emerald-400' 
                    : 'bg-amber-100/90 text-amber-800 dark:bg-amber-950/80 dark:text-amber-400';
                
                const indicatorClass = car.status === 'Tersedia' ? 'bg-emerald-500' : 'bg-amber-500';
                
                let sSewaButton = '';
                if (car.status === 'Tersedia') {
                    sSewaButton = `
                        <a href="/rentals/create?car_id=${car.id}" class="px-4 py-2.5 text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl transition-all shadow-md shadow-indigo-600/10">
                            Sewa
                        </a>
                    `;
                }

                catalogContainer.innerHTML += `
                    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex flex-col h-full">
                        <div class="relative bg-slate-100 dark:bg-slate-950 h-48 flex items-center justify-center overflow-hidden">
                            <img src="${car.gambar_url}" alt="${car.nama_mobil}" class="w-full h-full object-cover">
                            <span class="absolute top-4 right-4 inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold backdrop-blur-md ${badgeClass}">
                                <span class="w-1.5 h-1.5 mr-1.5 rounded-full ${indicatorClass}"></span>
                                ${car.status}
                            </span>
                        </div>
                        <div class="p-6 flex-grow flex flex-col justify-between space-y-4">
                            <div class="space-y-1">
                                <span class="text-slate-400 dark:text-slate-500 text-xs font-semibold uppercase tracking-wider">${car.jenis_mobil}</span>
                                <h3 class="font-bold text-slate-800 dark:text-white text-lg leading-tight">${car.nama_mobil}</h3>
                            </div>
                            <div class="pt-4 border-t border-slate-100 dark:border-slate-800 flex justify-between items-center">
                                <div>
                                    <p class="text-xs text-slate-400 dark:text-slate-500">Tarif Sewa</p>
                                    <p class="font-extrabold text-indigo-600 dark:text-indigo-400 text-lg">Rp ${car.harga_sewa_per_hari.toLocaleString('id-ID')}<span class="text-xs font-normal text-slate-400">/hari</span></p>
                                </div>
                                <div class="flex gap-2">
                                    <a href="/cars/${car.id}" class="px-4 py-2.5 text-xs font-bold text-slate-700 bg-slate-50 hover:bg-slate-100 dark:bg-slate-800/60 dark:text-slate-300 dark:hover:bg-slate-800 rounded-xl transition-all border border-slate-200/50 dark:border-slate-700/50">
                                        Detail
                                    </a>
                                    ${sSewaButton}
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });
        };

        searchInput.addEventListener('input', debounce((e) => {
            performSearch(e.target.value);
        }, 400));
    }
});


// ==========================================
// Pelanggan - Submit Kontak AJAX
// ==========================================
document.addEventListener('DOMContentLoaded', () => {
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const submitBtn = contactForm.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerText;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Mengirim...';

            try {
                const response = await fetch('/kontak', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        name: document.getElementById('name').value,
                        email: document.getElementById('email').value,
                        message: document.getElementById('message').value
                    })
                });

                const result = await response.json();
                if (result.success) {
                    showCustomAlert(result.message);
                    contactForm.reset();
                } else {
                    showCustomAlert('Gagal mengirim saran. Silakan coba lagi.');
                }
            } catch (err) {
                console.error(err);
                showCustomAlert('Terjadi kesalahan saat mengirim saran.');
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        });
    }
});


// ==========================================
// Pelanggan - Booking Form & Live Price & Validation
// ==========================================
document.addEventListener('DOMContentLoaded', () => {
    const bookingForm = document.getElementById('bookingForm');
    if (bookingForm) {
        const carSelect = document.getElementById('car_id');
        const dateInput = document.getElementById('tanggal_sewa');
        const durationInput = document.getElementById('lama_sewa');
        const paymentMethodSelect = document.getElementById('metode_pembayaran');
        const buktiTransferContainer = document.getElementById('buktiTransferContainer');
        const buktiTransferInput = document.getElementById('bukti_transfer');
        const buktiPreview = document.getElementById('buktiPreview');
        const previewContainer = document.getElementById('previewContainer');
        const buktiText = document.getElementById('buktiText');
        const fileNameDisplay = document.getElementById('fileNameDisplay');
        const loadingOverlay = document.getElementById('loadingOverlay');
        const totalPriceBox = document.getElementById('totalPriceBox');
        const totalPriceVal = document.getElementById('totalPriceVal');

        const togglePaymentFields = () => {
            if (paymentMethodSelect.value === 'Transfer Bank') {
                buktiTransferContainer.classList.remove('hidden');
            } else {
                buktiTransferContainer.classList.add('hidden');
            }
        };

        paymentMethodSelect.addEventListener('change', togglePaymentFields);
        togglePaymentFields();

        buktiTransferInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (event) => {
                    buktiPreview.src = event.target.result;
                    previewContainer.classList.remove('hidden');
                    buktiText.classList.add('hidden');
                    fileNameDisplay.textContent = file.name;
                };
                reader.readAsDataURL(file);
            } else {
                previewContainer.classList.add('hidden');
                buktiText.classList.remove('hidden');
            }
        });

        const calculatePrice = () => {
            const selectedOption = carSelect.options[carSelect.selectedIndex];
            const dailyPrice = selectedOption ? parseInt(selectedOption.getAttribute('data-price')) : 0;
            const duration = parseInt(durationInput.value) || 0;
            
            const total = dailyPrice * duration;
            if (total > 0) {
                totalPriceBox.classList.remove('hidden');
                totalPriceVal.textContent = 'Rp ' + total.toLocaleString('id-ID');
            } else {
                totalPriceBox.classList.add('hidden');
            }
        };

        carSelect.addEventListener('change', calculatePrice);
        durationInput.addEventListener('input', calculatePrice);

        calculatePrice();

        const showError = (fieldId, msg) => {
            const errSpan = document.getElementById(`error-${fieldId}`);
            const inputField = document.getElementById(fieldId);
            
            errSpan.textContent = msg;
            errSpan.classList.remove('hidden');
            inputField.classList.add('border-rose-500');
            inputField.classList.remove('border-slate-200', 'dark:border-slate-800');
        };

        const hideError = (fieldId) => {
            const errSpan = document.getElementById(`error-${fieldId}`);
            const inputField = document.getElementById(fieldId);
            
            errSpan.classList.add('hidden');
            inputField.classList.remove('border-rose-500');
            inputField.classList.add('border-slate-200');
        };

        bookingForm.addEventListener('submit', (e) => {
            let isValid = true;

            if (carSelect.value === '') {
                showError('car_id', 'Pilih mobil terlebih dahulu.');
                isValid = false;
            } else {
                hideError('car_id');
            }

            const dateValueStr = dateInput.value;
            if (dateValueStr === '') {
                showError('tanggal_sewa', 'Tanggal sewa wajib diisi.');
                isValid = false;
            } else {
                const selectedDate = new Date(dateValueStr);
                selectedDate.setHours(0,0,0,0);
                
                const today = new Date();
                today.setHours(0,0,0,0);

                if (selectedDate < today) {
                    showError('tanggal_sewa', 'Tanggal sewa tidak boleh kurang dari hari ini.');
                    isValid = false;
                } else {
                    hideError('tanggal_sewa');
                }
            }

            const durationValue = parseInt(durationInput.value);
            if (isNaN(durationValue) || durationValue < 1) {
                showError('lama_sewa', 'Lama sewa minimal 1 hari.');
                isValid = false;
            } else {
                hideError('lama_sewa');
            }

            if (paymentMethodSelect.value === '') {
                showError('metode_pembayaran', 'Metode pembayaran wajib dipilih.');
                isValid = false;
            } else {
                hideError('metode_pembayaran');
                
                if (paymentMethodSelect.value === 'Transfer Bank') {
                    if (!buktiTransferInput.files || buktiTransferInput.files.length === 0) {
                        showError('bukti_transfer', 'Bukti transfer wajib diunggah.');
                        isValid = false;
                    } else {
                        const file = buktiTransferInput.files[0];
                        const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                        if (!allowedTypes.includes(file.type)) {
                            showError('bukti_transfer', 'Format file harus jpeg, png, atau jpg.');
                            isValid = false;
                        } else if (file.size > 10 * 1024 * 1024) {
                            showError('bukti_transfer', 'Ukuran file maksimal 10MB.');
                            isValid = false;
                        } else {
                            hideError('bukti_transfer');
                        }
                    }
                }
            }

            if (isValid) {
                loadingOverlay.classList.remove('hidden');
            } else {
                e.preventDefault();
            }
        });
    }
});


// ==========================================
// Pelanggan - Riwayat Sewa (Modal & AJAX & Bintang)
// ==========================================
function viewBukti(src) {
    const buktiImage = document.getElementById('buktiImage');
    const buktiModal = document.getElementById('buktiModal');
    if (buktiImage && buktiModal) {
        buktiImage.src = src;
        buktiModal.classList.remove('hidden');
    }
}

function closeBukti() {
    const buktiModal = document.getElementById('buktiModal');
    if (buktiModal) {
        buktiModal.classList.add('hidden');
    }
}

function openReviewModal(rentalId, carName) {
    const reviewCarName = document.getElementById('reviewCarName');
    const reviewForm = document.getElementById('reviewForm');
    const reviewModal = document.getElementById('reviewModal');
    if (reviewCarName && reviewForm && reviewModal) {
        reviewCarName.textContent = carName;
        reviewForm.action = `/rentals/${rentalId}/review`;
        reviewModal.classList.remove('hidden');
    }
}

function closeReviewModal() {
    const reviewModal = document.getElementById('reviewModal');
    if (reviewModal) {
        reviewModal.classList.add('hidden');
    }
}

async function cancelBooking(id, button) {
    const confirmed = await showCustomConfirm('Apakah Anda yakin ingin membatalkan penyewaan ini?');
    if (!confirmed) {
        return;
    }

    button.disabled = true;
    button.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Loading...';

    try {
        const response = await fetch(`/rentals/${id}/cancel`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });

        const result = await response.json();

        if (result.success) {
            const tr = button.closest('tr');
            const badge = tr.querySelector('.status-badge');
            badge.className = 'status-badge inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-rose-100 text-rose-800 dark:bg-rose-950/30 dark:text-rose-400';
            badge.innerHTML = '<span class="w-1.5 h-1.5 mr-1.5 rounded-full bg-rose-500"></span>Ditolak / Batal';
            button.parentElement.innerHTML = '<span class="text-slate-400 dark:text-slate-600">-</span>';
            showCustomAlert(result.message);
        } else {
            button.disabled = false;
            button.innerHTML = '<i class="fas fa-ban mr-1"></i> Batalkan';
            showCustomAlert(result.message);
        }
    } catch (err) {
        button.disabled = false;
        button.innerHTML = '<i class="fas fa-ban mr-1"></i> Batalkan';
        console.error(err);
        showCustomAlert('Gagal menghubungi server. Cobalah beberapa saat lagi.');
    }
}

window.viewBukti = viewBukti;
window.closeBukti = closeBukti;
window.openReviewModal = openReviewModal;
window.closeReviewModal = closeReviewModal;
window.cancelBooking = cancelBooking;

document.addEventListener('DOMContentLoaded', () => {
    const stars = document.querySelectorAll('#starsContainer i');
    const ratingInput = document.getElementById('ratingInput');
    if (stars.length && ratingInput) {
        stars.forEach(star => {
            star.addEventListener('click', () => {
                const val = parseInt(star.getAttribute('data-value'));
                ratingInput.value = val;
                
                stars.forEach((s, idx) => {
                    if (idx < val) {
                        s.className = 'fas fa-star';
                    } else {
                        s.className = 'far fa-star';
                    }
                });
            });
        });
    }
});


// ==========================================
// Admin - Transaksi & Penyewaan AJAX
// ==========================================
async function updateRentalStatus(id, newStatus, button) {
    let confirmMsg = `Ubah status penyewaan ini menjadi ${newStatus.replace('_', ' ')}?`;
    if (newStatus === 'ditolak') {
        confirmMsg = 'Apakah Anda yakin ingin membatalkan/menolak penyewaan ini?';
    } else if (newStatus === 'selesai') {
        confirmMsg = 'Apakah Anda yakin ingin menandai transaksi ini selesai (mobil dikembalikan)?';
    } else if (newStatus === 'sedang_disewa') {
        confirmMsg = 'Konfirmasi bahwa mobil telah diserahkan ke pelanggan?';
    }
    
    const confirmed = await showCustomConfirm(confirmMsg);
    if (!confirmed) {
        return;
    }

    const container = button.closest('.action-buttons-container');
    const buttons = container ? container.querySelectorAll('button') : [];
    buttons.forEach(btn => btn.disabled = true);
    
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>';

    try {
        const response = await fetch(`/admin/rentals/${id}/status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                status_penyewaan: newStatus
            })
        });

        const result = await response.json();

        if (result.success) {
            const tr = button.closest('tr');
            const badge = tr.querySelector('.status-badge');
            const metode = container ? container.getAttribute('data-metode') : '';
            
            const rentalsContainer = document.getElementById('rentalsContainer');
            const isTabTransaksi = rentalsContainer ? rentalsContainer.getAttribute('data-tab') === 'transaksi' : false;
            
            const statusClasses = {
                'menunggu_konfirmasi': 'bg-amber-100 text-amber-800 dark:bg-amber-950/30 dark:text-amber-400',
                'menunggu_pembayaran': 'bg-yellow-100 text-yellow-800 dark:bg-yellow-950/30 dark:text-yellow-400',
                'menunggu_pengambilan': 'bg-blue-100 text-blue-800 dark:bg-blue-950/30 dark:text-blue-400',
                'sedang_disewa': 'bg-indigo-100 text-indigo-800 dark:bg-indigo-950/30 dark:text-indigo-400',
                'selesai': 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950/30 dark:text-emerald-400',
                'ditolak': 'bg-rose-100 text-rose-800 dark:bg-rose-950/30 dark:text-rose-400'
            };
            
            const statusLabels = {
                'menunggu_konfirmasi': 'Menunggu Konfirmasi',
                'menunggu_pembayaran': 'Menunggu Pembayaran',
                'menunggu_pengambilan': 'Menunggu Pengambilan',
                'sedang_disewa': 'Sedang Disewa',
                'selesai': 'Selesai',
                'ditolak': 'Ditolak / Batal'
            };
            
            const dotClasses = {
                'menunggu_konfirmasi': 'bg-amber-500',
                'menunggu_pembayaran': 'bg-yellow-500',
                'menunggu_pengambilan': 'bg-blue-500',
                'sedang_disewa': 'bg-indigo-500',
                'selesai': 'bg-emerald-500',
                'ditolak': 'bg-rose-500'
            };

            let transStatusClass = statusClasses[newStatus];
            let transDotClass = dotClasses[newStatus];
            let transLabel = statusLabels[newStatus];

            if (isTabTransaksi && (newStatus === 'menunggu_pengambilan' || newStatus === 'sedang_disewa' || newStatus === 'selesai')) {
                transStatusClass = 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950/30 dark:text-emerald-400';
                transDotClass = 'bg-emerald-500';
                transLabel = 'Selesai';
            }

            if (badge && isTabTransaksi) {
                badge.className = `status-badge inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${transStatusClass}`;
                badge.innerHTML = `<span class="w-1.5 h-1.5 mr-1.5 rounded-full ${transDotClass}"></span><span class="status-text">${transLabel}</span>`;
            }

            if (isTabTransaksi) {
                if (newStatus === 'menunggu_konfirmasi') {
                    let buttonsHtml = '';
                    if (metode === 'Transfer Bank') {
                        buttonsHtml = `
                            <button onclick="updateRentalStatus(${id}, 'menunggu_pengambilan', this)" class="px-2 py-1 text-[11px] font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg transition-all shadow-sm">
                                Setujui
                            </button>
                        `;
                    } else {
                        buttonsHtml = `
                            <button onclick="updateRentalStatus(${id}, 'menunggu_pembayaran', this)" class="px-2 py-1 text-[11px] font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg transition-all shadow-sm">
                                Setujui
                            </button>
                        `;
                    }
                    buttonsHtml += `
                        <button onclick="updateRentalStatus(${id}, 'ditolak', this)" class="px-2 py-1 text-[11px] font-semibold text-rose-600 bg-rose-50 hover:bg-rose-100 dark:bg-rose-950/30 dark:text-rose-400 rounded-lg transition-all">
                            Tolak
                        </button>
                    `;
                    container.innerHTML = `
                        <span class="status-badge inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${transStatusClass}">
                            <span class="w-1.5 h-1.5 mr-1.5 rounded-full ${transDotClass}"></span>
                            <span class="status-text">${transLabel}</span>
                        </span>
                        <div class="flex items-center gap-1">
                            ${buttonsHtml}
                        </div>
                    `;
                } else if (newStatus === 'menunggu_pembayaran') {
                    container.innerHTML = `
                        <span class="status-badge inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${transStatusClass}">
                            <span class="w-1.5 h-1.5 mr-1.5 rounded-full ${transDotClass}"></span>
                            <span class="status-text">${transLabel}</span>
                        </span>
                        <div class="flex items-center gap-1">
                            <button onclick="updateRentalStatus(${id}, 'menunggu_pengambilan', this)" class="px-2.5 py-1 text-[11px] font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg transition-all shadow-sm">
                                Konfirmasi Bayar
                            </button>
                            <button onclick="updateRentalStatus(${id}, 'ditolak', this)" class="px-2.5 py-1 text-[11px] font-semibold text-rose-600 bg-rose-50 hover:bg-rose-100 dark:bg-rose-950/30 dark:text-rose-400 rounded-lg transition-all">
                                Batalkan
                            </button>
                        </div>
                    `;
                } else {
                    container.innerHTML = `
                        <span class="status-badge inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${transStatusClass}">
                            <span class="w-1.5 h-1.5 mr-1.5 rounded-full ${transDotClass}"></span>
                            <span class="status-text">${transLabel}</span>
                        </span>
                    `;
                }
            } else {
                let badgeHtml = `
                    <span class="status-badge inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${statusClasses[newStatus]}">
                        <span class="w-1.5 h-1.5 mr-1.5 rounded-full ${dotClasses[newStatus]}"></span>
                        <span class="status-text">${statusLabels[newStatus]}</span>
                    </span>
                `;
                
                let buttonHtml = '';
                if (newStatus === 'menunggu_pengambilan') {
                    buttonHtml = `
                        <button onclick="updateRentalStatus(${id}, 'sedang_disewa', this)" class="px-2.5 py-1 text-[11px] font-semibold text-white bg-sky-600 hover:bg-sky-700 rounded-lg transition-all shadow-sm">
                            Serahkan Mobil
                        </button>
                    `;
                } else if (newStatus === 'sedang_disewa') {
                    buttonHtml = `
                        <button onclick="updateRentalStatus(${id}, 'selesai', this)" class="px-2.5 py-1 text-[11px] font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg transition-all shadow-sm">
                            Selesai
                        </button>
                    `;
                }
                
                container.innerHTML = badgeHtml + buttonHtml;
            }

            showCustomAlert(result.message);
        } else {
            if (buttons.length) buttons.forEach(btn => btn.disabled = false);
            button.innerHTML = originalText;
            showCustomAlert(result.message);
        }
    } catch (err) {
        if (buttons.length) buttons.forEach(btn => btn.disabled = false);
        button.innerHTML = originalText;
        console.error(err);
        showCustomAlert('Terjadi kesalahan saat memproses status penyewaan.');
    }
}

async function deleteRental(id, button) {
    const confirmed = await showCustomConfirm('Apakah Anda yakin ingin menghapus data riwayat transaksi ini dari database secara permanen?');
    if (!confirmed) {
        return;
    }

    button.disabled = true;
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

    try {
        const response = await fetch(`/admin/rentals/${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });

        const result = await response.json();

        if (result.success) {
            const tr = button.closest('tr');
            tr.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
            setTimeout(() => {
                tr.remove();
            }, 500);
            showCustomAlert(result.message);
        } else {
            button.disabled = false;
            button.innerHTML = originalText;
            showCustomAlert(result.message);
        }
    } catch (err) {
        button.disabled = false;
        button.innerHTML = originalText;
        console.error(err);
        showCustomAlert('Terjadi kesalahan saat menghapus data.');
    }
}

window.updateRentalStatus = updateRentalStatus;
window.deleteRental = deleteRental;
