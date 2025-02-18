<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Footer;
use Illuminate\Http\Request;

class AdminAppointmentController extends Controller
{
    public function index(Request $request)
    {
        $appointments = Appointment::orderBy('appointment_date', 'asc')
            ->orderBy('appointment_time', 'asc')
            ->paginate(20);

        return view('admin.modules.appointments.index', compact('appointments'));
    }

    // appointment approve
    public function approve($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update(['status' => 1]);

        return redirect()->back()->with('success', 'Appointment approved successfully.');
    }


    // appointment delete
    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        return redirect()->back()->with('success', 'Appointment deleted successfully.');
    }
}
