<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctor::all();
        return view('client.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function about()
    {
        $doctors = Doctor::all();
        return view('client.about', compact('doctors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'gender' => 'required|in:male,female,other',
            'date' => 'required|date',
            'phone' => 'required|string|max:15',
            'doctor' => 'required|exists:doctors,id',
            'message' => 'nullable|string',
        ]);

        // Create a new user
        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'role' => 'patient',
        ]);

        // Create a new patient record
        $patient = Patient::create([
            'user_id' => $user->id,
            'dob' => $request->date,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'medical_history' => $request->message,
            'address' => 'Default address', // Set default address if needed
        ]);

        // Create a new appointment record
        Appointment::create([
            'patient_id' => $patient->id,
            'doctor_id' => $request->doctor,
            'appointment_date' => now(), // Customize this if needed
            'status' => 'scheduled',
        ]);

        return redirect()->route('client.home')->with('success', 'Appointment scheduled successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
