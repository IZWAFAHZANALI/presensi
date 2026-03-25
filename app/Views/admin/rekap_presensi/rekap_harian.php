<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<?php
if(isset($lokasi_presensi)){
    if($lokasi_presensi['zona_waktu'] == 'WIB') date_default_timezone_set('Asia/Jakarta');
    elseif($lokasi_presensi['zona_waktu'] == 'WITA') date_default_timezone_set('Asia/Makassar');
    elseif($lokasi_presensi['zona_waktu'] == 'WIT') date_default_timezone_set('Asia/Jayapura');
}
?>

<div class="container-fluid">
    <div class="mb-4">
        <h4 class="fw-bold text-dark">Rekap Presensi Harian 📅</h4>
        <p class="text-muted small">Pantau kehadiran pegawai secara real-time berdasarkan tanggal yang dipilih.</p>
    </div>

    <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;">
        <div class="card-body p-4">
            <form method="GET" action="<?= base_url('Admin/rekap_harian') ?>" class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-secondary">Filter Tanggal</label>
                    <input type="date" class="form-control border-0 bg-light" name="filter_tanggal" 
                           value="<?= $tanggal ?? date('Y-m-d') ?>" style="border-radius: 12px;">
                </div>
                
                <div class="col-md-9 text-md-end">
                    <div class="d-flex gap-2 justify-content-md-end">
                        <button type="submit" class="btn btn-primary px-4 fw-bold shadow-sm" style="border-radius: 12px;">
                            Tampilkan 🔍
                        </button>
                        <button type="submit" name="excel" class="btn btn-success px-4 fw-bold shadow-sm" style="border-radius: 12px;">
                            Export Excel 📗
                        </button>
                        <a href="<?= base_url('Admin/rekap_harian') ?>" class="btn btn-outline-secondary px-4 fw-bold" style="border-radius: 12px;">
                            Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="ps-4 py-3 border-0">NO</th>
                        <th class="py-3 border-0">NAMA PEGAWAI</th>
                        <th class="py-3 border-0 text-center">TANGGAL</th>
                        <th class="py-3 border-0 text-center">MASUK</th>
                        <th class="py-3 border-0 text-center">KELUAR</th>
                        <th class="py-3 border-0 text-center">TOTAL KERJA</th>
                        <th class="py-3 border-0 text-center pe-4">STATUS</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <?php if ($rekap_harian) : ?>
                        <?php 
                        $no = 1; 
                        foreach ($rekap_harian as $rekap) : 
                            
                            // Logika Jam Kerja
                            $tm_masuk = strtotime($rekap['tanggal_masuk'] . ' ' . $rekap['jam_masuk']);
                            $tm_keluar = strtotime($rekap['tanggal_keluar'] . ' ' . $rekap['jam_keluar']);
                            
                            if ($rekap['jam_keluar'] == '00:00:00') {
                                $total_kerja = "<span class='text-warning small fw-bold italic'>Bekerja...</span>";
                            } elseif ($tm_keluar > $tm_masuk) {
                                $selisih = $tm_keluar - $tm_masuk;
                                $jam_k = floor($selisih / 3600);
                                $menit_k = floor(($selisih % 3600) / 60);
                                $total_kerja = "<span class='text-dark fw-bold'>{$jam_k}j {$menit_k}m</span>";
                            } else {
                                $total_kerja = "<span class='text-danger'>-</span>";
                            }

                            // Logika Terlambat
                            $jam_real = strtotime($rekap['jam_masuk']);
                            $jam_kantor = strtotime($rekap['jam_masuk_kantor']);
                            $selisih_t = $jam_real - $jam_kantor;
                        ?>
                            <tr>
                                <td class="ps-4 fw-bold text-muted"><?= $no++ ?></td>
                                <td>
                                    <div class="fw-bold text-dark"><?= $rekap['nama'] ?></div>
                                    <small class="text-muted d-block" style="font-size: 10px;">ID Pegawai: #<?= rand(1000, 9999) ?></small>
                                </td>
                                <td class="text-center">
                                    <div class="small fw-medium"><?= date('d M Y', strtotime($rekap['tanggal_masuk'])) ?></div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-primary border px-3" style="font-size: 13px;"><?= $rekap['jam_masuk'] ?></span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-secondary border px-3" style="font-size: 13px;">
                                        <?= ($rekap['jam_keluar'] == '00:00:00') ? '--:--' : $rekap['jam_keluar'] ?>
                                    </span>
                                </td>
                                <td class="text-center"><?= $total_kerja ?></td>
                                <td class="text-center pe-4">
                                    <?php if ($selisih_t <= 0) : ?>
                                        <span class="badge-on-time">✨ On Time</span>
                                    <?php else : 
                                        $jam_t = floor($selisih_t / 3600);
                                        $menit_t = floor(($selisih_t % 3600) / 60);
                                    ?>
                                        <span class="text-late">
                                            🚀 Telat: <?= ($jam_t > 0) ? $jam_t . 'j ' : '' ?><?= $menit_t ?>m
                                        </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="mb-2" style="font-size: 40px;">📅</div>
                                <p class="text-muted">Belum ada data presensi untuk hari ini.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    /* Styling Badge Kawai (Consistant with Monthly) */
    .badge-on-time {
        background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
        color: #166534;
        padding: 6px 14px;
        border-radius: 30px;
        font-weight: 700;
        font-size: 11px;
        border: 1px solid #86efac;
        display: inline-block;
    }

    .text-late {
        color: #ef4444;
        background-color: #fef2f2;
        padding: 6px 14px;
        border-radius: 30px;
        font-weight: 700;
        font-size: 11px;
        border: 1px solid #fecaca;
        display: inline-block;
    }

    /* Hover & Table UI */
    .table-hover tbody tr:hover {
        background-color: #f8faff !important;
        transition: 0.3s;
    }

    thead th {
        font-size: 11px;
        letter-spacing: 1px;
    }

    .italic { font-style: italic; }
</style>

<?= $this->endSection() ?>