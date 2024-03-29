<?php

namespace App\Http\Controllers;

use App\Models\student;
use App\Models\teacher;
use App\Models\session;
use Carbon\Carbon;
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
     * Display the specified resource.
     */
    public function showInfo(student $student)
    {
        $student = student::find($student->id);
        $sessions = session::where('student_id', $student->id)->get();

        // last session - DONE
        $lastSession = session::where('student_id', $student->id)
            ->latest()->first();

        // remain amount - DONE
        $remainPages = 604 - last($lastSession->pages);
        $remainVerses = $remainPages / 20;

        // name - DONE
        $name = $student->name;

        // tested verses - DONE
        $testedVerses = $student->tested_verses;

        // sessions count in every month - DONE
        // $avgSessionsInMonth = count($sessions);

        // avarege marks - DONE
        $sum = 0;
        for ($i = 0; $i < count($sessions); $i++) {
            $sum = $sum + $sessions[$i]->mark;
        }
        $avgMarks = $sum / count($sessions);

        // teacher name - DONE
        $teacher_name = $student->teacher_name;

        // notes - DONE
        $notes = $student->notes;

        $response = [
            'name' => $name,
            'teacher_name' => $teacher_name,
            'last_session' => $lastSession,
            'remain_pages' => $remainPages,
            'remain_verses' => $remainVerses,
            'average_marks' => $avgMarks,
            'tested_verses' => $testedVerses,
            'notes' => $notes
        ];
        return response()->json($response);
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
            'starting_date' => $request->starting_date,
            'tested_verses' => $request->tested_verses,
            'notes' => $request->notes
        ]);

        return response()->json($student);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(student $student)
    {
        $student->delete();
        return response()->json(null, 204);
    }
}
