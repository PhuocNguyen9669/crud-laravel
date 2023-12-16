<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->name('users.')->prefix('users')->controller(UserController::class)->group(function () {
    Route::get('/','index')->name('index');
    Route::get('/create','create')->name('create');
    Route::post('/store','store')->name('store');
    Route::get('/{id}/edit','edit')->name('edit');

    Route::put('/{id}/update','update')->name('update');
    Route::delete('/{id}/destroy','destroy')->name('destroy');
});

// Route::get('users', [UserController::class, 'index'])->name('users.index')->middleware('auth');
// Route::get('users/create', [UserController::class, 'create'])->name('users.create')->middleware('auth');
// Route::post('users/store', [UserController::class, 'store'])->name('users.store')->middleware('auth');
// Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('auth');

// Route::put('users/{id}/update', [UserController::class, 'update'])->name('users.update')->middleware('auth');
// Route::delete('users/{id}/destroy', [UserController::class, 'destroy'])->name('users.destroy')->middleware('auth');
