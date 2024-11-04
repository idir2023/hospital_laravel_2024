@extends('layouts.app')
@section('title', 'Appointment List')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Appointments</h5>
        </div>
        <div class="card-body">
            <h6 class="text-muted">Manage your appointments here.</h6>

            {{-- Display Messages --}}
            @include('layouts.includes.messages')

            {{-- Appointment Table --}}
            <div class="table-responsive mt-3">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name Patient</th>
                            <th scope="col">Status</th>
                            <th scope="col">Date</th>
                            <th scope="col">Medical History</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->id }}</td>
                            <td>{{ $appointment->patient->user->name }} </td>
                            <td>
                                <span class="badge
                                    @if($appointment->status === 'scheduled') bg-info
                                    @elseif($appointment->status === 'completed') bg-success
                                    @elseif($appointment->status === 'canceled') bg-danger
                                    @endif
                                    text-white">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') }}</td>
                            <td>{{ Str::limit($appointment->patient->medical_history, 50, '...') }}</td>
                            <td class="text-center">

                                {{-- Change Status Button --}}
                                <button class="btn btn-outline-secondary btn-sm mx-1" onclick="changeStatus({{ $appointment->id }})">
                                    <i class="fas fa-sync-alt"> status</i>
                                </button>

                                {{-- Delete Button --}}
                                <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this appointment?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm mx-1" aria-label="Delete Appointment">
                                        <i class="fas fa-trash"> delete</i>
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
                {{ $appointments->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

<script>
    function changeStatus(appointmentId) {
        // AJAX call to change status
        fetch(`/appointments/${appointmentId}/change-status`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload(); // Reload the page to update status
            } else {
                alert('Failed to change status');
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>
@endsection
