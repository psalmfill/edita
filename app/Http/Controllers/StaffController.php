<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Student;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('staff.home');
    }

    public function projects()
    {
        $projects = Project::paginate();
        return view('staff.projects', compact('projects'));
    }

    public function students()
    {
        $students = Student::paginate();
        return view('staff.students', compact('students'));
    }
}
