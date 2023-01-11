@extends('layouts.auth')
@section('content')
    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
        <div class="brand-logo">
            <h3>Project Manager</h3>
        </div>
        @if (\Session::has('message'))
            <div class="alert alert-success">{{ \Session::get('message') }}</div>
        @endif
        <h4>Hello! let's get started</h4>
        <h6 class="font-weight-light">Sign in to continue.</h6>
        <form class="pt-3" method="post" action={{ route('do.login') }}>
            @csrf
            <div class="form-group">
                <input type="text"
                    class="form-control form-control-lg {{ $errors->has('matric_number') ? 'border-danger' : '' }}"
                    id="matricNumber" name='matric_number' value="{{ old('matric_number') }}"
                    placeholder="Matric Number - 16/EG/CE/111" required>
                @if ($errors->has('matric_number'))
                    <div class="pt-1 text-danger">{{ $errors->first('matric_number') }}</div>
                @endif
            </div>
            <div class="form-group">
                <input type="password"
                    class="form-control form-control-lg {{ $errors->has('password') ? 'border-danger' : '' }}"
                    id="password" name='password' placeholder="Password">
                @if ($errors->has('password'))
                    <div class="pt-1 text-danger">{{ $errors->first('password') }}</div>
                @endif
            </div>
            <div class="mt-3">
                <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN
                    IN</button>
            </div>
            {{-- <div class="my-2 d-flex justify-content-between align-items-center">
                <div class="form-check">
                    <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input">
                        Keep me signed in
                    </label>
                </div>
                <a href="#" class="auth-link text-black">Forgot password?</a>
            </div> --}}
            <div class="text-center mt-4 font-weight-light">
                Don't have an account? <a href="{{ route('signup') }}" class="text-primary">Create</a>
            </div>
        </form>
    </div>
@endsection
