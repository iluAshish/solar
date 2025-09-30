<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WelcomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [WelcomeController::class, 'home'])->name('home');
Route::get('/login', [WelcomeController::class, 'login'])->name('auth');
Route::post('/book', [WelcomeController::class, 'store'])->name('book.store');
Route::get('/about-us', function () {
    return view('about');
})->name('about');
Route::get('/services', function () {
    return view('service');
})->name('service');
Route::get('/products', function () {
    return view('products');
})->name('products');
Route::get('/contact-us', function () {
    return view('contact');
})->name('contact');

// Newly added pages
Route::get('/privacy-policy', function () {
    return view('privacy_policy');
})->name('privacy.policy');

Route::get('/refund-policy', function () {
    return view('refund_policy');
})->name('refund.policy');

Route::get('/shipping-policy', function () {
    return view('shipping_policy');
})->name('shipping.policy');

Route::get('/terms-and-conditions', function () {
    return view('terms_conditions');
})->name('terms.conditions');

// Auth Routes
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/admin-login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/admin-login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Group Routes
Route::group(['middleware' => 'auth'], function () {
    Route::get('/transaction', [AdminController::class, 'transaction'])->name('admin.transaction');
    Route::get('/users', [AdminController::class, 'user'])->name('admin.user');
    Route::get('/plans', [AdminController::class, 'plans'])->name('admin.plans');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/del-func', [AdminController::class, 'delete_func'])->name('admin.del.function');
    Route::get('/booking', [AdminController::class, 'book'])->name('admin.book');
    Route::get('/franchise-application', [AdminController::class, 'franchise'])->name('admin.franchise');
    Route::get('/image-gallery', [AdminController::class, 'ImageGallery'])->name('admin.imagegallery');
    Route::get('/add-image', [AdminController::class, 'add_image'])->name('admin.add_image');
    Route::get('/update-image/{id}', [AdminController::class, 'updateimage'])->name('admin.update_image');
    Route::post('/store-image-gallery', [AdminController::class, 'store'])->name('admin.imagegallery.store');
    Route::post('/update-image-gallery/{id}', [AdminController::class, 'update'])->name('admin.imagegallery.update');
    Route::get('/image-gallery/{id}', [AdminController::class, 'delete'])->name('admin.imagegallery.delete');
    Route::get('/video-gallery', [AdminController::class, 'VideoGallery'])->name('admin.VideoGallery');
    Route::get('/admin/add-video', [AdminController::class, 'addVideo'])->name('admin.add_video');
    Route::post('/admin/add-video', [AdminController::class, 'storeVideo'])->name('admin.store_video');
    Route::get('/admin/edit-video/{id}', [AdminController::class, 'editVideo'])->name('admin.edit_video');
    Route::post('/admin/edit-video/{id}', [AdminController::class, 'updateVideo'])->name('admin.update_video');
    Route::get('/admin/delete-video/{id}', [AdminController::class, 'deleteVideo'])->name('admin.delete_video');
});

// Clear Cache Route
Route::get('/clear-cache', function() {
    \Artisan::call('cache:clear');
    \Artisan::call('config:clear');
    \Artisan::call('route:clear');
    return redirect()->back()->with('success', 'Cache cleared successfully!');
});

// Clear Storage Route
Route::get('/clear-storage', function() {
    \Storage::disk('local')->cleanDirectory('public');
    \Storage::disk('local')->cleanDirectory('storage');
    return redirect()->back()->with('success', 'Storage cleared successfully!');
});
