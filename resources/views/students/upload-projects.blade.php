@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title">Upload Project</h4>
                            <p class="card-description">
                                Students project
                            </p>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <form class="forms-sample" enctype="multipart/form-data" method="post"
                                action="{{ route('student.projects.upload') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="projectTitle">Project Title</label>
                                    <input type="text" class="form-control" id="projectTitle" name="title"
                                        {{ $errors->has('title') ? 'border-danger' : '' }} placeholder="Project Title"
                                        required>
                                    @if ($errors->has('title'))
                                        <div class="pt-1 text-danger">{{ $errors->first('title') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="projectDescription">Project Description</label>
                                    <textarea class="form-control" id="projectDescription" name="description" placeholder="Project Description"
                                        {{ $errors->has('description') ? 'border-danger' : '' }} rows="10" required></textarea>
                                    @if ($errors->has('description'))
                                        <div class="pt-1 text-danger">{{ $errors->first('description') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="document">Document</label>
                                    <input type="file" class="form-control" id="document" name="document"
                                        {{ $errors->has('document') ? 'border-danger' : '' }} required>
                                    @if ($errors->has('document'))
                                        <div class="pt-1 text-danger">{{ $errors->first('document') }}</div>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <button class="btn btn-light">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
