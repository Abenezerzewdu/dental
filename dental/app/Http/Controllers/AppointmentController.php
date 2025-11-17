<?php

namespace App\Http\Controllers;

use id;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Service;
use App\Models\Appointment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{

    //show all the appointments for admin and reception
    public function index(Request $request)
{
    $filter = $request->filter ?? 'all';

    $query = Appointment::with(['patient', 'service']);

    // Receptionist sees only today and future
    if ($request->user()->hasRole('reception')) {
        $query->whereDate('appointment_time', '>=', today());
    }

    // Apply filters
    switch ($filter) {
        case 'today':
            $query->whereDate('appointment_time', today());
            break;

        case 'future':
            $query->whereDate('appointment_time', '>', today());
            break;

        case 'checked':
            $query->where('checkin_status', 'checked_in');
            break;
    }

    // FINAL single query
    $appointments = $query->orderBy('appointment_time')->get();

    return Inertia::render('Appointments/Index', [
        'appointments' => $appointments,
        'filter' => $filter,
    ]);
}


    
    //create form for appointment
    public function create(){
       $services = Service::select('id','name')->get();

    return Inertia::render('Appointments/Create', [
        'services' => $services
    ]);
    }

    //show individual appointments
    public function show(string $id){
        $user=User::findOrFail($id);
      Inertia::render("Appointment/Show",[
     'user'=>$user,
    ]);
    }

   

    //store appointment
    public function store(Request $request){
        
       $validated = $request->validate([
        'service_id' => 'required|exists:services,id',
        'appointment_date' => 'required|date|after:today',
        'notes' => 'nullable|string|max:255',
    ]);

    // Attach the appointment to the currently logged-in user
    Appointment::create([
        'patient_id' => auth()->id(),
        'service_id' => $validated['service_id'],
        'appointment_date' => $validated['appointment_date'],
        'notes' => $validated['notes'] ?? null,
        'status' => 'pending',
    ]);

    return redirect()->back()
                     ->with('success', 'Appointment created successfully!');
    }

    //show appointment editing page 
   public function edit(Appointment $appointment)
{
    $services = Service::all();

    return Inertia::render('Appointments/Edit', [
        'appointment' => $appointment,
        'services' => $services
    ]);
}

public function update(Request $request, Appointment $appointment)
{
    $validated = $request->validate([
        'service_id' => 'required|exists:services,id',
        'appointment_time' => 'required|date|after:today',
        'notes' => 'nullable|string|max:255',
    ]);

    $appointment->update($validated);

    return redirect()->route('appointment.index')
                     ->with('success', 'Appointment updated successfully!');
}

public function destroy(Appointment $appointment)
{
    $appointment->delete();

    return redirect()->route('appointment.index')
        ->with('success', 'Appointment deleted successfully!');
}


public function guestBooking(Request $request)
{
    // Validate input
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'required|string|max:20',
        'appointment_time' => 'required|date|after:now',
        'service_id' => 'required|exists:services,id',
        'notes' => 'nullable|string|max:500',
    ]);

    // 1️⃣ Check if a user exists by email OR create one
    $user = \App\Models\User::firstOrCreate(
        ['email' => $validated['email']], // Check by email
        [
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'role' => 'patient',   // Assign patient role on creation only
            'password' => bcrypt(Str::random(12)), // Required for auth
        ]
    );

    // 2️⃣ If user existed already but does NOT have patient role → assign it
    if ($user->hasRole('patient')) {
        $user->assignRole('patient');
        $user->save();
    }

    // 3️⃣ Create the appointment
    $appointment = \App\Models\Appointment::create([
        'patient_id' => $user->id,
        'appointment_time' => $validated['appointment_time'],
        'service_id' => $validated['service_id'],
        'notes' => $validated['notes'] ?? null,
        'status' => 'pending',
    ]);

    // 4️⃣ Log the user in
    Auth::login($user);

    // 5️⃣ Redirect to patient dashboard
    return redirect()->route('patient.dashboard')
                     ->with('success', 'Your appointment has been booked successfully!');
}


 public function checkIn($id)
{
    $appointment = Appointment::findOrFail($id);

    $appointment->checkin_status = 'checked_in';
    $appointment->checked_in_at = now();
    $appointment->save();

    return back()->with('success', 'Patient checked in successfully');
}


}

