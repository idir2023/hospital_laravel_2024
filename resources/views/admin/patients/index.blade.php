@extends('layouts.app')
@section('title', 'Patient List')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Patients</h5>
            {{-- <a href="{{ route('patients.create') }}" class="btn btn-light btn-sm">Add Patient</a> --}}
        </div>
        <div class="card-body">
            <h6 class="text-muted">Manage your patients here.</h6>

            {{-- Display Messages --}}
            @include('layouts.includes.messages')

            {{-- Patient Table --}}
            <div class="table-responsive mt-3">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Address</th>
                            <th scope="col">Medical History</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($patients as $patient)
                        <tr>
                            <td>{{ $patient->id }}</td>
                            <td>{{ $patient->user->name }}</td>
                            <td>{{ $patient->user->email }}</td>
                            <td>{{ $patient->phone }}</td>
                            <td>{{ $patient->address }}</td>
                            <td>{{ Str::limit($patient->medical_history, 50, '...') }}</td>
                            <td class="text-center">
                                <a href="{{ route('patients.show', $patient->id) }}" class="btn btn-outline-warning btn-sm mx-1" aria-label="Show Patient">
                                    <i class="fas fa-eye">show</i>
                                </a>
                                {{-- Edit Button triggers modal --}}
                                <button class="btn btn-outline-info btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#editPatientModal" data-id="{{ $patient->id }}" data-first_name="{{ $patient->first_name }}" data-last_name="{{ $patient->last_name }}" data-email="{{ $patient->email }}" data-phone="{{ $patient->phone }}" data-address="{{ $patient->address }}" data-medical_history="{{ $patient->medical_history }}">
                                    <i class="fas fa-edit">edit</i>
                                </button>
                                {{-- delete button --}}
                                <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this patient?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm mx-1" aria-label="Delete Patient">
                                        <i class="fas fa-trash">delete</i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-danger">
                                No records found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination Links --}}
            <div class="d-flex justify-content-center mt-3">
                {{ $patients->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

{{-- Edit Patient Modal --}}
<div class="modal fade" id="editPatientModal" tabindex="-1" aria-labelledby="editPatientModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editPatientForm" method="POST" action="">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="editPatientModalLabel">Edit Patient</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- First Name --}}
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-control" id="edit_first_name" required>
                    </div>

                    {{-- Last Name --}}
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="form-control" id="edit_last_name" required>
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="edit_email" required>
                    </div>

                    {{-- Phone --}}
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" id="edit_phone" required>
                    </div>

                    {{-- Address --}}
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" name="address" class="form-control" id="edit_address" required>
                    </div>

                    {{-- Medical History --}}
                    <div class="mb-3">
                        <label for="medical_history" class="form-label">Medical History</label>
                        <textarea name="medical_history" class="form-control" id="edit_medical_history"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Script to Handle Data for Edit Modal --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var editModal = document.getElementById('editPatientModal');
        editModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            var first_name = button.getAttribute('data-first_name');
            var last_name = button.getAttribute('data-last_name');
            var email = button.getAttribute('data-email');
            var phone = button.getAttribute('data-phone');
            var address = button.getAttribute('data-address');
            var medical_history = button.getAttribute('data-medical_history');

            // Set form action URL with patient ID
            var form = document.getElementById('editPatientForm');
            form.action = `/patients/${id}`;

            // Fill modal fields with data
            document.getElementById('edit_first_name').value = first_name;
            document.getElementById('edit_last_name').value = last_name;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_phone').value = phone;
            document.getElementById('edit_address').value = address;
            document.getElementById('edit_medical_history').value = medical_history;
        });
    });
</script>
@endsection
