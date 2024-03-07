<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
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

// GetListOfTeachers
Route::get('/teachers', [TeacherController::class, 'index']);

// GetListOfStudent
Route::get('/students', [StudentController::class, 'index']);

// RoutesForAdmin
Route::group((['prefix' => 'admin']), function () {

    // addNewUser
    Route::post('/user/add', [UserController::class, 'newUser']);

    // showUserByid
    Route::get('/user/{id}', [UserController::class, 'show']);

    // FillStudentInformation
    Route::put('/student/form/{student}', [StudentController::class, 'update']);

    // FillTeacherInformation
    Route::put('/teacher/form/{teacher}', [TeacherController::class, 'update']);
});


// RoutesForTeacher
Route::prefix('teacher')->group(function () {
});

// RoutesForStudents
Route::prefix('student')->group(function () {
});


Route::middleware(['auth:sanctum'])->group(function () {
});
