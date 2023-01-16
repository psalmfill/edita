<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Conversation;
use App\Models\Project;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

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

        $validatedData['commentable_type'] = \App\Models\User::class;
        $validatedData['commentable_id'] = auth()->id();

        if (Comment::create($validatedData)) {
            return redirect()->route('staff.project', $validatedData['project_id'])->with('message', 'comment submited');
        }

        return redirect()->back()->with('error', 'comment was not submited');
    }
    public function getProject($id)
    {
        $project = Project::findOrFail($id);
        $comments = $project->comments()->orderBy('created_at', 'desc')->paginate();
        return view('staff.project', compact('project', 'comments'));
    }

    public function gradeProject(Request $request){
        $project  = Project::findOrFail($request->project_id);
        $project->update([
            'score' => $request->score,
            'grade_by' => auth()->id()
        ]);
        return redirect()->back()->with('message', 'Project graded successfully');
    }

    public function getProjectConversation($id){
        $project = Project::findOrFail($id);

        $conversation = Conversation::whereHas('projects', function($q) use ($project) {
            $q->where([
                'project_id' => $project->id,
            ])
            ->where([
                'conversation_project.user_id' => auth()->id(),
                'conversation_project.student_id' => $project->student_id
            ]);
        })->first();
        return view('staff.project_conversation', compact('project', 'conversation'));
    }

    public function sendProjectConversation(Request $request,$id){
        $project = Project::findOrFail($id);

        $conversation = Conversation::whereHas('projects', function($q) use ($project) {
            $q->where([
                'project_id' => $project->id,
            ])
            ->where([
                'conversation_project.user_id' => auth()->id(),
                'conversation_project.student_id' => $project->student_id
            ]);
        })->first();
        if (!$conversation){
            $conversation = Conversation::create();
            $conversation->projects()->attach([$project->id => [
                'user_id' => auth()->id(),
                'student_id' => $project->student_id
            ]]);

        }
        $conversation->messages()->create([
            'sender_type' => \App\Models\User::class,
            'sender_id' => auth()->id(),
            'content' => $request->content,
        ]);
        return redirect()->back()->with('message', "Message sent");
    }
}
