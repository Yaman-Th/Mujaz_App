<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\student;
use App\Models\teacher;
use Illuminate\Http\Request;
use TaylorNetwork\UsernameGenerator\Generator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string'
        ]);

        $generator = new Generator();

        if ($request->role == "Student") {
            $username = "ST " . $generator->generate($request->name);
        } else if ($request->role == "Teacher") {
            $username = "TE " . $generator->generate($request->name);
        }

        $random = str_shuffle('12345678abcdefghijklmnopqrstuvwxyz');
        $password = substr($random, 0, 8);

        $user = User::create([
            'name' => $request->name,
            'username' => $username,
            'password' => $password,
            'role' => $request->role
        ]);

        if ($user->role == "Student") {
            $student = student::create([
                'name' => $user->name,
                'user_id' => $user->id,
            ]);
        } else if ($user->role == "Teacher") {
            $teacher = teacher::create([
                'name' => $user->name,
                'user_id' => $user->id,
            ]);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'username' => $user->username,
            'password' => $password,
            'token' => $token
        ];


        return response($response, 201);
    }

    public function show(string $id)
    {
        $user = User::find($id);

        if ($user === null) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return $user;
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',

        ]);

        $user = User::where('username', $request->username)->first();



        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'username' => ['The provided credentials are incorrect.'],
            ]);
        }



        return response()
            ->json([
                'message' => 'You have logged in successfully.',
                'user' => $user,
                'token' => $user->createToken('myapptoken')->plainTextToken,
            ]);
    }
}
