<?php

use App\Http\Controllers\ProfileController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BarangController;

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

Route::get('/dashboard', [BarangController::class ,'index1'])
->name('dashboard')->middleware(['auth', 'verified']);


Route::get('/masuk', [BarangController::class ,'index'])
->name('masuk')->middleware(['auth', 'verified']);

Route::get('/keluar', [BarangController::class ,'index2'])
->name('keluar')->middleware(['auth', 'verified']);

Route::get('/users', function () {
    return view('users'); 
})->middleware(['auth','verified'])->name('users');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

//Data Table
Route::post('masuk', [BarangController::class,'store'])->name('masuk');
Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
Route::put('/barang/{id}', [BarangController::class, 'update'])->name('barang.update');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
}); 


Route::post('/update-profile', [ProfileController::class, 'updateProfile'])->name('updateProfile')->middleware(['auth', 'verified']);


require __DIR__.'/auth.php';
