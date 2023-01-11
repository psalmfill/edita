@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Projects</h4>
                    <p class="card-description">
                        Students project
                    </p>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        User
                                    </th>
                                    <th>
                                        First name
                                    </th>
                                    <th>
                                        Matric Number
                                    </th>
                                    <th>
                                        Projects
                                    </th>
                                    <th>
                                        Date Joined
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr>
                                        <td class="py-1">
                                            @if ($student->image)
                                                <img src="{{ asset($student->image) }}" alt="image">
                                            @else
                                                <img src="{{ asset('images/faces/face1.jpg') }}" alt="image">
                                            @endif
                                        </td>
                                        <td>
                                            {{ $student->full_name }}
                                        </td>
                                        <td>
                                            {{ $student->matric_number }}
                                        </td>
                                        <td>
                                            {{ $student->projects()->count() }}
                                        </td>
                                        <td>
                                            {{ $student->created_at->format('d F, Y') }}
                                        </td>
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
