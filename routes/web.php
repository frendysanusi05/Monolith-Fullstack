<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KatalogBarang\KatalogController;
use App\Http\Controllers\BeliBarang\BeliController;
use App\Http\Controllers\RiwayatTransaksi\RiwayatController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::redirect('/', '/login');

Auth::routes();

Route::middleware('auth')
    ->group(
        function() {
            // Route::get('home', [HomeController::class, 'index'])->name('home');
            Route::redirect('home', 'katalog');

            Route::namespace('KatalogBarang')
                ->group(
                    function() {
                        Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog');
                        Route::get('/katalog-detail/{id}', [KatalogController::class, 'detail'])->name('katalog.detail');
                        Route::get('/get-barang', [KatalogController::class, 'getBarang'])->name('katalog.getBarang');
                        Route::get('/get-detail-barang/{id}', [KatalogController::class, 'getDetailBarang'])->name('katalog.getDetailBarang');
                        // Route::get('/poll-barang', [KatalogController::class, 'pollItems'])->name('katalog.poll');
                    }
                );

            Route::namespace('BeliBarang')
                ->group(
                    function() {
                        Route::get('/beli/{id}', [BeliController::class, 'index'])->name('beli');
                        Route::get('/get-identitas-barang/{id}', [BeliController::class, 'getIdentitasBarang'])->name('beli.getIdentitasBarang');
                        Route::get('/transaksi/{id}/{jumlah}', [BeliController::class, 'transaction'])->name('beli.transaction');
                    }
                );

            Route::namespace('RiwayatTransaksi')
                ->group(
                    function() {
                        Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat');
                        Route::get('/get-riwayat/{id}', [RiwayatController::class, 'getRiwayat'])->name('riwayat.getRiwayat');
                    }
                );
            }
        );
