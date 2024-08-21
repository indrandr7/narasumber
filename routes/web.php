<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\NarasumberController;
use App\Http\Controllers\BagianController;
use App\Http\Controllers\BiroController;
use App\Http\Controllers\PpkController;
use App\Http\Controllers\BendaharaController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\EselonController;
use App\Http\Controllers\GolonganController;
use App\Http\Controllers\MataanggaranController;

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/auth', [LoginController::class, 'authenticate']);

Route::group(['middleware' => 'auth'], function(){
    Route::get('/logout', function(){
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    })->name('logout');

    Route::get('/kegiatan', [KegiatanController::class, 'index']);
    Route::get('/kegiatan/add', [KegiatanController::class, 'add']);
    Route::post('/kegiatan/save', [KegiatanController::class, 'save']);
    Route::get('/kegiatan/edit/{kodekegiatan}', [KegiatanController::class, 'edit']);
    Route::post('/kegiatan/saveupdate', [KegiatanController::class, 'saveupdate']);
    Route::post('/kegiatan/saveupdatedata', [KegiatanController::class, 'saveupdatedata']);
    Route::post('/kegiatan/delete', [KegiatanController::class, 'delete']);
    Route::get('/kegiatan/narsumadd', [KegiatanController::class, 'narsumadd']);
    Route::post('/kegiatan/narsumlist', [KegiatanController::class, 'narsumlist']);
    Route::post('/kegiatan/narsumsave', [KegiatanController::class, 'narsumsave']);
    Route::get('/kegiatan/narsumedit', [KegiatanController::class, 'narsumedit']);
    Route::post('/kegiatan/narsumsaveupdate', [KegiatanController::class, 'narsumsaveupdate']);
    Route::post('/kegiatan/narsumdelete', [KegiatanController::class, 'narsumdelete']);
    Route::post('/kegiatan/getnarsum', [KegiatanController::class, 'getnarsum']);
    Route::get('/kegiatan/verifikasi', [KegiatanController::class, 'verifikasi']);
    Route::get('/kegiatan/verifikasilihat/{kodekegiatan}', [KegiatanController::class, 'verifikasilihat']);
    Route::get('/kegiatan/verifikasidetail', [KegiatanController::class, 'verifikasidetail']);
    Route::get('/kegiatan/lihatbuktitransfer', [KegiatanController::class, 'lihatbuktitransfer']);
    Route::post('/kegiatan/verifikasibayar_save', [KegiatanController::class, 'verifikasibayar_save']);
    Route::get('/kegiatan/cetakkwitansi', [KegiatanController::class, 'cetakkwitansi']);
    Route::get('/kegiatan/cetakusulan', [KegiatanController::class, 'cetakusulan']);
    Route::post('/kegiatan/cari', [KegiatanController::class, 'cari']);
    Route::get('/kegiatan/cetakmatrik', [KegiatanController::class, 'cetakmatrik']);
    Route::get('/kegiatan/cetakmatriks', [KegiatanController::class, 'cetakmatriks']);
    Route::get('/kegiatan/download', [KegiatanController::class, 'downloadfile']);
    Route::get('/kegiatan/downloadst', [KegiatanController::class, 'downloadst']);
    Route::get('/kegiatan/cetakdokumen', [KegiatanController::class, 'cetakdokumen']);

    Route::get('/narasumber', [NarasumberController::class, 'index']);
    Route::get('/narasumber/getlist', [NarasumberController::class, 'getlist']);
    Route::get('/narasumber/add', [NarasumberController::class, 'add']);
    Route::post('/narasumber/save', [NarasumberController::class, 'save']);
    Route::get('/narasumber/edit', [NarasumberController::class, 'edit']);
    Route::post('/narasumber/saveupdate', [NarasumberController::class, 'saveupdate']);
    Route::post('/narasumber/delete', [NarasumberController::class, 'delete']);
    // Route::get('/narasumber/downloadnarsum____', [NarasumberController::class, 'downloadnarsum']);
    Route::get('/narasumber/unduh', [NarasumberController::class, 'unduh']);

    Route::get('/bagian', [BagianController::class, 'index']);
    Route::get('/bagian/getlist', [BagianController::class, 'getlist']);
    Route::get('/bagian/add', [BagianController::class, 'add']);
    Route::post('/bagian/save', [BagianController::class, 'save']);
    Route::get('/bagian/edit', [BagianController::class, 'edit']);
    Route::post('/bagian/saveupdate', [BagianController::class, 'saveupdate']);
    Route::post('/bagian/delete', [BagianController::class, 'delete']);

    Route::get('/biro', [BiroController::class, 'index']);
    Route::get('/biro/getlist', [BiroController::class, 'getlist']);
    Route::get('/biro/add', [BiroController::class, 'add']);
    Route::post('/biro/save', [BiroController::class, 'save']);
    Route::get('/biro/edit', [BiroController::class, 'edit']);
    Route::post('/biro/saveupdate', [BiroController::class, 'saveupdate']);
    Route::post('/biro/delete', [BiroController::class, 'delete']);

    Route::get('/ppk', [PpkController::class, 'index']);
    Route::get('/ppk/getlist', [PpkController::class, 'getlist']);
    Route::get('/ppk/add', [PpkController::class, 'add']);
    Route::post('/ppk/save', [PpkController::class, 'save']);
    Route::get('/ppk/edit', [PpkController::class, 'edit']);
    Route::post('/ppk/saveupdate', [PpkController::class, 'saveupdate']);
    Route::post('/ppk/delete', [PpkController::class, 'delete']);

    Route::get('/bendahara', [BendaharaController::class, 'index']);
    Route::get('/bendahara/getlist', [BendaharaController::class, 'getlist']);
    Route::get('/bendahara/add', [BendaharaController::class, 'add']);
    Route::post('/bendahara/save', [BendaharaController::class, 'save']);
    Route::get('/bendahara/edit', [BendaharaController::class, 'edit']);
    Route::post('/bendahara/saveupdate', [BendaharaController::class, 'saveupdate']);
    Route::post('/bendahara/delete', [BendaharaController::class, 'delete']);

    Route::get('/pengguna', [PenggunaController::class, 'index']);
    Route::get('/pengguna/getlist', [PenggunaController::class, 'getlist']);
    Route::get('/pengguna/add', [PenggunaController::class, 'add']);
    Route::post('/pengguna/save', [PenggunaController::class, 'save']);
    Route::get('/pengguna/edit', [PenggunaController::class, 'edit']);
    Route::post('/pengguna/saveupdate', [PenggunaController::class, 'saveupdate']);
    Route::post('/pengguna/delete', [PenggunaController::class, 'delete']);
    Route::get('/pengguna/gantipassword', [PenggunaController::class, 'gantipassword']);
    Route::post('/pengguna/passwordupdate', [PenggunaController::class, 'passwordupdate']);

    Route::get('/eselon', [EselonController::class, 'index']);
    Route::get('/eselon/getlist', [EselonController::class, 'getlist']);
    Route::get('/eselon/add', [EselonController::class, 'add']);
    Route::post('/eselon/save', [EselonController::class, 'save']);
    Route::get('/eselon/edit', [EselonController::class, 'edit']);
    Route::post('/eselon/saveupdate', [EselonController::class, 'saveupdate']);
    Route::post('/eselon/delete', [EselonController::class, 'delete']);

    Route::get('/golongan', [GolonganController::class, 'index']);
    Route::get('/golongan/getlist', [GolonganController::class, 'getlist']);
    Route::get('/golongan/add', [GolonganController::class, 'add']);
    Route::post('/golongan/save', [GolonganController::class, 'save']);
    Route::get('/golongan/edit', [GolonganController::class, 'edit']);
    Route::post('/golongan/saveupdate', [GolonganController::class, 'saveupdate']);
    Route::post('/golongan/delete', [GolonganController::class, 'delete']);

    Route::get('/mataanggaran', [MataanggaranController::class, 'index']);
    Route::get('/mataanggaran/getlist', [MataanggaranController::class, 'getlist']);
    Route::get('/mataanggaran/add', [MataanggaranController::class, 'add']);
    Route::post('/mataanggaran/save', [MataanggaranController::class, 'save']);
    Route::get('/mataanggaran/edit', [MataanggaranController::class, 'edit']);
    Route::post('/mataanggaran/saveupdate', [MataanggaranController::class, 'saveupdate']);
    Route::post('/mataanggaran/delete', [MataanggaranController::class, 'delete']);

});
