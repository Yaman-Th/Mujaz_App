<?php

use App\Http\Controllers\SessionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// PublicRoutes
Route::post('/user/login', [UserController::class, 'login']);

// RoutesForAdmin
Route::group((['prefix' => 'admin', 'middleware' => ['auth:sanctum']]), function () {

    // AddNewUser
    Route::post('/user/add', [UserController::class, 'store']);

    // UpdateUserInformtion
    Route::put('/user/{user}', [UserController::class, 'update']);

    // Logout
    Route::post('/user/logout', [UserController::class, 'logout']);

    // DeleteUser
    Route::delete('/user/destroy/{user}', [UserController::class, 'destroy']);

    // GetUserByid
    Route::get('/user/{id}', [UserController::class, 'show']);

    // FillStudentInformation
    Route::put('/student/form/{student}', [StudentController::class, 'update']);

    // FillTeacherInformation
    Route::put('/teacher/form/{teacher}', [TeacherController::class, 'update']);

    // GetListOfTeachers
    Route::get('/teachers', [TeacherController::class, 'index']);

    // GetListOfStudent
    Route::get('/students', [StudentController::class, 'index']);

    // AddNewSession
    Route::post('/session/add', [SessionController::class, 'store']);

    // GetAllSessions
    Route::get('/sessions', [SessionController::class, 'index']);

    // GetSessionsByStudent
    Route::get('/session/students/{student}', [SessionController::class, 'getByStudent']);

    // GetSessionsByTeacher
    Route::get('/session/teachers/{teacher}', [SessionController::class, 'getByTeacher']);

    // GetSessionsByFilter
    Route::get('/session', [SessionController::class, 'filteredSessions']);

    // UpdateSession
    Route::put('/session/{session}', [SessionController::class, 'update']);

    // DestroySession
    Route::delete('/session/destroy/{session}', [SessionController::class, 'destroy']);
});


// RoutesForTeacher
Route::group((['prefix' => 'teacher', 'middleware' => ['auth:sanctum']]), function () {
});

// RoutesForStudents
Route::group((['prefix' => 'student', 'middleware' => ['auth:sanctum']]), function () {
});
