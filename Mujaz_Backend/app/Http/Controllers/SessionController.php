<?php

namespace App\Http\Controllers;


use App\Models\session;
use App\Models\mistake;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $session = session::create(
            [
                'student_name' => $request->student_name,
                'teacher_name' => $request->teacher_name,
                'start_page' => $request->start_page,
                'end_page' => $request->end_page,
                'first_ayah' => $request->first_ayah,
                'last_ayah' => $request->last_ayah,
                'amount' => $request->amount,
                'mark' => $request->mark
            ]
        );

        $mistake = mistake::create([
            'session_id' => $session->id,

        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(session $session)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(session $session)
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
