<div class="row">
    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-primary">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <svg class="nav-icon fa-xl me-2" style="fill: white; width: 3.5em; height: 3.5em;">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                    </svg>
                    <div class="text-end ms-auto">
                        <div class="fs-2 fw-bold">{{ $doctor_count }}</div>
                        <div>Doctors</div>
                    </div>
                </div>
                <div class="text-end">
                    <a href="{{ route('doctors.index') }}" class="text-white text-decoration-none">
                        <small class="text-medium-emphasis-inverse">See more</small>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.col-->

    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-warning">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <svg class="nav-icon" style="fill: white; width: 3.5em; height: 3.5em;" aria-hidden="true">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-disabled') }}"></use>
                    </svg>
                    <div class="text-end ms-auto">
                        <div class="fs-2 fw-bold">{{ $patient_count }}</div>
                        <div>Patients</div>
                    </div>
                </div>
                <div class="text-end">
                    <a href="{{ route('patients.index') }}" class="text-white text-decoration-none">
                        <small class="text-medium-emphasis-inverse">See more</small>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.col-->

    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-danger">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <svg class="nav-icon" style="fill: white; width: 3.5em; height: 3.5em;">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-calendar-check') }}"></use>
                    </svg>
                    <div class="text-end ms-auto">
                        <div class="fs-2 fw-bold">{{ $appointment_count }}</div>
                        <div>Appointments</div>
                    </div>
                </div>
                <div class="text-end">
                    <a href="{{ route('appointments.index') }}" class="text-white text-decoration-none">
                        <small class="text-medium-emphasis-inverse">See more</small>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.col-->

    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-info">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <svg class="nav-icon" style="fill: white; width: 3.5em; height: 3.5em;">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-money') }}"></use>
                    </svg>
                    <div class="text-end ms-auto">
                        <div class="fs-2 fw-bold">{{ $bill_count }}</div>
                        <div>Bills</div>
                    </div>
                </div>
                <div class="text-end">
                    <a href="{{ route('bills.index') }}" class="text-white text-decoration-none">
                        <small class="text-medium-emphasis-inverse">See more</small>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.col-->
</div>
<!-- /.row-->
