<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\NarasumberController;
use App\Http\Controllers\BagianController;

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
    Route::get('/kegiatan/delete', [KegiatanController::class, 'delete']);
    Route::get('/kegiatan/narsumadd', [KegiatanController::class, 'narsumadd']);
    Route::post('/kegiatan/narsumlist', [KegiatanController::class, 'narsumlist']);
    Route::post('/kegiatan/narsumsave', [KegiatanController::class, 'narsumsave']);
    Route::get('/kegiatan/narsumedit', [KegiatanController::class, 'narsumedit']);
    Route::post('/kegiatan/narsumsaveupdate', [KegiatanController::class, 'narsumsaveupdate']);
    Route::post('/kegiatan/narsumdelete', [KegiatanController::class, 'narsumdelete']);
    Route::post('/kegiatan/getnarsum', [KegiatanController::class, 'getnarsum']);

    Route::get('/narasumber', [NarasumberController::class, 'index']);
    Route::get('/narasumber/getlist', [NarasumberController::class, 'getlist']);
    Route::get('/narasumber/add', [NarasumberController::class, 'add']);
    Route::post('/narasumber/save', [NarasumberController::class, 'save']);
    Route::get('/narasumber/edit', [NarasumberController::class, 'edit']);
    Route::post('/narasumber/saveupdate', [NarasumberController::class, 'saveupdate']);
    Route::post('/narasumber/delete', [NarasumberController::class, 'delete']);

    Route::get('/bagian', [BagianController::class, 'index']);
    Route::get('/bagian/getlist', [BagianController::class, 'getlist']);
    Route::get('/bagian/add', [BagianController::class, 'add']);
    Route::post('/bagian/save', [BagianController::class, 'save']);
    Route::get('/bagian/edit', [BagianController::class, 'edit']);
    Route::post('/bagian/saveupdate', [BagianController::class, 'saveupdate']);
    Route::post('/bagian/delete', [BagianController::class, 'delete']);

});
