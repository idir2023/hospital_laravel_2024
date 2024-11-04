@extends('layouts.app')
@section('title', 'Medications List')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4>Medications</h4>
                <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addMedicationModal">Add Medication</button>
            </div>
            <div class="card-body">
                @include('layouts.includes.messages')
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($medications as $medication)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $medication->name }}</td>
                                <td>{{ $medication->description }}</td>
                                <td>{{ $medication->price }}</td>
                                <td>
                                    <!-- Edit Button -->
                                    <button class="btn btn-outline-warning btn-sm mx-1" data-bs-toggle="modal"
                                        data-bs-target="#editMedicationModal" onclick="editMedication({{ json_encode($medication) }})">
                                        Edit
                                    </button>
                                    <!-- Delete Form with Confirmation -->
                                    <form action="{{ route('medications.destroy', $medication->id) }}" method="POST"
                                        style="display:inline;" onsubmit="return confirmDelete(event)">
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

    <!-- Add Medication Modal -->
    <div class="modal fade" id="addMedicationModal" tabindex="-1" aria-labelledby="addMedicationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('medications.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addMedicationModalLabel">Add Medication</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price" name="price" required step="0.01">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Medication Modal -->
    <div class="modal fade" id="editMedicationModal" tabindex="-1" aria-labelledby="editMedicationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editMedicationForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editMedicationModalLabel">Edit Medication</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="editDescription" name="description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editPrice" class="form-label">Price</label>
                            <input type="number" class="form-control" id="editPrice" name="price" required step="0.01">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript for Delete Confirmation -->
    <script>
        function confirmDelete(event) {
            const confirmed = confirm('Are you sure you want to delete this medication?');
            if (!confirmed) {
                event.preventDefault();
            }
            return confirmed;
        }

        // Edit Medication function (to handle edit modal)
        function editMedication(medication) {
            $('#editMedicationModal').modal('show');
            $('#editMedicationForm').attr('action', `/medications/${medication.id}`);
            $('#editName').val(medication.name);
            $('#editDescription').val(medication.description);
            $('#editPrice').val(medication.price);
        }
    </script>
@endsection
