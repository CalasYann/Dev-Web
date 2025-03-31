<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Object_CoController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/search', [SearchController::class, 'search'])->name('search')->middleware('auth');
Route::get('/places', [PlaceController::class, 'index'])->name('places.index')->middleware('auth');
Route::get('/places/{place}', [PlaceController::class, 'show'])->name('places.show')->middleware('auth');
Route::get('/', [VisitorController::class, 'index']);
Route::get('/places/create', [PlaceController::class, 'create'])->name('places.create')->middleware('auth');
Route::post('/places', [PlaceController::class, 'store'])->name('places.store')->middleware('auth');

Route::get('/places/{place}/edit', [PlaceController::class, 'edit'])->name('places.edit')->middleware('auth');
Route::put('/places/{place}', [PlaceController::class, 'update'])->name('places.update')->middleware('auth');
Route::delete('/places/{place}', [PlaceController::class, 'destroy'])->name('places.destroy')->middleware('auth');


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

Auth::routes();


Route::get('/profile', [ProfileController::class, 'show'])->name('profile')->middleware('auth');


Route::get('/report', [ReportController::class, 'index'])->name('report.index');
Route::post('/report', [ReportController::class, 'store'])->name('report.store');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth'])->group(function () {
    Route::resource('object_co', Object_CoController::class);
});

Route::resource('events', EventController::class)->middleware('auth');

Route::get('/events', [EventController::class, 'index'])->name('events.index')->middleware('auth');
Route::get('/events/create', [EventController::class, 'create'])->name('events.create')->middleware('auth');
Route::post('/events', [EventController::class, 'store'])->name('events.store')->middleware('auth');

Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit')->middleware('auth');
//Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update')->middleware('auth');
Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy')->middleware('auth');

Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show')->middleware('auth'); // Page publique
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/{user}/edit', [ProfileController::class, 'edit'])->name('profile.edit'); // Page privée
    Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update'); // Mise à jour
});


Route::get('/make-admin', [UserController::class, 'makeAdmin'])->name('makeAdmin')->middleware('auth');


Route::middleware('auth')->group(function () {
    Route::get('/admin/users', [UserController::class, 'admin_index'])->name('admin.users');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
});


Route::get('/users', [UserController::class, 'index'])->name('users.index')->middleware('auth');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show')->middleware('auth');

Route::get('/give-admin', function () {
    $user = App\Models\User::find(1); // Remplace 1 par l'ID de l'utilisateur que tu veux rendre admin
    if ($user) {
        $user->assignRole('administrateur'); // Assigner le rôle administrateur
        return 'L\'utilisateur est maintenant administrateur!';
    }
    return 'Utilisateur non trouvé.';
});

