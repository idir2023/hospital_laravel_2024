<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $doctors = Doctor::latest()->paginate(10);
        return view('admin.doctors.index', compact('doctors'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view('admin.doctors.create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'specialty' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'address' => 'required|string|max:255',
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional: Add size limit
    ]);

    // Handle the profile picture upload
    $avatarPath = null;

    if ($request->hasFile('avatar')) {
        $avatarPath = $request->file('avatar')->store('avatars', 'public');
    }

    // Create a new user associated with the doctor
    $user = User::create([
        'name' => $request->first_name . ' ' . $request->last_name,
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'email' => $request->email,
        'role' => 'doctor',
    ]);

    // Create a new Doctor instance and associate it with the user
    $doctor = new Doctor;

    $doctor->user_id = $user->id;
    $doctor->specialty = $request->specialty;
    $doctor->phone = $request->phone;
    $doctor->address = $request->address;
    $doctor->avatar = $avatarPath;

    $doctor->save();

    // Redirect with a success message
    return redirect()->route('doctors.index')->with('success', 'Doctor created successfully.');
}


    // Show the form for editing the specified resource.
    public function edit(string $id)
    {
        $doctor = Doctor::findOrFail($id); // Use findOrFail to handle not found cases
        return view('admin.doctor.edit', compact('doctor'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        // Find the doctor by ID
        $doctor = Doctor::findOrFail($id);
        $user = $doctor->user; // Find the associated user

        // Validate the request data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'specialty' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Update the associated user details
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'role'=>'doctor'
        ]);

        // Handle the profile picture upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($doctor->avatar) {
                Storage::disk('public')->delete($doctor->avatar);
            }

            // Store the new avatar
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $doctor->avatar = $avatarPath; // Update the avatar path
        }

        // Update doctor's attributes
        $doctor->update([
            'specialty' => $request->specialty,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        // Redirect back to the doctor index with a success message
        return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        // Find the doctor by ID
        $doctor = Doctor::findOrFail($id); // Use findOrFail for better error handling
        $user = $doctor->user; // Find the associated user

        // Check if the user exists before attempting to delete
        if ($user) {
            $user->delete();
        }

        // Delete the doctor's avatar if it exists
        if ($doctor->avatar) {
            Storage::disk('public')->delete($doctor->avatar);
        }

        // Delete the doctor
        $doctor->delete();

        return redirect()->route('doctors.index')->with('success', 'Doctor deleted successfully.');
    }
}
