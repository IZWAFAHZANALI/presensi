<?= $this->extend('pegawai/layout.php') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    :root {
        --mps-navy: #001180;
        --mps-red: #ed1c24;
        --mps-bg: #f4f7fe;
    }

    .card-main {
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        background: #fff;
    }

    .header-section {
        background: var(--mps-navy);
        border-radius: 20px 20px 0 0;
        padding: 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header-title h4 { color: #fff; font-weight: 700; margin: 0; }
    .header-title p { color: rgba(255,255,255,0.7); margin: 0; font-size: 0.9rem; }

    .btn-ajukan {
        background: #fff;
        color: var(--mps-navy);
        border: none;
        padding: 10px 20px;
        border-radius: 12px;
        font-weight: 700;
        transition: all 0.3s;
        text-decoration: none;
    }

    .btn-ajukan:hover {
        background: var(--mps-red);
        color: #fff;
        transform: translateY(-3px);
    }

    .status-badge {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        display: inline-block;
    }

    .status-pending { background: #fff8e1; color: #ffa000; border: 1px solid #ffe082; }
    .status-approved { background: #e8f5e9; color: #2e7d32; border: 1px solid #c8e6c9; }
    .status-rejected { background: #ffebee; color: #c62828; border: 1px solid #ffcdd2; }

    .table-container { padding: 20px; }
    
    .custom-table thead th {
        background: #f8fafc;
        border: none;
        color: #64748b;
        font-size: 0.8rem;
        text-transform: uppercase;
        padding: 15px;
    }

    .custom-table tbody td {
        padding: 15px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
    }

    .btn-action {
        width: 35px;
        height: 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        transition: 0.3s;
        text-decoration: none;
    }

    .btn-edit { background: #e0e7ff; color: #4338ca; }
    .btn-edit:hover { background: #4338ca; color: #fff; }
    
    .btn-delete { background: #fee2e2; color: #ef4444; }
    .btn-delete:hover { background: #ef4444; color: #fff; }

    .file-link {
        text-decoration: none;
        font-weight: 600;
        color: var(--mps-navy);
    }
</style>

<div class="container-fluid py-4">
    <div class="card card-main">
        <div class="header-section">
            <div class="header-title">
                <h4>Data Ketidakhadiran</h4>
                <p>Kelola perizinan, sakit, dan cuti Anda</p>
            </div>
            <a href="<?= base_url('Pegawai/ketidakhadiran/create') ?>" class="btn btn-ajukan">
                <i class="bi bi-plus-circle-fill"></i> Ajukan Izin
            </a>
        </div>

        <div class="table-container">
            <div class="table-responsive">
                <table class="table custom-table" id="Table">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">Tanggal</th>
                            <th width="15%">Keterangan</th>
                            <th>Deskripsi</th>
                            <th width="10%">Lampiran</th>
                            <th width="15%">Status</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($ketidakhadiran) : ?>
                            <?php $no= 1; ?>
                            <?php foreach ($ketidakhadiran as $k) : ?>    
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td class="fw-bold"><?= date('d M Y', strtotime($k['tanggal'])) ?></td>
                                    <td><span class="badge bg-light text-dark border"><?= $k['keterangan'] ?></span></td>
                                    <td class="small text-muted"><?= $k['deskripsi'] ?></td>
                                    <td>
                                        <a target="_blank" class="file-link" href="<?= base_url('file_ketidakhadiran/' . $k['file']) ?>">
                                            <i class="bi bi-file-earmark-text"></i> Lihat
                                        </a>
                                    </td>
                                    <td>
                                        <?php 
                                            $s = strtolower($k['status']);
                                            $class = ($s == 'disetujui' || $s == 'approved') ? 'status-approved' : (($s == 'ditolak' || $s == 'rejected') ? 'status-rejected' : 'status-pending');
                                        ?>
                                        <span class="status-badge <?= $class ?>"><?= $k['status'] ?></span>
                                    </td>
                                    <td class="text-center">
                                        <?php if($s == 'pending') : ?>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="<?= base_url('Pegawai/ketidakhadiran/edit/' . $k['id']) ?>" class="btn-action btn-edit" title="Edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <a href="<?= base_url('Pegawai/ketidakhadiran/delete/' . $k['id']) ?>" class="btn-action btn-delete tombol-hapus" onclick="return confirm('Yakin hapus data?')" title="Hapus">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </a>
                                            </div>
                                        <?php else : ?>
                                            <small class="text-muted"><i class="bi bi-lock-fill"></i> Locked</small>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="7" class="text-center py-5">Data Kosong</td>
                            </tr>
                        <?php endif ; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>