<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\WisataController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OlahragaController;
use App\Http\Controllers\LocationObjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages.home');
});

Route::middleware(['auth'])->group(function () {
    Route::middleware(['admin'])->controller(LocationObjectController::class)->group(function () {
        Route::get('admin-index', 'index')->name('index');
        // Route::get('olahraga/{id}', 'show')->name('show');
    });
    Route::controller(OlahragaController::class)->as('olahraga.')->group(function(){
        Route::get('olahraga', 'index')->name('index');
        Route::get('olahraga/{id}', 'show')->name('show');
    });

    Route::controller(WisataController::class)->as('wisata.')->group(function(){
        Route::get('wisata', 'index')->name('index');
        Route::get('wisata/{id}', 'show')->name('show');
    });

    Route::controller(RatingController::class)->as('rating.')->group(function(){
        Route::post('olahraga/{id}', 'store')->name('store.olahraga');
        Route::post('wisata/{id}', 'store')->name('store.wisata');
        Route::post('ubah-olahraga/{id}', 'update')->name('update.olahraga');
        Route::post('ubah-wisata/{id}', 'update')->name('update.wisata');
        Route::post('hapus-olahraga/{id}', 'destroy')->name('destroy.olahraga');
        Route::post('hapus-wisata/{id}', 'destroy')->name('destroy.wisata');
    });

    Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::get('/profil', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/perbarui-profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/perbarui-profil', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profil', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
