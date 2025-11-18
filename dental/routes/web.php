<?php

use Inertia\Inertia;
use App\Models\appointment;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReceptionController;
use App\Http\Controllers\RoleAssignController;
use App\Models\Appointment as ModelsAppointment;
use GuzzleHttp\Middleware;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', [HomeController::class,'dashboardSwitch'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','role:admin|reception'])->get('/appointments',[AppointmentController::class,'index'])->name('appointment.index');

Route::get('/appointment/create',[AppointmentController::class,'create'])->name('appointment.create');

Route::get('/appointments/{appointment}/edit',[AppointmentController::class,'edit'])->name('appointment.edit');

Route::get('/appointments/{appointment}',[AppointmentController::class,'show'])->name('appointment.show');

ROute::post('/appointments/guest',[AppointmentController::class,'guestBooking'])->name('appointments.guest');

// Update form submission
Route::put('/appointments/{appointment}', [AppointmentController::class, 'update'])
    ->name('appointments.update');

//delete appointment
Route::delete('/appointments/{appointment}',[AppointmentController::class,'destroy'])->name('appointment.delete')->middleware('auth','role:admin');

//all the core routes with methods of service created
Route::resource('services', ServiceController::class);

//all core crud routes and methods of users
Route::resource('users',UserController::class);

 

Route::get('/admin',[AdminController::class,'index'])->middleware('auth','role:admin');

Route::get('/reception',[ReceptionController::class,'index'])->middleware(['auth','role:reception']);



Route::get('/debug-role', function() {
    $user = auth()->user();
    return [
        'user' => $user->id ?? null,
        'roles' => $user ? $user->getRoleNames() : 'not logged in',
    ];
});

Route::post('/appointments/{appointment}/checkin', 
    [AppointmentController::class, 'checkIn'])
    ->middleware(['role:reception']);

 Route::get("/admin/roles",[RoleAssignController::class,'index']);
 Route::post('/admin/role/assign',[RoleAssignController::class,'assignRole'])->name('admin.roles.assign');
Route::get("/",[HomeController::class,'index']);

Route::get('/dashboardp',[HomeController::class,'dashboard'])->name('patient.dashboard');

require __DIR__.'/auth.php';
