<?php

use App\Http\Controllers\admin\InformasiController;
use App\Http\Controllers\admin\InformasiDesaController;
use App\Http\Controllers\admin\PariwisataDesaController;
use App\Http\Controllers\admin\PemerintahanDesaController;
use App\Http\Controllers\admin\ProfilDesaController;
use App\Http\Controllers\admin\UmkmDesaController;
use App\Http\Controllers\api\BeritaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaPageController;
use App\Http\Controllers\DataDesaController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PerangkatDesaController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PengumumanPageController;
use App\Http\Controllers\PetaUmkmController;
use App\Models\PerangkatDesa;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageController::class,'index'])->name('home');

Route::get('/profilDesa', [DataDesaController::class, "index"]);

Route::get('/pemerintahan',[PerangkatDesaController::class,"getData"]);

Route::get('/pengumuman/{id}', [PengumumanPageController::class,'index']);
Route::get('/berita/{id}',[BeritaPageController::class,"index"]);

Route::get('/pariwisataDesa', function () {
    return view('pariwisataDesa');
});

Route::get('/umkm', function () {
    return view('umkm');
});

Route::get('/informasi',[PengumumanController::class,"index"]);
Route::post('/informasi',[PengumumanController::class,"store"])->name('informasi.store');

Route::get('/peta-umkm', function() {
    return view('peta-umkm');
})->name('peta.umkm');

Route::get('/peta-wilayah', function () {
    return view('peta-wilayah');
})->name('peta-wilayah');



//public
Route::get('/', [LandingPageController::class, 'index'])->name('landingPage.index');
Route::get('/pemerintahan', [PerangkatDesaController::class, "getData"])->name('pemerintahan.index');
Route::get('/informasi', [PengumumanController::class, "index"])->name('informasi.index');
Route::get('/umkm', function () {
    return view('umkm');
})->name('umkm.index');
Route::get('/pariwisataDesa', function () {
    return view('pariwisataDesa');
})->name('pariwisata.index');



Route::get('peta-umkm', [PetaUmkmController::class, 'index']);

//admin
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/login', [AuthController::class, 'index'])->name('auth.index');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('checkToken')->name('auth.logout');


// Halaman Admin Pemerintahan
Route::get('/admin/pemerintahan', [PemerintahanDesaController::class, 'index'])
    ->middleware('checkToken')
    ->name('admin.pemerintahan.index');
Route::post('/admin/perangkat-desa', [PemerintahanDesaController::class, 'tambahPerangkatDesa'])
    ->middleware('checkToken')
    ->name('admin.pemerintahan.perangkat-desa.create');
Route::put('/admin/perangkat-desa', [PemerintahanDesaController::class, 'updatePerangkatDesa'])
    ->middleware('checkToken')
    ->name('admin.pemerintahan.perangkat-desa.update');
Route::delete('/admin/perangkat-desa/{id}', [PemerintahanDesaController::class, 'deletePerangkatDesa'])
    ->middleware('checkToken')
    ->name('admin.pemerintahan.perangkat-desa.destroy');
Route::post('/admin/lembaga', [PemerintahanDesaController::class, 'tambahLembagaDesa'])
    ->middleware('checkToken')
    ->name('admin.pemerintahan.lembaga.create');
Route::delete('/admin/lembaga/{id}', [PemerintahanDesaController::class, 'deleteLembagaDesa'])
    ->middleware('checkToken')
    ->name('admin.pemerintahan.lembaga.destroy');
Route::put('/admin/lembaga', [PemerintahanDesaController::class, 'updateLembagaDesa'])
    ->middleware('checkToken')
    ->name('admin.pemerintahan.lembaga.update');
Route::put('/admin/struktur', [PemerintahanDesaController::class, 'updateStrukturDesa'])
    ->middleware('checkToken')
    ->name('admin.pemerintahan.struktur.update');

// Halaman Admin Informasi Desa
Route::get('/admin/informasi', [InformasiDesaController::class, 'index'])->middleware('checkToken')->name('informasi-desa.index');
Route::post('/admin/informasi/berita', [InformasiDesaController::class, 'tambahBerita'])
    ->middleware('checkToken')
    ->name('admin.informasi.berita.create');
Route::post('/admin/informasi/pengumuman', [InformasiDesaController::class, 'tambahPengumuman'])
    ->middleware('checkToken')
    ->name('admin.informasi.pengumuman.create');
Route::put('/admin/informasi/berita/{id}', [InformasiDesaController::class, 'updateBerita'])
    ->middleware('checkToken')
    ->name('admin.informasi.berita.update');
Route::put('/admin/informasi/pengumuman/{id}', [InformasiDesaController::class, 'updatePengumuman'])
    ->middleware('checkToken')
    ->name('admin.informasi.pengumuman.update');
    
// Halaman Admin UMKM Desa
Route::get('/admin/umkm/', [UmkmDesaController::class, 'index'])->middleware('checkToken')->name('umkm-desa.index');
Route::post('/admin/umkm', [UmkmDesaController::class, 'tambahUmkm'])
    ->middleware('checkToken')
    ->name('admin.umkm-desa.create');
Route::put('/admin/umkm/{id}', [UmkmDesaController::class, 'updateUmkm'])
    ->middleware('checkToken')
    ->name('admin.umkm-desa.update');
Route::delete('/admin/umkm/{id}', [UmkmDesaController::class, 'deleteUmkm'])
    ->middleware('checkToken')
    ->name('admin.umkm-desa.destroy');
Route::get('/admin/pariwisata-desa', [PariwisataDesaController::class, 'index'])->middleware('checkToken')->name('pariwisata-desa.index');

// Halaman Admin Profil Desa
Route::get('/admin/profil-desa', [ProfilDesaController::class, 'index'])
    ->middleware('checkToken')
    ->name('admin.profil-desa.index');
Route::put('/admin/profil-desa/profil', [ProfilDesaController::class, 'updateProfilDesa'])
    ->middleware('checkToken')
    ->name('admin.profil-desa.profil.update');
Route::get('/p', [DataDesaController::class, "index"])->name('profilDesa.index');
Route::put('/admin/profil-desa/visi', [ProfilDesaController::class, 'updateVisiDesa'])
    ->middleware('checkToken')
    ->name('admin.profil-desa.visi.update');
Route::put('/admin/profil-desa/misi', [ProfilDesaController::class, 'updateMisiDesa'])
    ->middleware('checkToken')
    ->name('admin.profil-desa.misi.update');
Route::delete('/admin/profil-desa/misi/{id}', [ProfilDesaController::class, 'deleteMisiDesa'])
    ->middleware('checkToken')
    ->name('admin.profil-desa.misi.destroy');
Route::put('/admin/profil-desa/sejarah', [ProfilDesaController::class, 'updateSejarahDesa'])
    ->middleware('checkToken')
    ->name('admin.profil-desa.sejarah.update');
Route::post('/admin/profil-desa/misi', [ProfilDesaController::class, 'tambahMisiDesa'])
    ->middleware('checkToken')
    ->name('admin.profil-desa.misi.create');
