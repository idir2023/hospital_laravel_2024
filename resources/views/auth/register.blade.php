@extends('layouts.guest')

@section('content')
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="row w-100">
            <!-- Left Panel - Login Form -->
            <div class="col-lg-6 d-flex flex-column justify-content-center">
                <div class="card p-4 shadow-sm" style="background-color: #ffffff; border-radius: 10px;">
                    <div class="card-body">
                        <h1 class="text-center mb-4 text-white">{{ __('Register') }}</h1>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- First Name Input -->
                            <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <svg class="icon">
                                        <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                                    </svg>
                                </span>
                                <input class="form-control @error('first_name') is-invalid @enderror" type="text"
                                    name="first_name" placeholder="{{ __('First name') }}" required
                                    autocomplete="first_name" autofocus>
                                @error('first_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Last Name Input -->
                            <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <svg class="icon">
                                        <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                                    </svg>
                                </span>
                                <input class="form-control @error('last_name') is-invalid @enderror" type="text"
                                    name="last_name" placeholder="{{ __('Last name') }}" required autocomplete="last_name">
                                @error('last_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Email Input -->
                            <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <svg class="icon">
                                        <use xlink:href="{{ asset('icons/coreui.svg#cil-envelope-open') }}"></use>
                                    </svg>
                                </span>
                                <input class="form-control @error('email') is-invalid @enderror" type="email"
                                    name="email" placeholder="{{ __('Email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Password Input -->
                            <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <svg class="icon">
                                        <use xlink:href="{{ asset('icons/coreui.svg#cil-lock-locked') }}"></use>
                                    </svg>
                                </span>
                                <input class="form-control @error('password') is-invalid @enderror" type="password"
                                    name="password" placeholder="{{ __('Password') }}" required
                                    autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Confirm Password Input -->
                            <div class="input-group mb-4">
                                <span class="input-group-text">
                                    <svg class="icon">
                                        <use xlink:href="{{ asset('icons/coreui.svg#cil-lock-locked') }}"></use>
                                    </svg>
                                </span>
                                <input class="form-control @error('password_confirmation') is-invalid @enderror"
                                    type="password" name="password_confirmation" placeholder="{{ __('Confirm Password') }}"
                                    required autocomplete="new-password">
                                @error('password_confirmation')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Register Button -->
                            <button class="btn btn-primary" type="submit">{{ __('Register') }}</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Panel - Image -->
            <div class="col-lg-6 text-white d-flex flex-column justify-content-center align-items-center text-center py-5"
                style="background-image: url('{{ asset('img/hospital.jpg') }}'); background-size: cover; background-position: center; position: relative;">
                <!-- Optional text overlay for the image can be added here if desired -->
            </div>
        </div>
    </div>
@endsection
