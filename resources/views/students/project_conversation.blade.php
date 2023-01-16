@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <h4 class="card-title">{{ $project->title }} @if($project->score) ({{ $project->score}}) @endif </h4>
                           </div>
                        <a class="d-block btn btn-danger btn-icon-text " style="height:50px"
                            href="{{ route('student.projects.download', $project->id) }}">
                            <i class="ti-download btn-icon-prepend"></i>
                            Download Project
                        </a>
                    </div>

                    <div class="card-description">
                        {{ $project->description }}
                    </div>

                    @php
                        $messages = $conversation->messages()->paginate() ;
                        // dd($messages);
                    @endphp
                    {{ $messages->links() }}

                    @foreach ($messages as $message)
                    <div class="d-flex {{ auth('student')->user() == $message->sender? 'flex-row-reverse':'' }}">

                        <div class="card p-3 m-2 col-5 text-white float-right {{ auth('student')->user() == $message->sender? 'bg-secondary':'bg-info' }}">
                            <div class="d-flex justify-content-between">

                                <h5 class="text-primary">{{ $message->sender->full_name }}</h5>
                                <p><small>{{ $message->created_at->diffForHumans() }}</small></p>
                            </div>

                            {{ $message->content }}
                        </div>
                    </div>
                    @endforeach
                    <hr>
                    <form class="forms-sample" action="{{ route('student.projects.conversation.send', $project->id) }}" method="post">
                        @csrf
                        <input type="hidden" name="project_id" value="{{ $project->id }}" />
                        <div class="form-group">
                            <textarea class="form-control" id="exampleTextarea1" name="content" placeholder="Message" rows="4"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
                    <hr>
                </div>
            </div>
        </div>
    </div>
@endsection
