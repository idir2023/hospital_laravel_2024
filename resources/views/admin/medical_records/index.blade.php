@extends('layouts.app')
@section('title', 'Medical Record List')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4>Medical Records</h4>
                <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addMedicalRecordModal">Add Medical
                    Record</button>
            </div>
            <div class="card-body">
                @include('layouts.includes.messages')
                <div class="table-responsive mt-3">
                    <table class="table table-hover table-bordered">
                        <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Patient</th>
                            <th>Doctor</th>
                            <th>Diagnosis</th>
                            <th>Treatment</th>
                            <th>Record Date</th>
                            <th>Notes</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($medicalRecords as $record)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $record->patient->user->name }}</td>
                                <td>{{ $record->doctor->user->name }}</td>
                                <td>{{ $record->diagnosis }}</td>
                                <td>{{ $record->treatment }}</td>
                                <td>{{ $record->record_date }}</td>
                                <td>{{ $record->notes }}</td>

                                <td>
                                    <button class="btn btn-outline-warning btn-sm mx-1" data-bs-toggle="modal"
                                        data-bs-target="#editMedicalRecordModal" data-id="{{ $record->id }}"
                                        data-patient="{{ $record->patient_id }}" data-notes="{{ $record->notes }}"
                                        data-doctor="{{ $record->doctor_id }}" data-diagnosis="{{ $record->diagnosis }}"
                                        data-treatment="{{ $record->treatment }}"
                                        data-record-date="{{ $record->record_date }}">Edit</button>
                                    <form action="{{ route('medical_records.destroy', $record->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm mx-1">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Medical Record Modal -->
    <div class="modal fade" id="editMedicalRecordModal" tabindex="-1" aria-labelledby="editMedicalRecordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" id="editMedicalRecordForm">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editMedicalRecordModalLabel">Edit Medical Record</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_patient_id" class="form-label">Patient</label>
                            <select name="patient_id" id="edit_patient_id" class="form-select" required>
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->id }}">{{ $patient->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_doctor_id" class="form-label">Doctor</label>
                            <select name="doctor_id" id="edit_doctor_id" class="form-select" required>
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_diagnosis" class="form-label">Diagnosis</label>
                            <textarea name="diagnosis" id="edit_diagnosis" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit_treatment" class="form-label">Treatment</label>
                            <textarea name="treatment" id="edit_treatment" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit_notes" class="form-label">Notes</label>
                            <textarea name="notes" id="edit_notes" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit_record_date" class="form-label">Record Date</label>
                            <input type="date" name="record_date" id="edit_record_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Medical Record</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Medical Record Modal -->
    <div class="modal fade" id="addMedicalRecordModal" tabindex="-1" aria-labelledby="addMedicalRecordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('medical_records.store') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addMedicalRecordModalLabel">Add Medical Record</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="patient_id" class="form-label">Patient</label>
                            <select name="patient_id" id="patient_id" class="form-select" required>
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->id }}">{{ $patient->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="doctor_id" class="form-label">Doctor</label>
                            <select name="doctor_id" id="doctor_id" class="form-select" required>
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="diagnosis" class="form-label">Diagnosis</label>
                            <textarea name="diagnosis" id="diagnosis" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="treatment" class="form-label">Treatment</label>
                            <textarea name="treatment" id="treatment" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea name="notes" id="notes" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="record_date" class="form-label">Record Date</label>
                            <input type="date" name="record_date" id="record_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Medical Record</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        const editMedicalRecordModal = document.getElementById('editMedicalRecordModal');
        editMedicalRecordModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget; // Button that triggered the modal
            const patientId = button.getAttribute('data-patient');
            const doctorId = button.getAttribute('data-doctor');
            const diagnosis = button.getAttribute('data-diagnosis');
            const treatment = button.getAttribute('data-treatment');
            const notes = button.getAttribute('data-notes');
            const recordDate = button.getAttribute('data-record-date');
            const form = document.getElementById('editMedicalRecordForm');
            form.action = `/medical_records/${button.getAttribute('data-id')}`; // Set the form action for update

            // Set values in the modal
            document.getElementById('edit_patient_id').value = patientId;
            document.getElementById('edit_doctor_id').value = doctorId;
            document.getElementById('edit_diagnosis').value = diagnosis;
            document.getElementById('edit_treatment').value = treatment;
            document.getElementById('edit_notes').value = notes;
            document.getElementById('edit_record_date').value = recordDate;
        });
    </script>
@endsection
