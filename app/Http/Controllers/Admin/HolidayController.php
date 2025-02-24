<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Holiday;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    // List all holidays
    public function index()
    {
        $holidays = Holiday::orderBy('holiday_date', 'asc')->get();
        return view('admin.modules.holidays.index', compact('holidays'));
    }

    // Show form to create a new holiday
    public function create()
    {
        return view('admin.modules.holidays.create');
    }

    // Store new holiday
    public function store(Request $request)
    {
        $request->validate([
            'holiday_date' => 'required|date|unique:holidays,holiday_date',
            'description' => 'nullable|string|max:255',
        ]);

        Holiday::create($request->only('holiday_date', 'description'));

        return redirect()->route('admin.holidays.index')
            ->with('success', 'Holiday added successfully!');
    }

    // Show form to edit an existing holiday
    public function edit($id)
    {
        $holiday = Holiday::findOrFail($id);
        return view('admin.modules.holidays.edit', compact('holiday'));
    }

    // Update holiday
    public function update(Request $request, $id)
    {
        $holiday = Holiday::findOrFail($id);
        $request->validate([
            'holiday_date' => 'required|date|unique:holidays,holiday_date,' . $holiday->id,
            'description' => 'nullable|string|max:255',
        ]);

        $holiday->update($request->only('holiday_date', 'description'));

        return redirect()->route('admin.holidays.index')
            ->with('success', 'Holiday updated successfully!');
    }

    // Delete holiday
    public function destroy($id)
    {
        $holiday = Holiday::findOrFail($id);
        $holiday->delete();
        return redirect()->route('admin.holidays.index')
            ->with('success', 'Holiday deleted successfully!');
    }
}
