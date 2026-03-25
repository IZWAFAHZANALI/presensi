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
                    Kembali
                </a>
                <h5 class="fw-bold text-dark mb-0">Edit Lokasi Presensi 📍</h5>
            </div>

            <div class="card shadow-sm border-0" style="border-radius: 20px;">
                <div class="card-body p-4 p-md-5">
                    <form method="POST" action="<?= base_url('Admin/lokasi_presensi/update/'.$lokasi_presensi['id']) ?>">
                        <?= csrf_field() ?>

                        <div class="row">
                            <div class="col-md-6 border-end-md">
                                <h6 class="fw-bold text-primary mb-3">Informasi Umum</h6>
                                
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Nama Lokasi</label>
                                    <input type="text" name="nama_lokasi" value="<?= $lokasi_presensi['nama_lokasi'] ?>" 
                                           class="form-control bg-light border-0 <?= ($validation->hasError('nama_lokasi')) ? 'is-invalid' : '' ?>" 
                                           placeholder="Contoh: Kantor Pusat" style="border-radius: 10px;">
                                    <div class="invalid-feedback"><?= $validation->getError('nama_lokasi') ?></div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Tipe Lokasi</label>
                                    <input type="text" name="tipe_lokasi" value="<?= $lokasi_presensi['tipe_lokasi'] ?>" 
                                           class="form-control bg-light border-0 <?= ($validation->hasError('tipe_lokasi')) ? 'is-invalid' : '' ?>" 
                                           placeholder="Contoh: Pusat / Cabang" style="border-radius: 10px;">
                                    <div class="invalid-feedback"><?= $validation->getError('tipe_lokasi') ?></div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Alamat Lengkap</label>
                                    <textarea name="alamat_lokasi" class="form-control bg-light border-0 <?= ($validation->hasError('alamat_lokasi')) ? 'is-invalid' : '' ?>" 
                                              rows="4" placeholder="Alamat detail lokasi..." style="border-radius: 10px;"><?= $lokasi_presensi['alamat_lokasi']?></textarea>
                                    <div class="invalid-feedback"><?= $validation->getError('alamat_lokasi') ?></div>
                                </div>
                            </div>

                            <div class="col-md-6 ps-md-4">
                                <h6 class="fw-bold text-primary mb-3">Koordinat & Operasional</h6>

                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="form-label small fw-bold">Latitude</label>
                                        <input type="text" name="latitude" value="<?= $lokasi_presensi['latitude'] ?>" 
                                               class="form-control bg-light border-0 <?= ($validation->hasError('latitude')) ? 'is-invalid' : '' ?>" style="border-radius: 10px;">
                                        <div class="invalid-feedback"><?= $validation->getError('latitude') ?></div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label small fw-bold">Longitude</label>
                                        <input type="text" name="longitude" value="<?= $lokasi_presensi['longitude'] ?>" 
                                               class="form-control bg-light border-0 <?= ($validation->hasError('longitude')) ? 'is-invalid' : '' ?>" style="border-radius: 10px;">
                                        <div class="invalid-feedback"><?= $validation->getError('longitude') ?></div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="form-label small fw-bold">Radius (Meter)</label>
                                        <input type="number" name="radius" value="<?= $lokasi_presensi['radius'] ?>" 
                                               class="form-control bg-light border-0 <?= ($validation->hasError('radius')) ? 'is-invalid' : '' ?>" style="border-radius: 10px;">
                                        <div class="invalid-feedback"><?= $validation->getError('radius') ?></div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label small fw-bold">Zona Waktu</label>
                                        <select name="zona_waktu" class="form-select bg-light border-0 <?= ($validation->hasError('zona_waktu')) ? 'is-invalid' : '' ?>" style="border-radius: 10px;">
                                            <option value="">-- Pilih --</option>
                                            <option <?= ($lokasi_presensi['zona_waktu'] == 'WIB') ? 'selected' : '' ?> value="WIB">WIB</option>
                                            <option <?= ($lokasi_presensi['zona_waktu'] == 'WITA') ? 'selected' : '' ?> value="WITA">WITA</option>
                                            <option <?= ($lokasi_presensi['zona_waktu'] == 'WIT') ? 'selected' : '' ?> value="WIT">WIT</option>
                                        </select>
                                        <div class="invalid-feedback"><?= $validation->getError('zona_waktu') ?></div>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-6 mb-3">
                                        <label class="form-label small fw-bold">Jam Masuk</label>
                                        <input type="time" name="jam_masuk" value="<?= $lokasi_presensi['jam_masuk'] ?>" 
                                               class="form-control bg-light border-0 <?= ($validation->hasError('jam_masuk')) ? 'is-invalid' : '' ?>" style="border-radius: 10px;">
                                        <div class="invalid-feedback"><?= $validation->getError('jam_masuk') ?></div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label small fw-bold">Jam Pulang</label>
                                        <input type="time" name="jam_pulang" value="<?= $lokasi_presensi['jam_pulang'] ?>" 
                                               class="form-control bg-light border-0 <?= ($validation->hasError('jam_pulang')) ? 'is-invalid' : '' ?>" style="border-radius: 10px;">
                                        <div class="invalid-feedback"><?= $validation->getError('jam_pulang') ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4 opacity-50">

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary px-5 py-2 fw-bold shadow-sm" style="border-radius: 12px;">
                                <i class="bi bi-save me-2"></i> Update Data Lokasi
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