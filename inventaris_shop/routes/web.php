<?php

use App\Http\Controllers\ProfileController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\UserController;

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

Route::get('keluar/{id_barang}', [BarangController::class,'edit']);
Route::post('masuk', [BarangController::class,'store']);
Route::put('keluar/{id_barang}', [BarangController::class, 'update'])->name('keluar.update');
Route::delete('keluar/{id_barang}', [BarangController::class, 'destroy'])->name('keluar.destroy');





Route::get('/dashboard', [BarangController::class ,'index1'])
->name('dashboard')->middleware(['auth', 'verified']);


Route::get('/masuk', [BarangController::class ,'index'])
->name('masuk')->middleware(['auth', 'verified']);

Route::get('/keluar', [BarangController::class ,'index2'])
->name('keluar')->middleware(['auth', 'verified']);

Route::get('/users', [UserController::class, 'showUsers'])->middleware('auth')->name('users');

Route::get('/users', [UserController::class, 'showUsers'])->name('users');
Route::delete('/users/{id}', [UserController::class, 'deleteUser'])->name('deleteUser');
Route::post('/users/set-role/{id}', [UserController::class, 'setRole'])->name('setRole');


Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

//Data Table

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/update-profile', [UserController::class, 'updateProfile'])->name('update-profile');
    Route::get('/users', [UserController::class, 'showUsers'])->name('users');
    Route::delete('/users/{id}', [UserController::class, 'deleteUser'])->name('deleteUser');
    Route::post('/users/set-role/{id}', [UserController::class, 'setRole'])->name('setRole');
 
    });

    Route::middleware(['admin'])->group(function () {
        Route::delete('/users/{id}', [UserController::class, 'deleteUser'])->name('deleteUser');
        Route::post('/users/set-role/{id}', [UserController::class, 'setRole'])->name('setRole');
    });
    

require __DIR__.'/auth.php';



