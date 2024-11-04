<ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-speedometer') }}"></use>
            </svg>
            {{ __('Dashboard') }}
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->is('doctors*') ? 'active' : '' }}" href="{{ route('doctors.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
            </svg>
            {{ __('Doctors') }}
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->is('patients*') ? 'active' : '' }}" href="{{ route('patients.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-disabled') }}"></use>
            </svg>
            {{ __('Patients') }}
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->is('appointments*') ? 'active' : '' }}" href="{{ route('appointments.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-calendar') }}"></use>
            </svg>
            {{ __('Appointments') }}
        </a>
    </li>
    @if(Auth::user() && Auth::user()->role === 'admin')
    <li class="nav-item">
        <a class="nav-link {{ request()->is('prescriptions*') ? 'active' : '' }}" href="{{ route('prescriptions.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-file') }}"></use>
            </svg>
            {{ __('Prescriptions') }}
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->is('medical_records*') ? 'active' : '' }}" href="{{ route('medical_records.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-notes') }}"></use>
            </svg>
            {{ __('Medical Records') }}
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->is('departments*') ? 'active' : '' }}" href="{{ route('departments.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-building') }}"></use> <!-- Changed icon to cil-building -->
            </svg>
            {{ __('Departments') }}
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->is('bills*') ? 'active' : '' }}" href="{{ route('bills.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-money') }}"></use>
            </svg>
            {{ __('Bills') }}
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->is('medications*') ? 'active' : '' }}" href="{{ route('medications.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-medical-cross') }}"></use>
            </svg>
            {{ __('Medications') }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('beds*') ? 'active' : '' }}" href="{{ route('beds.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-bed') }}"></use> <!-- Changed icon to cil-bed -->
            </svg>
            {{ __('Beds') }}
        </a>
    </li>
    @endif

    <li class="nav-group" aria-expanded="false">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-layers') }}"></use>
            </svg>
            {{ __('Two-level menu') }}
        </a>
        <ul class="nav-group-items">
            <li class="nav-item">
                <a class="nav-link" href="#" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-sitemap') }}"></use>
                    </svg>
                    {{ __('Child menu') }}
                </a>
            </li>
        </ul>
    </li>
</ul>
