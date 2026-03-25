<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="mb-3">
                <a href="<?= base_url('Admin/Jabatan') ?>" class="text-decoration-none text-muted small d-flex align-items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                    </svg>
                    Kembali ke Daftar Jabatan
                </a>
            </div>

            <div class="card shadow-sm border-0" style="border-radius: 20px;">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-4">
                        <div class="mb-3" style="font-size: 50px;">💼</div>
                        <h5 class="fw-bold text-dark">Tambah Jabatan Baru</h5>
                        <p class="text-muted small">Masukkan nama jabatan untuk struktur organisasi</p>
                    </div>

                    <form method="POST" action="<?= base_url('Admin/Jabatan/store') ?>">
                        <?= csrf_field() ?>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark ms-1">Nama Jabatan</label>
                            <input type="text" 
                                   class="form-control form-control-lg border-0 bg-light <?= ($validation->hasError('jabatan')) ? 'is-invalid' : '' ?>" 
                                   style="border-radius: 12px; font-size: 16px; padding: 12px 20px;"
                                   name="jabatan" 
                                   placeholder="jabatan"
                                   value="<?= old('jabatan') ?>" 
                                   autofocus />
                            <div class="invalid-feedback ms-1"><?= $validation->getError('jabatan') ?></div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary py-3 fw-bold shadow-sm" style="border-radius: 15px; letter-spacing: 0.5px;">
                                Simpan Jabatan Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="mt-4 p-3 border-0 shadow-sm d-flex align-items-center bg-white" style="border-radius: 15px;">
                <span class="me-3" style="font-size: 24px;">💡</span>
                <small class="text-muted">Gunakan nama jabatan yang spesifik agar memudahkan pembagian tugas pegawai nantinya.</small>
            </div>
        </div>
    </div>
</div>

<style>
    /* Fokus input yang lembut khas MPSNet Kawai */
    .form-control:focus {
        background-color: #fff !important;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.1);
        border: 1px solid #0d6efd !important;
    }
</style>

<?= $this->endSection() ?>