<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/logout', function () {
    auth()->logout();
    auth('student')->logout();
    return redirect()->route('login');
})->name('logout');

Route::get('/profile', function () {
    return redirect()->route('login');
})->name('profile');

Route::group(['prefix' => 'student'], function () {

    Route::get('/', [StudentController::class, 'index'])->name('student.dashboard');
    Route::get('/sign-up', [StudentAuthController::class, 'signup'])->name('signup');
    Route::post('/sign-up', [StudentAuthController::class, 'doSignup'])->name('do.signup');
    Route::get('/login', [StudentAuthController::class, 'login'])->name('login');
    Route::post('/login', [StudentAuthController::class, 'authenticate'])->name('do.login');
    Route::get('/projects', [StudentController::class, 'projects'])->name('student.projects');
    Route::get('/all-projects', [StudentController::class, 'allProjects'])->name('students.all_projects');
    Route::get('/projects/upload/', [StudentController::class, 'uploadProjectForm'])->name('student.projects.upload.show');
    Route::post('/projects/upload/', [StudentController::class, 'uploadProject'])->name('student.projects.upload');
    Route::get('/projects/download/{id}', [StudentController::class, 'getDownload'])->name('student.projects.download');
    Route::post('/projects/comment', [StudentController::class, 'submitComment'])->name('student.project.comment');
    Route::get('/projects/{id}', [StudentController::class, 'getProject'])->name('student.project');

    Route::get('/projects/{id}/conversation', [StudentController::class, 'getProjectConversation'])->name('student.projects.conversation');
    Route::post('/projects/{id}/conversation', [StudentController::class, 'sendProjectConversation'])->name('student.projects.conversation.send');
});


Route::get('/login', [AuthController::class, 'login'])->name('staff_login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('do.staff_login');
Route::group(['prefix' => 'dashboard'], function () {

    Route::get('/', [StaffController::class, 'index'])->name('staff.dashboard');
    Route::get('/projects', [StaffController::class, 'projects'])->name('staff.projects');
    Route::post('/projects/comment', [StaffController::class, 'submitComment'])->name('staff.project.comment');
    Route::get('/projects/download/{id}', [StaffController::class, 'getDownload'])->name('staff.projects.download');
    Route::get('/students', [StaffController::class, 'students'])->name('staff.students');
    Route::post('/projects/grade', [StaffController::class, 'gradeProject'])->name('staff.project.grade');
    Route::get('/projects/{id}', [StaffController::class, 'getProject'])->name('staff.project');
    Route::get('/projects/{id}/conversation', [StaffController::class, 'getProjectConversation'])->name('staff.projects.conversation');
    Route::post('/projects/{id}/conversation', [StaffController::class, 'sendProjectConversation'])->name('staff.projects.conversation.send');
});

Route::get('/{any?}', function () {
    return view('app');
})->where('any', '.*');
