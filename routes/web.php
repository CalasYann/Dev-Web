<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/places', [PlaceController::class, 'index'])->name('places.index');
Route::get('/places/{place}', [PlaceController::class, 'show'])->name('places.show');
Route::get('/', [VisitorController::class, 'index']);
Route::get('/places/create', [PlaceController::class, 'create'])->name('places.create');
Route::post('/places', [PlaceController::class, 'store'])->name('places.store');

Route::get('/places/{place}/edit', [PlaceController::class, 'edit'])->name('places.edit');
Route::put('/places/{place}', [PlaceController::class, 'update'])->name('places.update');
Route::delete('/places/{place}', [PlaceController::class, 'destroy'])->name('places.destroy');


Route::middleware('auth')->group(function () {
    Route::get('/places/{place}/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/places/{place}/reservations', [ReservationController::class, 'store'])->name('reservations.store');
});

Route::delete('/reservations/{res}', [ReservationController::class, 'destroy'])
    ->middleware('auth')
    ->name('reservations.destroy');

Route::get('/my-reservations', [ReservationController::class, 'myReservations'])
    ->middleware('auth')
    ->name('reservations.index');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
