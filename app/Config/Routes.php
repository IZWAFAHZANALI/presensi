<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index');
$routes->post('login', 'Login::login_action');
$routes->get('logout', 'Login::logout');

$routes->get('Admin/home', 'Admin\Home::index', ['filter' => 'adminFilter']);
$routes->get('Admin/profile', 'Admin\profile::index', ['filter' => 'adminFilter']);
$routes->get('Admin/Jabatan', 'Admin\Jabatan::index', ['filter' => 'adminFilter']);
$routes->get('Admin/Jabatan/create', 'Admin\Jabatan::create', ['filter' => 'adminFilter']);
$routes->post('Admin/Jabatan/store', 'Admin\Jabatan::store', ['filter' => 'adminFilter']);
$routes->get('Admin/Jabatan/edit/(:segment)', 'Admin\Jabatan::edit/$1', ['filter' => 'adminFilter']);
$routes->post('Admin/Jabatan/update/(:segment)', 'Admin\Jabatan::update/$1', ['filter' => 'adminFilter']);
$routes->get('Admin/Jabatan/delete/(:segment)', 'Admin\Jabatan::delete/$1', ['filter' => 'adminFilter']);

$routes->get('Admin/lokasi_presensi', 'Admin\LokasiPresensi::index', ['filter' => 'adminFilter']);
$routes->get('Admin/lokasi_presensi/create', 'Admin\LokasiPresensi::create', ['filter' => 'adminFilter']);
$routes->post('Admin/lokasi_presensi/store', 'Admin\LokasiPresensi::store', ['filter' => 'adminFilter']);
$routes->get('Admin/lokasi_presensi/edit/(:segment)', 'Admin\LokasiPresensi::edit/$1', ['filter' => 'adminFilter']);
$routes->post('Admin/lokasi_presensi/update/(:segment)', 'Admin\LokasiPresensi::update/$1', ['filter' => 'adminFilter']);
$routes->get('Admin/lokasi_presensi/delete/(:segment)', 'Admin\LokasiPresensi::delete/$1', ['filter' => 'adminFilter']);
$routes->get('Admin/lokasi_presensi/detail/(:segment)', 'Admin\LokasiPresensi::detail/$1', ['filter' => 'adminFilter']);

$routes->get('Admin/data_pegawai', 'Admin\DataPegawai::index', ['filter' => 'adminFilter']);
$routes->get('Admin/data_pegawai/create', 'Admin\DataPegawai::create', ['filter' => 'adminFilter']);
$routes->post('Admin/data_pegawai/store', 'Admin\DataPegawai::store', ['filter' => 'adminFilter']);
$routes->get('Admin/data_pegawai/edit/(:segment)', 'Admin\DataPegawai::edit/$1', ['filter' => 'adminFilter']);
$routes->post('Admin/data_pegawai/update/(:segment)', 'Admin\DataPegawai::update/$1', ['filter' => 'adminFilter']);
$routes->get('Admin/data_pegawai/delete/(:segment)', 'Admin\DataPegawai::delete/$1', ['filter' => 'adminFilter']);
$routes->get('Admin/data_pegawai/detail/(:segment)', 'Admin\DataPegawai::detail/$1', ['filter' => 'adminFilter']);

$routes->get('Admin/rekap_harian', 'Admin\RekapPresensi::rekap_harian', ['filter' => 'adminFilter']);
$routes->get('Admin/rekap_bulanan', 'Admin\RekapPresensi::rekap_bulanan', ['filter' => 'adminFilter']);

$routes->get('Admin/ketidakhadiran', 'Admin\Ketidakhadiran::index', ['filter' => 'adminFilter']);
$routes->get('Admin/approved_ketidakhadiran/(:segment)', 'Admin\Ketidakhadiran::approved/$1', ['filter' => 'adminFilter']);


$routes->get('Pegawai/home', 'Pegawai\Home::index', ['filter' => 'pegawaiFilter']);
$routes->get('Pegawai/profile', 'Pegawai\profile::index', ['filter' => 'pegawaiFilter']);
$routes->post('Pegawai/profile/update_foto/(:segment)', 'Pegawai\Profile::update_foto/$1', ['filter' => 'pegawaiFilter']);

$routes->post('Pegawai/presensi_masuk', 'Pegawai\home::presensi_masuk', ['filter' => 'pegawaiFilter']);
$routes->post('Pegawai/presensi_masuk_aksi', 'Pegawai\home::presensi_masuk_aksi', ['filter' => 'pegawaiFilter']);

$routes->post('Pegawai/presensi_keluar/(:segment)', 'Pegawai\home::presensi_keluar/$1', ['filter' => 'pegawaiFilter']);
$routes->post('Pegawai/presensi_keluar_aksi/(:segment)', 'Pegawai\home::presensi_keluar_aksi/$1', ['filter' => 'pegawaiFilter']);

$routes->get('Pegawai/rekap_presensi', 'Pegawai\RekapPresensi::index', ['filter' => 'pegawaiFilter']);

$routes->get('Pegawai/ketidakhadiran', 'Pegawai\Ketidakhadiran::index', ['filter' => 'pegawaiFilter']);
$routes->get('Pegawai/ketidakhadiran/create', 'Pegawai\ketidakhadiran::create', ['filter' => 'pegawaiFilter']);
$routes->post('Pegawai/ketidakhadiran/store', 'Pegawai\ketidakhadiran::store', ['filter' => 'pegawaiFilter']);
$routes->get('Pegawai/ketidakhadiran/edit/(:segment)', 'Pegawai\ketidakhadiran::edit/$1', ['filter' => 'pegawaiFilter']);
$routes->post('Pegawai/ketidakhadiran/update/(:segment)', 'Pegawai\ketidakhadiran::update/$1', ['filter' => 'pegawaiFilter']);
$routes->get('Pegawai/ketidakhadiran/delete/(:segment)', 'Pegawai\ketidakhadiran::delete/$1', ['filter' => 'pegawaiFilter']);
$routes->get('Pegawai/ketidakhadiran/detail/(:segment)', 'Pegawai\ketidakhadiran::detail/$1', ['filter' => 'pegawaiFilter']);
