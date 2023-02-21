<?php

use App\Http\Controllers\PostGuzzleController;
use App\Http\Controllers\DiscordNotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CountdownsController;
use App\Http\Controllers\RemindersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

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
})->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::get('users', [UsersController::class, "index"])->name('users');
Route::get('users/getUsers/', [UsersController::class, "getUsers"])->name('users.getUsers');
Route::post('store-user', [UsersController::class, 'store']);
Route::post('create', [UsersController::class, 'create']);
Route::post('edit-user', [UsersController::class, 'edit']);
Route::post('delete-user', [UsersController::class, 'destroy']);

//Route::get('notification',[PostGuzzleController::class,'notification']);
Route::get('testview',[PostGuzzleController::class,'testView']);
Route::get('dashboard',[DashboardController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('posts',[PostGuzzleController::class,'index']);
Route::get('posts/store', [PostGuzzleController::class, 'store' ]);

Route::get('notification', [DiscordNotificationController::class, 'notification' ]);
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

