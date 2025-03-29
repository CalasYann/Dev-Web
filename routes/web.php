<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Object_CoController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;


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


Route::get('/profile', [ProfileController::class, 'show'])->name('profile');


Route::get('/report', [ReportController::class, 'index'])->name('report.index');
Route::post('/report', [ReportController::class, 'store'])->name('report.store');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth'])->group(function () {
    Route::resource('object_co', Object_CoController::class);
});

Route::resource('events', EventController::class);

Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
Route::post('/events', [EventController::class, 'store'])->name('events.store');

Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
