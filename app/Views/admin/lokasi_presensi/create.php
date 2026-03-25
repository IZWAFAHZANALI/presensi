<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="mb-3 d-flex align-items-center justify-content-between">
                <a href="<?= base_url('Admin/lokasi_presensi') ?>" class="text-decoration-none text-muted small d-flex align-items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                    </svg>
                    Batal
                </a>
                <h5 class="fw-bold text-dark mb-0">Tambah Lokasi Presensi Baru 📍</h5>
            </div>

            <div class="card shadow-sm border-0" style="border-radius: 20px;">
                <div class="card-body p-4 p-md-5">
                    <form method="POST" action="<?= base_url('Admin/lokasi_presensi/store') ?>">
                        <?= csrf_field() ?>

                        <div class="row">
                            <div class="col-md-6 border-end-md">
                                <div class="d-flex align-items-center gap-2 mb-3">
                                    <span style="font-size: 20px;">🏢</span>
                                    <h6 class="fw-bold text-primary mb-0">Identitas Lokasi</h6>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-muted">Nama Lokasi</label>
                                    <input type="text" name="nama_lokasi" 
                                           class="form-control bg-light border-0 <?= ($validation->hasError('nama_lokasi')) ? 'is-invalid' : '' ?>" 
                                           placeholder="Misal: Kantor Cabang Bandung" style="border-radius: 10px;" value="<?= old('nama_lokasi') ?>">
                                    <div class="invalid-feedback"><?= $validation->getError('nama_lokasi') ?></div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-muted">Tipe Lokasi</label>
                                    <input type="text" name="tipe_lokasi" 
                                           class="form-control bg-light border-0 <?= ($validation->hasError('tipe_lokasi')) ? 'is-invalid' : '' ?>" 
                                           placeholder="Misal: Pusat, Cabang, atau Proyek" style="border-radius: 10px;" value="<?= old('tipe_lokasi') ?>">
                                    <div class="invalid-feedback"><?= $validation->getError('tipe_lokasi') ?></div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-muted">Alamat Lengkap</label>
                                    <textarea name="alamat_lokasi" class="form-control bg-light border-0 <?= ($validation->hasError('alamat_lokasi')) ? 'is-invalid' : '' ?>" 
                                              rows="4" placeholder="Tulis alamat detail di sini..." style="border-radius: 10px;"><?= old('alamat_lokasi') ?></textarea>
                                    <div class="invalid-feedback"><?= $validation->getError('alamat_lokasi') ?></div>
                                </div>
                            </div>

                            <div class="col-md-6 ps-md-4">
                                <div class="d-flex align-items-center gap-2 mb-3">
                                    <span style="font-size: 20px;">⚙️</span>
                                    <h6 class="fw-bold text-primary mb-0">Konfigurasi & Waktu</h6>
                                </div>

                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="form-label small fw-bold text-muted">Latitude</label>
                                        <input type="text" name="latitude" class="form-control bg-light border-0 <?= ($validation->hasError('latitude')) ? 'is-invalid' : '' ?>" 
                                               placeholder="-6.12345" style="border-radius: 10px;" value="<?= old('latitude') ?>">
                                        <div class="invalid-feedback"><?= $validation->getError('latitude') ?></div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label small fw-bold text-muted">Longitude</label>
                                        <input type="text" name="longitude" class="form-control bg-light border-0 <?= ($validation->hasError('longitude')) ? 'is-invalid' : '' ?>" 
                                               placeholder="106.12345" style="border-radius: 10px;" value="<?= old('longitude') ?>">
                                        <div class="invalid-feedback"><?= $validation->getError('longitude') ?></div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="form-label small fw-bold text-muted">Radius (Meter)</label>
                                        <input type="number" name="radius" class="form-control bg-light border-0 <?= ($validation->hasError('radius')) ? 'is-invalid' : '' ?>" 
                                               placeholder="Misal: 50" style="border-radius: 10px;" value="<?= old('radius') ?>">
                                        <div class="invalid-feedback"><?= $validation->getError('radius') ?></div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label small fw-bold text-muted">Zona Waktu</label>
                                        <select name="zona_waktu" class="form-select bg-light border-0 <?= ($validation->hasError('zona_waktu')) ? 'is-invalid' : '' ?>" style="border-radius: 10px;">
                                            <option value="">-- Pilih --</option>
                                            <option value="WIB" <?= old('zona_waktu') == 'WIB' ? 'selected' : '' ?>>WIB</option>
                                            <option value="WITA" <?= old('zona_waktu') == 'WITA' ? 'selected' : '' ?>>WITA</option>
                                            <option value="WIT" <?= old('zona_waktu') == 'WIT' ? 'selected' : '' ?>>WIT</option>
                                        </select>
                                        <div class="invalid-feedback"><?= $validation->getError('zona_waktu') ?></div>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-6 mb-3">
                                        <label class="form-label small fw-bold text-muted">Jam Masuk</label>
                                        <input type="time" name="jam_masuk" class="form-control bg-light border-0 <?= ($validation->hasError('jam_masuk')) ? 'is-invalid' : '' ?>" 
                                               style="border-radius: 10px;" value="<?= old('jam_masuk') ?>">
                                        <div class="invalid-feedback"><?= $validation->getError('jam_masuk') ?></div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label small fw-bold text-muted">Jam Pulang</label>
                                        <input type="time" name="jam_pulang" class="form-control bg-light border-0 <?= ($validation->hasError('jam_pulang')) ? 'is-invalid' : '' ?>" 
                                               style="border-radius: 10px;" value="<?= old('jam_pulang') ?>">
                                        <div class="invalid-feedback"><?= $validation->getError('jam_pulang') ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4 opacity-50">

                        <div class="d-flex justify-content-end gap-2">
                            <button type="reset" class="btn btn-light px-4 fw-bold text-muted" style="border-radius: 12px;">Reset</button>
                            <button type="submit" class="btn btn-primary px-5 py-2 fw-bold shadow-sm" style="border-radius: 12px;">
                                Simpan Lokasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control:focus, .form-select:focus {
        background-color: #fff !important;
        border: 1px solid #0d6efd !important;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.05);
    }
    @media (min-width: 768px) {
        .border-end-md { border-right: 1px solid #eee !important; }
    }
</style>

<?= $this->endSection() ?>