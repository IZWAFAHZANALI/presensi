<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<?php date_default_timezone_set('Asia/Jakarta'); ?>

<style>
    /* Styling khusus untuk Dashboard */
    .dashboard-date {
        font-weight: 700;
        color: var(--mps-navy);
        background: #fff;
        padding: 8px 20px;
        border-radius: 50px;
        display: inline-block;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border: 2px solid var(--bg-soft);
    }

    .icon-card {
        background: #ffffff !important;
        border-radius: 30px !important; /* Super rounded */
        border: none !important;
        padding: 25px !important;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
        z-index: 1;
    }

    .icon-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,102,0.1) !important;
    }

    /* Efek hiasan lingkaran di belakang kartu */
    .icon-card::after {
        content: '';
        position: absolute;
        top: -20px;
        right: -20px;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        z-index: -1;
        opacity: 0.1;
    }

    .icon-card.total-pegawai::after { background: #9b51e0; }
    .icon-card.hadir::after { background: #219653; }
    .icon-card.alpa::after { background: #eb5757; }
    .icon-card.izin::after { background: #f2994a; }

    .icon-card .icon {
        width: 60px !important;
        height: 60px !important;
        border-radius: 18px !important; /* Squircle style */
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 15px;
    }

    .icon-card .content h6 {
        font-weight: 700;
        color: #888;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .icon-card .content h3 {
        font-weight: 800;
        color: var(--mps-navy);
        font-size: 28px;
    }

    /* Chart Container Styling */
    .chart-wrapper {
        background: #fff;
        border-radius: 35px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        border: 2px solid #f8f9ff;
    }
</style>

<div class="mb-4">
    <span class="dashboard-date">
        <i class="ti ti-calendar-event me-2"></i> Data Tanggal: <?= date('d F Y') ?>
    </span>
</div>

<div class="row">
    <div class="col-xl-3 col-lg-4 col-sm-6">
        <div class="icon-card total-pegawai mb-30 shadow-sm">
            <div class="icon purple">
                <i class="ti ti-users fs-1 text-purple"></i>
            </div>
            <div class="content">
                <h6 class="mb-1">Total Pegawai</h6>
                <h3 class="mb-0"><?= $total_pegawai ?></h3>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-4 col-sm-6">
        <div class="icon-card hadir mb-30 shadow-sm">
            <div class="icon success">
                <i class="ti ti-user-check fs-1 text-success"></i>
            </div>
            <div class="content">
                <h6 class="mb-1">Hadir</h6>
                <h3 class="mb-0"><?= $total_hadir ?></h3>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-4 col-sm-6">
        <div class="icon-card alpa mb-30 shadow-sm">
            <div class="icon danger" style="background: rgba(235, 87, 87, 0.1);">
                <i class="ti ti-user-x fs-1 text-danger"></i>
            </div>
            <div class="content">
                <h6 class="mb-1">Alpa</h6>
                <h3 class="mb-0"><?= $total_pegawai - ($total_hadir + $ketidakhadiran) ?></h3>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-4 col-sm-6">
        <div class="icon-card izin mb-30 shadow-sm">
            <div class="icon orange">
                <i class="ti ti-clock-pause fs-1 text-orange"></i>
            </div>
            <div class="content">
                <h6 class="mb-1">Izin/Sakit</h6>
                <h3 class="mb-0"><?= $ketidakhadiran ?></h3>
            </div>
        </div>
    </div>
</div>



<?= $this->endSection() ?>