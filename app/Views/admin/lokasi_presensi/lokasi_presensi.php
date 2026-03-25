<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="text-dark fw-bold mb-1">Lokasi Presensi 📍</h4>
            <p class="text-muted small mb-0">Atur titik koordinat dan wilayah absensi pegawai.</p>
        </div>
        <a href="<?= base_url('Admin/lokasi_presensi/create') ?>" class="btn btn-primary px-4 shadow-sm d-flex align-items-center gap-2" style="border-radius: 12px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10s-10-4.477-10-10s4.477-10 10-10m3 9h-2v-2a1 1 0 0 0 -2 0v2h-2a1 1 0 0 0 0 2h2v2a1 1 0 0 0 2 0v-2h2a1 1 0 0 0 0 -2" />
            </svg>
            Tambah Lokasi
        </a>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="Table">
                    <thead style="background-color: #f8f9fa;">
                        <tr>
                            <th class="ps-4 py-3 text-muted fw-bold small text-uppercase" style="width: 70px;">No</th>
                            <th class="py-3 text-muted fw-bold small text-uppercase">Nama Lokasi</th>
                            <th class="py-3 text-muted fw-bold small text-uppercase">Alamat</th>
                            <th class="py-3 text-muted fw-bold small text-uppercase">Tipe</th>
                            <th class="py-3 text-muted fw-bold small text-uppercase text-center" style="width: 250px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($lokasi_presensi as $lok) : ?>    
                        <tr>
                            <td class="ps-4 text-muted fw-bold"><?= $no++ ?></td>
                            <td>
                                <span class="fw-bold text-dark"><?= $lok['nama_lokasi'] ?></span>
                            </td>
                            <td>
                                <small class="text-muted d-block text-truncate" style="max-width: 250px;" title="<?= $lok['alamat_lokasi'] ?>">
                                    <?= $lok['alamat_lokasi'] ?>
                                </small>
                            </td>
                            <td>
                                <span class="badge rounded-pill bg-light text-primary px-3 py-2 border">
                                    <?= $lok['tipe_lokasi'] ?>
                                </span>
                            </td>
                            <td class="text-center pe-4">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="<?= base_url('Admin/lokasi_presensi/detail/' . $lok['id']) ?>" 
                                       class="btn btn-sm fw-bold shadow-sm" 
                                       style="border-radius: 10px; background-color: #e7f5ff; color: #228be6; border: 1px solid #a5d8ff;">
                                       Detail
                                    </a>

                                    <a href="<?= base_url('Admin/lokasi_presensi/edit/' . $lok['id']) ?>" 
                                       class="btn btn-sm fw-bold shadow-sm" 
                                       style="border-radius: 10px; background-color: #fff9db; color: #f08c00; border: 1px solid #ffe066;">
                                       Edit
                                    </a>
                                    
                                    <a href="<?= base_url('Admin/lokasi_presensi/delete/' . $lok['id']) ?>" 
                                       class="btn btn-sm fw-bold shadow-sm tombol-hapus" 
                                       onclick="return confirm('Yakin hapus data lokasi <?= $lok['nama_lokasi'] ?>?')"
                                       style="border-radius: 10px; background-color: #fff5f5; color: #fa5252; border: 1px solid #ffc9c9;">
                                       Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody> 
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    /* Mengatur jarak antar baris */
    #Table tbody tr td {
        padding-top: 15px;
        padding-bottom: 15px;
    }
    
    /* Efek hover pada baris */
    #Table tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.01);
    }

    .btn:hover {
        filter: brightness(0.95);
        transform: translateY(-1px);
        transition: all 0.2s;
    }
</style>

<?= $this->endSection() ?>