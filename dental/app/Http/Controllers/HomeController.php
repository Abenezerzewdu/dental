<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Service;
use App\Models\Appointment;
use Illuminate\Http\Request;

use function Symfony\Component\Clock\now;

class HomeController extends Controller
{
    
    public function index()
    {
        $services = Service::select('id', 'name', 'description','photo')->get();

        return Inertia::render('Home/Index', [
            'services' => $services,
            
        ]);
    }


    //patient dashboard
    public function dashboard()
{
    return Inertia::render('Patient/Dashboard', [
         'nextAppointment'=>Appointment::with(['service'])->where('patient_id',auth()->id())->where('appointment_time','>=',now())->orderBy('appointment_time', 'asc')->get(),
        'notifications' => [
            ['text' => 'Your dental cleaning is coming soon.', 'date' => 'Nov 15'],
            ['text' => 'New X-ray results available.', 'date' => 'Nov 10'],
        ],
    ]);
}
function dashboardSwitch() {
    $user=auth()->user();
    if($user->hasRole('admin')){
      return Inertia::render('Admin/Index');
    }
    elseif($user->hasRole('reception')){
       return Inertia::render("Reception/Index");
    }
    elseif($user->hasRole('patient')){
           return Inertia::render("Patient/Dashboard");

    }
    return Inertia::render('Dashboard');
}
}


