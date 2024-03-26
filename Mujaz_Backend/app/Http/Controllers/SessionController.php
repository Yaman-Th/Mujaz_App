<?php

namespace App\Http\Controllers;


use App\Models\session;
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
                    'taps_num' => $request->taps_num,
                    'mark' => $request->mark,
                    'duration' => $request->duration,
                    'notes' => $request->notes
                ]
            );
        } else if ($user->role === 'teacher') {
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
                    'taps_num' => $request->taps_num,
                    'mark' => $request->mark,
                    'duration' => $request->duration,
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

    public function filteredSessions(Request $request)
    {

        $student_name = $request->query('student_name');
        $teacher_name = $request->query('teacher_name');
        $dateFrom = $request->query('dateFrom');
        $dateTo = $request->query('dateTo');


        $sessions = session::where(function ($query) use ($teacher_name, $student_name, $dateFrom, $dateTo) {

            if ($student_name && $teacher_name && $dateFrom && $dateTo) {
                $query->where('teacher_name', $teacher_name)
                    ->where('student_name', $student_name)
                    ->whereBetween('date', [$dateFrom, $dateTo]);
            }

            if ($teacher_name && $dateFrom && $dateTo) {
                $query->where('teacher_name', $teacher_name)
                    ->whereBetween('date', [$dateFrom, $dateTo]);
            }
            if ($student_name && $dateFrom && $dateTo) {
                $query->where('student_name', $student_name)
                    ->whereBetween('date', [$dateFrom, $dateTo]);
            }
            if ($teacher_name) {
                $query->where('teacher_name', $teacher_name);
            }
            if ($student_name) {
                $query->where('student_name', $student_name);
            }
            if ($dateFrom && $dateTo) {
                $query->whereBetween('date', [$dateFrom, $dateTo]);
            }
        })->get();

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
        $user = user::find($request->user_id);
        $student = student::find($request->student_id);
        $teacher = teacher::where('user_id', $request->user_id)->first();

        if ($user->role === 'admin') {
            $session->update(
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
                    'taps_num' => $request->taps_num,
                    'mark' => $request->mark,
                    'duration' => $request->duration,
                    'notes' => $request->notes
                ]
            );
        } else if ($user->role === 'teacher') {
            $session->update(
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
                    'taps_num' => $request->taps_num,
                    'mark' => $request->mark,
                    'duration' => $request->duration,
                    'notes' => $request->notes
                ]
            );
        }

        return response()->json($session);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(session $session)
    {
        $session->delete();
        return response()->json('session deleted succefully !!', 204);
    }
}
