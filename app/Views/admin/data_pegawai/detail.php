<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="d-flex align-items-center mb-4">
        <a href="<?= base_url('Admin/data_pegawai') ?>" class="btn btn-outline-secondary btn-sm me-3">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
        <h4 class="mb-0 text-dark fw-bold">Detail Profil Pegawai</h4>
    </div>

    <div class="card shadow-sm border-0 overflow-hidden" style="border-radius: 15px;">
        <div class="row g-0">
            <div class="col-md-4 bg-light d-flex flex-column align-items-center justify-content-center py-5 border-end">
                <div class="position-relative">
                    <img src="<?= base_url('profile/' . $pegawai['foto']) ?>" 
                        class="img-thumbnail shadow-sm" 
                        style="width: 180px; height: 180px; object-fit: cover; border-radius: 25px;" 
                        alt="Foto Pegawai">
                    <span class="position-absolute bottom-0 end-0 badge rounded-pill bg-success border border-2 border-white p-2">
                        <span class="visually-hidden">Status</span>
                    </span>
                </div>
                <h5 class="mt-3 mb-0 fw-bold text-dark"><?= $pegawai['nama'] ?></h5>
                <p class="text-muted small"><?= $pegawai['nip'] ?> • <?= $pegawai['jabatan'] ?></p>
                <span class="badge rounded-pill bg-primary px-3"><?= $pegawai['role'] ?></span>
            </div>

            <div class="col-md-8">
                <div class="card-body p-4">
                    <h6 class="text-uppercase text-primary fw-bold small mb-4" style="letter-spacing: 1px;">Informasi Pribadi</h6>
                    
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Username</div>
                        <div class="col-sm-8 fw-bold text-dark"><?= $pegawai['username'] ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Jenis Kelamin</div>
                        <div class="col-sm-8 text-dark"><?= $pegawai['jenis_kelamin'] ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">No. Handphone</div>
                        <div class="col-sm-8 text-dark"><?= $pegawai['no_handphone'] ?></div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-4 text-muted">Alamat</div>
                        <div class="col-sm-8 text-dark"><?= $pegawai['alamat'] ?></div>
                    </div>

                    <hr class="text-light">

                    <h6 class="text-uppercase text-primary fw-bold small my-4" style="letter-spacing: 1px;">Informasi Penempatan</h6>
                    
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Lokasi Presensi</div>
                        <div class="col-sm-8">
                            <i class="bi bi-geo-alt-fill text-danger me-1"></i> <?= $pegawai['lokasi_presensi'] ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Status Kepegawaian</div>
                        <div class="col-sm-8">
                            <?php if($pegawai['status'] == 'Aktif'): ?>
                                <span class="text-success fw-bold"><i class="bi bi-check-circle-fill"></i> <?= $pegawai['status'] ?></span>
                            <?php else: ?>
                                <span class="text-danger fw-bold"><i class="bi bi-x-circle-fill"></i> <?= $pegawai['status'] ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>