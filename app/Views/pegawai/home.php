<?= $this->extend('pegawai/layout.php') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    /* Gradient soft untuk aksen kartu */
    .bg-gradient-navy {
        background: linear-gradient(135deg, #000066 0%, #001180 100%);
    }
    
    .bg-gradient-red {
        background: linear-gradient(135deg, #ff0000 0%, #cc0000 100%);
    }

    /* Greeting Section */
    .welcome-text h2 {
        color: var(--mps-navy);
        font-weight: 800;
        letter-spacing: -1px;
    }

    /* Digital Clock - Modern Glassmorphism Look */
    .clock-container {
        background: #f8faff;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        padding: 20px;
        text-align: center;
        margin-bottom: 25px;
        position: relative;
        overflow: hidden;
    }

    .clock-container::before {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 4px; height: 100%;
        background: var(--mps-red);
    }

    .parent-clock {
        display: flex;
        justify-content: center;
        align-items: baseline;
        font-size: 3rem;
        font-weight: 800;
        color: var(--mps-navy);
        font-family: 'Inter', sans-serif;
        gap: 5px;
    }

    .clock-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: #94a3b8;
        font-weight: 700;
    }

    /* Presence Cards */
    .card-presensi {
        border: none;
        border-radius: 24px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        background: #fff;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,102,0.05) !important;
    }

    .card-presensi:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,102,0.1) !important;
    }

    .icon-box {
        width: 70px;
        height: 70px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 30px;
    }

    .btn-mps {
        border-radius: 15px;
        padding: 14px;
        font-weight: 700;
        transition: all 0.3s;
        border: none;
        letter-spacing: 0.5px;
    }

    .btn-mps-primary {
        background: var(--mps-navy);
        color: white;
    }

    .btn-mps-danger {
        background: var(--mps-red);
        color: white;
    }

    .btn-mps:disabled {
        background: #e2e8f0;
        color: #94a3b8;
    }

    /* Map Enhancement */
    #map { 
        height: 380px; 
        width: 100%;
        border-radius: 24px;
        z-index: 1;
        border: 5px solid #fff;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    }

    .info-radius-card {
        background: #fff8e1;
        border-left: 5px solid #ffc107;
        border-radius: 15px;
    }

</style>

<div class="container-fluid">
    <div class="row mb-2 animate__animated animate__fadeIn">
        <div class="col-12 welcome-text">
            <h2 class="mb-0">Halo, Selamat Bekerja! 👋</h2>
            <p class="text-muted">Pantau kehadiran dan lokasi Anda secara real-time.</p>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12 animate__animated animate__zoomIn">
            <div class="clock-container" style="padding: 15px; margin-bottom: 10px;"> <div class="clock-label">Waktu Saat Ini</div>
                <div class="parent-clock" style="font-size: 2.5rem;">
                    <span id="jam-masuk">00</span><span class="animate__animated animate__flash animate__infinite">:</span>
                    <span id="menit-masuk">00</span><span class="animate__animated animate__flash animate__infinite">:</span>
                    <span id="detik-masuk">00</span>
                </div>
                <p class="text-muted small mb-0 fw-bold"><?= date('l, d F Y') ?></p>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-xl-4 col-md-6">
            <div class="card card-presensi h-100">
                <div class="card-body text-center p-4">
                    <?php if($cek_presensi < 1) : ?>
                        <div class="icon-box bg-primary bg-opacity-10 text-primary">
                            <i class="bi bi-box-arrow-in-right"></i>
                        </div>
                        <h5 class="fw-800 text-dark mb-2">Presensi Masuk</h5>
                        <p class="text-muted small mb-4">Silakan klik tombol di bawah untuk memulai hari Anda.</p>
                        
                        <form method="POST" action="<?= base_url('Pegawai/presensi_masuk') ?>">
                            <input type="hidden" name="latitude_pegawai" id="latitude_pegawai">
                            <input type="hidden" name="longitude_pegawai" id="longitude_pegawai">
                            <input type="hidden" name="id_pegawai" value="<?= session()->get('id_pegawai') ?>" > 
                            <button class="btn btn-mps btn-mps-primary w-100 shadow-sm">
                                <i class="bi bi-geo-alt-fill me-2"></i>Absen Masuk
                            </button>
                        </form>
                    <?php else : ?>
                        <div class="icon-box bg-success bg-opacity-10 text-success animate__animated animate__bounceIn">
                            <i class="bi bi-check2-circle"></i>
                        </div>
                        <h5 class="fw-800 text-dark mb-2">Berhasil Masuk</h5>
                        <p class="text-muted small mb-4">Semangat! Kamu sudah tercatat hadir hari ini.</p>
                        <div class="badge bg-success bg-opacity-10 text-success p-2 px-3 rounded-pill">
                            <i class="bi bi-shield-check me-1"></i> Sesi Aktif
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="card card-presensi h-100">
                <div class="card-body text-center p-4">
                    <?php if($cek_presensi < 1) : ?>
                        <div class="icon-box bg-light text-muted opacity-50">
                            <i class="bi bi-lock-fill"></i>
                        </div>
                        <h5 class="fw-800 text-muted mb-2">Presensi Keluar</h5>
                        <p class="text-muted small mb-0">Tersedia setelah Anda melakukan presensi masuk.</p>

                    <?php elseif($cek_presensi_keluar > 0) : ?>
                        <div class="icon-box bg-warning bg-opacity-10 text-warning">
                            <i class="bi bi-house-door-fill"></i>
                        </div>
                        <h5 class="fw-800 text-dark mb-2">Selesai Bekerja</h5>
                        <p class="text-muted small mb-4">Hati-hati di jalan, sampai jumpa besok!</p>
                        <div class="badge bg-warning bg-opacity-10 text-warning p-2 px-3 rounded-pill">
                            <i class="bi bi-moon-stars me-1"></i> Sudah Pulang
                        </div>

                    <?php else : ?>
                        <div class="icon-box bg-danger bg-opacity-10 text-danger">
                            <i class="bi bi-box-arrow-right"></i>
                        </div>
                        <h5 class="fw-800 text-dark mb-2">Presensi Keluar</h5>
                        <p class="text-muted small mb-4">Pastikan semua laporan pekerjaan sudah selesai.</p>

                        <span id="jam-keluar" class="d-none"></span><span id="menit-keluar" class="d-none"></span><span id="detik-keluar" class="d-none"></span>

                        <form method="POST" action="<?= base_url('Pegawai/presensi_keluar/' . $ambil_presensi_masuk['id']) ?>">
                            <input type="hidden" name="latitude_pegawai" id="latitude_pegawai_keluar">
                            <input type="hidden" name="longitude_pegawai" id="longitude_pegawai_keluar">
                            <input type="hidden" name="tanggal_keluar" value="<?= date('Y-m-d') ?>">
                            <input type="hidden" name="jam_keluar" value="<?= date('H:i:s') ?>">
                            <button class="btn btn-mps btn-mps-danger w-100 shadow-sm">
                                <i class="bi bi-power me-2"></i>Absen Keluar
                            </button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-12">
            <div class="card border-0 shadow-sm rounded-4 h-100 info-radius-card">
                <div class="card-body p-4">
                    <h6 class="fw-800 mb-3 text-dark"><i class="bi bi-info-circle-fill me-2 text-warning"></i> Aturan Lokasi</h6>
                    <p class="small text-muted mb-3">Anda wajib berada dalam radius <strong><?= $lokasi_presensi['radius'] ?> meter</strong> dari titik kantor.</p>
                    
                    <div class="p-3 bg-white rounded-4 border border-warning border-opacity-25 shadow-sm">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-pin-map-fill text-danger me-2"></i>
                            <span class="small fw-bold text-dark"><?= $lokasi_presensi['nama_lokasi'] ?></span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-broadcast text-primary me-2"></i>
                            <span class="small text-muted">Akurasi GPS sangat disarankan.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12 text-center mb-3">
            <h5 class="fw-800 text-dark mb-1">Peta Lokasi Anda</h5>
            <div class="mx-auto" style="width: 50px; height: 3px; background: var(--mps-red); border-radius: 10px;"></div>
        </div>
        <div class="col-12"> 
            <div id="map"></div>
        </div>
    </div>
</div>

<script>
    // Logika Jam Tetap Sama (Hanya visual yang diubah di HTML)
    window.setInterval("waktu()", 1000);
    function waktu() {
        const sekarang = new Date();
        const h = formatWaktu(sekarang.getHours());
        const m = formatWaktu(sekarang.getMinutes());
        const s = formatWaktu(sekarang.getSeconds());
        
        document.getElementById("jam-masuk").innerHTML = h;
        document.getElementById("menit-masuk").innerHTML = m;
        document.getElementById("detik-masuk").innerHTML = s;

        // Update hidden clock jika ada
        const elJamK = document.getElementById("jam-keluar");
        if(elJamK){ elJamK.innerHTML = h; document.getElementById("menit-keluar").innerHTML = m; document.getElementById("detik-keluar").innerHTML = s; }
    }
    function formatWaktu(w) { return (w < 10) ? "0" + w : w; }
</script>

<script>
    var map;
    const officeLat = <?= $lokasi_presensi['latitude'] ?>;
    const officeLong = <?= $lokasi_presensi['longitude'] ?>;
    const officeRadius = <?= $lokasi_presensi['radius'] ?>;

    // FIX: Mengatasi marker hilang/pecah pada Leaflet
    delete L.Icon.Default.prototype._getIconUrl;
    L.Icon.Default.mergeOptions({
        iconRetinaUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-icon-2x.png',
        iconUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-icon.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
    });

    function getLocation(){
        if(navigator.geolocation){
            navigator.geolocation.getCurrentPosition(showPosition, function(error) {
                Swal.fire({ icon: 'error', title: 'GPS Tidak Aktif', text: 'Tolong aktifkan GPS Anda!', confirmButtonColor: '#000066' });
            });
        }
    }

    function showPosition(position){
        var lat_peg = position.coords.latitude;
        var long_peg = position.coords.longitude;

        if(document.getElementById('latitude_pegawai')) {
            document.getElementById('latitude_pegawai').value = lat_peg;
            document.getElementById('longitude_pegawai').value = long_peg;
        }
        if(document.getElementById('latitude_pegawai_keluar')) {
            document.getElementById('latitude_pegawai_keluar').value = lat_peg;
            document.getElementById('longitude_pegawai_keluar').value = long_peg;
        }
        
        var officeLoc = L.latLng(officeLat, officeLong);
        var userLoc = L.latLng(lat_peg, long_peg);
        var distance = userLoc.distanceTo(officeLoc); 

        initMap(lat_peg, long_peg, distance);
    }

    function initMap(lat_peg, long_peg, distance){
        if (map !== undefined) { map.remove(); }
        map = L.map('map').setView([officeLat, officeLong], 17);
        
        L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; CartoDB'
        }).addTo(map);

        L.circle([officeLat, officeLong], {
            color: (distance <= officeRadius) ? '#2ecc71' : '#ed1c24',
            fillColor: (distance <= officeRadius) ? '#2ecc71' : '#ed1c24',
            fillOpacity: 0.1,
            radius: officeRadius,
            weight: 2
        }).addTo(map);

        var officeIcon = L.divIcon({
            html: '<i class="bi bi-building-fill text-danger" style="font-size: 30px;"></i>',
            iconSize: [30, 30],
            className: 'border-0 bg-transparent'
        });
        // Marker Kantor
        L.marker([officeLat, officeLong], {icon: officeIcon}).addTo(map)
            .bindPopup("<b>Kantor:</b><br><?= $lokasi_presensi['nama_lokasi'] ?>")
            .openPopup();

        var userMarker = L.marker([lat_peg, long_peg]).addTo(map)
            .bindPopup("<b>Jarak:</b> " + Math.round(distance) + "m dari kantor")
            .openPopup();

        const btnMasuk = document.querySelector('.btn-mps-primary');
        const btnKeluar = document.querySelector('.btn-mps-danger');

        if (distance > officeRadius) {
            if(btnMasuk) { 
                btnMasuk.disabled = true; 
                btnMasuk.classList.replace('btn-mps-primary', 'btn-secondary');
                btnMasuk.innerHTML = '<i class="bi bi-exclamation-triangle-fill me-2"></i>Di Luar Radius'; 
            }
            if(btnKeluar) { 
                btnKeluar.disabled = true; 
                btnKeluar.classList.replace('btn-mps-danger', 'btn-secondary');
                btnKeluar.innerHTML = '<i class="bi bi-exclamation-triangle-fill me-2"></i>Di Luar Radius'; 
            }
        }

        setTimeout(function() { map.invalidateSize(); }, 500);
    }

    window.onload = function() { getLocation(); };
</script>

<?= $this->endSection() ?>