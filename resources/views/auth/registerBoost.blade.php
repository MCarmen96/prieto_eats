@extends('layouts.layout')

@section('content')

    <form method="POST" action="{{ route('register') }}">

        <h1 class="h3 mb-3 fw-normal">Register new User</h1>
        @csrf
        <!-- Name -->
        <div class="form-floating">
            {{-- value="{{old('name')}}" esto sirve por si falla la validacion del form que le usuario no tenga que volver a poner el campo--}}

            <input type="text" class="form-control @error('name') is-invalid @enderror" id="floatingInput" value="{{old('name')}}" name="name" required>
            <label for="floatingInput">Name</label>
            @error('name')
                <div class="invalid-feedback mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <!-- Email Address -->
        <div class="form-floating">
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput" value="{{old('email')}}" name="email" placeholder="name@example.com" required>
            <label for="floatingInput">Email address</label>
            @error('email')
                <div class="invalid-feedback mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <!-- Password -->
        <div class="form-floating">
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="floatingPassword" required placeholder="Password">
            <label for="floatingPassword">{{ __('Password') }}</label>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <!-- Confirm Password -->
        <div class="form-floating">

            <input type="password" name="password_confirmation" required class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword" name="password_confirmation" >Password</label>

        </div>

        <div class="form-floating">
            <a href="{{ route('login') }}">Ya tienes cuenta???</a>
        </div>
        <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>

    </form>

@endsection
