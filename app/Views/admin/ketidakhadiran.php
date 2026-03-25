<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="mb-4">
        <h4 class="fw-bold text-dark">Data Ketidakhadiran Pegawai 📝</h4>
        <p class="text-muted small">Kelola dan verifikasi pengajuan izin atau sakit pegawai di sini.</p>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="Table">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="ps-4 py-3 border-0">NO</th>
                        <th class="py-3 border-0">TANGGAL</th>
                        <th class="py-3 border-0 text-center">KETERANGAN</th>
                        <th class="py-3 border-0">DESKRIPSI</th>
                        <th class="py-3 border-0 text-center">LAMPIRAN</th>
                        <th class="py-3 border-0 text-center">STATUS</th>
                        <th class="py-3 border-0 text-center pe-4">AKSI</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <?php if($ketidakhadiran) : ?>
                        <?php $no= 1; ?>
                        <?php foreach ($ketidakhadiran as $data) : ?>    
                        <tr>
                            <td class="ps-4 fw-bold text-muted"><?= $no++ ?></td>
                            <td>
                                <div class="fw-bold text-dark"><?= date('d M Y', strtotime($data['tanggal'])) ?></div>
                            </td>
                            <td class="text-center">
                                <?php if($data['keterangan'] == 'Sakit') : ?>
                                    <span class="badge rounded-pill bg-soft-danger text-danger px-3">🤒 Sakit</span>
                                <?php else : ?>
                                    <span class="badge rounded-pill bg-soft-info text-info px-3">📝 Izin</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="text-muted small" style="max-width: 200px; line-height: 1.2;">
                                    <?= (strlen($data['deskripsi']) > 50) ? substr($data['deskripsi'], 0, 50) . '...' : $data['deskripsi'] ?>
                                </div>
                            </td>
                            <td class="text-center">
                                <a class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold" 
                                   href="<?= base_url('file_ketidakhadiran/' . $data['file']) ?>" target="_blank">
                                    <i class="bi bi-download me-1"></i> Lihat File
                                </a>
                            </td>
                            <td class="text-center">
                                <?php if($data['status'] == 'Pending') : ?>
                                    <span class="badge-status pending">⏳ <?= $data['status'] ?></span>
                                <?php else : ?>
                                    <span class="badge-status approved">✅ <?= $data['status'] ?></span>
                                <?php endif ; ?>
                            </td>
                            <td class="text-center pe-4">
                                <?php if($data['status'] == 'Pending') : ?>
                                    <a class="btn btn-success btn-sm rounded-pill px-3 fw-bold shadow-sm" 
                                       href="<?= base_url('Admin/approved_ketidakhadiran/' . $data['id']) ?>"
                                       onclick="return confirm('Apakah Anda yakin ingin menyetujui pengajuan ini?')">
                                        Setujui
                                    </a>
                                <?php else : ?>
                                    <button class="btn btn-light btn-sm rounded-pill px-3 text-muted border-0" disabled>
                                        Selesai
                                    </button>
                                <?php endif ; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div style="font-size: 50px;">🍃</div>
                                <p class="text-muted mt-2">Tidak ada data ketidakhadiran saat ini.</p>
                            </td>
                        </tr>
                    <?php endif ; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    /* Styling Badges Keterangan */
    .bg-soft-danger { background-color: rgba(220, 53, 69, 0.1); }
    .bg-soft-info { background-color: rgba(13, 202, 240, 0.1); }

    /* Custom Status Badges */
    .badge-status {
        padding: 6px 14px;
        border-radius: 30px;
        font-weight: 700;
        font-size: 11px;
        display: inline-block;
    }
    .badge-status.pending {
        background-color: #fff9db;
        color: #f08c00;
        border: 1px solid #ffe066;
    }
    .badge-status.approved {
        background-color: #ebfbee;
        color: #2b8a3e;
        border: 1px solid #b2f2bb;
    }

    /* Table Hover & UI */
    .table-hover tbody tr:hover {
        background-color: #f8faff !important;
        transition: 0.3s ease;
    }

    thead th {
        font-size: 11px;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .btn-sm {
        font-size: 11px;
    }
</style>

<?= $this->endSection() ?>