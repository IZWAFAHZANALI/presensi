<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="card shadow-sm border-0" style="border-radius: 15px;">
        <div class="card-header bg-white py-3 border-bottom">
            <h5 class="mb-0 text-primary fw-bold">Edit Data Pegawai: <span class="text-dark"><?= $pegawai['nama'] ?></span></h5>
        </div>
        <div class="card-body p-4">
            <form method="POST" action="<?= base_url('Admin/data_pegawai/update/'. $pegawai['id']) ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="row">
                    <div class="col-md-6 border-end">
                        <h6 class="text-muted mb-3 text-uppercase small fw-bold">Data Profil</h6>
                        
                        <div class="mb-3 input-style-1">
                            <label class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : '' ?>" 
                                   name="nama" value="<?= old('nama', $pegawai['nama']) ?>" />
                            <div class="invalid-feedback"><?= $validation->getError('nama') ?></div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3 input-style-1">
                                <label class="form-label fw-bold">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control <?= ($validation->hasError('jenis_kelamin')) ? 'is-invalid' : '' ?>">
                                    <option value="Laki-Laki" <?= ($pegawai['jenis_kelamin'] == 'Laki-Laki') ? 'selected' : '' ?>>Laki-Laki</option>
                                    <option value="Perempuan" <?= ($pegawai['jenis_kelamin'] == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
                                    <option value="Fauzan" <?= ($pegawai['jenis_kelamin'] == 'Fauzan') ? 'selected' : '' ?>>Fauzan</option>
                                </select>
                                <div class="invalid-feedback"><?= $validation->getError('jenis_kelamin') ?></div>
                            </div>
                            <div class="col-md-6 mb-3 input-style-1">
                                <label class="form-label fw-bold">No. Handphone</label>
                                <input type="text" class="form-control <?= ($validation->hasError('no_handphone')) ? 'is-invalid' : '' ?>" 
                                       name="no_handphone" value="<?= old('no_handphone', $pegawai['no_handphone']) ?>" />
                                <div class="invalid-feedback"><?= $validation->getError('no_handphone') ?></div>
                            </div>
                        </div>

                        <div class="mb-3 input-style-1">
                            <label class="form-label fw-bold">Alamat</label>
                            <textarea name="alamat" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : '' ?>" 
                                      rows="3"><?= old('alamat', $pegawai['alamat']) ?></textarea>
                            <div class="invalid-feedback"><?= $validation->getError('alamat') ?></div>
                        </div>

                        <div class="mb-3 input-style-1">
                            <label class="form-label fw-bold">Update Foto Profil</label>
                            <input type="hidden" value="<?= $pegawai['foto'] ?>" name="foto_lama">
                            <input type="file" class="form-control <?= ($validation->hasError('foto')) ? 'is-invalid' : '' ?>" name="foto" />
                            <div class="small text-muted mt-1">Biarkan kosong jika tidak ingin mengubah foto.</div>
                            <div class="invalid-feedback"><?= $validation->getError('foto') ?></div>
                        </div>
                    </div>

                    <div class="col-md-6 ps-md-4">
                        <h6 class="text-muted mb-3 text-uppercase small fw-bold">Akun & Penempatan</h6>
                        
                        <div class="mb-3 input-style-1">
                            <label class="form-label fw-bold">Jabatan</label>
                            <select name="jabatan" class="form-control <?= ($validation->hasError('jabatan')) ? 'is-invalid' : '' ?>">
                                <?php foreach($jabatan as $jab) : ?>
                                    <option value="<?= $jab['jabatan'] ?>" <?= ($pegawai['jabatan'] == $jab['jabatan']) ? 'selected' : '' ?>>
                                        <?= $jab['jabatan'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= $validation->getError('jabatan') ?></div>
                        </div>

                        <div class="mb-3 input-style-1">
                            <label class="form-label fw-bold">Lokasi Presensi</label>
                            <select name="lokasi_presensi" class="form-control <?= ($validation->hasError('lokasi_presensi')) ? 'is-invalid' : '' ?>">
                                <?php foreach($lokasi_presensi as $lok) : ?>
                                    <option value="<?= $lok['id'] ?>" <?= ($pegawai['lokasi_presensi'] == $lok['id']) ? 'selected' : '' ?>>
                                        <?= $lok['nama_lokasi'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= $validation->getError('lokasi_presensi') ?></div>
                        </div>

                        <div class="mb-3 input-style-1">
                            <label class="form-label fw-bold">Username</label>
                            <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>" 
                                   name="username" value="<?= old('username', $pegawai['username']) ?>" />
                            <div class="invalid-feedback"><?= $validation->getError('username') ?></div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3 input-style-1">
                                <label class="form-label fw-bold">Password Baru</label>
                                <input type="hidden" value="<?= $pegawai['password'] ?>" name="password_lama">
                                <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" 
                                       name="password" placeholder="Isi jika ganti" />
                            </div>
                            <div class="col-md-6 mb-3 input-style-1">
                                <label class="form-label fw-bold">Konfirmasi</label>
                                <input type="password" class="form-control <?= ($validation->hasError('konfirmasi_password')) ? 'is-invalid' : '' ?>" 
                                       name="konfirmasi_password" placeholder="Ulangi password" />
                            </div>
                        </div>

                        <div class="mb-3 input-style-1">
                            <label class="form-label fw-bold">Role</label>
                            <select name="role" class="form-control <?= ($validation->hasError('role')) ? 'is-invalid' : '' ?>">
                                <option value="Admin" <?= ($pegawai['role'] == 'Admin') ? 'selected' : '' ?>>Admin</option>
                                <option value="Pegawai" <?= ($pegawai['role'] == 'Pegawai') ? 'selected' : '' ?>>Pegawai</option>
                            </select>
                            <div class="invalid-feedback"><?= $validation->getError('role') ?></div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-end gap-2">
                    <a href="<?= base_url('Admin/data_pegawai') ?>" class="btn btn-light px-4">Kembali</a>
                    <button type="submit" class="btn btn-primary px-4 shadow-sm">Update Data Pegawai</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>