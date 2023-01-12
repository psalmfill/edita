<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student');
    }

    public function index()
    {
        return view('students.home');
    }

    public function projects()
    {
        $projects = auth('student')->user()->projects()->paginate();
        return view('students.projects', compact('projects'));
    }

    public function getProject($id)
    {
        $project = Project::findOrFail($id);
        $comments = $project->comments()->orderBy('created_at', 'desc')->paginate();
        return view('students.project', compact('project', 'comments'));
    }

    public function allProjects()
    {
        $projects = Project::paginate();
        return view('students.projects', compact('projects'));
    }

    public function uploadProjectForm()
    {
        return view('students.upload-projects');
    }

    public function uploadProject(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'document' => 'required',
        ]);
        // everything passed
        // do file upload
        //Perform passport upload
        if ($request->has('document')) {

            $path = $request->file('document')->store('documents');
        }

        $validatedData['upload'] = $path;
        $validatedData['student_id'] = auth('student')->id();

        if (Project::create($validatedData)) {
            return redirect()->route('student.projects')->with('message', 'Project submitted successfully');
        } else {
            // remove the uploaded files
            if (Storage::exists($path)) {
                Storage::delete($path);
            }
            return back()->with('error', 'Project submission failed');
        }
    }

    public function getDownload($id)
    {
        //PDF file is stored under project/public/download/info.pdf
        $project = Project::findOrFail($id);
        $file = storage_path() . "/app/" . $project->upload;
        return Response::download($file);
    }



    public function submitComment(Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required',
            'project_id' => 'required| exists:projects,id',
        ]);

        $validatedData['commentable_type'] = \App\Models\Student::class;
        $validatedData['commentable_id'] = auth('student')->id();

        if (Comment::create($validatedData)) {
            return redirect()->route('student.project', $validatedData['project_id'])->with('message', 'comment submited');
        }

        return redirect()->back()->with('error', 'comment was not submited');
    }
}
