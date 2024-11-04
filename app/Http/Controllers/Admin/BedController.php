<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bed;
use Illuminate\Http\Request;


class BedController extends Controller
{
    public function index()
    {
        $beds = Bed::all();
        return view('admin.beds.index', compact('beds'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bed_number' => 'required|integer|unique:beds,bed_number',
            'status' => 'required|in:available,occupied,maintenance',
        ]);

        Bed::create($request->all());
        return redirect()->route('beds.index')->with('success', 'Bed added successfully!');
    }

    public function update(Request $request, Bed $bed)
    {
        $request->validate([
            'bed_number' => 'required|integer|unique:beds,bed_number,' . $bed->id,
            'status' => 'required|in:available,occupied,maintenance',
        ]);

        $bed->update($request->all());
        return redirect()->route('beds.index')->with('success', 'Bed updated successfully!');
    }

    public function destroy(Bed $bed)
    {
        $bed->delete();
        return redirect()->route('beds.index')->with('success', 'Bed deleted successfully!');
    }
}
