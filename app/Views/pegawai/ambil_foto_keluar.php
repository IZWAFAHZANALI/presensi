<?= $this->extend('pegawai/layout.php') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>

<style>
    :root {
        --mps-navy: #001180;
        --mps-red: #ed1c24;
        --mps-light: #fef2f2; /* Light red tint for exit page */
    }

    .camera-container {
        max-width: 550px;
        margin: 0 auto;
    }

    .card-camera {
        border: none;
        border-radius: 20px;
        background: #fff;
        border-top: 5px solid var(--mps-red); /* Merah untuk Keluar */
        overflow: hidden;
    }

    /* Info Bar Styling */
    .attendance-meta {
        background: #f8fafc;
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
        box-shadow: 0 10px 25px rgba(237, 28, 36, 0.08); /* Red shadow tint */
        transform: scaleX(-1);
    }

    #my_camera video {
        border-radius: 10px;
        width: 100% !important;
        height: auto !important;
    }

    .btn-mps-exit {
        background-color: var(--mps-red);
        color: white;
        border: none;
        padding: 14px;
        border-radius: 12px;
        font-weight: 700;
        width: 100%;
        transition: all 0.3s;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .btn-mps-exit:hover {
        background-color: #c41219;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(237, 28, 36, 0.3);
    }

    .exit-header {
        color: var(--mps-red);
        font-weight: 800;
        letter-spacing: -0.5px;
    }
</style>

<div class="container py-4">
    <div class="camera-container animate__animated animate__fadeIn">
        
        <div class="card card-camera shadow-lg">
            <div class="card-body p-4">
                
                <div class="d-flex align-items-center mb-4">
                    <div class="flex-shrink-0 bg-danger text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                        <i class="bi bi-box-arrow-right fs-4"></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0 fw-bold text-dark"><?= session()->get('nama') ?></h6>
                        <small class="text-muted">Selesai bertugas hari ini</small>
                    </div>
                </div>

                <h4 class="exit-header mb-3 text-center">Konfirmasi Presensi Keluar</h4>

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
                                <span class="meta-label">Jam Pulang</span>
                                <span class="meta-value" id="realtime-clock">00:00:00</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="meta-item mt-2 pt-2 border-top">
                                <span class="meta-label"><i class="bi bi-geo-alt-fill text-danger"></i> Titik Lokasi</span>
                                <span class="meta-value"><?= $lokasi_presensi ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="tanggal_keluar" id="tanggal_keluar" value="<?= $tanggal_keluar ?>">
                <input type="hidden" name="jam_keluar" id="jam_keluar" value="<?= $jam_keluar ?>">

                <div id="my_camera" class="mb-4"></div>
                
                <div style="display: none;" id="my_result"></div>

                <button class="btn btn-mps-exit shadow-sm mb-3" id="ambil_foto_keluar">
                    <i class="bi bi-camera-fill me-2"></i>Ambil Foto & Selesai Kerja
                </button>

                <p class="text-center text-muted mb-0" style="font-size: 0.75rem;">
                    Sampai jumpa di hari kerja berikutnya!
                </p>
            </div>
        </div>

        <div class="text-center mt-3">
            <a href="<?= base_url('Pegawai/home') ?>" class="text-muted text-decoration-none small">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
</div>

<script>
    // --- Realtime Clock ---
    function updateClock() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('id-ID', { hour12: false });
        const el = document.getElementById('realtime-clock');
        if(el) el.textContent = timeString;
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

    // --- Logika Pengiriman AJAX (Dipertahankan sesuai kode asli Anda) ---
    document.getElementById('ambil_foto_keluar').addEventListener('click', function(){
        let tanggal_keluar = document.getElementById('tanggal_keluar').value;
        let jam_keluar = document.getElementById('jam_keluar').value;

        // Visual feedback saat klik
        this.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Memproses...';
        this.disabled = true;

        Webcam.snap(function(data_uri){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (xhttp.readyState == 4) {
                    if (xhttp.status == 200) {
                        window.location.href = '<?= base_url('Pegawai/home') ?>';
                    } else {
                        alert("Gagal menyimpan: " + xhttp.statusText);
                        // Reset button jika gagal
                        const btn = document.getElementById('ambil_foto_keluar');
                        btn.innerHTML = '<i class="bi bi-camera-fill me-2"></i>Ambil Foto & Selesai Kerja';
                        btn.disabled = false;
                    }
                }
            };
            
            // URL tetap menggunakan base_url dengan ID Presensi seperti kode asli
            xhttp.open("POST", "<?= base_url('Pegawai/presensi_keluar_aksi/' . $id_presensi) ?>", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(
                'foto_keluar=' + encodeURIComponent(data_uri) + 
                '&tanggal_keluar=' + tanggal_keluar +
                '&jam_keluar=' + jam_keluar
            );
        });
    });
</script>

<?= $this->endSection() ?>