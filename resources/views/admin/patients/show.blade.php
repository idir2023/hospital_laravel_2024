@extends('layouts.app')
@section('title', 'Patient Details')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Patient Profile</h5>
            <a href="{{ route('patients.index') }}" class="btn btn-light btn-sm">Back to Patient List</a>
        </div>

        <div class="card-body">
            {{-- Patient Profile Header --}}
            <div class="row mb-4">
                <div class="col-md-4 text-center">
                    <img src="{{ asset('img/default-avatar.jpg') }}"
                         alt="Patient Profile Picture"
                         class="img-fluid rounded-circle"
                         style="width: 150px; height: 150px;">
                </div>
                <div class="col-md-8">
                    <h2 class="text-dark">{{ $patient->user->name }}</h2>
                    <p class="text-muted"><strong>Email:</strong> {{ $patient->user->email }}</p>
                    <p class="text-muted"><strong>Phone:</strong> {{ $patient->phone }}</p>
                    <p class="text-muted"><strong>Address:</strong> {{ $patient->address }}</p>
                </div>
            </div>

            <hr>

            {{-- Personal Information Section --}}
            <div class="mb-4">
                <h5 class="text-primary">Personal Information</h5>
                <ul class="list-unstyled">
                    <li><strong>Date of Birth:</strong> {{ $patient->date_of_birth ?? 'N/A' }}</li>
                    <li><strong>Gender:</strong> {{ $patient->gender ?? 'N/A' }}</li>
                    <li><strong>Insurance Provider:</strong> {{ $patient->insurance_provider ?? 'N/A' }}</li>
                </ul>
            </div>

            {{-- Medical History Section --}}
            <div class="mb-4">
                <h5 class="text-primary">Medical History</h5>
                <p>{{ $patient->medical_history ?? 'No medical history available.' }}</p>
            </div>

            {{-- Action Buttons Section --}}
            <div class="d-flex justify-content-center">
                <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this patient?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">Delete Patient</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
