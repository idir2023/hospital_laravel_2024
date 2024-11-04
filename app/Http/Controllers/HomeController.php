<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Bill;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $doctor_count = Doctor::count();
        $patient_count = Patient::count();
        $appointment_count = Appointment::count(); // Fixed variable name
        $bill_count = Bill::count(); // Changed variable name for consistency

        return view('home', compact('doctor_count', 'patient_count', 'appointment_count', 'bill_count'));
    }

    public function about()
    {
        return view('about');
    }
}
