<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\{
    DashboardController, 
    HomeController
};

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    // Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::prefix('dashboard')->group(function () {
        Route::match(['get', 'post'], '/post/create', [DashboardController::class, 'postCreate'])->name('dashboard.post.create');
        Route::match(['get', 'post'], '/post/{post_id}/edit', [DashboardController::class, 'postEdit'])->name('dashboard.post.edit');
        Route::post('/post/{post_id}/delete', [DashboardController::class, 'postDelete'])->name('dashboard.post.delete');
    });
});
