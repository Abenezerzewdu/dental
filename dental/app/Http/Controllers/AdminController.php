<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Service;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    //display the dashboard
    public function index()
    {
        //get total appointment,service and user number
        $users=User::count();
        $appointments=Appointment::count();
        $services=Service::count();

        // return a collection with `name` and `appointments_count` for each service
        $service = Service::withCount('appointments')->get();
 

        //get the overall monthly appoitments
        $appointmentsPerMonth = Appointment::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total')
        )
        ->whereYear('created_at', Carbon::now()->year)
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('total', 'month'); // returns [1 => 12, 2 => 19, ...] etc
        
        // --- User Growth Data ---
    $userGrowth = User::select(
        DB::raw('MONTH(created_at) as month'),
        DB::raw('COUNT(*) as total')
    )
    ->groupBy('month')
    ->orderBy('month')
    ->get();

    // convert month numbers to readable names
    $userGrowthLabels = $userGrowth->pluck('month')->map(function ($month) {
        return date("F", mktime(0, 0, 0, $month, 1));
    });

    $userGrowthData = $userGrowth->pluck('total');

        return Inertia::render("Admin/Index",[
           'users'=>$users,
           'appointments'=>$appointments,
           'services'=>$services,
           'appointmentsPerMonth'=>$appointmentsPerMonth,
           'service'=>$service,
           'userGrowthLabels'=>$userGrowthLabels,
           'userGrowthData'=>$userGrowthData,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
