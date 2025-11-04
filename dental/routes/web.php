<?php

use Inertia\Inertia;
use App\Models\appointment;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AppointmentController;
use App\Models\Appointment as ModelsAppointment;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/appointment',[AppointmentController::class,'index'])->name('appointment.index');

Route::get('/appointment/create',[AppointmentController::class,'create'])->name('appointment.create');

Route::get('/appointments/{appointment}/edit',[AppointmentController::class,'edit'])->name('appointment.edit');

ROute::post('/appointments/guest',[AppointmentController::class,'guestBooking'])->name('appointments.guest');

// Update form submission
Route::put('/appointments/{appointment}', [AppointmentController::class, 'update'])
    ->name('appointments.update');

//delete appointment
Route::delete('/appointments/{appointment}',[AppointmentController::class,'destroy'])->name('appointment.delete');

//all the core routes with methods of service created
Route::resource('services', ServiceController::class);

require __DIR__.'/auth.php';
