<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Department;

class DepartmentController extends Controller
{
    public function index()
    {
        // Retrieve all departments
        $departments = Department::all();

        // Return the view with departments data
        return view('admin.departments.index', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Department::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return back()->with('success', 'Department added successfully.');
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $department->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return back()->with('success', 'Department updated successfully.');
    }

    public function destroy(Department $department)
    {
        // Delete the specified department
        $department->delete();

        // Redirect back with a success message
        return back()->with('success', 'Department deleted successfully.');
    }
}
