<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.svg') ?>" type="image/x-icon" />
    <title><?= $title ?></title>

    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/lineicons.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/materialdesignicons.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/main.css') ?>" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tabler-icons/3.35.0/tabler-icons.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --mps-navy: #000066;
            --mps-red: #ff0000;
            --mps-light-blue: #eef2ff;
            --bg-soft: #f4f7fe;
            --sidebar-width: 280px;
        }

        body {
            background-color: var(--bg-soft);
            background-image: radial-gradient(rgba(0, 0, 102, 0.05) 1.5px, transparent 1.5px);
            background-size: 30px 30px; /* Pola dot halus agar tidak flat */
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #334155;
            overflow-x: hidden;
        }

        /* --- Custom Scrollbar --- */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        /* --- Modern Preloader --- */
        #preloader {
            background: #fff;
            height: 100vh;
            width: 100%;
            position: fixed;
            z-index: 999999;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .spinner {
            width: 60px;
            height: 60px;
            border: 6px solid var(--mps-light-blue);
            border-top: 6px solid var(--mps-red);
            border-radius: 50%;
            animation: spin 1s cubic-bezier(0.68, -0.55, 0.27, 1.55) infinite;
        }

        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }

        /* --- Sidebar Modern --- */
        .sidebar-nav-wrapper {
            background: #ffffff !important;
            border-right: none !important;
            box-shadow: 20px 0 40px rgba(0,0,0,0.03) !important;
            width: var(--sidebar-width) !important;
            border-radius: 0 30px 30px 0; /* Membuat pojok sidebar membulat */
        }

        .navbar-logo {
            padding: 40px 20px !important;
            transition: all 0.3s ease;
        }

        .sidebar-nav ul .nav-item {
            margin: 8px 15px !important;
        }

        .sidebar-nav ul .nav-item a {
            border-radius: 15px !important;
            padding: 14px 20px !important;
            font-weight: 600 !important;
            color: #64748b !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar-nav ul .nav-item.active a {
            background: var(--mps-navy) !important;
            color: #ffffff !important;
            box-shadow: 0 10px 20px rgba(0,0,102,0.15);
        }

        .sidebar-nav ul .nav-item a:hover:not(.active) {
            background: var(--mps-light-blue) !important;
            color: var(--mps-navy) !important;
            transform: translateX(5px);
        }

        .sidebar-nav ul .nav-item a .icon {
            width: 35px !important;
            height: 35px !important;
            background: #f8fafc;
            border-radius: 10px;
            margin-right: 15px !important;
            font-size: 18px;
            transition: all 0.3s ease;
        }

        .sidebar-nav ul .nav-item.active a .icon {
            background: rgba(255,255,255,0.2) !important;
            color: #fff !important;
        }

        /* --- Floating Header --- */
        .header {
            background: rgba(255, 255, 255, 0.8) !important;
            backdrop-filter: blur(15px);
            margin: 15px 25px;
            border-radius: 20px;
            border: 1px solid rgba(255,255,255,0.5) !important;
            box-shadow: 0 10px 30px rgba(0,0,0,0.04) !important;
            padding: 10px 0;
        }

        #menu-toggle {
            background: #fff !important;
            color: var(--mps-navy) !important;
            border: 2px solid var(--mps-light-blue) !important;
            border-radius: 12px !important;
            padding: 10px 18px !important;
            font-weight: 700;
            box-shadow: 0 4px 6px rgba(0,0,0,0.02);
        }

        .profile-box {
            background: #f8fafc !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 16px !important;
            padding: 6px 15px 6px 6px !important;
            transition: all 0.3s ease;
        }

        .profile-box:hover {
            border-color: var(--mps-navy) !important;
            background: #fff !important;
        }

        /* --- Main Content Section --- */
        .main-wrapper {
            padding-bottom: 50px;
        }

        .content-card-wrapper {
            background: #ffffff;
            border-radius: 30px;
            padding: 35px;
            box-shadow: 0 20px 50px rgba(0,0,102,0.02);
            border: 1px solid rgba(0,0,0,0.02);
            min-height: 70vh;
        }

        .title h2 {
            font-size: 28px;
            letter-spacing: -0.5px;
            position: relative;
            display: inline-block;
        }

        .title h2::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 40px;
            height: 4px;
            background: var(--mps-red);
            border-radius: 10px;
        }
    </style>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
</head>
<body>
    <div id="preloader">
        <div class="spinner"></div>
    </div>

    <aside class="sidebar-nav-wrapper">
        <div class="navbar-logo">
            <a href="<?= base_url('Pegawai/home') ?>">
                <img src="<?= base_url('assets/images/logo/logo-mpsnet.png') ?>" alt="logo" style="width: 100%; max-width: 150px; filter: drop-shadow(0 5px 10px rgba(0,0,0,0.05));" />
            </a>
        </div>
        <nav class="sidebar-nav">
            <ul>
                <li class="nav-item <?= (uri_string() == 'Pegawai/home') ? 'active' : '' ?>">
                    <a href="<?= base_url('Pegawai/home') ?>">
                        <span class="icon"><i class="ti ti-layout-dashboard"></i></span>
                        <span class="text">Dashboard</span>
                    </a>
                </li>
                
                <li class="nav-item <?= (uri_string() == 'Pegawai/rekap_presensi') ? 'active' : '' ?>">
                    <a href="<?= base_url('Pegawai/rekap_presensi') ?>">
                        <span class="icon"><i class="ti ti-calendar-stats"></i></span>
                        <span class="text">Rekap Presensi</span>
                    </a>
                </li>
                
                <li class="nav-item <?= (uri_string() == 'Pegawai/ketidakhadiran') ? 'active' : '' ?>">
                    <a href="<?= base_url('Pegawai/ketidakhadiran') ?>">
                        <span class="icon"><i class="ti ti-user-pause"></i></span>
                        <span class="text">Ketidakhadiran</span>
                    </a>
                </li>

                <li class="nav-item" style="margin-top: 50px !important;">
                    <a href="<?= base_url('logout') ?>" class="text-danger" style="background: rgba(255,0,0,0.03) !important;">
                        <span class="icon" style="background: rgba(255,0,0,0.08);"><i class="ti ti-logout text-danger"></i></span>
                        <span class="text">Keluar</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>
    <div class="overlay"></div>

    <main class="main-wrapper">
        <header class="header">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-5 col-md-5 col-6">
                        <div class="header-left d-flex align-items-center">
                            <div class="menu-toggle-btn mr-15">
                                <button id="menu-toggle" class="main-btn primary-btn btn-hover">
                                    <i class="lni lni-grid-alt me-2"></i> Menu
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-6">
                        <div class="header-right d-flex justify-content-end">
                            <div class="profile-box">
                                <button class="dropdown-toggle bg-transparent border-0 d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                                    <div class="profile-info d-flex align-items-center">
                                        <div class="position-relative">
                                            <?php 
                                            $foto_profil = session()->get('foto');
                                            $path_foto = (empty($foto_profil)) ? 'default.png' : $foto_profil; 
                                            ?>
                                            <img src="<?= base_url('profile/' . $path_foto) ?>" 
                                                class="rounded-circle shadow-sm" 
                                                style="width: 38px; height: 38px; object-fit: cover; border: 2px solid #fff;">
                                        </div>
                                        <div class="content d-none d-md-block text-start ms-3">
                                            <h6 class="text-sm fw-800 mb-0"><?= session()->get('username') ?></h6>
                                            <p class="text-xs text-muted mb-0" style="font-size: 10px;"><?= session()->get('jabatan') ?? 'Pegawai MPSNET' ?></p>
                                        </div>
                                    </div>
                                    <i class="ti ti-chevron-down ms-3 text-muted"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0" style="border-radius: 18px; padding: 10px;">
                                    <li><a href="<?= base_url('Pegawai/profile') ?>" class="dropdown-item px-3 py-2 text-sm rounded-3"><i class="ti ti-user-circle me-2"></i> Profil Saya</a></li>
                                    <li><hr class="dropdown-divider opacity-50"></li>
                                    <li><a href="<?= base_url('logout') ?>" class="dropdown-item px-3 py-2 text-sm text-danger rounded-3"><i class="ti ti-logout me-2"></i> Log Out</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <section class="section">
            <div class="container-fluid">
                <div class="title-wrapper pt-2"> 
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="title mb-2">
                                <h2 class="fw-800 text-dark"><?= $title ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="content-card-wrapper" style="padding: 25px;">
                    <?= $this->renderSection('content') ?>
                </div>
            </div>
        </section>

        <footer class="footer py-4 mt-5">
            <div class="container-fluid">
                <p class="text-sm text-center text-muted">
                    &copy; <?= date('Y') ?> <strong>MPSNET Presensi</strong>. Developed with ❤️
                </p>
            </div>
        </footer>
    </main>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js')?>"></script>
    <script src="<?= base_url('assets/js/main.js')?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        window.addEventListener('load', function() {
            const preloader = document.getElementById('preloader');
            setTimeout(() => { 
                preloader.style.opacity = '0';
                setTimeout(() => { preloader.style.display = 'none'; }, 500);
            }, 600);
        });

        $(document).ready( function () {
            $('#Table').DataTable({
                "language": { "search": "Cari data:", "lengthMenu": "Tampilkan _MENU_ data" }
            });
        });
    </script>
</body>
</html>