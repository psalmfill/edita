<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('login');
    }

    public function login()
    {
        return view('auth.staff.login');
    }

    public function authenticate(Request $request)
    {
        $vaidatedData = $request->validate([
            'password' => 'required',
            'email' => [
                'required',
                'string',
                'email',
            ]
        ]);
        if (auth()->guard()->attempt($vaidatedData)) {
            return redirect()->route('staff.dashboard')->with('message', 'Sign in successful');
        } else {
            return back()->with('error', 'Invalid login credential was provided');
        }
    }
}
