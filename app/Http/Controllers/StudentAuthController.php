<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class StudentAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except(['logout']);
    }

    public function login()
    {
        return view('auth.students.login');
    }

    public function signup()
    {
        return view('auth.students.signup');
    }

    public function doSignup(Request $request)
    {
        $vaidatedData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'password' => 'required|string|confirmed',
            'matric_number' => [
                'required',
                'string',
                'regex:(^(\d+)\/([A-Z]+)\/([A-Z]+)\/(\d+)?$)',
                'unique:students'
            ]
        ]);

        // signup the user
        $vaidatedData['password'] = bcrypt($vaidatedData['password']);
        $user = Student::create($vaidatedData);
        return redirect()->route('login')->with('message', 'Sign up successful');
    }

    public function authenticate(Request $request)
    {
        $vaidatedData = $request->validate([
            'password' => 'required',
            'matric_number' => [
                'required',
                'string',
                'regex:(^(\d+)\/([A-Z]+)\/([A-Z]+)\/(\d+)?$)',
            ]
        ]);
        if (auth()->guard('student')->attempt($vaidatedData)) {

            return redirect()->route('student.dashboard')->with('message', 'Sign in successful');
        } else {
            return back()->with('error', 'Invalid login credential was provided');
        }
    }
}
