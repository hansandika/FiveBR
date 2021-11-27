<?php

namespace App\Http\Controllers;

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

Route::get('/', [GigController::class, 'index'])->name('show-home');

Route::get('/login', [Auth\LoginController::class, 'index'])->name('show-login');
Route::post('/login', [Auth\LoginController::class, 'login'])->name('login');

Route::get('/register', [Auth\RegisterController::class, 'index'])->name('show-register');
Route::post('/register', [Auth\RegisterController::class, 'register'])->name('register');


Route::prefix('/profile')->middleware('auth')->group(function () {
    Route::get('{user}', [ProfileController::class, 'index'])->name('show-profile');
    Route::get('edit/{user}', [ProfileController::class, 'edit'])->name('edit-profile');
    Route::put('{user}', [ProfileController::class, 'update'])->name('update-profile');
});

Route::prefix('/gig')->middleware('auth')->group(function () {
    Route::get('create', [GigController::class, 'create'])->name('create-gig');
    Route::post('create', [GigController::class, 'store'])->name('store-gig');
    Route::get("loved", [FavouriteGigController::class, 'index'])->name('show-favourite-gig');
    Route::get('edit/{gig}', [GigController::class, 'edit'])->name('edit-gig');
    Route::put('{gig}', [GigController::class, 'update'])->name('update-gig');
    Route::delete('{gig}', [GigController::class, 'destroy'])->name('delete-gig');
    Route::get('checkout/{gig}/{type}', [CheckoutController::class, 'index'])->name('show-checkout');
    Route::post('checkout/{gig}', [CheckoutController::class, 'store'])->name('store-checkout');
    Route::post('review/{gig}', [ReviewController::class, 'store'])->name('store-review');
    Route::get('{gig}', [GigController::class, 'show'])->name('show-gig')->withoutMiddleware('auth');
});

Route::prefix('/api')->middleware('auth')->group(function () {
    Route::post('love/{user}/{gig}', [FavouriteGigController::class, 'store'])->name('store-favourite-gig');
    Route::delete('love/{user}/{gig}', [FavouriteGigController::class, 'destroy'])->name('delete-favourite-gig');
});

Route::get('/search', [SearchController::class, 'index'])->name('search-gig');

Route::middleware('auth')->group(function () {
    Route::get('/logout', [Auth\LoginController::class, 'logout'])->name('logout');
    Route::get('/transactions', [TransactionController::class, 'index'])->name('show-transactions');
});
