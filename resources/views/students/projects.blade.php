@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title">My Projects</h4>
                            <p class="card-description">
                                Students project
                            </p>
                        </div>
                        <a class="d-block btn btn-primary btn-icon-text " style="height:50px"
                            href="{{ route('student.projects.upload.show') }}">
                            <i class="ti-upload btn-icon-prepend"></i>
                            Submit Project
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Student Name</th>
                                    <th>Matric Number</th>
                                    <th>
                                        Title
                                    </th>
                                    <th>Description</th>
                                    <th>
                                        Submited Date
                                    </th>

                                    <th>
                                        Action
                                    </th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                    <tr>
                                        <td>{{ $project->student->full_name }}</td>
                                        <td>{{ $project->student->matric_number }}</td>
                                        <td class="py-1">
                                            <a href="{{ route('student.project', $project->id) }}">
                                                {{ $project->title }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ $project->description }}</td>

                                        <td>
                                            {{ $project->created_at->format('d F,Y') }}
                                        </td>
                                        <td><a class="btn btn-outline-danger"
                                                href="{{ route('student.projects.download', $project->id) }}">
                                                <i class="ti-download"></i>
                                            </a></td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
