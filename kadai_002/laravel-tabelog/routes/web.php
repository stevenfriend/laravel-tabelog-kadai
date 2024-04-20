<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SubscriptionController;

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

Route::get('/',  [WebController::class, 'index'])->name('top');
Route::get('/home', [WebController::class, 'index'])->name('home');

Route::controller(ReservationController::class)->group(function () {
    Route::get('users/mypage/reservation', 'index')->name('mypage.reservation')->middleware(['auth', 'verified']);
});

Route::controller(UserController::class)->group(function () {
    Route::get('users/mypage', 'mypage')->name('mypage');
    Route::get('users/mypage/edit', 'edit')->name('mypage.edit');
    Route::put('users/mypage', 'update')->name('mypage.update');
    Route::get('users/mypage/favorite', 'favorite')->name('mypage.favorite');
    Route::get('users/mypage/password/edit', 'edit_password')->name('mypage.edit_password');
    Route::put('users/mypage/password', 'update_password')->name('mypage.update_password');
});

Route::controller(SubscriptionController::class)->group(function () {
    Route::get('subscription/create', 'create')->name('subscription.create')->middleware(['auth', 'verified']);
    Route::post('subscription/store', 'store')->name('subscription.store')->middleware(['auth', 'verified']);
    Route::get('subscription/edit', 'edit')->name('subscription.edit');
    Route::put('subscription/update', 'update')->name('subscription.update');
    Route::get('subscription/cancel', 'cancel')->name('subscription.cancel');
    Route::delete('subscription/destroy', 'destroy')->name('subscription.destroy');
});

Route::post('reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::delete('reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

Route::post('reservations', [ReservationController::class, 'store'])->name('reservations.store');
Route::delete('reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');

Route::get('restaurants/{restaurant}/favorite', [RestaurantController::class, 'favorite'])->name('restaurants.favorite');
Route::resource('restaurants', RestaurantController::class);
Auth::routes(['verify' => true]);
