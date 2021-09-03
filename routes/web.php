<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Route;

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

// Logout
Route::get('/user/logout/', [DashboardController::class, 'adminLogout'])->name('admin.logout');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


// Backend Routes here
Route::middleware(['auth:sanctum', 'verified'])->group(function (){

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/category/all', [CategoryController::class, 'index'])->name('category.all');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/edit/{category}', [CategoryController::class, 'edit'])->name('edit.category');
    Route::put('/category/update/{category}',[CategoryController::class, 'update'])->name('update.category');
    Route::get('/category/delete/{category}',[CategoryController::class, 'destroy'])->name('delete.category');
    Route::get('/category/restore/{id}', [CategoryController::class, 'restoreCategory'])->name('restore.category');
    Route::get('/category/p/delete/{id}', [CategoryController::class, 'permanentDelete'])->name('permanent.delete');

    Route::get('/dashboard/brand', [BrandController::class, 'index'])->name('brand.index');
    Route::post('/brand/store', [BrandController::class, 'store'])->name('brand.store');
    Route::get('/brand/edit/{id}', [BrandController::class, 'edit'])->name('edit.brand');
    Route::put('/brand/update/{id}', [BrandController::class, 'update'])->name('update.brand');
    Route::get('/brand/delete/{id}', [BrandController::class, 'destroy'])->name('delete.brand');

    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
    Route::post('/gallery/store', [GalleryController::class, 'store'])->name('gallery.store');

    Route::get('/dashboard/slider', [SliderController::class, 'index'])->name('slider.admin');
    Route::post('/dashboard/slider/store', [SliderController::class, 'storeSlider'])->name('slider.store');
    Route::get('/dashboard/slider/delete/{id}', [SliderController::class, 'destroySlider'])->name('slider.delete');

});


// Frontend Routes Here
Route::get('/', [HomeController::class, 'index'])->name('home.index');
