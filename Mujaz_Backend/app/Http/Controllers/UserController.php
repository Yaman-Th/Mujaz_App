<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\student;
use App\Models\teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use ArPHP\I18N\Arabic;

class UserController extends Controller
{

    public function generateUsername($name)
    {
        $arabic = new Arabic();
        $characters = '0123456789'; // Allowed characters

        $name = str_replace(" ", "_", strtolower($arabic->ar2en($name)));
        $username = substr($name, 0, 5) . rand(100, 999);
        // Check for uniqueness (replace with your actual user table check)
        while (User::where('username', $username)->exists()) {
            $username = substr($name, 0, 5) . rand(100, 999);
        }

        return $username;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string'
        ]);

        $teacher = teacher::where('user_id', $request->user_id)->first();
        $requestUser = User::find($request->user_id);

        if ($request->role == "student") {
            $username = "st_" . UserController::generateUsername($request->name);
        } else if ($request->role == "teacher") {
            $username = "te_" . UserController::generateUsername($request->name);
        }

        $random = str_shuffle('12345678abcdefghijklmnopqrstuvwxyz');
        $password = substr($random, 0, 8);

        if ($requestUser->role == "admin") {
            $user = User::create([
                'name' => $request->name,
                'username' => $username,
                'password' => $password,
                'role' => $request->role
            ]);

            if ($user->role == "student") {
                student::create([
                    'name' => $user->name,
                    'user_id' => $user->id,
                    'teacher_id' => $teacher->id,
                    'teacher_name' => $teacher->name
                ]);
            } else if ($user->role == "teacher") {
                teacher::create([
                    'name' => $user->name,
                    'user_id' => $user->id,
                ]);
            }
        } else if ($requestUser->role == "teacher") {
            if ($request->role == "teacher")
                return response()->json('You Are not authorized to Add Teachers', 401);
            elseif ($request->role == "student") {
                $user = User::create([
                    'name' => $request->name,
                    'username' => $username,
                    'password' => $password,
                    'role' => $request->role
                ]);
                student::create([
                    'name' => $user->name,
                    'user_id' => $user->id,
                    'teacher_id' => $teacher->id,
                    'teacher_name' => $teacher->name
                ]);
            }
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

    public function logout(Request $request)
    {

        $request->user()->currentAccessToken()->delete();

        return response()->json('Logged out successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }

    public function update(User $user, Request $request)
    {
        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        return response()->json($user, 200);
    }
}
