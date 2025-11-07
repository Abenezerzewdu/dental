<?php

namespace App\Http\Controllers;

use id;
use Inertia\Inertia;
use App\Models\Service;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{

    //show all the appointments for admin
    public function index(){
          
        $appointments = Appointment::with('patient', 'service')->latest()->get();

    return Inertia::render('Appointments/Index', [
        'appointments' => $appointments
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

    return redirect()->route('appointments.index')
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
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'required|string|max:20',
        'appointment_time' => 'required|date',
        'service_id' => 'required|exists:services,id',

        // 'service' => 'required|string|max:255',
        'notes' => 'nullable|string|max:500',
    ]);

    // 1️⃣ If a user already exists, use that user
    $user = \App\Models\User::firstOrCreate(
        ['email' => $validated['email']],
        [
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'role' => 'patient',
        ]
    );

    // 2️⃣ Create the appointment
    $appointment = \App\Models\Appointment::create([
        'patient_id' => $user->id,
        'appointment_time' => $validated['appointment_time'],
        'service_id' => $validated['service_id'],
        'notes' => $validated['notes'] ?? null,
        'status' => 'pending',
    ]);

    // 3️⃣ Optional: Send email confirmation or success message
    // Notification::send($user, new AppointmentCreated($appointment));

    return redirect()->back()->with('success', 'Your appointment has been booked successfully!');
}

}

