<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DigitalAssetController;
use App\Http\Controllers\CategoryController;

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

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DigitalAssetController::class, 'index'])->name('digitalAssets.index');
    Route::get('/digital-assets/create', [DigitalAssetController::class, 'create'])->name('digitalAssets.create');
    Route::post('/digital-assets/create', [DigitalAssetController::class, 'store'])->name('digitalAssets.store');

    Route::get('/digital-assets/{id}', [DigitalAssetController::class, 'view'])->name('digitalAssets.view');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories/create', [CategoryController::class, 'store'])->name('categories.store');
    // Add more routes that require authentication here
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
