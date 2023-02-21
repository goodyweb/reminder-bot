<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostGuzzleController;
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
Route::get('/dashboard',[PostGuzzleController::class,'notification'])->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
