@extends('layouts.layout')

@section('content')

    <form method="POST" action="{{ route('login') }}" >

        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
        @csrf

        <div class="form-floating">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Email address</label>
            @error('email')
                <div class="invalid-feedback mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-floating">
            <div class="form-floating">

            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
            @error('password')
                <div class="invalid-feedback mt-2">
                    {{ $message }}
                </div>
            @enderror

            {{--hacer vista de contrseña olvidada--}}
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Has olvidado tu contraseña??</a>
                @endif
                </div>
        </div>
        <div class="form-check text-start my-3">
            <input class="form-check-input" type="checkbox" value="remember-me" id="checkDefault">
            <label class="form-check-label" for="checkDefault">
                Remember me
            </label>
        </div>
        <button class="btn btn-primary w-100 py-2" type="submit">Login</button>

    </form>

@endsection
