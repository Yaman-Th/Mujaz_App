<?php

namespace App\Http\Controllers;


use App\Models\session;
use App\Models\mistake;
use App\Models\student;
use App\Models\teacher;
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
        $student = student::find($request->student_id);
        $teacher = teacher::find($request->teacher_id);

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
                'mark' => $request->mark,
                'notes' => $request->notes
            ]
        );

        for ($i = 0; $i < $request->mistakes_num; $i++) {
            $mistakes = mistake::create(
                [
                    'session_id' => $session->id,
                    'type' => $request->mistakes[$i]['type'],
                    'ayah_num' => $request->mistakes[$i]['ayah_num'],
                    'word' => $request->mistakes[$i]['word'],
                    'mark' => $request->mistakes[$i]['mark'],
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
