@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title">{{ $project->title }}</h4>
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
                    <hr>
                    <form class="forms-sample" action="{{ route('staff.project.comment') }}" method="post">
                        @csrf
                        <input type="hidden" name="project_id" value="{{ $project->id }}" />
                        <div class="form-group">
                            <label for="exampleTextarea1">Leave a comment</label>
                            <textarea class="form-control" id="exampleTextarea1" name="content" rows="4"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>

                    @foreach ($comments as $comment)
                        <hr>
                        <div class="card p-3">
                            <div class="d-flex justify-content-between">

                                <h5 class="text-primary">{{ $comment->commentable->full_name }}</h5>
                                <p><small>{{ $comment->created_at->diffForHumans() }}</small></p>
                            </div>

                            {{ $comment->content }}
                        </div>
                    @endforeach
                    <hr>
                    {{ $comments->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
