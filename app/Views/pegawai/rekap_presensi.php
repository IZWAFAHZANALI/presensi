<?= $this->extend('pegawai/layout.php') ?>

<?= $this->section('content') ?>

<?php
if(isset($lokasi_presensi)){
    if($lokasi_presensi['zona_waktu'] == 'WIB') date_default_timezone_set('Asia/Jakarta');
    elseif($lokasi_presensi['zona_waktu'] == 'WITA') date_default_timezone_set('Asia/Makassar');
    elseif($lokasi_presensi['zona_waktu'] == 'WIT') date_default_timezone_set('Asia/Jayapura');
}
?>

<style>
    :root {
        --mps-navy: #001180;
        --mps-red: #ed1c24;
        --mps-light: #f8fafc;
    }

    /* Card Styling */
    .card-rekap {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .card-header-mps {
        background-color: var(--mps-navy);
        color: white;
        padding: 20px;
        font-weight: 700;
        border: none;
    }

    /* Filter Styling */
    .filter-section {
        background-color: var(--mps-light);
        padding: 20px;
        border-bottom: 1px solid #e2e8f0;
    }

    .form-control-mps {
        border-radius: 10px;
        border: 1px solid #cbd5e1;
        padding: 10px 15px;
    }

    .btn-mps-primary {
        background-color: var(--mps-navy);
        color: white;
        border-radius: 10px;
        font-weight: 600;
        padding: 10px 25px;
        transition: all 0.3s;
    }

    .btn-mps-primary:hover {
        background-color: #000a4d;
        color: white;
        transform: translateY(-2px);
    }

    /* Table Styling */
    .table thead th {
        background-color: #f1f5f9;
        color: #475569;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
        font-weight: 700;
        border: none;
        padding: 15px;
    }

    .table tbody td {
        padding: 15px;
        vertical-align: middle;
        color: #1e293b;
        border-color: #f1f5f9;
    }

    .table-hover tbody tr:hover {
        background-color: #f8fafc;
    }

    /* Status Badges */
    .badge-on-time {
        background: #ecfdf5;
        color: #059669;
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.8rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border: 1px solid #d1fae5;
    }

    .badge-late {
        background: #fef2f2;
        color: var(--mps-red);
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.8rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border: 1px solid #fee2e2;
    }

    .time-badge {
        background: #fff;
        border: 1px solid #e2e8f0;
        color: var(--mps-navy);
        padding: 4px 10px;
        border-radius: 6px;
        font-weight: 600;
        font-family: 'Courier New', Courier, monospace;
    }

    .total-work-label {
        color: #64748b;
        font-size: 0.85rem;
    }
</style>

<div class="container-fluid py-4 animate__animated animate__fadeIn">
    <div class="card card-rekap">
        <div class="card-header-mps d-flex justify-content-between align-items-center">
            <h5 class="mb-0" style="color: #ffffff;"><i class="bi bi-journal-text me-2"></i>Rekap Presensi Pribadi</h5>
            <span class="badge bg-white text-primary rounded-pill px-3 py-2 fs-7">
                <i class="bi bi-calendar3 me-1"></i> <?= date('F Y') ?>
            </span>
        </div>

        <div class="filter-section">
            <form class="row g-3 align-items-end" method="GET" action="<?= base_url('Pegawai/rekap_presensi') ?>">
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-muted">Filter Berdasarkan Tanggal</label>
                    <input type="date" class="form-control form-control-mps" name="filter_tanggal" value="<?= $tanggal ?? date('Y-m-d') ?>">
                </div>
                <div class="col-md-auto">
                    <button type="submit" class="btn btn-mps-primary">
                        <i class="bi bi-search me-1"></i> Tampilkan
                    </button>
                    <a href="<?= base_url('Pegawai/rekap_presensi') ?>" class="btn btn-outline-secondary border-0 ms-2 rounded-pill">
                        <i class="bi bi-arrow-clockwise me-1"></i> Reset
                    </a>
                </div>
            </form>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Tanggal</th>
                            <th>Jam Masuk</th>
                            <th>Jam Keluar</th>
                            <th>Total Kerja</th>
                            <th class="text-center">Status Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($rekap_presensi) : ?>
                            <?php 
                            $no = 1;
                            foreach ($rekap_presensi as $rekap) : 
                                
                                // Logic Jam Kerja
                                $tm_masuk = strtotime($rekap['tanggal_masuk'] . ' ' . $rekap['jam_masuk']);
                                $tm_keluar = strtotime($rekap['tanggal_keluar'] . ' ' . $rekap['jam_keluar']);
                                
                                if ($rekap['jam_keluar'] == '00:00:00') {
                                    $total_kerja = "<span class='badge bg-light text-muted'>Proses...</span>";
                                } elseif ($tm_keluar > $tm_masuk) {
                                    $selisih = $tm_keluar - $tm_masuk;
                                    $jam_k = floor($selisih / 3600);
                                    $menit_k = floor(($selisih % 3600) / 60);
                                    $total_kerja = "<span class='fw-bold text-dark'>{$jam_k}j {$menit_k}m</span>";
                                } else {
                                    $total_kerja = "<span class='text-danger'>-</span>";
                                }

                                // Logic Terlambat
                                $jam_real = strtotime($rekap['jam_masuk']);
                                $jam_kantor = strtotime($rekap['jam_masuk_kantor']);
                                $selisih_t = $jam_real - $jam_kantor;
                            ?>
                                <tr>
                                    <td class="text-center text-muted small"><?= $no++ ?></td>
                                    <td class="fw-bold">
                                        <?= date('d M Y', strtotime($rekap['tanggal_masuk'])) ?>
                                    </td>
                                    <td>
                                        <span class="time-badge"><i class="bi bi-box-arrow-in-right me-1 text-success"></i><?= $rekap['jam_masuk'] ?></span>
                                    </td>
                                    <td>
                                        <?php if($rekap['jam_keluar'] != '00:00:00'): ?>
                                            <span class="time-badge"><i class="bi bi-box-arrow-right me-1 text-danger"></i><?= $rekap['jam_keluar'] ?></span>
                                        <?php else: ?>
                                            <span class="text-muted small">-- : --</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $total_kerja ?></td>
                                    <td class="text-center">
                                        <?php if ($selisih_t <= 0) : ?>
                                            <div class="badge-on-time">
                                                <i class="bi bi-check-circle-fill"></i> Tepat Waktu
                                            </div>
                                        <?php else : 
                                            $jam_t = floor($selisih_t / 3600);
                                            $menit_t = floor(($selisih_t % 3600) / 60);
                                        ?>
                                            <div class="badge-late">
                                                <i class="bi bi-exclamation-triangle-fill"></i>
                                                Telat: <?= ($jam_t > 0) ? $jam_t . 'j ' : '' ?><?= $menit_t ?>m
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="80" class="opacity-25 mb-3" alt="no-data">
                                    <p class="text-muted">Tidak ada data presensi pada periode ini.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>