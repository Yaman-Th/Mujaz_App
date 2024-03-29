<?php

namespace App\Http\Controllers;

use App\Models\student;
use App\Models\teacher;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = student::all();

        if ($students === null)
            return response()->json('Sorry, No Students Here', 404);

        return response()->json($students);
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
    public function show(student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, student $student)
    {
        $teacher = teacher::find($request->teacher_id);

        $student->update([
            'teacher_id' => $teacher->id,
            'teacher_name' => $teacher->name,
            'phone' => $request->phone,
            'starting_date' => $request->starting_date
        ]);

        return response()->json($student);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(student $student)
    {
        //
    }
}
