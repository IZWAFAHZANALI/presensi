<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<div class="container-fluid">
    <div class="d-flex align-items-center mb-4">
        <a href="<?= base_url('Admin/home') ?>" class="btn btn-white shadow-sm btn-sm me-3" style="border-radius: 10px; padding: 8px 15px;">
            <i class="bi bi-arrow-left text-primary"></i>
        </a>
        <div class="d-flex align-items-center">
            <div class="icon-box-header me-3 d-flex align-items-center justify-content-center">
                <i class="bi bi-person-badge-fill text-primary" style="font-size: 24px !important; display: block !important;"></i>
            </div>
            <div>
                <h4 class="mb-0 text-dark fw-bold">Profil Saya ✨</h4>
                <p class="text-muted small mb-0">Kelola informasi pribadi dan data kepegawaian Anda.</p>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 overflow-hidden" style="border-radius: 15px;">
        <div class="row g-0">
            <div class="col-md-4 bg-light d-flex flex-column align-items-center justify-content-center py-5 border-end">
                <div class="position-relative">
                    <img src="<?= base_url('profile/' . $pegawai['foto']) ?>"
                        class="img-thumbnail shadow-sm"
                        style="width: 180px; height: 180px; object-fit: cover; border-radius: 25px;"
                        alt="Foto Pegawai">
                </div>
                
                <h5 class="mt-3 mb-1 fw-bold text-dark"><?= $pegawai['nama'] ?></h5>
                <p class="text-primary small fw-medium mb-3"><?= $pegawai['nip'] ?></p>
                
                <div class="d-flex gap-2">
                    <span class="badge badge-kawai-blue"><?= $pegawai['jabatan'] ?></span>
                    <span class="badge badge-kawai-purple"><?= $pegawai['role'] ?></span>
                </div>
            </div>

            <div class="col-md-8 bg-white">
                <div class="card-body p-4 p-lg-5">
                    
                    <div class="d-flex align-items-center mb-4">
                        <div class="icon-box me-3 d-flex align-items-center justify-content-center">
                            <i class="bi bi-person-lines-fill text-primary" style="font-size: 20px !important; display: block !important;"></i>
                        </div>
                        <h6 class="text-dark fw-bold mb-0">Informasi Pribadi</h6>
                    </div>

                    <div class="row g-4 mb-5">
                        <div class="col-sm-6">
                            <label class="small text-muted mb-1">Username</label>
                            <div class="fw-bold text-dark p-3 bg-light" style="border-radius: 12px;"><?= $pegawai['username'] ?></div>
                        </div>
                        <div class="col-sm-6">
                            <label class="small text-muted mb-1">Jenis Kelamin</label>
                            <div class="fw-bold text-dark p-3 bg-light" style="border-radius: 12px;"><?= $pegawai['jenis_kelamin'] ?></div>
                        </div>
                        <div class="col-sm-6">
                            <label class="small text-muted mb-1">No. Handphone</label>
                            <div class="fw-bold text-dark p-3 bg-light" style="border-radius: 12px;"><?= $pegawai['no_handphone'] ?></div>
                        </div>
                        <div class="col-sm-6">
                            <label class="small text-muted mb-1">Alamat</label>
                            <div class="fw-bold text-dark p-3 bg-light" style="border-radius: 12px;"><?= $pegawai['alamat'] ?></div>
                        </div>
                    </div>

                    <hr class="border-0 bg-light mb-5" style="height: 2px;">

                    <div class="d-flex align-items-center mb-4">
                        <div class="icon-box me-3 d-flex align-items-center justify-content-center" style="background-color: #fff4e6;">
                            <i class="bi bi-building text-warning" style="font-size: 20px !important; display: block !important;"></i>
                        </div>
                        <h6 class="text-dark fw-bold mb-0">Informasi Penempatan</h6>
                    </div>

                    <div class="row g-4">
                        <div class="col-sm-6">
                            <label class="small text-muted mb-1">Lokasi Presensi</label>
                            <div class="d-flex align-items-center p-3 border" style="border-radius: 12px; border-style: dashed !important;">
                                <i class="bi bi-geo-alt-fill text-danger me-2"></i>
                                <span class="fw-bold text-dark"><?= $pegawai['lokasi_presensi'] ?></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="small text-muted mb-1">Status Kepegawaian</label>
                            <div class="p-3 border" style="border-radius: 12px; border-style: dashed !important;">
                                <?php if($pegawai['status'] == 'Aktif'): ?>
                                    <span class="text-success fw-bold"><i class="bi bi-check-circle-fill me-1"></i> Akun <?= $pegawai['status'] ?></span>
                                <?php else: ?>
                                    <span class="text-danger fw-bold"><i class="bi bi-x-circle-fill me-1"></i> <?= $pegawai['status'] ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Paksa Icon Box memiliki dimensi yang pas dan posisi center */
    .icon-box-header, .icon-box {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        flex-shrink: 0;
    }

    .icon-box-header {
        width: 45px;
        height: 45px;
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        border: 1px solid #eef2ff;
    }

    .icon-box {
        width: 40px;
        height: 40px;
        background-color: #eef2ff;
        border-radius: 10px;
    }

    /* Warna & Badge */
    .badge-kawai-blue {
        background-color: #e0e7ff;
        color: #4338ca;
        padding: 8px 16px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 11px;
    }

    .badge-kawai-purple {
        background-color: #f3e8ff;
        color: #7e22ce;
        padding: 8px 16px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 11px;
    }

    .btn-white {
        background-color: white;
        border: none;
    }
</style>

<?= $this->endSection() ?>