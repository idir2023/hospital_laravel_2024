<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Medication;
use Illuminate\Http\Request;

class MedicationController extends Controller
{
    // Display a list of medications
    public function index()
    {
        $medications = Medication::all();
        return view('admin.medications.index', compact('medications'));
    }

    // Store a new medication
    public function store(Request $request)
    {
        // Validate input data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        // Create the medication
        Medication::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return back()->with('success', 'Medication added successfully.');
    }

    // Update an existing medication
    public function update(Request $request, Medication $medication)
    {
        // Validate input data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        // Update the medication
        $medication->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return back()->with('success', 'Medication updated successfully.');
    }

    // Delete a medication
    public function destroy(Medication $medication)
    {
        $medication->delete();
        return back()->with('success', 'Medication deleted successfully.');
    }
}
