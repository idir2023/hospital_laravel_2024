@extends('layouts.app')
@section('title', 'Prescription List')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4>Prescriptions</h4>
                {{-- <button type="button" id="printButton" class="btn btn-light">Print</button> --}}
                <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addPrescriptionModal">Add
                    Prescription</button>
            </div>

            <div class="card-body">
                {{-- Display Messages --}}
                @include('layouts.includes.messages')
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Patient</th>
                            <th>Doctor</th>
                            <th>Medication Instructions</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($prescriptions as $prescription)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $prescription->patient->user->name }}</td>
                                <td>{{ $prescription->doctor->user->name }}</td>
                                <td>{{ $prescription->medication_instructions }}</td>
                                <td>
                                    {{-- delete Button --}}
                                    <form action="{{ route('prescriptions.destroy', $prescription->id) }}" method="POST" style="display:inline; color: red" onsubmit="return confirmDelete();">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm mx-1">Delete</button>
                                    </form>

                                    <script>
                                        function confirmDelete() {
                                            return confirm('Are you sure you want to delete this prescription? This action cannot be undone.');
                                        }
                                    </script>

                                    <button class="btn btn-outline-warning btn-sm mx-1" data-bs-toggle="modal"
                                        data-bs-target="#editPrescriptionModal{{ $prescription->id }}"
                                        data-prescription='@json($prescription)'>Edit</button>

                                    <!-- Edit Prescription Modal -->
                                    <div class="modal fade" id="editPrescriptionModal{{ $prescription->id }}" tabindex="-1"
                                        aria-labelledby="editPrescriptionModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form method="POST" id="editPrescriptionForm"
                                                action="{{ route('prescriptions.update', $prescription->id) }}">

                                                @csrf
                                                @method('PUT')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editPrescriptionModalLabel">Edit
                                                            Prescription</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="edit_patient_id{{ $prescription->id }}"
                                                                class="form-label">Patient</label>
                                                            <select name="patient_id"
                                                                id="edit_patient_id{{ $prescription->id }}"
                                                                class="form-select" required>
                                                                @foreach ($patients as $patient)
                                                                    <option value="{{ $patient->id }}"
                                                                        {{ $prescription->patient_id == $patient->id ? 'selected' : '' }}>
                                                                        {{ $patient->user->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="edit_doctor_id{{ $prescription->id }}"
                                                                class="form-label">Doctor</label>
                                                            <select name="doctor_id"
                                                                id="edit_doctor_id{{ $prescription->id }}"
                                                                class="form-select" required>
                                                                @foreach ($doctors as $doctor)
                                                                    <option value="{{ $doctor->id }}"
                                                                        {{ $prescription->doctor_id == $doctor->id ? 'selected' : '' }}>
                                                                        {{ $doctor->user->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label
                                                                for="edit_medication_instructions{{ $prescription->id }}"
                                                                class="form-label">Medication Instructions</label>
                                                            <textarea name="medication_instructions" id="edit_medication_instructions{{ $prescription->id }}" class="form-control"
                                                                required>{{ $prescription->medication_instructions }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update
                                                            Prescription</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Prescription Modal -->
    <div class="modal fade" id="addPrescriptionModal" tabindex="-1" aria-labelledby="addPrescriptionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('prescriptions.store') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPrescriptionModalLabel">Add Prescription</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="patient_id" class="form-label">Patient</label>
                            <select name="patient_id" id="patient_id" class="form-select" required>
                                <option value="">Select patient</option>
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->id }}">{{ $patient->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="doctor_id" class="form-label">Doctor</label>
                            <select name="doctor_id" id="doctor_id" class="form-select" required>
                                <option value="">Select doctor</option>
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="medication_instructions" class="form-label">Medication Instructions</label>
                            <textarea name="medication_instructions" id="medication_instructions" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Prescription</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@section('scripts')
    {{-- <script>
        $(document).ready(function() {
            $('#printButton').on('click', function() {
                alert('Print button clicked');
            });
        });
    </script> --}}
@endsection

@endsection
