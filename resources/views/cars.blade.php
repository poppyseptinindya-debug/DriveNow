@extends('layouts.app')

@section('title', 'DriveNow | Kelola Mobil')
@section('active-cars', 'class="active"')

@section('content')
<div class="section-title">
    <h2>Daftar Mobil</h2>
    <button class="btn-primary" onclick="openMobilModal()">+ Tambah Mobil</button>
</div>

<div class="search-bar">
    <input type="text" id="searchMobil" placeholder="🔍 Cari mobil...">
    <select id="filterStatus">
        <option value="">Semua Status</option>
        <option value="Tersedia">Tersedia</option>
        <option value="Disewa">Disewa</option>
    </select>
</div>

<div id="kelompokMobilContainer" class="gallery">
    <p>Loading data mobil...</p>
</div>

<!-- Modal Tambah/Edit Mobil -->
<div id="modalMobil" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="modalMobilTitle">Tambah Mobil</h3>
            <span class="close-modal" onclick="closeMobilModal()">&times;</span>
        </div>
        <form id="formMobil">
            <input type="hidden" id="mobilId">
            <div class="form-group">
                <label>Nama Mobil</label>
                <input type="text" id="namaMobil" required>
            </div>
            <div class="form-group">
                <label>Jenis Mobil</label>
                <select id="jenisMobil" required>
                    <option value="MPV">MPV</option>
                    <option value="SUV">SUV</option>
                    <option value="City Car">City Car</option>
                    <option value="Sedan">Sedan</option>
                </select>
            </div>
            <div class="form-group">
                <label>Harga per Hari</label>
                <input type="number" id="hargaMobil" required>
            </div>
            <div class="form-group">
                <label>Status</label>
                <select id="statusMobil" required>
                    <option value="Tersedia">Tersedia</option>
                    <option value="Disewa">Disewa</option>
                </select>
            </div>
            <div class="form-group">
                <label>Gambar</label>
                <input type="file" id="gambarMobil" accept="image/*">
            </div>
            <button type="submit" class="btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    console.log('Halaman Kelola Mobil loaded');

    let mobilData = JSON.parse(localStorage.getItem('mobil')) || [];

    function displayMobil() {
        let container = document.getElementById('kelompokMobilContainer');
        container.innerHTML = '';

        if(mobilData.length === 0) {
            container.innerHTML = '<p>Belum ada data mobil</p>';
            return;
        }

        mobilData.forEach(mobil => {
            let card = document.createElement('div');
            card.className = 'mobil-card';
            card.innerHTML = `
                <img src="${mobil.gambar || 'https://placehold.co/300x170'}" alt="${mobil.nama}">
                <div class="card-body">
                    <h4>${mobil.nama}</h4>
                    <p class="jenis">${mobil.jenis}</p>
                    <p class="harga">Rp ${mobil.harga.toLocaleString('id-ID')}</p>
                    <span class="status-badge status-${mobil.status.toLowerCase()}">${mobil.status}</span>
                    <div style="margin-top: 10px;">
                        <button class="btn-warning" onclick="editMobil(${mobil.id})">Edit</button>
                        <button class="btn-danger" onclick="deleteMobil(${mobil.id})">Hapus</button>
                    </div>
                </div>
            `;
            container.appendChild(card);
        });
    }

    function openMobilModal() {
        document.getElementById('modalMobil').style.display = 'flex';
        document.getElementById('modalMobilTitle').innerText = 'Tambah Mobil';
        document.getElementById('formMobil').reset();
        document.getElementById('mobilId').value = '';
    }

    function closeMobilModal() {
        document.getElementById('modalMobil').style.display = 'none';
    }

    function editMobil(id) {
        let mobil = mobilData.find(m => m.id === id);
        document.getElementById('modalMobil').style.display = 'flex';
        document.getElementById('modalMobilTitle').innerText = 'Edit Mobil';
        document.getElementById('mobilId').value = mobil.id;
        document.getElementById('namaMobil').value = mobil.nama;
        document.getElementById('jenisMobil').value = mobil.jenis;
        document.getElementById('hargaMobil').value = mobil.harga;
        document.getElementById('statusMobil').value = mobil.status;
    }

    function deleteMobil(id) {
        if(confirm('Yakin hapus mobil ini?')) {
            mobilData = mobilData.filter(m => m.id !== id);
            localStorage.setItem('mobil', JSON.stringify(mobilData));
            displayMobil();
            alert('Mobil berhasil dihapus!');
        }
    }

    document.getElementById('formMobil').addEventListener('submit', function(e) {
        e.preventDefault();

        let id = document.getElementById('mobilId').value;
        let mobilBaru = {
            id: id ? parseInt(id) : Date.now(),
            nama: document.getElementById('namaMobil').value,
            jenis: document.getElementById('jenisMobil').value,
            harga: parseInt(document.getElementById('hargaMobil').value),
            status: document.getElementById('statusMobil').value,
            gambar: 'https://placehold.co/300x170'
        };

        if(id) {
            let index = mobilData.findIndex(m => m.id === parseInt(id));
            mobilData[index] = mobilBaru;
            alert('Mobil berhasil diupdate!');
        } else {
            mobilData.push(mobilBaru);
            alert('Mobil berhasil ditambahkan!');
        }

        localStorage.setItem('mobil', JSON.stringify(mobilData));
        closeMobilModal();
        displayMobil();
    });

    displayMobil();
</script>
@endpush
