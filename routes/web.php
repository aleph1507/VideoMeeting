<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BannerController;

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

Route::group(['middleware' => 'auth'], function () {
    Route::resource('banners', BannerController::class);
    Route::resource('categories', CategoryController::class)->except('show');
    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::get('{user}', [UserController::class, 'show'])->name('show');
        Route::delete('{user}', [UserController::class, 'destroy'])->name('destroy');
    });
});

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('index');
