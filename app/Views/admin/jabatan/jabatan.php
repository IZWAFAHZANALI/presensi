<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="text-dark fw-bold mb-1">Data Jabatan 💼</h4>
            <p class="text-muted small mb-0">Manajemen struktur organisasi dan posisi pegawai.</p>
        </div>
        <a href="<?= base_url('Admin/Jabatan/create') ?>" class="btn btn-primary px-4 shadow-sm d-flex align-items-center gap-2" style="border-radius: 12px;">
             <i class="bi bi-plus-lg"></i> Tambah Jabatan
        </a>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="Table">
                    <thead style="background-color: #f8f9fa;">
                        <tr>
                            <th class="ps-4 py-3 text-muted fw-bold small text-uppercase" style="width: 80px;">NO</th>
                            <th class="py-3 text-muted fw-bold small text-uppercase">NAMA JABATAN</th>
                            <th class="py-3 text-muted fw-bold small text-uppercase text-center" style="width: 220px;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($jabatan as $jab) : ?>    
                        <tr>
                            <td class="ps-4">
                                <span class="fw-bold text-muted"><?= $no++ ?></span>
                            </td>
                            <td>
                                <span class="fw-bold text-dark fs-6"><?= $jab['jabatan'] ?></span>
                            </td>
                            <td class="text-center pe-4">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="<?= base_url('Admin/Jabatan/edit/' . $jab['id']) ?>" 
                                       class="btn btn-sm px-3 fw-bold shadow-sm" 
                                       style="border-radius: 10px; background-color: #fff9db; color: #f08c00; border: 1px solid #ffe066;">
                                       Edit
                                    </a>
                                    
                                    <a href="<?= base_url('Admin/Jabatan/delete/' . $jab['id']) ?>" 
                                       class="btn btn-sm px-3 fw-bold shadow-sm tombol-hapus" 
                                       onclick="return confirm('Yakin ingin menghapus jabatan <?= $jab['jabatan'] ?>?')"
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

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    /* Hover effect agar lebih hidup */
    #Table tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.01);
    }
    
    .btn:hover {
        filter: brightness(0.9);
        transform: translateY(-1px);
    }
</style>

<?= $this->endSection() ?>