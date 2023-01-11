@extends('layouts.auth')
@section('content')
    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
        <div class="brand-logo">
            <h3>Project Manager</h3>
        </div>
        <h4>New here?</h4>
        <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
        <form class="pt-3" action="{{ route('do.signup') }}" method="post">
            @csrf
            <div class="form-group">
                <input type="text"
                    class="form-control form-control-lg {{ $errors->has('first_name') ? 'border-danger' : '' }}"
                    id="firstName" name='first_name' value="{{ old('first_name') }}" placeholder="First Name" required>
                @if ($errors->has('first_name'))
                    <div class="pt-1 text-danger">{{ $errors->first('first_name') }}</div>
                @endif
            </div>

            <div class="form-group">
                <input type="text"
                    class="form-control form-control-lg {{ $errors->has('last_name') ? 'border-danger' : '' }}"
                    id="LastName" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name" required>
                @if ($errors->has('last_name'))
                    <div class="pt-1 text-danger">{{ $errors->first('last_name') }}</div>
                @endif
            </div>

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
            <div class="form-group">
                <input type="password" class="form-control form-control-lg" id="confirmPassword"
                    name="password_confirmation" placeholder="Confirm Password">
            </div>
            <div class="mt-3">
                <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN
                    UP</button>
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
                Already have an account? <a href="{{ route('login') }}" class="text-primary">Login</a>
            </div>
        </form>
    </div>
@endsection
