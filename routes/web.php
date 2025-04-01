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
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Models\Role;



Route::get('/connecte-simple', function () {
    return view('ConnecteSimple');
})->name('connecte.simple');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', function(){
    Auth::logout();
    return redirect('/login');
})->name('logout');

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



/*
Route::get('/admin/users', [UserController::class, 'adminDashboard'])->name('admin.users');
Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
*/
//Route::middleware(['auth', 'can:administrateur'])->group(function () {   

    Route::get('/admin/users', [UserController::class, 'admin_index'])->name('admin.users');
    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
//});
Route::put('/admin/users/{user}/roles', [UserController::class, 'updateRoles'])->name('admin.users.updateRoles');

Route::get('/admin/logs', [UserController::class, 'logs'])->name('admin.logs')->middleware('auth');

//Route::get('/admin/logs', [App\Http\Controllers\LogController::class, 'index'])->name('admin.logs')->middleware('auth');






Route::get('/users', [UserController::class, 'index'])->name('users.index')->middleware('auth');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show')->middleware('auth');



Route::get('/rapport', [Object_CoController::class, 'rapport'])->name('object_cos.rapport');

Route::get('/rapport-objets/pdf', [Object_CoController::class, 'genererRapportPDF'])->name('object_co.rapport.pdf')->middleware('auth');
