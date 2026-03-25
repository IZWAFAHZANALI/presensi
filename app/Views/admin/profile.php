<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<div class="container-fluid">
    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius: 12px;">
            <i class="bi bi-check-circle-fill me-2"></i> <?= session()->getFlashdata('pesan'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="d-flex align-items-center mb-4">
        <a href="<?= base_url('Admin/home') ?>" class="btn btn-white shadow-sm btn-sm me-3" style="border-radius: 10px; padding: 8px 15px;">
            <i class="bi bi-arrow-left text-primary"></i>
        </a>
        <div class="d-flex align-items-center">
            <div class="icon-box-header me-3 d-flex align-items-center justify-content-center">
                <i class="bi bi-person-badge-fill text-primary" style="font-size: 24px !important; display: block !important;"></i>
            </div>
            <div>
                <h4 class="mb-0 text-dark fw-bold">Profil Admin ✨</h4>
                <p class="text-muted small mb-0">Kelola informasi pribadi Anda.</p>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 overflow-hidden" style="border-radius: 15px;">
        <div class="row g-0">
            <div class="col-md-4 bg-light d-flex flex-column align-items-center justify-content-center py-5 border-end">
                
                <form action="<?= base_url('Admin/profile/update_foto/' . $pegawai['id']) ?>" method="post" enctype="multipart/form-data" id="formFoto">
                    <?= csrf_field(); ?>
                    <div class="position-relative">
                        <img src="<?= base_url('profile/' . ($pegawai['foto'] ?? 'default.png')) ?>"
                            class="img-thumbnail shadow-sm profile-preview"
                            style="width: 180px; height: 180px; object-fit: cover; border-radius: 25px;"
                            alt="Foto Admin">
                        
                        <label for="fotoInput" class="btn btn-primary btn-sm position-absolute shadow" 
                               style="bottom: 10px; right: 10px; border-radius: 12px; padding: 8px 10px; cursor: pointer;"
                               title="Ubah Foto">
                            <i class="bi bi-camera-fill"></i>
                        </label>
                        <input type="file" id="fotoInput" name="foto" style="display: none;" accept="image/*" onchange="submitForm()">
                    </div>
                </form>

                <h5 class="mt-4 mb-1 fw-bold text-dark"><?= $pegawai['nama'] ?></h5>
                <p class="text-primary small fw-medium mb-3"><?= $pegawai['nip'] ?></p>
                
                <div class="d-flex gap-2">
                    <span class="badge badge-kawai-blue"><?= $pegawai['jabatan'] ?></span>
                    <span class="badge badge-kawai-purple"><?= $pegawai['role'] ?></span>
                </div>

                <?php if (isset($validation) && $validation->hasError('foto')) : ?>
                    <div class="text-danger small mt-3 fw-bold"><?= $validation->getError('foto'); ?></div>
                <?php endif; ?>
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
    /* Menyamakan Style dengan View Pegawai */
    .profile-preview:hover { opacity: 0.85; transition: 0.3s; }
    .icon-box-header, .icon-box { display: flex !important; align-items: center !important; justify-content: center !important; flex-shrink: 0; }
    .icon-box-header { width: 45px; height: 45px; background-color: white; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); border: 1px solid #eef2ff; }
    .icon-box { width: 40px; height: 40px; background-color: #eef2ff; border-radius: 10px; }
    .badge-kawai-blue { background-color: #e0e7ff; color: #4338ca; padding: 8px 16px; border-radius: 12px; font-weight: 600; font-size: 11px; }
    .badge-kawai-purple { background-color: #f3e8ff; color: #7e22ce; padding: 8px 16px; border-radius: 12px; font-weight: 600; font-size: 11px; }
    .btn-white { background-color: white; border: none; }
</style>

<script>
    function submitForm() {
        document.getElementById("formFoto").submit();
    }
</script>

<?= $this->endSection() ?>