<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth\LoginController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

$routes->get('/', 'Auth\LoginController::index', ['filter' => 'redirectIfAuthenticated']);
$routes->get('login', 'Auth\LoginController::index', ['filter' => 'redirectIfAuthenticated']);
$routes->post('login', 'Auth\LoginController::login', ['filter' => 'redirectIfAuthenticated']);
$routes->post('auth/login', 'Auth\LoginController::login', ['filter' => 'redirectIfAuthenticated']);
$routes->get('logout', 'Auth\LoginController::logout');

$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'auth'], function ($routes) {
    // Dashboard Admin 
    $routes->get('dashboard', 'DashboardController::index');

    // Route Admin/Fakultas 
    $routes->get('fakultas', 'FakultasController::index', ['as' => 'admin.fakultas.index']);
    $routes->get('fakultas/create', 'FakultasController::create', ['as' => 'admin.fakultas.create']);
    $routes->post('fakultas', 'FakultasController::store', ['as' => 'admin.fakultas.store']);
    $routes->get('fakultas/edit/(:num)', 'FakultasController::edit/$1', ['as' => 'admin.fakultas.edit']);
    $routes->put('fakultas/(:num)', 'FakultasController::update/$1', ['as' => 'admin.fakultas.update']);
    $routes->delete('fakultas/(:num)', 'FakultasController::delete/$1', ['as' => 'admin.fakultas.delete']);

    // Route Admin/Prodi 
    $routes->get('prodi', 'ProdiController::index', ['as' => 'admin.prodi.index']);
    $routes->get('prodi/create', 'ProdiController::create', ['as' => 'admin.prodi.create']);
    $routes->post('prodi', 'ProdiController::store', ['as' => 'admin.prodi.store']);
    $routes->get('prodi/edit/(:num)', 'ProdiController::edit/$1', ['as' => 'admin.prodi.edit']);
    $routes->post('prodi/update/(:num)', 'ProdiController::update/$1', ['as' => 'admin.prodi.update']);
    $routes->delete('prodi/delete/(:num)', 'ProdiController::delete/$1', ['as' => 'admin.prodi.delete']);

    // Route Admin/Mahasiswa 
    $routes->get('mahasiswa', 'MahasiswaController::index', ['as' => 'admin.mahasiswa.index']);
    $routes->get('mahasiswa/create', 'MahasiswaController::create', ['as' => 'admin.mahasiswa.create']);
    $routes->post('mahasiswa', 'MahasiswaController::store', ['as' => 'admin.mahasiswa.store']);
    $routes->get('mahasiswa/edit/(:num)', 'MahasiswaController::edit/$1', ['as' => 'admin.mahasiswa.edit']);
    $routes->put('mahasiswa/update/(:num)', 'MahasiswaController::update/$1', ['as' => 'admin.mahasiswa.update']);
    $routes->delete('mahasiswa/delete/(:num)', 'MahasiswaController::delete/$1', ['as' => 'admin.mahasiswa.delete']);

    // Route untuk Dosen
    $routes->get('dosen', 'DosenController::index', ['as' => 'admin.dosen.index']);
    $routes->get('dosen/create', 'DosenController::create', ['as' => 'admin.dosen.create']);
    $routes->post('dosen', 'DosenController::store', ['as' => 'admin.dosen.store']);
    $routes->get('dosen/edit/(:num)', 'DosenController::edit/$1', ['as' => 'admin.dosen.edit']);
    $routes->put('dosen/update/(:num)', 'DosenController::update/$1', ['as' => 'admin.dosen.update']);
    $routes->delete('dosen/delete/(:num)', 'DosenController::delete/$1', ['as' => 'admin.dosen.delete']);

    // Route untuk Dosen
    $routes->get('pembimbing', 'PembimbingController::index', ['as' => 'admin.pembimbing.index']);
    $routes->get('pembimbing/create', 'PembimbingController::create', ['as' => 'admin.pembimbing.create']);
    $routes->post('pembimbing/store', 'PembimbingController::store', ['as' => 'admin.pembimbing.store']);
    $routes->get('pembimbing/edit/(:num)', 'PembimbingController::edit/$1', ['as' => 'admin.pembimbing.edit']);
    $routes->post('pembimbing/update/(:num)', 'PembimbingController::update/$1', ['as' => 'admin.pembimbing.update']);
    $routes->delete('pembimbing/delete/(:num)', 'PembimbingController::delete/$1', ['as' => 'admin.pembimbing.delete']);

    // Admin Instansi 
    $routes->get('instansi', 'InstansiController::index');
    $routes->get('instansi/create', 'InstansiController::create');
    $routes->post('instansi/store', 'InstansiController::store');
    $routes->get('instansi/edit/(:num)', 'InstansiController::edit/$1');
    $routes->post('instansi/update/(:num)', 'InstansiController::update/$1');
    $routes->delete('instansi/delete/(:num)', 'InstansiController::delete/$1');

    // Admin PKL 
    $routes->get('pkl', 'PklController::index', ['as' => 'admin.pkl.index']);
    $routes->get('pkl/create', 'PklController::create', ['as' => 'admin.pkl.create']);
    $routes->post('pkl', 'PklController::store', ['as' => 'admin.pkl.store']);
    $routes->get('pkl/edit/(:num)', 'PklController::edit/$1', ['as' => 'admin.pkl.edit']);
    $routes->post('pkl/update/(:num)', 'PklController::update/$1', ['as' => 'admin.pkl.update']);
    $routes->get('pkl/delete/(:num)', 'PklController::delete/$1', ['as' => 'admin.pkl.delete']);
    // Rute untuk assign anggota PKL
    $routes->get('pkl/anggota/(:num)', 'PKLController::assignAnggota/$1', ['as' => 'admin.pkl.assign_anggota']);
    $routes->get('pkl/anggota/tambah', 'PKLController::storeAnggota');
    $routes->post('pkl/anggota/delete', 'PKLController::deleteAnggota');
    $routes->get('pkl/anggota/status', 'PKLController::statusAnggota');

    // Admin PKL Jurnal Pelaksanaan
    $routes->get('pkl/jurnal/pelaksanaan', 'PKLJurnalPelaksanaanController::index', ['as' => 'admin.jurnal.pelaksanaan.index']);
    $routes->get('pkl/jurnal/pelaksanaan/create', 'PKLJurnalPelaksanaanController::create', ['as' => 'admin.jurnal.pelaksanaan.create']);
    $routes->post('pkl/jurnal/pelaksanaan', 'PKLJurnalPelaksanaanController::store', ['as' => 'admin.jurnal.pelaksanaan.store']);
    $routes->get('pkl/jurnal/pelaksanaan/edit/(:num)', 'PKLJurnalPelaksanaanController::edit/$1', ['as' => 'admin.jurnal.pelaksanaan.edit']);
    $routes->post('pkl/jurnal/pelaksanaan/update/(:num)', 'PKLJurnalPelaksanaanController::update/$1', ['as' => 'admin.jurnal.pelaksanaan.update']);
    $routes->get('pkl/jurnal/pelaksanaan/show/(:num)', 'PKLJurnalPelaksanaanController::show/$1', ['as' => 'admin.jurnal.pelaksanaan.show']);
    $routes->get('pkl/jurnal/pelaksanaan/delete/(:num)', 'PKLJurnalPelaksanaanController::delete/$1', ['as' => 'admin.jurnal.pelaksanaan.delete']);

    // Admin PKL Jurnal Bimbingan
    $routes->get('pkl/jurnal/bimbingan', 'PKLJurnalBimbinganController::index', ['as' => 'admin.jurnal.bimbingan.index']);
    $routes->get('pkl/jurnal/bimbingan/create', 'PKLJurnalBimbinganController::create', ['as' => 'admin.jurnal.bimbingan.create']);
    $routes->post('pkl/jurnal/bimbingan', 'PKLJurnalBimbinganController::store', ['as' => 'admin.jurnal.bimbingan.store']);
    $routes->get('pkl/jurnal/bimbingan/edit/(:num)', 'PKLJurnalBimbinganController::edit/$1', ['as' => 'admin.jurnal.bimbingan.edit']);
    $routes->post('pkl/jurnal/bimbingan/update/(:num)', 'PKLJurnalBimbinganController::update/$1', ['as' => 'admin.jurnal.bimbingan.update']);
    $routes->get('pkl/jurnal/bimbingan/show/(:num)', 'PKLJurnalBimbinganController::show/$1', ['as' => 'admin.jurnal.bimbingan.show']);
    $routes->get('pkl/jurnal/bimbingan/delete/(:num)', 'PKLJurnalBimbinganController::delete/$1', ['as' => 'admin.jurnal.bimbingan.delete']);

    // Jadwal sidang
    $routes->get('pkl/jadwal', 'PKLJadwalSidangController::index');
    $routes->post('pkl/jadwal/simpan', 'PKLJadwalSidangController::simpan', ['as' => 'admin.pkl.jadwal.simpan']);
    $routes->get('pkl/jadwal/detail', 'PKLJadwalSidangController::show');
    $routes->get('pkl/jadwal/update_status/(:num)/(:num)', 'PKLJadwalSidangController::update_status/$1/$2', ['as' => 'admin.pkl.jadwal.update_status']);
  
    // PKL laporan
    $routes->get('pkl/laporan', 'PKLLaporanController::index', ['as' => 'admin.pkl.laporan.index']);
    $routes->get('pkl/laporan/cetak', 'PKLLaporanController::cetak', ['as' => 'admin.pkl.laporan.cetak']);
    $routes->get('pkl/laporan/jurnal/pelaksanaan', 'PKLLaporanController::pelaksanaan', ['as' => 'admin.pkl.laporan.jurnal.pelaksanaan']);
    $routes->get('pkl/laporan/jurnal/pelaksanaan/cetak', 'PKLLaporanController::pelaksanaan_cetak', ['as' => 'admin.pkl.laporan.jurnal.pelaksanaan_cetak']);
    $routes->get('pkl/laporan/jurnal/bimbingan', 'PKLLaporanController::bimbingan', ['as' => 'admin.pkl.laporan.jurnal.bimbingan']);
    $routes->get('pkl/laporan/jurnal/bimbingan/cetak', 'PKLLaporanController::bimbingan_cetak', ['as' => 'admin.pkl.laporan.jurnal.bimbingan.cetak']);
    $routes->get('pkl/laporan/jadwal', 'PKLLaporanController::jadwal', ['as' => 'admin.pkl.laporan.jadwal']);
    $routes->get('pkl/laporan/jadwal/cetak', 'PKLLaporanController::jadwal_cetak', ['as' => 'admin.pkl.laporan.jadwal.cetak']);
    $routes->get('pkl/laporan/dospem', 'PKLLaporanController::dospem', ['as' => 'admin.pkl.laporan.dospem']);
    $routes->get('pkl/laporan/dospem/cetak', 'PKLLaporanController::dospem_cetak', ['as' => 'admin.pkl.laporan.dospem.cetak']);

    // Admin Tempat
    $routes->get('tempat', 'TempatController::index', ['as' => 'admin.tempat.index']);
    $routes->get('tempat/create', 'TempatController::create', ['as' => 'admin.tempat.create']);
    $routes->post('tempat', 'TempatController::store', ['as' => 'admin.tempat.store']);
    $routes->get('tempat/edit/(:num)', 'TempatController::edit/$1', ['as' => 'admin.tempat.edit']);
    $routes->post('tempat/update/(:num)', 'TempatController::update/$1', ['as' => 'admin.tempat.update']);
    $routes->get('tempat/show/(:num)', 'TempatController::show/$1', ['as' => 'admin.tempat.show']);
    $routes->get('tempat/delete/(:num)', 'TempatController::delete/$1', ['as' => 'admin.tempat.delete']);

    // Dosen Pembimbing 
    $routes->get('dosen_pembimbing', 'DosenPembimbingController::index', ['as' => 'admin.dosen_pembimbing.index']);
    $routes->get('dosen_pembimbing/create', 'DosenPembimbingController::create', ['as' => 'admin.dosen_pembimbing.create']);
    $routes->post('dosen_pembimbing', 'DosenPembimbingController::store', ['as' => 'admin.dosen_pembimbing.store']);
    $routes->get('dosen_pembimbing/edit/(:segment)', 'DosenPembimbingController::edit/$1', ['as' => 'admin.dosen_pembimbing.edit']);
    $routes->post('dosen_pembimbing/update/(:segment)', 'DosenPembimbingController::update/$1', ['as' => 'admin.dosen_pembimbing.update']);
    $routes->get('dosen_pembimbing/delete/(:segment)', 'DosenPembimbingController::delete/$1', ['as' => 'admin.dosen_pembimbing.delete']);
});


$routes->group('mahasiswa', ['namespace' => 'App\Controllers\Mahasiswa', 'filter' => 'authMahasiswa'], function ($routes) {
    // Dashboard Mahasiswa 
    $routes->get('', 'DashboardController::index', ['as' => 'mahasiswa.dashboard']);
    $routes->get('dashboard', 'DashboardController::index', ['as' => 'mahasiswa.dashboard.index']);

    // Menu PKL Mahasiswa 
    $routes->get('pkl', 'PKLController::index');
    $routes->get('', 'PKLController::index');
    $routes->post('pkl', 'PKLController::update_instansi');
    // Jurnal Pelaksanaan 
    $routes->get('pkl/jurnal', 'PKLJurnalController::index');
    // Jurnal Pelaksanaan 
    $routes->get('pkl/jurnal/pelaksanaan', 'PKLJurnalController::pelaksanaan', ['as' => 'mahasiswa.pkl.jurnal.pelaksanaan']);
    $routes->post('pkl/jurnal/pelaksanaan', 'PKLJurnalController::storePelaksanaan', ['as' => 'mahasiswa.pkl.jurnal.pelaksanaan.store']);
    $routes->get('pkl/jurnal/pelaksanaan/validasi/(:segment)', 'PKLJurnalController::validasiPelaksanaan/$1', ['as' => 'mahasiswa.pkl.jurnal.pelaksanaan.validasi']);
    $routes->get('pkl/jurnal/pelaksanaan/unvalidasi/(:segment)', 'PKLJurnalController::unvalidasiPelaksanaan/$1', ['as' => 'mahasiswa.pkl.jurnal.pelaksanaan.unvalidasi']);
    $routes->post('pkl/simpan_instansi', 'PKLController::simpan_instansi', ['as' => 'mahasiswa.pkl.simpan_instansi']);
    $routes->post('pkl/edit_instansi', 'PKLController::edit_instansi', ['as' => 'mahasiswa.pkl.edit_instansi']);
    $routes->post('pkl/jurnal/pelaksanaan/edit/(:num)', 'PKLJurnalController::edit_pelaksanaan/$1', ['as' => 'mahasiswa.pkl.jurnal.pelaksanaan.edit']);
    $routes->get('pkl/jurnal/pelaksanaan/delete/(:num)', 'PKLJurnalController::delete_pelaksanaan/$1', ['as' => 'mahasiswa.pkl.jurnal.pelaksanaan.delete']);

    // Jurnal Bimbingan 
    $routes->get('pkl/jurnal/bimbingan', 'PKLJurnalController::bimbingan',  ['as' => 'mahasiswa.pkl.jurnal.bimbingan']);
    $routes->post('pkl/jurnal/bimbingan', 'PKLJurnalController::storeBimbingan',  ['as' => 'mahasiswa.pkl.jurnal.bimbingan.store']);
    $routes->post('pkl/jurnal/bimbingan/simpan_judul', 'PKLJurnalController::simpanJudulLaporan',  ['as' => 'mahasiswa.pkl.jurnal.bimbingan.simpanJudul']);

    $routes->get('pkl/jurnal/bimbingan/validasi/(:segment)', 'PKLJurnalController::validasiBimbingan/$1', ['as' => 'mahasiswa.pkl.jurnal.bimbingan.validasi']);
    $routes->get('pkl/jurnal/bimbingan/unvalidasi/(:segment)', 'PKLJurnalController::unvalidasiBimbingan/$1', ['as' => 'mahasiswa.pkl.jurnal.bimbingan.unvalidasi']);
    $routes->post('pkl/jurnal/bimbingan/edit/(:num)', 'PKLJurnalController::edit_bimbingan/$1', ['as' => 'mahasiswa.pkl.jurnal.bimbingan.edit']);
    $routes->get('pkl/jurnal/bimbingan/delete/(:num)', 'PKLJurnalController::delete_bimbingan/$1', ['as' => 'mahasiswa.pkl.jurnal.bimbingan.delete']);


    // Formulir penilaian
    $routes->get('pkl/formulir', 'PKLFormulirController::index');
    $routes->get('pkl/formulir/log-harian', 'PKLFormulirController::log_harian');
    $routes->get('pkl/jadwal', 'PKLJadwalController::index', ['as' => 'mahasiswa.pkl.jadwal.index']);
    $routes->post('pkl/jadwal/daftar', 'PKLJadwalController::daftar', ['as' => 'mahasiswa.pkl.jadwal.daftar']);
});



$routes->group('dosen', ['namespace' => 'App\Controllers\Dosen', 'filter' => 'authDosen'], function ($routes) {
    $routes->get('dashboard', 'DashboardController::index');
    $routes->get('pkl', 'PKLController::index');
    $routes->get('pkl/approve', 'PKLController::approve_bimbingan');
    $routes->get('pkl/jurnal/detail/(:segment)', 'PKLController::bimbingan_detail/$1');
    $routes->get('pkl/detail', 'PKLController::detail');
    $routes->get('pkl/jadwal', 'PKLController::jadwal_pkl');
    $routes->get('pkl/validasi-penguji', 'PKLController::validasi_penguji');
    $routes->get('pkl/jadwal/bimbingan', 'PKLController::jadwal_pkl_bimbingan');
    $routes->get('pkl/penilaian/1', 'PKLController::penilaian');
    $routes->post('pkl/penilaian/cetak', 'PKLController::cetak');
    $routes->post('pkl/revisi/cetak', 'PKLController::cetak_revisi');
    $routes->get('pkl/penilaian/2', 'PKLController::penilaian2');
});



if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
