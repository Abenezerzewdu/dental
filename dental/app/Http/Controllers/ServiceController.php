<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('name')->get();
        return Inertia::render('Services/Index', compact('services'));
    }

    public function create()
    {
        return Inertia::render('Services/Create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:500',
        'price' => 'nullable|numeric|min:0',
        'photo' => 'nullable|image|max:2048', // max 2MB
    ]);

    if ($request->hasFile('photo')) {
        $validated['photo'] = $request->file('photo')->store('services', 'public');
    }

    Service::create($validated);

    return redirect()->route('services.index')->with('success', 'Service created successfully!');
}
    
    public function edit(Service $service)
    {
        return Inertia::render('Services/Edit', compact('service'));
    }

public function update(Request $request, Service $service)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:500',
        'price' => 'nullable|numeric|min:0',
        'photo' => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('photo')) {
        // Optionally delete old photo
        if ($service->photo && Storage::disk('public')->exists($service->photo)) {
            Storage::disk('public')->delete($service->photo);
        }
        $validated['photo'] = $request->file('photo')->store('services', 'public');
    }

    $service->update($validated);

    return redirect()->route('services.index')->with('success', 'Service updated successfully!');
}


    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Service deleted successfully!');
    }
}