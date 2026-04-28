let daftarMobil = [];
let daftarPenyewaan = [];
let daftarTestimoni = [];
let nextIdMobil = 1;
let editingMobilId = null;
let gambarTerpilih = null;
let gambarPreviewUrl = null;

const defaultMobil = [
    { id: 1, nama: 'Toyota Avanza', jenis: 'MPV', harga: 350000, status: 'Tersedia', gambar: 'avanza.jpg' },
    { id: 2, nama: 'Honda Brio', jenis: 'City Car', harga: 300000, status: 'Disewa', gambar: 'brio.jpg' },
    { id: 3, nama: 'Toyota Fortuner', jenis: 'SUV', harga: 800000, status: 'Tersedia', gambar: 'fortuner.jpg' },
    { id: 4, nama: 'Mitsubishi Pajero', jenis: 'SUV', harga: 850000, status: 'Tersedia', gambar: 'pajero.jpg' },
    { id: 5, nama: 'Daihatsu Xenia', jenis: 'MPV', harga: 330000, status: 'Tersedia', gambar: 'xenia.jpg' },
    { id: 6, nama: 'Honda Civic', jenis: 'Sedan', harga: 700000, status: 'Tersedia', gambar: 'civic.jpg' },
    { id: 7, nama: 'Toyota Calya', jenis: 'MPV', harga: 280000, status: 'Tersedia', gambar: 'calya.jpg' }
];

setTimeout(() => {
    console.log('🔍 CEK GAMBAR:');
    defaultMobil.forEach(m => cekGambar(m.gambar));
}, 1000);

const defaultTestimoni = [
    { id: 1, nama: 'Budi Santoso', mobil: 'Toyota Avanza', rating: 5, review: 'Mobil bersih, pelayanan ramah!' },
    { id: 2, nama: 'Siti Aminah', mobil: 'Toyota Fortuner', rating: 4, review: 'Mobil nyaman untuk perjalanan jauh.' },
    { id: 3, nama: 'Andi Wijaya', mobil: 'Honda Brio', rating: 5, review: 'Proses cepat, mobil terawat.' }
];

function loadData() {
    const savedMobil = localStorage.getItem('daftarMobil');
    if (savedMobil) {
        try {
            daftarMobil = JSON.parse(savedMobil);
            nextIdMobil = Math.max(...daftarMobil.map(m => m.id), 0) + 1;
        } catch(e) { daftarMobil = [...defaultMobil]; }
    } else {
        daftarMobil = [...defaultMobil];
        nextIdMobil = 8;
        saveMobil();
    }

    const savedPenyewaan = localStorage.getItem('daftarPenyewaan');
    if (savedPenyewaan) {
        try { daftarPenyewaan = JSON.parse(savedPenyewaan); }
        catch(e) { daftarPenyewaan = []; }
    } else { daftarPenyewaan = []; savePenyewaan(); }

    const savedTestimoni = localStorage.getItem('daftarTestimoni');
    if (savedTestimoni) {
        try { daftarTestimoni = JSON.parse(savedTestimoni); }
        catch(e) { daftarTestimoni = [...defaultTestimoni]; }
    } else { daftarTestimoni = [...defaultTestimoni]; saveTestimoni(); }
}

function saveMobil() { localStorage.setItem('daftarMobil', JSON.stringify(daftarMobil)); }
function savePenyewaan() { localStorage.setItem('daftarPenyewaan', JSON.stringify(daftarPenyewaan)); }
function saveTestimoni() { localStorage.setItem('daftarTestimoni', JSON.stringify(daftarTestimoni)); }

function showToast(message, isError = false) {
    const existingToast = document.querySelector('.toast');
    if (existingToast) existingToast.remove();
    const toast = document.createElement('div');
    toast.className = 'toast' + (isError ? ' error' : '');
    toast.innerHTML = isError ? `❌ ${message}` : `✅ ${message}`;
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 3000);
}

function previewGambarFile(input) {
    const previewDiv = document.getElementById('previewGambar');
    const previewImg = document.getElementById('previewImg');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            previewDiv.style.display = 'block';
            gambarTerpilih = input.files[0];
            gambarPreviewUrl = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        previewDiv.style.display = 'none';
        gambarTerpilih = null;
        gambarPreviewUrl = null;
    }
}

function renderHome() {
    const totalMobilSpan = document.getElementById('totalMobil');
    const mobilTersediaSpan = document.getElementById('mobilTersedia');
    const mobilDisewaSpan = document.getElementById('mobilDisewa');
    const totalPenyewaanSpan = document.getElementById('totalPenyewaan');
    const popularContainer = document.getElementById('popularMobilContainer');
    const testimoniContainer = document.getElementById('testimoniContainer');

    if (totalMobilSpan) {
        totalMobilSpan.innerText = daftarMobil.length;
        mobilTersediaSpan.innerText = daftarMobil.filter(m => m.status === 'Tersedia').length;
        mobilDisewaSpan.innerText = daftarMobil.filter(m => m.status === 'Disewa').length;
        totalPenyewaanSpan.innerText = daftarPenyewaan.length;
    }

    if (popularContainer && daftarMobil.length > 0) {
        const mobilPopuler = daftarMobil.slice(0, 3);
        popularContainer.innerHTML = mobilPopuler.map(mobil => `
            <div class="mobil-card">
                <img src="${mobil.gambar}" alt="${mobil.nama}" onerror="this.style.src='https://placehold.co/400x250/1e4a76/white?text=${mobil.nama}'; console.log('Gambar gagal load: ${mobil.gambar}')">
                <div class="card-body">
                    <h4>${mobil.nama}</h4>
                    <div class="jenis">${mobil.jenis}</div>
                    <div class="harga">Rp ${mobil.harga.toLocaleString('id-ID')}<small>/hari</small></div>
                    <span class="status-badge ${mobil.status === 'Tersedia' ? 'status-tersedia' : 'status-disewa'}">${mobil.status}</span>
                </div>
            </div>
        `).join('');
    }

    if (testimoniContainer && daftarTestimoni.length > 0) {
        testimoniContainer.innerHTML = daftarTestimoni.map(t => `
            <div class="testimoni-card">
                <div class="rating">${'⭐'.repeat(t.rating)}${'☆'.repeat(5-t.rating)}</div>
                <div class="review-text">"${t.review}"</div>
                <div class="customer-name">- ${t.nama}</div>
                <div class="car-name">🚗 ${t.mobil}</div>
            </div>
        `).join('');
    }
}

function renderTabelMobil() {
    const container = document.getElementById('kelompokMobilContainer');
    if (!container) return;

    const searchTerm = document.getElementById('searchMobil')?.value.toLowerCase() || '';
    const filterStatus = document.getElementById('filterStatus')?.value || '';

    let filteredMobil = daftarMobil.filter(m => m.nama.toLowerCase().includes(searchTerm));
    if (filterStatus) filteredMobil = filteredMobil.filter(m => m.status === filterStatus);

    const jenisList = ['MPV', 'SUV', 'City Car', 'Sedan'];
    let html = '';

    for (const jenis of jenisList) {
        const mobilGroup = filteredMobil.filter(m => m.jenis === jenis);
        if (mobilGroup.length > 0) {
            html += `
                <div style="margin-top: 25px;">
                    <h3 style="color: var(--primary); margin-bottom: 15px; padding-left: 10px; border-left: 4px solid var(--primary);">
                        🚙 ${jenis} (${mobilGroup.length} mobil)
                    </h3>
                    <div class="table-container">
                        <table>
                            <thead><tr><th>No</th><th>Gambar</th><th>Nama Mobil</th><th>Jenis</th><th>Harga/Hari</th><th>Status</th><th>Aksi</th></tr></thead>
                            <tbody>
                                ${mobilGroup.map((mobil, idx) => `
                                    <tr>
                                        <td>${idx + 1}</td>
                                        <td><img src="${mobil.gambar}" style="width:50px; height:40px; object-fit:cover; border-radius:8px;" onerror="this.src='https://placehold.co/50x40/1e4a76/white?text=Mobil'"></td>
                                        <td><strong>${mobil.nama}</strong></td>
                                        <td>${mobil.jenis}</td>
                                        <td>Rp ${mobil.harga.toLocaleString('id-ID')}</td>
                                        <td><span class="status-badge ${mobil.status === 'Tersedia' ? 'status-tersedia' : 'status-disewa'}">${mobil.status}</span></td>
                                        <td>
                                            <button class="btn-warning" onclick="editMobil(${mobil.id})">✏️ Edit</button>
                                            <button class="btn-danger" onclick="deleteMobil(${mobil.id})">🗑️ Hapus</button>
                                        </td>
                                    </tr>
                                `).join('')}
                            </tbody>
                        </table>
                    </div>
                </div>
            `;
        }
    }

    if (filteredMobil.length === 0) html = '<p style="text-align:center; padding:40px;">Tidak ada data mobil</p>';
    container.innerHTML = html;
}

function renderMobilGalleryByJenis() {
    const filterJenis = document.getElementById('filterJenisMobil')?.value;
    const container = document.getElementById('mobilGalleryContainer');
    if (!container) return;

    if (!filterJenis) {
        container.innerHTML = '<p style="text-align:center; padding:40px;">🔍 Silakan pilih jenis mobil terlebih dahulu</p>';
        return;
    }

    const mobilTersedia = daftarMobil.filter(m => m.status === 'Tersedia' && m.jenis === filterJenis);
    if (mobilTersedia.length === 0) {
        container.innerHTML = `<p style="text-align:center; padding:40px;">Tidak ada mobil ${filterJenis} yang tersedia</p>`;
        return;
    }

    container.innerHTML = `<div class="gallery">${mobilTersedia.map(mobil => `
        <div class="mobil-card" onclick="selectMobil(${mobil.id}, '${mobil.nama}', ${mobil.harga})" data-id="${mobil.id}">
            <img src="${mobil.gambar}" alt="${mobil.nama}" onerror="this.src='https://placehold.co/400x250/1e4a76/white?text=${mobil.nama}'">
            <div class="card-body">
                <h4>${mobil.nama}</h4>
                <div class="jenis">${mobil.jenis}</div>
                <div class="harga">Rp ${mobil.harga.toLocaleString('id-ID')}<small>/hari</small></div>
            </div>
        </div>
    `).join('')}</div>`;
}

function filterMobil() { renderTabelMobil(); }

function selectMobil(id, nama, harga) {
    document.querySelectorAll('#mobilGalleryContainer .mobil-card').forEach(card => card.classList.remove('selected'));
    const selectedCard = document.querySelector(`#mobilGalleryContainer .mobil-card[data-id="${id}"]`);
    if (selectedCard) selectedCard.classList.add('selected');
    document.getElementById('selectedMobilId').value = id;
    document.getElementById('selectedMobilNama').value = nama;
    document.getElementById('selectedMobilHarga').value = harga;
    hitungTotalSewa();
    showToast(`Mobil ${nama} dipilih`);
}

function hitungTotalSewa() {
    const harga = parseInt(document.getElementById('selectedMobilHarga')?.value || 0);
    const lama = parseInt(document.getElementById('lamaSewa')?.value || 0);
    const totalSpan = document.getElementById('totalHarga');
    if (harga > 0 && lama > 0) totalSpan.innerText = `Rp ${(harga * lama).toLocaleString('id-ID')}`;
    else totalSpan.innerText = 'Rp 0';
}

function renderRiwayatSewa() {
    const tbody = document.getElementById('riwayatSewaBody');
    if (!tbody) return;
    if (daftarPenyewaan.length === 0) {
        tbody.innerHTML = '<tr><td colspan="7" style="text-align:center">Belum ada riwayat penyewaan</td></tr>';
        return;
    }
    tbody.innerHTML = daftarPenyewaan.map((sewa, index) => `
        <tr><td>${index + 1}</td><td>${sewa.namaPenyewa}</td><td>${sewa.namaMobil}</td>
        <td>${sewa.tanggalSewa}</td><td>${sewa.lamaSewa} hari</td>
        <td>Rp ${sewa.total.toLocaleString('id-ID')}</td>
        <td><span class="status-badge status-tersedia">Aktif</span></td></tr>
    `).join('');
}

function openMobilModal() {
    editingMobilId = null;
    document.getElementById('modalMobilTitle').innerText = 'Tambah Mobil Baru';
    document.getElementById('formMobil').reset();
    document.getElementById('mobilId').value = '';
    document.getElementById('previewGambar').style.display = 'none';
    gambarTerpilih = null;
    gambarPreviewUrl = null;
    document.getElementById('modalMobil').style.display = 'flex';
}

function closeMobilModal() { document.getElementById('modalMobil').style.display = 'none'; }

function editMobil(id) {
    const mobil = daftarMobil.find(m => m.id === id);
    if (!mobil) return;
    editingMobilId = id;
    document.getElementById('modalMobilTitle').innerText = 'Edit Mobil';
    document.getElementById('mobilId').value = mobil.id;
    document.getElementById('namaMobil').value = mobil.nama;
    document.getElementById('jenisMobil').value = mobil.jenis;
    document.getElementById('hargaMobil').value = mobil.harga;
    document.getElementById('statusMobil').value = mobil.status;
    if (mobil.gambar) {
        document.getElementById('previewImg').src = mobil.gambar;
        document.getElementById('previewGambar').style.display = 'block';
        gambarPreviewUrl = mobil.gambar;
    }
    document.getElementById('modalMobil').style.display = 'flex';
}

function deleteMobil(id) {
    if (confirm('Yakin ingin menghapus mobil ini?')) {
        daftarMobil = daftarMobil.filter(m => m.id !== id);
        saveMobil();
        renderTabelMobil();
        renderHome();
        renderMobilGalleryByJenis();
        showToast('Mobil berhasil dihapus');
    }
}

function simpanGambarSebagaiBase64(file) {
    return new Promise((resolve, reject) => {
        if (!file) { resolve(null); return; }
        const reader = new FileReader();
        reader.onload = e => resolve(e.target.result);
        reader.onerror = e => reject(e);
        reader.readAsDataURL(file);
    });
}

document.getElementById('formMobil')?.addEventListener('submit', async function(e) {
    e.preventDefault();
    const id = document.getElementById('mobilId').value;
    const nama = document.getElementById('namaMobil').value.trim();
    const jenis = document.getElementById('jenisMobil').value;
    const harga = parseInt(document.getElementById('hargaMobil').value);
    const status = document.getElementById('statusMobil').value;
    const fileGambar = document.getElementById('gambarMobil').files[0];

    let gambarBase64 = null;
    if (fileGambar) gambarBase64 = await simpanGambarSebagaiBase64(fileGambar);
    else if (gambarPreviewUrl && gambarPreviewUrl.startsWith('data:image')) gambarBase64 = gambarPreviewUrl;
    else if (!gambarBase64) gambarBase64 = `https://placehold.co/400x250/1e4a76/white?text=${encodeURIComponent(nama)}`;

    if (id) {
        const index = daftarMobil.findIndex(m => m.id === parseInt(id));
        if (index !== -1) daftarMobil[index] = { ...daftarMobil[index], nama, jenis, harga, status, gambar: gambarBase64 };
        showToast('Mobil berhasil diupdate');
    } else {
        daftarMobil.push({ id: nextIdMobil++, nama, jenis, harga, status, gambar: gambarBase64 });
        showToast('Mobil berhasil ditambahkan');
    }
    saveMobil();
    renderTabelMobil();
    renderHome();
    renderMobilGalleryByJenis();
    closeMobilModal();
});

document.getElementById('gambarMobil')?.addEventListener('change', e => previewGambarFile(e.target));

function initFormSewa() {
    const filterJenis = document.getElementById('filterJenisMobil');
    const lamaInput = document.getElementById('lamaSewa');
    const tanggalInput = document.getElementById('tanggalSewa');
    const formSewa = document.getElementById('formSewa');

    if (tanggalInput) tanggalInput.min = new Date().toISOString().split('T')[0];
    if (lamaInput) lamaInput.addEventListener('input', hitungTotalSewa);
    if (filterJenis) filterJenis.addEventListener('change', () => {
        renderMobilGalleryByJenis();
        document.getElementById('selectedMobilId').value = '';
        document.getElementById('selectedMobilNama').value = '';
        document.getElementById('selectedMobilHarga').value = '';
        document.getElementById('totalHarga').innerText = 'Rp 0';
    });

    if (formSewa) formSewa.addEventListener('submit', function(e) {
        e.preventDefault();
        const mobilId = document.getElementById('selectedMobilId')?.value;
        const mobilNama = document.getElementById('selectedMobilNama')?.value;
        const mobilHarga = parseInt(document.getElementById('selectedMobilHarga')?.value || 0);
        const namaPenyewa = document.getElementById('namaPenyewa')?.value.trim();
        const emailPenyewa = document.getElementById('emailPenyewa')?.value.trim();
        const telpPenyewa = document.getElementById('telpPenyewa')?.value.trim();
        const tanggalSewa = document.getElementById('tanggalSewa')?.value;
        const lamaSewa = parseInt(document.getElementById('lamaSewa')?.value);

        if (!mobilId) { showToast('Pilih mobil dulu!', true); return; }
        if (!namaPenyewa || !emailPenyewa || !telpPenyewa || !tanggalSewa || !lamaSewa) { showToast('Isi semua field!', true); return; }
        if (!emailPenyewa.includes('@')) { showToast('Email tidak valid!', true); return; }
        if (telpPenyewa.length < 10 || telpPenyewa.length > 13) { showToast('No telepon 10-13 digit!', true); return; }

        const total = mobilHarga * lamaSewa;
        daftarPenyewaan.push({ id: Date.now(), namaPenyewa, emailPenyewa, telpPenyewa, mobilId: parseInt(mobilId), namaMobil: mobilNama, tanggalSewa, lamaSewa, total, tanggalTransaksi: new Date().toISOString() });
        savePenyewaan();

        const mobilIndex = daftarMobil.findIndex(m => m.id === parseInt(mobilId));
        if (mobilIndex !== -1) { daftarMobil[mobilIndex].status = 'Disewa'; saveMobil(); }

        daftarTestimoni.unshift({ id: Date.now(), nama: namaPenyewa, mobil: mobilNama, rating: 5, review: `Penyewaan mobil ${mobilNama} berhasil!` });
        saveTestimoni();

        document.getElementById('pesanSukses').innerHTML = `🎉 Terima kasih, ${namaPenyewa}! Total: Rp ${total.toLocaleString('id-ID')}`;
        document.getElementById('pesanSukses').style.display = 'block';
        setTimeout(() => document.getElementById('pesanSukses').style.display = 'none', 5000);

        formSewa.reset();
        document.getElementById('totalHarga').innerText = 'Rp 0';
        if (filterJenis) filterJenis.value = '';
        document.getElementById('mobilGalleryContainer').innerHTML = '<p style="text-align:center; padding:40px;">🔍 Pilih jenis mobil dulu</p>';
        showToast('Penyewaan berhasil!');
        renderTabelMobil();
        renderHome();
        renderRiwayatSewa();
    });
}

function toggleDarkMode() {
    document.body.classList.toggle('dark-mode');
    localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
    const btn = document.getElementById('darkModeBtn');
    if (btn) btn.innerHTML = document.body.classList.contains('dark-mode') ? '☀️' : '🌙';
}

function loadDarkModePreference() {
    if (localStorage.getItem('darkMode') === 'true') {
        document.body.classList.add('dark-mode');
        const btn = document.getElementById('darkModeBtn');
        if (btn) btn.innerHTML = '☀️';
    }
}

function initScrollToTop() {
    const btn = document.getElementById('scrollToTop');
    if (!btn) return;
    window.addEventListener('scroll', () => btn.style.display = window.scrollY > 300 ? 'flex' : 'none');
    btn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
}

function setActiveNav() {
    const page = window.location.pathname.split('/').pop() || 'index.html';
    document.querySelectorAll('nav a').forEach(link => {
        if (link.getAttribute('href') === page) link.classList.add('active');
        else link.classList.remove('active');
    });
}

document.addEventListener('DOMContentLoaded', function() {
    console.log('DriveNow Loaded!');
    loadData();
    loadDarkModePreference();
    setActiveNav();
    initScrollToTop();
    renderHome();
    renderTabelMobil();
    renderRiwayatSewa();
    initFormSewa();
    window.onclick = e => { if (e.target === document.getElementById('modalMobil')) closeMobilModal(); };
});
