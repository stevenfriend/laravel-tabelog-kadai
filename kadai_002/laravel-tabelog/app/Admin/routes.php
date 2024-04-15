<?php

use Illuminate\Routing\Router;
use App\Admin\Controllers\CategoryController;
use App\Admin\Controllers\RestaurantController;
use App\Admin\Controllers\UserController;
use App\Admin\Controllers\ReservationController;
use App\Admin\Controllers\ReviewController;
use App\Admin\Controllers\RestaurantImageController;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('categories', CategoryController::class);
    $router->resource('restaurants', RestaurantController::class);
    $router->resource('users', UserController::class);
    $router->resource('reservations', ReservationController::class);
    $router->resource('reviews', ReviewController::class);
    $router->resource('restaurant_images', RestaurantImageController::class);
});
