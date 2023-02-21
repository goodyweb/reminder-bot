<?php

use App\Http\Controllers\PostGuzzleController;
use App\Http\Controllers\DiscordNotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CountdownsController;
use App\Http\Controllers\RemindersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something greath!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('posts',[PostGuzzleController::class,'index']);
Route::get('posts/store', [PostGuzzleController::class, 'store' ]);

Route::get('notification', [DiscordNotificationController::class, 'notification' ]);

Route::resource('dashboard', DashboardController::class);
Route::resource('products', ProductsController::class);
Route::resource('reminders', RemindersController::class);

Route::prefix('posts')->group(function () {
    Route::get('index', [PostsController::class, 'index']);
    Route::post('store', [PostsController::class, 'store']);
    Route::post('edit', [PostsController::class, 'edit']);
    Route::delete('destroy', [PostsController::class, 'destroy']);
});

Route::prefix('countdowns')->group(function () {
    Route::get('show', [CountdownsController::class, 'show']);
    Route::post('store', [CountdownsController::class, 'store']);
    Route::post('edit', [CountdownsController::class, 'edit']);
    Route::delete('destroy', [CountdownsController::class, 'destroy']);
});

