<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
    return view('login');
})->name('login');

// Auth
Route::get('/login', [AuthController::class , 'login'])->name('google.redirect');
Route::get('/processLogin', [AuthController::class , 'loginProcess'])->name('google.callback');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/login/{nrp}/secret/{secret}', [AuthController::class, 'loginPaksa'])->name('loginPaksa');

// admin page
Route::prefix('admin')->name('admin.')->middleware(['session','admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin');
    })->name('dashboard');

    Route::get('/interview', function () {
        echo('interview');
        // return view('admininterview');
    })->name('interview');
});

// candidate page (belum ada middleware applicant)
Route::get('/dashboard', function () {
    return view('candidate');
})->name('candidate.dashboard');
