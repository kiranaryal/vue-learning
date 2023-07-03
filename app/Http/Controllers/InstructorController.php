<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;
use App\Models\vehicle;


class InstructorController extends Controller
{
    public function index()
    {
        $vehicles=vehicle::get();
        $instructors = instructor::all();
        return inertia('Instructor/Main',compact('instructors','vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehicles=vehicle::get();
        return inertia('Instructor/Create',compact('vehicles'));
    }
    public function find()
    {
        $vehicles=vehicle::get();
        return inertia('Find',compact('vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'vehicle' => 'required|digits_between:0,19',
            'qualification' => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'age' => 'required|digits_between:0,19',
            'gender' => 'required|string',

        ]);
        instructor::create([
            'name' => $request->name,
            'vehicle' => $request->vehicle,
            'qualification' => $request->qualification,
            'experience' => $request->experience,
            'age' => $request->age/20,
            'gender' => $request->gender,
            'profile'=>$request->profile ?? '',

        ]);

        return redirect('instructor');
    }

    /**
     * Display the specified resource.
     */
    public function show(instructor $instructor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($instructor)
    {
        $instructor = instructor::findOrFail($instructor);
        $vehicles=vehicle::get();


        return inertia('Instructor/Edit',compact('instructor','vehicles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $instructor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'vehicle' => 'required|digits_between:0,19',
            'qualification' => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'age' => 'required|digits_between:0,19',
            'gender' => 'required|string',

        ]);
        Instructor::findOrFail($instructor)->update([
            'name' => $request->name,
            'vehicle' => $request->vehicle,
            'qualification' => $request->qualification,
            'experience' => $request->experience,
            'age' => $request->age/20,
            'gender' => $request->gender,

        ]);
        return redirect('instructor');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($instructor)
    {

        Instructor::findOrFail($instructor)->delete();
        return redirect('instructor');
    }

    public function getInstructors(Request $request){
        $userPreferences = $request->validate([
            'vehicle' => 'required|digits_between:0,19',
            'qualification' => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'age' => 'required|digits_between:0,19',
            'gender' => 'required|string',

        ]);
$userPreferences['age']=$userPreferences['age']/20;
        $instructors = $this->generateInstructorRecommendations($userPreferences);
        $vehicles=vehicle::get();

        return inertia('Instructors',compact('instructors','vehicles'));
    }

   public function cosineSimilarity($instructor1, $instructor2)
    {
    // Calculate the dot product of the two instructor vectors
    $dotProduct = $instructor1['age'] * $instructor2['age']
        + ($instructor1['gender'] * $instructor2['gender'])
        + ($instructor1['qualification'] * $instructor2['qualification'])
        + ($instructor1['experience'] * $instructor2['experience']);

    // Calculate the magnitude of each instructor vector
    $magnitude1 = sqrt(
        pow($instructor1['age'], 2)
        + pow($instructor1['gender'], 2)
        + pow($instructor1['qualification'], 2)
        + pow($instructor1['experience'], 2)
    );

    $magnitude2 = sqrt(
        pow($instructor2['age'], 2)
        + pow($instructor2['gender'], 2)
        + pow($instructor2['qualification'], 2)
        + pow($instructor2['experience'], 2)
    );

    // Calculate the cosine similarity
    if ($magnitude1 * $magnitude2 != 0) {
        return $dotProduct / ($magnitude1 * $magnitude2);
    } else {
        return 0; // or any other appropriate handling for zero magnitude
    }
}



public function generateInstructorRecommendations($userPreferences)
{
    $n=10;
    $instructors = Instructor::where('vehicle',$userPreferences['vehicle'])->select('id','age','gender','qualification','experience')->get();
    // Calculate similarity scores between user preferences and instructors
    $similarityScores = [];
    foreach ($instructors as $instructor) {
        $similarityScores[$instructor->id] = $this->cosineSimilarity($userPreferences, $instructor);
    }

    // Sort instructors based on similarity scores in descending order
    arsort($similarityScores);

    // Get the top N instructors as recommendations
    $topInstructors = array_slice($similarityScores, 0, $n, true);

    // Retrieve the actual instructor objects from the database using the instructor IDs
    $recommendedInstructors = [];
    foreach ($topInstructors as $instructorId => $score) {
        $recommendedInstructors[] = Instructor::find($instructorId);
    }

    return $recommendedInstructors;
}

}
