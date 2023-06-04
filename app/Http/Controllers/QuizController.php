<?php

namespace App\Http\Controllers;

use App\Models\quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quiz = Quiz::all();
        return inertia('Quiz/Main',compact('quiz'));
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
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        quiz::create([
            'name' => $request->name,

        ]);
        sleep(1);

        return redirect()->back();    }

    /**
     * Display the specified resource.
     */
    public function show(quiz $quiz)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(quiz $quiz)
    {
        $quiz2 = $quiz;
        return inertia('Quiz/Main',compact('quiz2'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, quiz $quiz)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $quiz->update([
            'name' => $request->name,

        ]);
        sleep(1);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(quiz $quiz)
    {
        //
    }
}
