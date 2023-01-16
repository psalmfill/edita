@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <h4 class="card-title">{{ $project->title }} @if($project->score) ({{ $project->score}}) @endif </h4>
                           @auth()
                            <div>
                                <button type="button" class="btn p-0 ml-3 text-primary" data-toggle="modal" data-target="#exampleModal">
                                    Grade this project
                                  </button>

                                  <!-- Modal -->
                                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Grade Project</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                         <form action="{{ route('staff.project.grade') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="project_id" value="{{$project->id}}">
                                            <div class="form-group">
                                                <input type="number" min="0" max="100"
                                                    class="form-control form-control-lg {{ $errors->has('score') ? 'border-danger' : '' }}"
                                                    id="matricNumber" name='score' value="{{$project->score?? old('score') }}"
                                                    placeholder="Enter Score" required>
                                                @if ($errors->has('score'))
                                                    <div class="pt-1 text-danger">{{ $errors->first('score') }}</div>
                                                @endif
                                            </div>

                                            <div class="mt-3">
                                                <button class="btn btn-block btn-primary btn font-weight-medium auth-form-btn">Save</button>
                                            </div>
                                         </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                            </div>
                            @endauth
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
                    @if($conversation)
                    @php
                        $messages = $conversation->messages()->paginate() ;
                    @endphp
                    {{ $messages->links() }}

                    @foreach ($messages as $message)
                    <div class="d-flex {{ auth()->user() == $message->sender? 'flex-row-reverse':'' }}">

                        <div class="card p-3 m-2 col-5 text-white float-right {{ auth()->user() == $message->sender? 'bg-secondary':'bg-info' }}">
                            <div class="d-flex justify-content-between">

                                <h5 class="text-primary">{{ $message->sender->full_name }}</h5>
                                <p><small>{{ $message->created_at->diffForHumans() }}</small></p>
                            </div>

                            {{ $message->content }}
                        </div>
                    </div>
                    @endforeach

                    @endif

                    <hr>
                    <form class="forms-sample" action="{{ route('staff.projects.conversation.send', $project->id) }}" method="post">
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
