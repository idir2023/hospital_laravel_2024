@extends('layouts.app')

@section('title', 'Doctor List')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Doctors</h5>
                <!-- Trigger Add Doctor Modal -->
                @if(Auth::user() && Auth::user()->role === 'admin')
                <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addDoctorModal">
                    Add Doctor
                </button>
                @endif
            </div>
            <div class="card-body">
                <h6 class="text-muted">Manage your doctors here.</h6>

                @include('layouts.includes.messages')

                <div class="table-responsive mt-3">
                    <table class="table table-hover table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Specialty</th>
                                <th>Phone</th>
                                <th>Address</th>
                                @if(Auth::user() && Auth::user()->role === 'admin')
                                <th class="text-center">Actions</th>
                                @endif
                        </thead>
                        <tbody>
                            @forelse($doctors as $doctor)
                                <tr>
                                    <td class="text-center">
                                        @if ($doctor->avatar)
                                            <img src="{{ Storage::url($doctor->avatar) }}" class="rounded-circle"
                                                height="50" width="50" alt="Doctor">
                                        @else
                                            <p>No image available</p>
                                        @endif
                                    </td>
                                    <td>{{ $doctor->user->name }}</td>
                                    <td>{{ $doctor->user->email }}</td>
                                    <td>{{ $doctor->specialty }}</td>
                                    <td>{{ $doctor->phone }}</td>
                                    <td>{{ $doctor->address }}</td>
                                    @if(Auth::user() && Auth::user()->role === 'admin')
                                    <td class="text-center">
                                        <!-- Trigger Edit Doctor Modal -->
                                        <button type="button" class="btn btn-outline-info btn-sm mx-1"
                                            data-bs-toggle="modal" data-bs-target="#editDoctorModal{{ $doctor->id }}">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST"
                                            class="d-inline-block"
                                            onsubmit="return confirm('Are you sure you want to delete this doctor?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm mx-1">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                    @endif
                                </tr>

                                <!-- Edit Doctor Modal -->
                                <div class="modal fade" id="editDoctorModal{{ $doctor->id }}" tabindex="-1"
                                    aria-labelledby="editDoctorModalLabel{{ $doctor->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form method="POST" action="{{ route('doctors.update', $doctor->id) }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editDoctorModalLabel{{ $doctor->id }}">
                                                        Edit Doctor</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="mb-3 col-md-6">
                                                            <label for="first_name" class="form-label">First Name</label>
                                                            <input type="text" value="{{ $doctor->user->first_name }}"
                                                                name="first_name" class="form-control"
                                                                placeholder="Enter doctor's first name" required>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label for="last_name" class="form-label">Last Name</label>
                                                            <input type="text" value="{{ $doctor->user->last_name }}"
                                                                name="last_name" class="form-control"
                                                                placeholder="Enter doctor's last name" required>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="email" value="{{ $doctor->user->email }}"
                                                            name="email" class="form-control"
                                                            placeholder="Enter email address" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="specialty" class="form-label">Specialty</label>
                                                        <input type="text" value="{{ $doctor->specialty }}"
                                                            name="specialty" class="form-control"
                                                            placeholder="Enter specialty" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="phone" class="form-label">Phone</label>
                                                        <input type="text" name="phone" value="{{ $doctor->phone }}"
                                                            class="form-control" placeholder="Enter phone number" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="address" class="form-label">Address</label>
                                                        <input type="text" name="address" class="form-control"
                                                            placeholder="Enter address" value="{{ $doctor->address }}"
                                                            required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <img src="{{ Storage::url($doctor->avatar) }}"
                                                             height="70" width="70" class="rounded-circle"
                                                            alt="Doctor">
                                                        <input type="file" value="{{ $doctor->avatar }}"
                                                            name="avatar" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Update Doctor</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-danger">No records found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    {{ $doctors->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Add Doctor Modal -->
    <div class="modal fade" id="addDoctorModal" tabindex="-1" aria-labelledby="addDoctorModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('doctors.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addDoctorModalLabel">Add Doctor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control"
                                    placeholder="Enter doctor's first name" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control"
                                    placeholder="Enter doctor's last name" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter email address"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="specialty" class="form-label">Specialty</label>
                            <input type="text" name="specialty" class="form-control" placeholder="Enter specialty"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" placeholder="Enter phone number"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" placeholder="Enter address"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="avatar" class="form-label">Profile Picture</label>
                            <input type="file" name="avatar" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Doctor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
