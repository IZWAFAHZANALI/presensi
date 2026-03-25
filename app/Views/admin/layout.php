<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="assets/images/logo/logo-mpsnet.png" type="image/x-icon" />
    <title><?= $title ?></title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css')?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/lineicons.css')?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/main.css')?>" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tabler-icons/3.35.0/tabler-icons.min.css" />

    <style>
      :root {
        --mps-navy: #000066;
        --mps-red: #ff4d6d;
        --bg-soft: #f0f4ff;
        --accent-blue: #a2d2ff;
        --sidebar-width: 280px;
      }

      body {
        font-family: 'Nunito', sans-serif;
        background-color: var(--bg-soft);
        background-image: radial-gradient(#d1d9ff 1px, transparent 1px);
        background-size: 25px 25px;
      }

      /* --- SIDEBAR CUSTOM --- */
      .sidebar-nav-wrapper {
        background: var(--mps-navy) !important;
        border-radius: 0 40px 40px 0; /* Membuat pojok kanan sidebar membulat */
        box-shadow: 10px 0 30px rgba(0,0,102,0.1);
        padding: 20px 15px;
      }

      .navbar-logo {
        padding: 20px 0;
        text-align: center; /* Membuat logo di tengah */
        display: flex;
        justify-content: center;
      }

      .navbar-logo img {
        width: 60% !important; /* Memperbesar logo agar proporsional */
        filter: drop-shadow(0 5px 10px rgba(0,0,0,0.2));
        transition: transform 0.3s ease;
      }

      .navbar-logo img:hover {
        transform: scale(1.1) rotate(5deg); /* Animasi lucu saat di-hover */
      }

      /* Navigation Items */
      .sidebar-nav ul .nav-item a {
        border-radius: 50px; /* Menu berbentuk kapsul */
        margin: 5px 0;
        padding: 12px 20px;
        color: rgba(255,255,255,0.7) !important;
        font-weight: 600;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      }

      .sidebar-nav ul .nav-item a:hover, 
      .sidebar-nav ul .nav-item a.active {
        background: rgba(255,255,255,0.1);
        color: #fff !important;
        transform: translateX(10px); /* Efek bergeser sedikit */
      }

      .sidebar-nav ul .nav-item a .text {
        font-size: 15px;
      }

      /* Icon coloring */
      .sidebar-nav ul .nav-item a svg {
        margin-right: 15px;
        stroke: var(--accent-blue); /* Warna ikon biru muda pastel */
      }

      /* --- HEADER CUSTOM --- */
      .header {
        background: rgba(255, 255, 255, 0.8) !important;
        backdrop-filter: blur(10px);
        margin: 20px;
        border-radius: 30px; /* Header melayang yang membulat */
        box-shadow: 0 10px 30px rgba(0,0,0,0.05) !important;
        border: 2px solid #fff;
      }

      #menu-toggle {
        border-radius: 50px;
        padding: 10px 25px;
        background: var(--mps-navy);
        box-shadow: 0 5px 15px rgba(0,0,102,0.2);
      }

      /* --- Update Profile Box Admin agar sama dengan Pegawai --- */
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

      .profile-info {
          background: transparent !important; /* Menghilangkan background putih lama */
          padding: 0 !important;
          border: none !important;
          border-radius: 0 !important;
      }

      /* Update border foto agar putih bersih seperti punya Pegawai */
      .profile-info img {
          border-radius: 50%;
          border: 2px solid #fff !important; 
          width: 38px !important;
          height: 38px !important;
          object-fit: cover;
          box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      }

      /* Atur jarak teks nama agar lebih pas */
      .profile-info .content {
          margin-left: 12px;
      }

      .profile-info .content h6 {
          font-size: 14px;
          font-weight: 800 !important; /* Lebih bold seperti Pegawai */
          color: #334155;
      }

      .profile-info .content p {
          font-size: 10px !important;
          color: #64748b;
      }

      /* --- FOOTER --- */
      .footer {
        background: transparent;
        margin-top: 40px;
      }

      /* Animasi Mengambang untuk Page Title */
      .title h2 {
        color: var(--mps-navy);
        font-weight: 800;
        position: relative;
        display: inline-block;
      }

      /* Preloader Kawaii */
      .spinner {
          width: 60px;
          height: 60px;
          border: 6px solid #f3f3f3;
          border-top: 6px solid var(--mps-red) !important; /* Pakai warna merah logo */
          border-radius: 50%;
          animation: spin 1s linear infinite;
      }

      @keyframes spin {
          0% { transform: rotate(0deg); }
          100% { transform: rotate(360deg); }
      }

      /* Update CSS yang sudah ada di layout.php admin */
      .profile-info .image img {
          border-radius: 50%;
          border: 2px solid var(--mps-red);
          width: 40px; /* Ukuran tetap */
          height: 40px; /* Ukuran tetap */
          object-fit: cover; /* Memotong bagian tengah foto agar tidak gepeng */
      }

    </style>

    <!-- leaflet css -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""/>

    <!-- leaflet js -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""></script>

  </head>
  
  <body>
    <div id="preloader">
      <div class="spinner"></div>
    </div>

    <aside class="sidebar-nav-wrapper">
      <div class="navbar-logo">
        <a href="<?= base_url('Admin/home') ?>">
          <img src="<?= base_url('assets/images/logo/logo-mpsnet.PNG') ?>" alt="logo" />
        </a>
      </div>
      <nav class="sidebar-nav">
        <ul>
          <li class="nav-item">
            <a href="<?= base_url('Admin/home') ?>">
              <i class="ti ti-smart-home fs-4"></i>
              <span class="text">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('Admin/data_pegawai') ?>">
              <i class="ti ti-users-group fs-4"></i>
              <span class="text">Data Pegawai</span>
            </a>
          </li>

          <li class="nav-item nav-item-has-children">
            <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#Master-Data">
              <i class="ti ti-database-cog fs-4"></i>
              <span class="text">Master Data</span>
            </a>
            <ul id="Master-Data" class="collapse dropdown-nav">
              <li><a href="<?= base_url("Admin/Jabatan") ?>"> Data Jabatan </a></li>
              <li><a href="<?= base_url('Admin/lokasi_presensi') ?>"> Lokasi Presensi </a></li>
            </ul>
          </li>

          <li class="nav-item nav-item-has-children">
            <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#ddmenu_1">
              <i class="ti ti-report-analytics fs-4"></i>
              <span class="text">Rekap Presensi</span>
            </a>
            <ul id="ddmenu_1" class="collapse dropdown-nav">
              <li><a href="<?= base_url('Admin/rekap_harian') ?>"> Rekap Harian </a></li>
              <li><a href="<?= base_url('Admin/rekap_bulanan') ?>"> Rekap Bulanan </a></li>
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="<?= base_url('Admin/ketidakhadiran') ?>">
              <i class="ti ti-user-off fs-4"></i>
              <span class="text">Ketidakhadiran</span>
            </a>
          </li>
          <li class="nav-item mt-50">
            <a href="<?= base_url('logout') ?>" style="background: rgba(255, 77, 109, 0.2); color: var(--mps-red) !important;">
              <i class="ti ti-logout fs-4" style="stroke: var(--mps-red);"></i>
              <span class="text">Logout</span>
            </a>
          </li>
        </ul>
      </nav>
    </aside>
    <div class="overlay"></div>

    <main class="main-wrapper">
      <header class="header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-5 col-md-5 col-6">
              <div class="header-left d-flex align-items-center">
                <div class="menu-toggle-btn mr-15">
                  <button id="menu-toggle" class="main-btn primary-btn btn-hover">
                    <i class="ti ti-layout-sidebar-left-collapse me-2"></i> Menu
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
                                          <img src="<?= base_url('profile/' . $path_foto) ?>" class="rounded-circle shadow-sm">
                                      </div>
                                      <div class="content d-none d-md-block text-start">
                                          <h6 class="mb-0"><?= session()->get('username') ?></h6>
                                          <p class="mb-0"><?= session()->get('jabatan') ?? 'Admin MPSNET' ?></p>
                                      </div>
                                  </div>
                                  <i class="ti ti-chevron-down ms-3 text-muted"></i>
                              </button>
                              <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0" style="border-radius: 18px; padding: 10px;">
                                  <li><a href="<?= base_url('Admin/profile') ?>" class="dropdown-item px-3 py-2 text-sm rounded-3"><i class="ti ti-user-circle me-2"></i> Profil Saya</a></li>
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
          <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title">
                  <h2><?= $title ?> ✨</h2>
                </div>
              </div>
            </div>
          </div>
          <div class="content-card shadow-sm" style="background: #fff; border-radius: 30px; padding: 30px; border: 1px solid rgba(0,0,0,0.05);">
            <?= $this->renderSection('content') ?>
          </div>
        </div>
      </section>

      <footer class="footer">
        <div class="container-fluid text-center">
          <p class="text-sm text-muted">Made with ❤️ for <strong>MPSNET</strong></p>
        </div>
      </footer>
    </main>

    <script src="<?= base_url('assets/js/main.js')?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
      window.onload = function() {
        const preloader = document.getElementById('preloader');
        if (preloader) {
          preloader.style.display = 'none';
        }
      };
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- PERBAIKAN PRELOADER MACET ---
        // Jika setelah 3 detik preloader masih ada, kita paksa hilang
        setTimeout(function() {
            const preloader = document.getElementById('preloader');
            if (preloader) {
                preloader.style.opacity = '0';
                setTimeout(() => preloader.style.display = 'none', 500);
            }
        }, 3000);

        // Inisialisasi Dropdown
        var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
        var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
            return new bootstrap.Dropdown(dropdownToggleEl)
        });
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Logika Pemicu SweetAlert dari Session Flashdata
        $(document).ready(function() {
            <?php if (session()->getFlashdata('berhasil')) : ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '<?= session()->getFlashdata('berhasil') ?>',
                    showConfirmButton: false,
                    timer: 2000,
                    showClass: { popup: 'animate__animated animate__fadeInUp' }
                });
            <?php endif; ?>

            <?php if (session()->getFlashdata('gagal')) : ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Waduh!',
                    text: '<?= session()->getFlashdata('gagal') ?>',
                    confirmButtonColor: '#ff4d6d'
                });
            <?php endif; ?>
        });

        // Tombol Konfirmasi Hapus (Bisa dipakai di semua halaman admin)
        $(document).on('click', '.btn-hapus', function(e) {
            e.preventDefault();
            const href = $(this).attr('href');

            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#000066',
                cancelButtonColor: '#ff4d6d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = href;
                }
            })
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    </body>
</html>