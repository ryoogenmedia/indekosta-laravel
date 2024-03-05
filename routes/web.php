<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/**
 * landing page / halaman utama
 */

Route::namespace('App\Livewire\LandingPage')->name('landing-page.')->group(function(){
    Route::get('/', Index::class)->name('home');
    Route::get('/cari-kost', CariKost::class)->name('cari-kost');
    Route::get('/maps', Maps::class)->name('maps');
    Route::get('/rekomendasi', Recomendation::class)->name('recomendation');
    Route::get('/{id}/detail-kost', DetailKost::class)->name('detail-kost');
});


Route::middleware('auth', 'verified', 'force.logout')->namespace('App\Livewire')->group(function () {
    /**
     * beranda / home
     */
    Route::get('beranda', Home\Index::class)->name('home')
        ->middleware('roles:admin,user');

    /**
     * kosta
     */
    Route::namespace('Indekosta')->middleware('roles:admin')->prefix('indekosta')->name('indekosta.')->group(function () {
        Route::get('/', Index::class)->name('index');
        Route::get('/tambah', Create::class)->name('create');
        Route::get('/{id}/sunting', Edit::class)->name('edit');
    });

    /**
     * recomendation / rekomendasi
     */
    Route::namespace('Recomendation')->middleware('roles:admin')->prefix('rekomendasi')->name('recomendation.')->group(function () {
        Route::get('/', Index::class)->name('index');
    });

    /**
     * pengguna / user
     */
    Route::namespace('User')->middleware('roles:admin')->prefix('pengguna')->name('user.')->group(function () {
        Route::get('/', Index::class)->name('index');
        Route::get('/tambah', Create::class)->name('create');
        Route::get('/{id}/sunting', Edit::class)->name('edit');
    });

    /**
     * setting
     */
    Route::prefix('pengaturan')->name('setting.')->middleware('roles:admin,user')->namespace('Setting')->group(function () {
        Route::redirect('/', 'pengaturan/aplikasi');

        /**
         * Profile
         */
        Route::prefix('profil')->name('profile.')->group(function () {
            Route::get('/', Profile\Index::class)->name('index');
        });

        /**
         * Account
         */
        Route::prefix('akun')->name('account.')->group(function () {
            Route::get('/', Account\Index::class)->name('index');
        });
    });
});
