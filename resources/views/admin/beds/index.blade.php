@extends('layouts.app')
@section('title', 'Beds List')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4>Beds</h4>
                <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addBedModal">Add Bed</button>
            </div>
            <div class="card-body">
                @include('layouts.includes.messages')
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Bed Number</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($beds as $bed)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $bed->bed_number }}</td>
                                <td>
                                    @if ($bed->status === 'available')
                                        <span class="badge bg-success">Available</span>
                                    @elseif($bed->status === 'occupied')
                                        <span class="badge bg-danger">Occupied</span>
                                    @elseif($bed->status === 'maintenance')
                                        <span class="badge bg-warning">Maintenance</span>
                                    @else
                                        <span class="badge bg-secondary">Unknown</span>
                                    @endif
                                </td>
                                <td>
                                    <!-- Edit Button -->
                                    <button class="btn btn-outline-warning btn-sm mx-1" data-bs-toggle="modal"
                                        data-bs-target="#editBedModal" onclick="editBed({{ json_encode($bed) }})">
                                        Edit
                                    </button>
                                    <!-- Delete Form with Confirmation -->
                                    <form action="{{ route('beds.destroy', $bed->id) }}" method="POST"
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

    <!-- Add Bed Modal -->
    <div class="modal fade" id="addBedModal" tabindex="-1" aria-labelledby="addBedModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('beds.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addBedModalLabel">Add Bed</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="bed_number" class="form-label">Bed Number</label>
                            <input type="number" class="form-control" id="bed_number" name="bed_number" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="available">Available</option>
                                <option value="occupied">Occupied</option>
                                <option value="maintenance">Maintenance</option>
                            </select>
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

    <!-- Edit Bed Modal -->
    <div class="modal fade" id="editBedModal" tabindex="-1" aria-labelledby="editBedModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editBedForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editBedModalLabel">Edit Bed</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editBedNumber" class="form-label">Bed Number</label>
                            <input type="number" class="form-control" id="editBedNumber" name="bed_number" required>
                        </div>
                        <div class="mb-3">
                            <label for="editStatus" class="form-label">Status</label>
                            <select class="form-control" id="editStatus" name="status" required>
                                <option value="available">Available</option>
                                <option value="occupied">Occupied</option>
                                <option value="maintenance">Maintenance</option>
                            </select>
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
            const confirmed = confirm('Are you sure you want to delete this bed?');
            if (!confirmed) {
                event.preventDefault();
            }
            return confirmed;
        }

        // Edit Bed function (to handle edit modal)
        function editBed(bed) {
            $('#editBedModal').modal('show');
            $('#editBedForm').attr('action', `/beds/${bed.id}`);
            $('#editBedNumber').val(bed.bed_number);
            $('#editStatus').val(bed.status);
        }
    </script>
@endsection
