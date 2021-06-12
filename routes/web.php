<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FilmController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\FilmsController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::middleware(['auth:sanctum', 'verified', 'adminOnly'])->name("admin.")->prefix("admin")->group(function () {
    Route::get('/', DashboardController::class)->name("index");
    Route::resource('/films', FilmController::class);
    Route::resource('/users', UserController::class);
});

Route::get('/', [FilmsController::class, 'index'])->name('home');
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/review/{film}', [FilmsController::class, 'review'])->name('film.review');
    Route::post('/review/{film}', [FilmsController::class, 'rate'])->name('film.rate');
    Route::post('/comment/{film}', [FilmsController::class, 'comment'])->name('film.comment');
});


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
