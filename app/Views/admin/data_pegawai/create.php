<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 text-primary">Tambah Data Pegawai</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="<?= base_url('Admin/data_pegawai/store') ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3 input-style-1">
                            <label class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : '' ?>" 
                                   name="nama" placeholder="Masukkan Nama" value="<?= old('nama') ?>" />
                            <div class="invalid-feedback"><?= validation_show_error('nama') ?></div>
                        </div>

                        <div class="mb-3 input-style-1">
                            <label class="form-label fw-bold">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control <?= ($validation->hasError('jenis_kelamin')) ? 'is-invalid' : '' ?>">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-Laki" <?= old('jenis_kelamin') == 'Laki-Laki' ? 'selected' : '' ?>>Laki-Laki</option>
                                <option value="Perempuan" <?= old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                            </select>
                            <div class="invalid-feedback"><?= $validation->getError('jenis_kelamin') ?></div>
                        </div>

                        <div class="mb-3 input-style-1">
                            <label class="form-label fw-bold">No. Handphone</label>
                            <input type="text" class="form-control <?= ($validation->hasError('no_handphone')) ? 'is-invalid' : '' ?>" 
                                   name="no_handphone" placeholder="08xxxx" value="<?= old('no_handphone') ?>" />
                            <div class="invalid-feedback"><?= $validation->getError('no_handphone') ?></div>
                        </div>

                        <div class="mb-3 input-style-1">
                            <label class="form-label fw-bold">Alamat</label>
                            <textarea name="alamat" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : '' ?>" 
                                      rows="4" placeholder="Alamat Lengkap"><?= old('alamat') ?></textarea>
                            <div class="invalid-feedback"><?= $validation->getError('alamat') ?></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6 mb-3 input-style-1">
                                <label class="form-label fw-bold">Jabatan</label>
                                <select name="jabatan" class="form-control <?= ($validation->hasError('jabatan')) ? 'is-invalid' : '' ?>">
                                    <option value="">-- Pilih Jabatan --</option>
                                    <?php foreach($jabatan as $jab) : ?>
                                        <option value="<?= $jab['jabatan'] ?>" <?= old('jabatan') == $jab['jabatan'] ? 'selected' : '' ?>><?= $jab['jabatan'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback"><?= $validation->getError('jabatan') ?></div>
                            </div>

                            <div class="col-md-6 mb-3 input-style-1">
                                <label class="form-label fw-bold">Lokasi Presensi</label>
                                <select name="lokasi_presensi" class="form-control <?= ($validation->hasError('lokasi_presensi')) ? 'is-invalid' : '' ?>">
                                    <option value="">-- Pilih Lokasi --</option>
                                    <?php foreach($lokasi_presensi as $lok) : ?>
                                        <option value="<?= $lok['id'] ?>" <?= old('lokasi_presensi') == $lok['id'] ? 'selected' : '' ?>><?= $lok['nama_lokasi'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback"><?= $validation->getError('lokasi_presensi') ?></div>
                            </div>
                        </div>

                        <div class="mb-3 input-style-1">
                            <label class="form-label fw-bold">Username</label>
                            <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>" 
                                   name="username" placeholder="Username" value="<?= old('username') ?>" />
                            <div class="invalid-feedback"><?= $validation->getError('username') ?></div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3 input-style-1">
                                <label class="form-label fw-bold">Password</label>
                                <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" 
                                       name="password" placeholder="******" />
                                <div class="invalid-feedback"><?= $validation->getError('password') ?></div>
                            </div>
                            <div class="col-md-6 mb-3 input-style-1">
                                <label class="form-label fw-bold">Konfirmasi</label>
                                <input type="password" class="form-control <?= ($validation->hasError('konfirmasi_password')) ? 'is-invalid' : '' ?>" 
                                       name="konfirmasi_password" placeholder="******" />
                                <div class="invalid-feedback"><?= $validation->getError('konfirmasi_password') ?></div>
                            </div>
                        </div>

                        <div class="mb-3 input-style-1">
                            <label class="form-label fw-bold">Role</label>
                            <select name="role" class="form-control <?= ($validation->hasError('role')) ? 'is-invalid' : '' ?>">
                                <option value="">-- Pilih Role --</option>
                                <option value="Admin" <?= old('role') == 'Admin' ? 'selected' : '' ?>>Admin</option>
                                <option value="Pegawai" <?= old('role') == 'Pegawai' ? 'selected' : '' ?>>Pegawai</option>
                            </select>
                            <div class="invalid-feedback"><?= $validation->getError('role') ?></div>
                        </div>

                        <div class="mb-3 input-style-1">
                            <label class="form-label fw-bold">Foto Profil</label>
                            <input type="file" class="form-control <?= ($validation->hasError('foto')) ? 'is-invalid' : '' ?>" name="foto" />
                            <div class="invalid-feedback"><?= $validation->getError('foto') ?></div>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="d-flex justify-content-end gap-2">
                    <a href="<?= base_url('Admin/data_pegawai') ?>" class="btn btn-secondary px-4">Batal</a>
                    <button type="submit" class="btn btn-primary px-4">Simpan Data</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>