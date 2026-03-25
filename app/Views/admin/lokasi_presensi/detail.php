<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="mb-4">
        <a href="<?= base_url('Admin/lokasi_presensi') ?>" class="text-decoration-none text-muted small d-flex align-items-center gap-2 mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
            </svg>
            Kembali ke Daftar Lokasi
        </a>
        <h4 class="text-dark fw-bold">Detail Lokasi: <span class="text-primary"><?= $lokasi_presensi['nama_lokasi'] ?></span> 📍</h4>
    </div>

    <div class="row">
        <div class="col-md-5 mb-4">
            <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                <div class="card-body p-4">
                    <h6 class="text-muted text-uppercase small fw-bold mb-4" style="letter-spacing: 1px;">Informasi Titik Presensi</h6>
                    
                    <div class="detail-info">
                        <div class="d-flex justify-content-between py-2 border-bottom border-light">
                            <span class="text-muted">Tipe Lokasi</span>
                            <span class="fw-bold text-dark badge bg-soft-primary"><?= $lokasi_presensi['tipe_lokasi'] ?></span>
                        </div>
                        <div class="py-2 border-bottom border-light">
                            <span class="text-muted d-block mb-1">Alamat Lengkap</span>
                            <span class="fw-bold text-dark small"><?= $lokasi_presensi['alamat_lokasi'] ?></span>
                        </div>
                        <div class="row">
                            <div class="col-6 py-2 border-bottom border-light">
                                <span class="text-muted d-block mb-1">Latitude</span>
                                <span class="fw-medium text-dark"><?= $lokasi_presensi['latitude'] ?></span>
                            </div>
                            <div class="col-6 py-2 border-bottom border-light border-start">
                                <span class="text-muted d-block mb-1 ms-2">Longitude</span>
                                <span class="fw-medium text-dark ms-2"><?= $lokasi_presensi['longitude'] ?></span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between py-2 border-bottom border-light">
                            <span class="text-muted">Radius Jangkauan</span>
                            <span class="fw-bold text-danger"><?= $lokasi_presensi['radius'] ?> Meter</span>
                        </div>
                        <div class="d-flex justify-content-between py-2 border-bottom border-light">
                            <span class="text-muted">Zona Waktu</span>
                            <span class="fw-bold text-dark"><?= $lokasi_presensi['zona_waktu'] ?></span>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6 text-center p-3 bg-light rounded-start border-end">
                                <span class="text-muted d-block small uppercase fw-bold">Jam Masuk</span>
                                <span class="text-primary fw-bold fs-5"><?= $lokasi_presensi['jam_masuk'] ?></span>
                            </div>
                            <div class="col-6 text-center p-3 bg-light rounded-end">
                                <span class="text-muted d-block small uppercase fw-bold">Jam Pulang</span>
                                <span class="text-primary fw-bold fs-5"><?= $lokasi_presensi['jam_pulang'] ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 d-grid gap-2">
                         <a href="<?= base_url('Admin/lokasi_presensi/edit/' . $lokasi_presensi['id']) ?>" class="btn btn-primary fw-bold py-2" style="border-radius: 12px;">Ubah Data Lokasi</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 20px;">
                <div class="card-header bg-white py-3 border-0">
                    <h6 class="mb-0 fw-bold"><i class="bi bi-map me-2"></i>Pratinjau Jangkauan Kantor</h6>
                </div>
                <div id="map" style="height: 500px; width: 100%; z-index: 1;"></div>
            </div>
            
            <div class="alert alert-info mt-3 border-0 shadow-sm d-flex align-items-center" style="border-radius: 15px;">
                <span class="fs-4 me-3">💡</span>
                <small>Area berwarna merah menunjukkan zona jangkauan dimana pegawai diperbolehkan melakukan presensi.</small>
            </div>
        </div>
    </div>
</div>

<style>
    /* Styling Badge Soft */
    .bg-soft-primary {
        background-color: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
    }

    /* Hilangkan outline leaflet yang mengganggu estetika */
    .leaflet-container {
        font-family: 'Poppins', sans-serif;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Inisialisasi Map
        var lat = <?= $lokasi_presensi['latitude'] ?>;
        var lng = <?= $lokasi_presensi['longitude'] ?>;
        var rad = <?= $lokasi_presensi['radius'] ?>;

        var map = L.map('map').setView([lat, lng], 16);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap'
        }).addTo(map);

        // Tambahkan Circle Radius Kantor
        var circle = L.circle([lat, lng], {
            color: '#ff4d4d',
            fillColor: '#ff4d4d',
            fillOpacity: 0.2,
            weight: 2,
            radius: rad
        }).addTo(map);

        // Tambahkan Marker Kantor Custom (Emoji atau default)
        L.marker([lat, lng])
            .addTo(map)
            .bindPopup("<b>Titik Utama Kantor</b><br><?= $lokasi_presensi['nama_lokasi'] ?>")
            .openPopup();
            
        // Paksa map untuk resize
        setTimeout(function() {
            map.invalidateSize();
        }, 500);
    });
</script>

<?= $this->endSection() ?>