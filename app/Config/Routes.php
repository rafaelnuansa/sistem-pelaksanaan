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
    $routes->post('fakultas/update/(:num)', 'FakultasController::update/$1', ['as' => 'admin.fakultas.update']);
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
    $routes->get('instansi/delete/(:num)', 'InstansiController::delete/$1');


    // Admin Lokasi KKN 
    $routes->get('lokasi', 'KKNLokasiController::index');
    $routes->get('lokasi/create', 'KKNLokasiController::create');
    $routes->post('lokasi/store', 'KKNLokasiController::store');
    $routes->get('lokasi/edit/(:num)', 'KKNLokasiController::edit/$1');
    $routes->post('lokasi/update/(:num)', 'KKNLokasiController::update/$1');
    $routes->get('lokasi/delete/(:num)', 'KKNLokasiController::delete/$1');

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

    // Menampilkan daftar berkas (index)
    $routes->get('berkas', 'BerkasController::index');
    // Menampilkan form tambah berkas (create)
    $routes->get('berkas/create', 'BerkasController::create');
    // Menyimpan data berkas setelah proses upload (store)
    $routes->post('berkas', 'BerkasController::store');
    // Menampilkan form edit berkas (edit)
    $routes->get('berkas/edit/(:num)', 'BerkasController::edit/$1');
    // Update data berkas (update)
    $routes->post('berkas/update', 'BerkasController::update');
    // Hapus data berkas (delete)
    $routes->delete('berkas/(:num)', 'BerkasController::delete/$1');


    // Admin KKN 
    $routes->get('kkn', 'KKNController::index', ['as' => 'admin.kkn.index']);
    $routes->get('kkn/create', 'KKNController::create', ['as' => 'admin.kkn.create']);
    $routes->post('kkn', 'KKNController::store', ['as' => 'admin.kkn.store']);
    $routes->get('kkn/edit/(:num)', 'KKNController::edit/$1', ['as' => 'admin.kkn.edit']);
    $routes->post('kkn/update/(:num)', 'KKNController::update/$1', ['as' => 'admin.kkn.update']);
    $routes->get('kkn/delete/(:num)', 'KKNController::delete/$1', ['as' => 'admin.kkn.delete']);


    // Rute untuk assign anggota KKN
    $routes->get('kkn/anggota/(:num)', 'KKNController::assignAnggota/$1', ['as' => 'admin.kkn.assign_anggota']);
    $routes->get('kkn/anggota/tambah', 'KKNController::storeAnggota');
    $routes->post('kkn/anggota/delete', 'KKNController::deleteAnggota');
    $routes->get('kkn/anggota/status', 'KKNController::statusAnggota');


    // Admin KKN Jurnal Monitoring
    $routes->get('kkn/jurnal/monitoring', 'KKNJurnalMonitoringController::index', ['as' => 'admin.jurnal.monitoring.index']);
    $routes->get('kkn/jurnal/monitoring/create', 'KKNJurnalMonitoringController::create', ['as' => 'admin.jurnal.monitoring.create']);
    $routes->post('kkn/jurnal/monitoring', 'KKNJurnalMonitoringController::store', ['as' => 'admin.jurnal.monitoring.store']);
    $routes->get('kkn/jurnal/monitoring/edit/(:num)', 'KKNJurnalMonitoringController::edit/$1', ['as' => 'admin.jurnal.monitoring.edit']);
    $routes->post('kkn/jurnal/monitoring/update/(:num)', 'KKNJurnalMonitoringController::update/$1', ['as' => 'admin.jurnal.monitoring.update']);
    $routes->get('kkn/jurnal/monitoring/show/(:num)', 'KKNJurnalMonitoringController::show/$1', ['as' => 'admin.jurnal.monitoring.show']);
    $routes->get('kkn/jurnal/monitoring/delete/(:num)', 'KKNJurnalMonitoringController::delete/$1', ['as' => 'admin.jurnal.monitoring.delete']);

    // Admin KKN Jurnal Pelaksanaan
    $routes->get('kkn/jurnal/pelaksanaan', 'KKNJurnalPelaksanaanController::index', ['as' => 'admin.kkn.jurnal.pelaksanaan.index']);
    $routes->get('kkn/jurnal/pelaksanaan/create', 'KKNJurnalPelaksanaanController::create', ['as' => 'admin.kkn.jurnal.pelaksanaan.create']);
    $routes->post('kkn/jurnal/pelaksanaan', 'KKNJurnalPelaksanaanController::store', ['as' => 'admin.kkn.jurnal.pelaksanaan.store']);
    $routes->get('kkn/jurnal/pelaksanaan/edit/(:num)', 'KKNJurnalPelaksanaanController::edit/$1', ['as' => 'admin.kkn.jurnal.pelaksanaan.edit']);
    $routes->post('kkn/jurnal/pelaksanaan/update/(:num)', 'KKNJurnalPelaksanaanController::update/$1', ['as' => 'admin.kkn.jurnal.pelaksanaan.update']);
    $routes->get('kkn/jurnal/pelaksanaan/show/(:num)', 'KKNJurnalPelaksanaanController::show/$1', ['as' => 'admin.kkn.jurnal.pelaksanaan.show']);
    $routes->get('kkn/jurnal/pelaksanaan/delete/(:num)', 'KKNJurnalPelaksanaanController::delete/$1', ['as' => 'admin.kkn.jurnal.pelaksanaan.delete']);

    // Admin Skripsi 
    $routes->get('skripsi', 'SkripsiController::index', ['as' => 'admin.skripsi.index']);
    $routes->get('skripsi/create', 'SkripsiController::create', ['as' => 'admin.skripsi.create']);
    $routes->post('skripsi', 'SkripsiController::store', ['as' => 'admin.skripsi.store']);
    $routes->get('skripsi/edit/(:num)', 'SkripsiController::edit/$1', ['as' => 'admin.skripsi.edit']);
    $routes->post('skripsi/update/(:num)', 'SkripsiController::update/$1', ['as' => 'admin.skripsi.update']);
    $routes->get('skripsi/delete/(:num)', 'SkripsiController::delete/$1', ['as' => 'admin.skripsi.delete']);

    // Admin Skripsi Bimbingan
    $routes->get('skripsi/bimbingan', 'SkripsiBimbinganController::index', ['as' => 'admin.skripsi.bimbingan.index']);
    $routes->get('skripsi/bimbingan/(:num)', 'SkripsiBimbinganController::show/$1', ['as' => 'admin.skripsi.bimbingan.show']);

    // Admin Skripsi Sidang 
    $routes->get('skripsi/sidang', 'SkripsiSidangController::index', ['as' => 'admin.skripsi.sidang.index']);
    $routes->post('skripsi/sidang/simpan', 'SkripsiSidangController::simpan', ['as' => 'admin.skripsi.sidang.simpan']);

    // Rute untuk assign mahasiswa dosbing
    $routes->get('skripsi/(:num)', 'SkripsiController::assignMhs/$1', ['as' => 'admin.skripsi.assign']);
    $routes->get('skripsi/assign', 'SkripsiController::store');
    $routes->post('skripsi/delete', 'SkripsiController::delete');
});


$routes->group('mahasiswa', ['namespace' => 'App\Controllers\Mahasiswa', 'filter' => 'authMahasiswa'], function ($routes) {
    // Dashboard Mahasiswa 
    $routes->get('', 'DashboardController::index', ['as' => 'mahasiswa.dashboard']);
    $routes->get('dashboard', 'DashboardController::index', ['as' => 'mahasiswa.dashboard.index']);

    $routes->get('', 'PKLController::index');

    // Menu PKL Mahasiswa 
    $routes->get('pkl', 'PKLController::index');
    $routes->post('pkl', 'PKLController::update_instansi');
    // Jurnal Pelaksanaan 
    $routes->get('pkl/jurnal', 'PKLJurnalController::index');

    // Jurnal Pelaksanaan 
    $routes->get('pkl/jurnal/pelaksanaan', 'PKLJurnalController::pelaksanaan', ['as' => 'mahasiswa.pkl.jurnal.pelaksanaan']);
    $routes->get('pkl/jurnal/pelaksanaan/cetak', 'PKLJurnalController::pelaksanaan_cetak', ['as' => 'mahasiswa.pkl.jurnal.pelaksanaan.cetak']);
    $routes->post('pkl/jurnal/pelaksanaan', 'PKLJurnalController::storePelaksanaan', ['as' => 'mahasiswa.pkl.jurnal.pelaksanaan.store']);
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
    $routes->get('pkl/formulir/penilaian', 'PKLFormulirController::penilaian');
    $routes->get('pkl/formulir/log-harian', 'PKLFormulirController::log_harian');
    $routes->get('pkl/jadwal', 'PKLJadwalController::index', ['as' => 'mahasiswa.pkl.jadwal.index']);
    $routes->post('pkl/jadwal/daftar', 'PKLJadwalController::daftar', ['as' => 'mahasiswa.pkl.jadwal.daftar']);

    $routes->get('pkl/penilaian/cetak/(:segment)', 'PKLController::cetak/$1');


    // KKN 

    // Menu KKN Mahasiswa 
    $routes->get('kkn', 'KKNController::index');
    $routes->post('kkn', 'KKNController::update_instansi');
    // Jurnal Pelaksanaan 
    $routes->get('kkn/jurnal', 'KKNJurnalController::index');

    // Jurnal Pelaksanaan 
    $routes->get('kkn/jurnal/pelaksanaan', 'KKNJurnalController::pelaksanaan', ['as' => 'mahasiswa.kkn.jurnal.pelaksanaan']);
    $routes->get('kkn/jurnal/pelaksanaan/cetak', 'KKNJurnalController::pelaksanaan_cetak', ['as' => 'mahasiswa.kkn.jurnal.pelaksanaan.cetak']);
    $routes->post('kkn/jurnal/pelaksanaan', 'KKNJurnalController::storePelaksanaan', ['as' => 'mahasiswa.kkn.jurnal.pelaksanaan.store']);
    $routes->post('kkn/simpan_lokasi', 'KKNController::simpan_lokasi', ['as' => 'mahasiswa.kkn.simpan_lokasi']);
    $routes->post('kkn/edit_lokasi', 'KKNController::edit_lokasi', ['as' => 'mahasiswa.kkn.edit_lokasi']);
    $routes->post('kkn/jurnal/pelaksanaan/edit/(:num)', 'KKNJurnalController::edit_pelaksanaan/$1', ['as' => 'mahasiswa.kkn.jurnal.pelaksanaan.edit']);
    $routes->get('kkn/jurnal/pelaksanaan/delete/(:num)', 'KKNJurnalController::delete_pelaksanaan/$1', ['as' => 'mahasiswa.kkn.jurnal.pelaksanaan.delete']);

    // Jurnal Monitoring 
    $routes->get('kkn/jurnal/monitoring', 'KKNJurnalController::monitoring',  ['as' => 'mahasiswa.kkn.jurnal.monitoring']);
    $routes->post('kkn/jurnal/monitoring', 'KKNJurnalController::storeMonitoring',  ['as' => 'mahasiswa.kkn.jurnal.monitoring.store']);
    $routes->post('kkn/jurnal/monitoring/simpan_judul', 'KKNJurnalController::simpanJudulLaporan',  ['as' => 'mahasiswa.kkn.jurnal.monitoring.simpanJudul']);

    $routes->get('kkn/jurnal/monitoring/validasi/(:segment)', 'KKNJurnalController::validasiMonitoring/$1', ['as' => 'mahasiswa.kkn.jurnal.monitoring.validasi']);
    $routes->get('kkn/jurnal/monitoring/unvalidasi/(:segment)', 'KKNJurnalController::unvalidasiMonitoring/$1', ['as' => 'mahasiswa.kkn.jurnal.monitoring.unvalidasi']);
    $routes->post('kkn/jurnal/monitoring/edit/(:num)', 'KKNJurnalController::edit_monitoring/$1', ['as' => 'mahasiswa.kkn.jurnal.monitoring.edit']);
    $routes->get('kkn/jurnal/monitoring/delete/(:num)', 'KKNJurnalController::delete_monitoring/$1', ['as' => 'mahasiswa.kkn.jurnal.monitoring.delete']);

    // Surat IZIN Observasi KKN
    $routes->get('kkn/surat_izin_observasi', 'KKNController::surat_izin_observasi',  ['as' => 'mahasiswa.kkn.surat_izin_observasi']);
    $routes->get('kkn/surat_izin_observasi/view', 'KKNController::view_surat',  ['as' => 'mahasiswa.kkn.view_sio']);

    // Formulir penilaian
    $routes->get('kkn/formulir', 'KKNFormulirController::index');
    $routes->get('kkn/formulir/penilaian', 'KKNFormulirController::penilaian');
    $routes->get('kkn/formulir/log-harian', 'KKNFormulirController::log_harian');
    $routes->get('kkn/jadwal', 'KKNJadwalController::index', ['as' => 'mahasiswa.kkn.jadwal.index']);
    $routes->post('kkn/jadwal/daftar', 'KKNJadwalController::daftar', ['as' => 'mahasiswa.kkn.jadwal.daftar']);
    $routes->get('kkn/penilaian/cetak/(:segment)', 'KKNController::cetak/$1');

    //  KKN END 

    // MHS SKRIPSI 
    // Menu KKN Mahasiswa 
    $routes->get('skripsi', 'SkripsiController::index');
    $routes->post('skripsi', 'SkripsiController::edit_judul', ['as' => 'mahasiswa.skripsi.edit_judul']);
    // Bimbingan Skripsi 
    $routes->get('skripsi/bimbingan', 'SkripsiBimbinganController::index');
    $routes->post('skripsi/bimbingan', 'SkripsiBimbinganController::store', ['as' => 'mahasiswa.skripsi.bimbingan.store']);
    
    $routes->post('skripsi/bimbingan/edit/(:num)', 'SkripsiBimbinganController::update/$1', ['as' => 'mahasiswa.skripsi.bimbingan.edit']);
    $routes->get('skripsi/bimbingan/delete/(:num)', 'SkripsiBimbinganController::delete/$1', ['as' => 'mahasiswa.skripsi.bimbingan.delete']);
    $routes->get('skripsi/sidang', 'SkripsiSidangController::index');
    $routes->post('skripsi/sidang', 'SkripsiSidangController::daftar', ['as' => 'mahasiswa.skripsi.daftar']);

    // END MHS SKRIPSI



    // Menampilkan daftar berkas (index)
    $routes->get('berkas', 'BerkasController::index');
    // Menampilkan form tambah berkas (create)
    $routes->get('berkas/create', 'BerkasController::create');
    // Menyimpan data berkas setelah proses upload (store)
    $routes->post('berkas', 'BerkasController::store');
    // Menampilkan form edit berkas (edit)
    $routes->get('berkas/edit/(:num)', 'BerkasController::edit/$1');
    // Update data berkas (update)
    $routes->post('berkas/update', 'BerkasController::update');
    // Hapus data berkas (delete)
    $routes->delete('berkas/(:num)', 'BerkasController::delete/$1');
});



$routes->group('dosen', ['namespace' => 'App\Controllers\Dosen', 'filter' => 'authDosen'], function ($routes) {
    $routes->get('dashboard', 'DashboardController::index');
    $routes->get('pkl', 'PKLController::index');
    $routes->get('pkl/approve', 'PKLController::approve_bimbingan', ['as' => 'dosen.pkl.validasi.bimbingan']);
    $routes->get('pkl/reset', 'PKLController::reset_bimbingan', ['as' => 'dosen.pkl.validasi.bimbingan.reset']);
    $routes->get('pkl/jurnal/detail/(:segment)', 'PKLController::bimbingan_detail/$1');
    $routes->get('pkl/detail', 'PKLController::detail');
    $routes->get('pkl/jadwal', 'PKLController::jadwal_pkl');
    $routes->get('pkl/validasi-penguji', 'PKLController::validasi_penguji');
    $routes->get('pkl/jadwal/bimbingan', 'PKLController::jadwal_pkl_bimbingan');
    $routes->get('pkl/jurnal/pelaksanaan/validasi/(:segment)', 'PKLJurnalController::validasiPelaksanaan/$1', ['as' => 'dosen.pkl.jurnal.pelaksanaan.validasi']);
    $routes->get('pkl/jurnal/pelaksanaan/unvalidasi/(:segment)', 'PKLJurnalController::unvalidasiPelaksanaan/$1', ['as' => 'dosen.pkl.jurnal.pelaksanaan.unvalidasi']);
    $routes->get('pkl/penilaian/1', 'PKLController::penilaian');
    $routes->get('pkl/penilaian/cetak/(:segment)', 'PKLController::cetak/$1');
    $routes->post('pkl/penilaian/nilai', 'PKLController::nilai');
    $routes->post('pkl/revisi/cetak', 'PKLController::cetak_revisi');
    $routes->get('pkl/penilaian/2', 'PKLController::penilaian2');
    $routes->get('pkl/jadwal/update_status/(:num)/(:num)', 'PKLController::update_status_jadwal/$1/$2', ['as' => 'dosen.pkl.jadwal.update_status']);


    $routes->get('kkn', 'KKNController::index');

    $routes->get('kkn/pelaksanaan', 'KKNController::pelaksanaan');
    $routes->get('kkn/pelaksanaan/approve', 'KKNController::approve_pelaksanaan', ['as' => 'dosen.kkn.validasi.pelaksanaan']);
    $routes->get('kkn/pelaksanaan/reset', 'KKNController::reset_pelaksanaan', ['as' => 'dosen.kkn.validasi.pelaksanaan.reset']);
   
    $routes->get('kkn/pelaksanaan/(:segment)', 'KKNController::pelaksanaan_detail/$1');

    $routes->get('kkn/approve', 'KKNController::approve_monitoring', ['as' => 'dosen.kkn.validasi.monitoring']);
    $routes->get('kkn/reset', 'KKNController::reset_monitoring', ['as' => 'dosen.kkn.validasi.monitoring.reset']);
    $routes->get('kkn/jurnal/detail/(:segment)', 'KKNController::monitoring_detail/$1');
    $routes->get('kkn/detail', 'KKNController::detail');
    $routes->get('kkn/jadwal', 'KKNController::jadwal_kkn');
    $routes->get('kkn/validasi-penguji', 'KKNController::validasi_penguji');
    $routes->get('kkn/jadwal/monitoring', 'KKNController::jadwal_kkn_monitoring');
    $routes->get('kkn/penilaian/1', 'KKNController::penilaian');
    $routes->get('kkn/penilaian/cetak/(:segment)', 'KKNController::cetak/$1');
    $routes->post('kkn/penilaian/nilai', 'KKNController::nilai');
    $routes->post('kkn/revisi/cetak', 'KKNController::cetak_revisi');
    $routes->get('kkn/penilaian/2', 'KKNController::penilaian2');
    $routes->get('kkn/jadwal/update_status/(:num)/(:num)', 'KKNController::update_status_jadwal/$1/$2', ['as' => 'dosen.pkl.jadwal.update_status']);
});



if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
