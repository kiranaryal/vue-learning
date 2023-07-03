<?php

namespace App\Http\Controllers;

use App\Models\vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $vehicle = vehicle::all();
        return inertia('Vehicles/Main',compact('vehicle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Vehicles/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',

        ]);
        vehicle::create([
            'name' => $request->name,
            'type'=>$request->type,

        ]);

        return redirect('vehicle');
    }

    /**
     * Display the specified resource.
     */
    public function show(vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(vehicle $vehicle)
    {
        $vehicle = $vehicle;
        return inertia('Vehicles/Edit',compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, vehicle $vehicle)
    {
         $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',

        ]);
        $vehicle->update([
            'name' => $request->name,
            'type'=>$request->type,

        ]);

        return redirect('vehicle');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect('vehicle');

    }
}
