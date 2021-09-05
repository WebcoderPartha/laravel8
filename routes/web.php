<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeAboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;
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

    Route::get('/dashboard/about/all', [HomeAboutController::class, 'index'])->name('admin.home.about');
    Route::get('/dashboard/about/create', [HomeAboutController::class, 'create'])->name('admin.home.create');
    Route::post('/dashboard/about/store', [HomeAboutController::class, 'store'])->name('admin.home.store');
    Route::get('/dashboard/about/edit/{homeAbout}', [HomeAboutController::class, 'edit'])->name('admin.about.edit');
    Route::put('/dashboard/about/update/{homeAbout}', [HomeAboutController::class, 'update'])->name('admin.home.about.update');

    // Profile
    Route::get('/dashboard/profile', [ProfileController::class, 'userProfile'])->name('user.profile.admin');
    Route::put('/dashboard/profile/update', [ProfileController::class, 'updateProfile'])->name('update.profile');


});
// Password
Route::get('/dashboard/user/password', [PasswordController::class, 'index'])->name('change.password');
Route::post('/dashboard/user/password/update', [PasswordController::class, 'updatePassword'])->name('update.password');

// Frontend Routes Here
Route::get('/', [HomeController::class, 'index'])->name('home.index');
