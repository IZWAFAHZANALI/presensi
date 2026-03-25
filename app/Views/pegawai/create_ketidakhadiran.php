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
        background: linear-gradient(135deg, var(--mps-navy) 0%, #000a4d 100%);
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
        transition: 0.3s;
    }

    .form-control-mps:focus + .input-icon {
        color: var(--mps-navy);
    }

    /* Textarea adjustment */
    textarea.form-control-mps {
        padding-top: 15px;
    }
    textarea.form-control-mps + .input-icon {
        top: 25px;
        transform: none;
    }

    .btn-submit-mps {
        background-color: var(--mps-navy);
        border: none;
        padding: 14px;
        border-radius: 12px;
        font-weight: 700;
        letter-spacing: 0.5px;
        transition: all 0.3s;
        width: 100%;
        color: white;
    }

    .btn-submit-mps:hover {
        background-color: var(--mps-red);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(237, 28, 36, 0.3);
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
        transition: 0.3s;
    }

    .btn-back:hover {
        color: var(--mps-navy);
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9">
            
            <a href="<?= base_url('Pegawai/ketidakhadiran') ?>" class="btn-back">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar
            </a>

            <div class="card card-form animate__animated animate__fadeInUp">
                <div class="card-form-header">
                    <i class="bi bi-envelope-paper-fill"></i>
                    <h3 class="fw-bold mb-1">Form Pengajuan</h3>
                    <p class="mb-0 opacity-75">Lengkapi data berikut untuk mengajukan ketidakhadiran</p>
                </div>

                <div class="card-body form-container">
                    <form method="POST" action="<?= base_url('Pegawai/ketidakhadiran/store') ?>" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <input type="hidden" value="<?= session()->get('id_pegawai') ?>" name="id_pegawai">

                        <div class="input-group-mps">
                            <label class="form-label">Jenis Ketidakhadiran</label>
                            <div class="position-relative">
                                <select name="keterangan" class="form-control form-control-mps <?= ($validation->hasError('keterangan')) ? 'is-invalid' : '' ?>">
                                    <option value="" selected disabled>-- Pilih Keterangan --</option>
                                    <option value="Izin" <?= old('keterangan') == 'Izin' ? 'selected' : '' ?>>Izin (Urusan Penting)</option>
                                    <option value="Sakit" <?= old('keterangan') == 'Sakit' ? 'selected' : '' ?>>Sakit (Butuh Istirahat)</option>
                                </select>
                                <i class="bi bi-card-checklist input-icon"></i>
                                <div class="invalid-feedback ps-2"><?= $validation->getError('keterangan') ?></div>
                            </div>
                        </div>

                        <div class="input-group-mps">
                            <label class="form-label">Tanggal Ketidakhadiran</label>
                            <div class="position-relative">
                                <input type="date" class="form-control form-control-mps <?= ($validation->hasError('tanggal')) ? 'is-invalid' : '' ?>" 
                                       name="tanggal" value="<?= old('tanggal') ?>" />
                                <i class="bi bi-calendar-event input-icon"></i>
                                <div class="invalid-feedback ps-2"><?= validation_show_error('tanggal') ?></div>
                            </div>
                        </div>

                        <div class="input-group-mps">
                            <label class="form-label">Alasan / Deskripsi</label>
                            <div class="position-relative">
                                <textarea name="deskripsi" class="form-control form-control-mps <?= ($validation->hasError('deskripsi')) ? 'is-invalid' : '' ?>" 
                                          cols="30" rows="4" placeholder="Tuliskan alasan detail Anda..."><?= old('deskripsi') ?></textarea>
                                <i class="bi bi-chat-left-text input-icon"></i>
                                <div class="invalid-feedback ps-2"><?= $validation->getError('deskripsi') ?></div>
                            </div>
                        </div>

                        <div class="input-group-mps">
                            <label class="form-label">Dokumen Lampiran <small class="text-muted fw-normal">(Surat Sakit/Dokumen Pendukung)</small></label>
                            <div class="position-relative">
                                <input type="file" class="form-control form-control-mps <?= ($validation->hasError('file')) ? 'is-invalid' : '' ?>" name="file" />
                                <i class="bi bi-file-earmark-arrow-up input-icon"></i>
                                <div class="invalid-feedback ps-2"><?= $validation->getError('file') ?></div>
                            </div>
                        </div>

                        <div class="mt-4 pt-2">
                            <button type="submit" class="btn btn-submit-mps shadow">
                                <i class="bi bi-send-fill me-2"></i> Ajukan Sekarang
                            </button>
                        </div>

                    </form>
                </div>
            </div>

            <div class="text-center mt-4 text-muted small">
                <i class="bi bi-info-circle me-1"></i> Pastikan data yang Anda masukkan sudah benar sebelum menekan tombol ajukan.
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>