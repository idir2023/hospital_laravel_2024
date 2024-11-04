<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\MedicalRecord;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    public function index()
    {
        $medicalRecords = MedicalRecord::with(['patient', 'doctor'])->get();
        $patients = Patient::all();
        $doctors = Doctor::all();
        return view('admin.medical_records.index', compact('medicalRecords', 'patients', 'doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'diagnosis' => 'required|string',
            'treatment' => 'required|string',
            'notes' => 'nullable|string',
            'record_date' => 'required|date',
        ]);

        // Create a new medical record
        MedicalRecord::create($request->only([
            'patient_id',
            'doctor_id',
            'diagnosis',
            'treatment',
            'notes',
            'record_date',
        ]));

        return redirect()->route('medical_records.index')->with('success', 'Medical record added successfully.');
    }

    public function update(Request $request, MedicalRecord $medicalRecord)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'diagnosis' => 'required|string',
            'treatment' => 'required|string',
            'notes' => 'nullable|string',
            'record_date' => 'required|date',
        ]);

        // Update the existing medical record
        $medicalRecord->update($request->only([
            'patient_id',
            'doctor_id',
            'diagnosis',
            'treatment',
            'notes',
            'record_date',
        ]));

        return redirect()->route('medical_records.index')->with('success', 'Medical record updated successfully.');
    }

    public function destroy(MedicalRecord $medicalRecord)
    {
        // Delete the medical record
        $medicalRecord->delete();
        return redirect()->route('medical_records.index')->with('success', 'Medical record deleted successfully.');
    }
}
