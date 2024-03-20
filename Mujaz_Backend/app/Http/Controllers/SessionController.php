<?php

namespace App\Http\Controllers;


use App\Models\session;
use App\Models\mistake;
use App\Models\student;
use App\Models\teacher;
use App\Models\User;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sessions = session::all();
        return response()->json($sessions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = user::find($request->user_id);
        $student = student::find($request->student_id);
        $teacher = teacher::where('user_id', $request->user_id)->first();

        if ($user->role === 'admin') {
            $session = session::create(
                [
                    'date' => $request->date,
                    'student_id' => $student->id,
                    'student_name' => $student->name,
                    'teacher_id' => $user->id,
                    'teacher_name' => $user->name,
                    'pages' => $request->pages,
                    'ayat' => $request->ayat,
                    'amount' => $request->amount,
                    'mistakes' => $request->mistakes,
                    'mark' => $request->mark,
                    'notes' => $request->notes
                ]
            );
        } else if ($user->role === 'Teacher') {
            $session = session::create(
                [
                    'date' => $request->date,
                    'student_id' => $student->id,
                    'student_name' => $student->name,
                    'teacher_id' => $teacher->id,
                    'teacher_name' => $teacher->name,
                    'pages' => $request->pages,
                    'ayat' => $request->ayat,
                    'amount' => $request->amount,
                    'mistakes' => $request->mistakes,
                    'mark' => $request->mark,
                    'notes' => $request->notes
                ]
            );
        }

        return response()->json('session created successfully', 200);
    }

    // Get sessions by studnet
    public function getByStudent(student $student)
    {
        $student_id = $student->id;

        $sessions = session::where('student_id', $student_id)->get();
        return response()->json($sessions, 200);
    }

    // Get sessions by teacher
    public function getByTeacher(teacher $teacher)
    {
        $teacher_id = $teacher->id;

        $sessions = session::where('teacher_id', $teacher_id)->get();
        return response()->json($sessions, 200);
    }
    /**
     * Display the specified resource.
     */
    public function show(session $session)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, session $session)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(session $session)
    {
        //
    }
}
