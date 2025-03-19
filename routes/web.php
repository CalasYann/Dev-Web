<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ReservationController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/places', [PlaceController::class, 'index'])->name('places.index');
Route::get('/places/{place}', [PlaceController::class, 'show'])->name('places.show');

Route::get('/places/create', [PlaceController::class, 'create'])->name('places.create');
Route::post('/places', [PlaceController::class, 'store'])->name('places.store');

Route::get('/places/{place}/edit', [PlaceController::class, 'edit'])->name('places.edit');
Route::put('/places/{place}', [PlaceController::class, 'update'])->name('places.update');
Route::delete('/places/{place}', [PlaceController::class, 'destroy'])->name('places.destroy');



Route::middleware('auth')->group(function() {
    Route::get('/places/{place}/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/places/{place}/reservations', [ReservationController::class, 'store'])->name('reservations.store');
});
