<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReceptionController extends Controller
{
    //overview for reception
  public function index()
{
    $today = today();

    // Eager load relationships once
    $appointmentsQuery = Appointment::with(['patient', 'service'])
        ->whereDate('appointment_time', $today);

    $appointmentsToday = (clone $appointmentsQuery)->count();

    $checkedIn = (clone $appointmentsQuery)
        ->where('checkin_status', 'checked_in')
        ->count();

    $waiting = (clone $appointmentsQuery)
        ->where('status', 'pending')
        ->count();

    $completed = (clone $appointmentsQuery)
        ->where('checkin_status', 'completed')
        ->count();

    $todayAppointments = $appointmentsQuery
        ->orderBy('appointment_time')
        ->get();

    return Inertia::render('Reception/Index', [
        'stats' => [
            'todayAppointments' => $appointmentsToday,
            'checkedIn' => $checkedIn,
            'waiting' => $waiting,
            'completed' => $completed,
        ],
        'todayAppointments' => $todayAppointments,
    ]);
}


}
