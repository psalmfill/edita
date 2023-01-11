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



Route::group(['prefix' => 'student'], function () {

    Route::get('/sign-up', [StudentAuthController::class, 'signup'])->name('signup');
    Route::post('/sign-up', [StudentAuthController::class, 'doSignup'])->name('do.signup');
    Route::get('/login', [StudentAuthController::class, 'login'])->name('login');
    Route::post('/login', [StudentAuthController::class, 'authenticate'])->name('do.login');
    Route::get('', [StudentController::class, 'index'])->name('student.dashboard');
});


Route::get('/login', [AuthController::class, 'login'])->name('staff_login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('do.staff_login');
Route::group(['prefix' => 'dashboard'], function () {

    Route::get('/', [StaffController::class, 'index'])->name('staff.dashboard');
    Route::get('/projects', [StaffController::class, 'projects'])->name('staff.projects');
    Route::get('/students', [StaffController::class, 'students'])->name('staff.students');
});

Route::get('/{any?}', function () {
    return view('app');
})->where('any', '.*');
