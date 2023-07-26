<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KatalogBarang\KatalogController;
use App\Http\Controllers\BeliBarang\BeliController;

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
            Route::get('home', [HomeController::class, 'index'])->name('home');

            Route::namespace('KatalogBarang')
                ->group(
                    function() {
                        Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog');
                        Route::get('/katalog-detail/{id}', [KatalogController::class, 'detail'])->name('katalog.detail');
                        Route::get('/get-barang', [KatalogController::class, 'getBarang'])->name('katalog.getBarang');
                        Route::get('/get-detail-barang/{id}', [KatalogController::class, 'getDetailBarang'])->name('katalog.getDetailBarang');
                    }
                );

            Route::namespace('BeliBarang')
                ->group(
                    function() {
                        Route::get('/beli/{id}', [BeliController::class, 'index'])->name('beli');
                        Route::get('/get-identitas-barang/{id}', [BeliController::class, 'getIdentitasBarang'])->name('beli.getIdentitasBarang');
                    }
                );
            }
        );
