<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;


use App\Models\Bill;
use App\Models\Patient;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function index()
    {
        $bills = Bill::with('patient')->get(); // Adjust the relationship as needed
        $patients = Patient::all();
        return view('admin.bills.index', compact('bills', 'patients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'amount' => 'required|numeric',
            'status' => 'required|in:unpaid,paid,pending',
            'billing_date' => 'required|date',
        ]);

        Bill::create($request->all());

        return redirect()->route('bills.index')->with('success', 'Bill added successfully.');
    }

    public function update(Request $request, Bill $bill)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'amount' => 'required|numeric',
            'status' => 'required|in:unpaid,paid,pending',
            'billing_date' => 'required|date',
        ]);

        $bill->update($request->all());

        return redirect()->route('bills.index')->with('success', 'Bill updated successfully.');
    }

    public function destroy(Bill $bill)
    {
        $bill->delete();

        return redirect()->route('bills.index')->with('success', 'Bill deleted successfully.');
    }
}
