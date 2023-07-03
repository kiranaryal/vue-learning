<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\vehicle;

use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function index()
    {
        $vehicles=vehicle::get();
        $courses = Courses::all();
        return inertia('Courses/Main',compact('courses','vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehicles=vehicle::get();
        return inertia('Courses/Create',compact('vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|digits_between:0,19',
            'status' => 'required|string|max:255',
            'time' => 'required|string|max:255',
            'rate' => 'required|digits_between:0,19',
            'vat' => 'required|between:0,99.99',

        ]);
        Courses::create([
            'name' => $request->name,
            'type' => $request->type,
            'status' => $request->status,
            'time' => $request->time,
            'rate' => $request->rate,
            'vat' => $request->vat,
            'total' => $request->rate*$request->vat/100+$request->rate,

        ]);

        return redirect('courses');
    }

    /**
     * Display the specified resource.
     */
    public function show(Courses $courses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($courses)
    {
        $courses = Courses::findOrFail($courses);
        $vehicles=vehicle::get();


        return inertia('Courses/Edit',compact('courses','vehicles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $courses)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|digits_between:0,19',
            'status' => 'required|string|max:255',
            'time' => 'required|string|max:255',
            'rate' => 'required|digits_between:0,19',
            'vat' => 'required|between:0,99.99',

        ]);
        Courses::findOrFail($courses)->update([
            'name' => $request->name,
            'type' => $request->type,
            'status' => $request->status,
            'time' => $request->time,
            'rate' => $request->rate,
            'vat' => $request->vat,
            'total' => $request->rate*$request->vat/100+$request->rate,

        ]);
        return redirect('courses');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($courses)
    {

        Courses::findOrFail($courses)->delete();
        return redirect('courses');

    }
}
