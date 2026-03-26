<?= $this->extend('pegawai/layout.php') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>

<style>
    :root {
        --mps-navy: #001180;
        --mps-red: #ed1c24;
        --mps-light: #f4f7fe;
    }

    .camera-container {
        max-width: 550px;
        margin: 0 auto;
    }

    .card-camera {
        border: none;
        border-radius: 20px;
        background: #fff;
        border-top: 5px solid var(--mps-navy);
        overflow: hidden;
    }

    /* Info Bar Styling */
    .attendance-meta {
        background: var(--mps-light);
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid #e2e8f0;
    }

    .meta-item {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .meta-label {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        font-weight: 700;
    }

    .meta-value {
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--mps-navy);
    }

    /* Webcam Frame */
    #my_camera {
        border-radius: 15px;
        overflow: hidden;
        margin: 0 auto;
        border: 4px solid #fff;
        outline: 1px solid #e2e8f0;
        box-shadow: 0 10px 25px rgba(0, 17, 128, 0.08);
        transform: scaleX(-1);
    }

    #my_camera video {
        border-radius: 10px;
        width: 100% !important;
        height: auto !important;
    }

    .btn-mps-capture {
        background-color: var(--mps-navy);
        color: white;
        border: none;
        padding: 14px;
        border-radius: 12px;
        font-weight: 700;
        width: 100%;
        transition: all 0.3s;
    }

    .btn-mps-capture:hover {
        background-color: #000a4d;
        transform: translateY(-2px);
    }

    .live-indicator {
        display: inline-block;
        width: 8px;
        height: 8px;
        background: var(--mps-red);
        border-radius: 50%;
        margin-right: 5px;
        animation: pulse-red 2s infinite;
    }

    @keyframes pulse-red {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(237, 28, 36, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(237, 28, 36, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(237, 28, 36, 0); }
    }
</style>

<div class="container py-4">
    <div class="camera-container animate__animated animate__fadeInUp">
        
        <div class="card card-camera shadow-lg">
            <div class="card-body p-4">
                
                <div class="d-flex align-items-center mb-4">
                    <div class="flex-shrink-0 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                        <i class="bi bi-person-bounding-box fs-4"></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0 fw-bold text-dark"><?= session()->get('nama') ?></h6>
                        <small class="text-muted">Konfirmasi kehadiran Anda</small>
                    </div>
                    <div class="ms-auto text-end">
                        <span class="badge bg-light text-primary border"><span class="live-indicator"></span>LIVE</span>
                    </div>
                </div>

                <div class="attendance-meta">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="meta-item">
                                <span class="meta-label">Tanggal</span>
                                <span class="meta-value"><?= date('d M Y') ?></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="meta-item">
                                <span class="meta-label">Jam Presensi</span>
                                <span class="meta-value" id="realtime-clock">00:00:00</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="meta-item mt-2 pt-2 border-top">
                                <span class="meta-label"><i class="bi bi-geo-alt-fill text-danger"></i> Titik Presensi</span>
                                <span class="meta-value"><?= $lokasi_presensi ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="id_pegawai" id="id_pegawai" value="<?= $id_pegawai ?>">
                <input type="hidden" name="tanggal_masuk" id="tanggal_masuk" value="<?= $tanggal_masuk ?>">
                <input type="hidden" name="jam_masuk" id="jam_masuk" value="<?= $jam_masuk ?>">

                <div id="my_camera" class="mb-4"></div>
                
                <div style="display: none;" id="my_result"></div>

                <button class="btn btn-mps-capture shadow-sm mb-3" id="ambil_foto">
                    <i class="bi bi-camera-fill me-2"></i>Ambil Foto & Kirim
                </button>

                <p class="text-center text-muted mb-0" style="font-size: 0.75rem;">
                    Sistem mencatat lokasi koordinat secara otomatis.
                </p>
            </div>
        </div>

        <div class="text-center mt-3">
            <a href="<?= base_url('Pegawai/home') ?>" class="text-muted text-decoration-none small">
                <i class="bi bi-x-circle me-1"></i> Batalkan Presensi
            </a>
        </div>
    </div>
</div>

<script>
    // --- Realtime Clock ---
    function updateClock() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('id-ID', { hour12: false });
        document.getElementById('realtime-clock').textContent = timeString;
    }
    setInterval(updateClock, 1000);
    updateClock();

    // --- Konfigurasi Webcam ---
    Webcam.set({
        width: 420,
        height: 340,
        dest_width: 420,
        dest_height: 340,
        image_format: 'jpeg',
        jpeg_quality: 90,
        force_flash: false,
        flip_horiz: true,
    });

    Webcam.attach('#my_camera');

    document.getElementById('ambil_foto').addEventListener('click', function(){
        let id = document.getElementById('id_pegawai').value;
        let tanggal_masuk = document.getElementById('tanggal_masuk').value;
        let jam_masuk = document.getElementById('jam_masuk').value;
        
        this.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Mengirim...';
        this.disabled = true;

        Webcam.snap(function(data_uri){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    window.location.href = '<?= base_url('Pegawai/home') ?>';
                }
            };
            xhttp.open("POST", "<?= base_url('Pegawai/presensi_masuk_aksi') ?>", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(
                'foto_masuk=' + encodeURIComponent(data_uri) + 
                '&id_pegawai=' + id +
                '&tanggal_masuk=' + tanggal_masuk +
                '&jam_masuk=' + jam_masuk
            );
        });
    });
</script>

<?= $this->endSection() ?>