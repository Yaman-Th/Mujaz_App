<?php

use App\Http\Controllers\SessionController;
use App\Http\Controllers\NotificationController;
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

    Route::post('/save-token', [NotificationController::class, 'saveFCMToken']);

    // AddNewUser
    Route::post('/user/add', [UserController::class, 'store']);

    // GetAcounts
    Route::get('/users/get', [UserController::class, 'getAcounts']);

    // UpdateUserInformtion
    Route::put('/user/{user}', [UserController::class, 'update']);

    // Logout
    Route::post('/user/logout', [UserController::class, 'logout']);

    // DeleteUser
    Route::delete('/user/destroy/{user}', [UserController::class, 'destroy']);

    // GetUserByid
    Route::get('/user/{id}', [UserController::class, 'show']);

    // ResetPassword
    Route::put('/user/reset/{user}', [UserController::class, 'resetPassword']);

    // FillStudentInfo
    Route::put('/student/form/{student}', [StudentController::class, 'update']);

    // GetStudentInfo
    Route::get('/student/info/{student}', [StudentController::class, 'showInfo']);

    // GetListOfStudent
    Route::get('/students', [StudentController::class, 'index']);

    // GetStudentsByTeacher
    Route::get('/students/{teacher}', [StudentController::class, 'getByTeacher']);

    // FillTeacherInformation
    Route::put('/teacher/form/{teacher}', [TeacherController::class, 'update']);

    // GetListOfTeachers
    Route::get('/teachers', [TeacherController::class, 'index']);

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

    // Logout
    Route::post('/user/logout', [UserController::class, 'logout']);

    // AddNewUser
    Route::post('/user/add', [UserController::class, 'store']);

    // UpdateUserInformtion
    Route::put('/user/{user}', [UserController::class, 'update']);

    // FillStudentInfo
    Route::put('/student/form/{student}', [StudentController::class, 'update']);

    // GetStudentInfo
    Route::get('/student/info/{student}', [StudentController::class, 'showInfo']);

    // GetStudentsByTeacher
    Route::get('/students/{teacher}', [StudentController::class, 'getByTeacher']);

    // DeleteStudent
    Route::delete('student/destroy/{student}', [StudentController::class, 'destroy']);

    // FillTeacherInformation
    Route::put('/teacher/form/{teacher}', [TeacherController::class, 'update']);

    // AddNewSession
    Route::post('/session/add', [SessionController::class, 'store']);

    // UpdateSession
    Route::put('/session/{session}', [SessionController::class, 'update']);

    // DestroySession
    Route::delete('/session/destroy/{session}', [SessionController::class, 'destroy']);

    // GetSessionsByTeacher
    Route::get('/session/teachers/{teacher}', [SessionController::class, 'getByTeacher']);

    // GetSessionsByFilter
    Route::get('/session', [SessionController::class, 'filteredSessions']);
});

// RoutesForStudents
Route::group((['prefix' => 'student', 'middleware' => ['auth:sanctum']]), function () {

    Route::post('/save-token', [NotificationController::class, 'saveFCMToken']);


    // UpdateUserInformtion
    Route::put('/user/{user}', [UserController::class, 'update']);

    // Logout
    Route::post('/user/logout', [UserController::class, 'logout']);

    // FillStudentInfo
    Route::put('/student/form/{student}', [StudentController::class, 'update']);

    // GetStudentInfo
    Route::get('/student/info/{student}', [StudentController::class, 'showInfo']);

    // GetSessionsByStudent
    Route::get('/session/students/{student}', [SessionController::class, 'getByStudent']);

    // GetSessionsByFilter
    Route::get('/session', [SessionController::class, 'filteredSessions']);
});
