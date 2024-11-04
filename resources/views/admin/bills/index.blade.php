@extends('layouts.app')
@section('title', 'Bills Management')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4>Bills Management</h4>
                <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addBillModal">Add Bill</button>
            </div>
            <div class="card-body">
                @include('layouts.includes.messages')
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Patient</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Billing Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bills as $bill)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $bill->patient->user->name }} </td>
                                <td>{{ $bill->amount }}</td>
                                <td>
                                    @if ($bill->status === 'paid')
                                        <span class="badge bg-success">{{ $bill->status }}</span>
                                    @elseif($bill->status === 'unpaid')
                                        <span class="badge bg-danger">{{ $bill->status }}</span>
                                    @else
                                        <span class="badge bg-info">{{ $bill->status }}</span>
                                    @endif
                                </td>
                                <td>{{ $bill->billing_date }}</td>
                                <td>
                                    <button class="btn btn-outline-warning btn-sm mx-1" data-bs-toggle="modal"
                                        data-bs-target="#editBillModal"
                                        onclick="populateEditModal({{ json_encode($bill) }})">
                                        Edit
                                    </button>
                                    <form action="{{ route('bills.destroy', $bill->id) }}" method="POST"
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

    <!-- Add Bill Modal -->
    <div class="modal fade" id="addBillModal" tabindex="-1" aria-labelledby="addBillModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('bills.store') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addBillModalLabel">Add Bill</h5>
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
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" name="amount" id="amount" class="form-control" step="0.01"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="unpaid">Unpaid</option>
                                <option value="paid">Paid</option>
                                <option value="pending">Pending</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="billing_date" class="form-label">Billing Date</label>
                            <input type="date" name="billing_date" id="billing_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Bill</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Bill Modal -->
    <div class="modal fade" id="editBillModal" tabindex="-1" aria-labelledby="editBillModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" id="editBillForm">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editBillModalLabel">Edit Bill</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit_bill_id">
                        <div class="mb-3">
                            <label for="edit_patient_id" class="form-label">Patient</label>
                            <select name="patient_id" id="edit_patient_id" class="form-select" required>
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->id }}">{{ $patient->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_amount" class="form-label">Amount</label>
                            <input type="number" name="amount" id="edit_amount" class="form-control" step="0.01"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_status" class="form-label">Status</label>
                            <select name="status" id="edit_status" class="form-select" required>
                                <option value="unpaid">Unpaid</option>
                                <option value="paid">Paid</option>
                                <option value="pending">Pending</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_billing_date" class="form-label">Billing Date</label>
                            <input type="date" name="billing_date" id="edit_billing_date" class="form-control"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Bill</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function populateEditModal(bill) {
            // Set the form action to the correct URL
            document.getElementById('editBillForm').action = '/bills/' + bill.id; // Adjust the URL as needed

            // Populate the fields
            document.getElementById('edit_bill_id').value = bill.id;
            document.getElementById('edit_patient_id').value = bill.patient_id;
            document.getElementById('edit_amount').value = bill.amount;
            document.getElementById('edit_status').value = bill.status;
            document.getElementById('edit_billing_date').value = bill.billing_date;
        }
    </script>
@endsection
