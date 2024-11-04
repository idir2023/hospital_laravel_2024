@extends('layouts.guest')

@section('content')
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="row w-100">
            <!-- Left Panel - Login Form -->
            <div class="col-lg-6 d-flex flex-column justify-content-center">
                <div class="card p-4 shadow-sm">
                    <div class="card-body">
                        <h1 class="text-center mb-4">{{ __('Login to Hospital Portal') }}</h1>
                        <!-- Display errors, if any -->
                        @include('layouts.includes.errors')

                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <!-- Email Input -->
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Email') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-secondary text-white">
                                        <i class="bi bi-envelope-fill"></i>
                                    </span>
                                    <input id="email" class="form-control @error('email') is-invalid @enderror"
                                        type="email" name="email" placeholder="Enter your email" required>
                                </div>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Password Input -->
                            <div class="mb-4">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-secondary text-white">
                                        <i class="bi bi-lock-fill"></i>
                                    </span>
                                    <input id="password" class="form-control @error('password') is-invalid @enderror"
                                        type="password" name="password" placeholder="Enter your password" required>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Login Button and Forgot Password -->
                            <div class="d-flex justify-content-between align-items-center">
                                <button class="btn btn-primary" type="submit">{{ __('Login') }}</button>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}"
                                        class="text-decoration-none">{{ __('Forgot Password?') }}</a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Panel - Signup with Background Image -->
            <div class="col-lg-6 text-white d-flex flex-column justify-content-center align-items-center text-center py-5"
                style="background-image: url('{{ asset('img/hospital.jpg') }}'); background-size: cover; background-position: center; position: relative;">
                <!-- Optional Overlay for better text contrast -->
                <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.5);"></div>
                <div class="position-relative z-1">
                    <h2 class="mb-4">{{ __('New to Our Hospital?') }}</h2>
                    <p class="mb-4">Access comprehensive hospital services and manage your appointments with ease. Register today!</p>
                    <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">{{ __('Sign Up') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
