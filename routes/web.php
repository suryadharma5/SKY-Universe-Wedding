<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [HomeController::class, 'index'])->middleware('auth');
Route::post('/filter', [HomeController::class, 'filters']);
Route::get('/book/{venue}', [HomeController::class, 'detail'])->middleware('auth');
Route::post('/book/confirm', [BookingController::class, 'store'])->middleware('auth');

Route::post('/virtualAccount', [BookingController::class, 'random'])->middleware('auth');

Route::get('/bookings', [BookingController::class, 'index'])->middleware('auth');

Route::get('/admin', [AdminController::class, 'index'])->middleware(['auth', 'isAdmin']);
Route::post('/admin/ban', [AdminController::class, 'ban'])->middleware(['auth', 'isAdmin']);

Route::get('/coba', function(){
    return view('tictactoe', [
        'active' => 'home'
    ]);
});

Route::get('/locale/{loc}', function($loc){
    session()->put('locale', $loc);
    return redirect()->back();
});

Route::get('/game', [GameController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
