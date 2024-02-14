<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DigitalAssetController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/digital-assets/create', [DigitalAssetController::class, 'create'])->name('digitalAssets.create');
Route::post('/digital-assets', [DigitalAssetController::class, 'store'])->name('digitalAssets.store');
