<?= $this->extend('pegawai/layout.php') ?>

<?= $this->section('content') ?>

<style>
    :root {
        --mps-navy: #001180;
        --mps-red: #ed1c24;
        --mps-light: #f8fafc;
    }

    .card-form {
        border: none;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .card-form-header {
        background: linear-gradient(135deg, #001180 0%, #ed1c24 150%); /* Sedikit sentuhan merah di gradasi */
        padding: 30px;
        color: white;
        text-align: center;
    }

    .card-form-header i {
        font-size: 3rem;
        margin-bottom: 15px;
        opacity: 0.9;
    }

    .form-container {
        padding: 40px;
    }

    .form-label {
        font-weight: 700;
        color: #475569;
        font-size: 0.9rem;
        margin-bottom: 8px;
    }

    .input-group-mps {
        position: relative;
        margin-bottom: 25px;
    }

    .form-control-mps {
        border-radius: 12px !important;
        padding: 12px 15px 12px 45px;
        border: 1.5px solid #e2e8f0;
        transition: all 0.3s;
    }

    .form-control-mps:focus {
        border-color: var(--mps-navy);
        box-shadow: 0 0 0 4px rgba(0, 17, 128, 0.1);
    }

    .input-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        z-index: 10;
    }

    /* Textarea adjustment */
    textarea.form-control-mps {
        padding-top: 15px;
    }
    textarea.form-control-mps + .input-icon {
        top: 25px;
        transform: none;
    }

    .current-file-info {
        background: #f1f5f9;
        padding: 10px 15px;
        border-radius: 10px;
        font-size: 0.85rem;
        margin-top: 8px;
        color: #64748b;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-update-mps {
        background-color: var(--mps-navy);
        border: none;
        padding: 14px;
        border-radius: 12px;
        font-weight: 700;
        transition: all 0.3s;
        width: 100%;
        color: white;
    }

    .btn-update-mps:hover {
        background-color: #000a4d;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 17, 128, 0.2);
        color: white;
    }

    .btn-back {
        text-decoration: none;
        color: #64748b;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        margin-bottom: 20px;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9">
            
            <a href="<?= base_url('Pegawai/ketidakhadiran') ?>" class="btn-back">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar
            </a>

            <div class="card card-form">
                <div class="card-form-header">
                    <i class="bi bi-pencil-square"></i>
                    <h3 class="fw-bold mb-1">Edit Pengajuan</h3>
                    <p class="mb-0 opacity-75">Perbarui data ketidakhadiran Anda</p>
                </div>

                <div class="card-body form-container">
                    <form method="POST" action="<?= base_url('Pegawai/ketidakhadiran/update/' . $ketidakhadiran['id']) ?>" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <input type="hidden" value="<?= session()->get('id_pegawai') ?>" name="id_pegawai">
                        <input type="hidden" name="file_lama" value="<?= $ketidakhadiran['file'] ?>">

                        <div class="input-group-mps">
                            <label class="form-label">Jenis Ketidakhadiran</label>
                            <div class="position-relative">
                                <select name="keterangan" class="form-control form-control-mps <?= ($validation->hasError('keterangan')) ? 'is-invalid' : '' ?>">
                                    <option value="Izin" <?= ($ketidakhadiran['keterangan'] == 'Izin') ? 'selected' : '' ?>>Izin (Urusan Penting)</option>
                                    <option value="Sakit" <?= ($ketidakhadiran['keterangan'] == 'Sakit') ? 'selected' : '' ?>>Sakit (Butuh Istirahat)</option>
                                </select>
                                <i class="bi bi-card-checklist input-icon"></i>
                                <div class="invalid-feedback ps-2"><?= $validation->getError('keterangan') ?></div>
                            </div>
                        </div>

                        <div class="input-group-mps">
                            <label class="form-label">Tanggal Ketidakhadiran</label>
                            <div class="position-relative">
                                <input type="date" class="form-control form-control-mps <?= ($validation->hasError('tanggal')) ? 'is-invalid' : '' ?>" 
                                       name="tanggal" value="<?= $ketidakhadiran['tanggal'] ?>" />
                                <i class="bi bi-calendar-event input-icon"></i>
                                <div class="invalid-feedback ps-2"><?= validation_show_error('tanggal') ?></div>
                            </div>
                        </div>

                        <div class="input-group-mps">
                            <label class="form-label">Alasan / Deskripsi</label>
                            <div class="position-relative">
                                <textarea name="deskripsi" class="form-control form-control-mps <?= ($validation->hasError('deskripsi')) ? 'is-invalid' : '' ?>" 
                                          cols="30" rows="4"><?= $ketidakhadiran['deskripsi'] ?></textarea>
                                <i class="bi bi-chat-left-text input-icon"></i>
                                <div class="invalid-feedback ps-2"><?= $validation->getError('deskripsi') ?></div>
                            </div>
                        </div>

                        <div class="input-group-mps">
                            <label class="form-label">Ganti Dokumen Lampiran <small class="text-muted fw-normal">(Kosongkan jika tidak diganti)</small></label>
                            <div class="position-relative">
                                <input type="file" class="form-control form-control-mps <?= ($validation->hasError('file')) ? 'is-invalid' : '' ?>" name="file" />
                                <i class="bi bi-file-earmark-arrow-up input-icon"></i>
                                <div class="invalid-feedback ps-2"><?= $validation->getError('file') ?></div>
                            </div>
                            
                            <div class="current-file-info">
                                <i class="bi bi-file-check-fill text-success"></i>
                                <span>File saat ini: <strong><?= $ketidakhadiran['file'] ?></strong></span>
                            </div>
                        </div>

                        <div class="mt-4 pt-2">
                            <button type="submit" class="btn btn-update-mps shadow">
                                <i class="bi bi-check2-circle me-2"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>