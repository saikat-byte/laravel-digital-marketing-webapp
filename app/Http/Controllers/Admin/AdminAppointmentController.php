<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AppointmentConfirmation;
use App\Models\Appointment;
use App\Models\Footer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminAppointmentController extends Controller
{
    // List all appointments for admin
    public function index()
    {
        $appointments = Appointment::orderBy('appointment_date', 'asc')
            ->orderBy('start_time', 'asc')
            ->get();
        return view('admin.modules.appointments.index', compact('appointments'));
    }

    // Edit appointment details

    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('admin.modules.appointments.edit', compact('appointment'));
    }


    // Update the appointment based on admin input
    public function update(Request $request, $id)
    {
        $request->validate([
            'appointment_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
            'status' => 'required|in:pending,confirmed,canceled,rescheduled',
        ]);

        // Convert start_time from 12-hour format to 24-hour format if needed
        $startTime = Carbon::parse($request->start_time)->format('H:i:s');

        $appointment = Appointment::findOrFail($id);
        $appointment->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'appointment_date' => $request->appointment_date,
            'start_time' => $startTime,
            'notes' => $request->notes,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.appointments.index')
            ->with('success', 'Appointment updated successfully!');
    }


    // Update appointment status (confirm, cancel, reschedule)
    public function updateStatus(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $request->validate([
            'status' => 'required|in:confirmed,canceled,rescheduled'
        ]);

        $appointment->status = $request->status;
        $appointment->save();

        // Status based mail sending
        if ($request->status == 'confirmed') {
            Mail::to($appointment->email)->send(new AppointmentConfirmation($appointment));
        } elseif ($request->status == 'canceled') {
            // AppointmentCancellation mail class usage
            Mail::to($appointment->email)->send(new \App\Mail\AppointmentCancellation($appointment));
        } elseif ($request->status == 'rescheduled') {
            // AppointmentReschedule mail class usage
            Mail::to($appointment->email)->send(new \App\Mail\AppointmentReschedule($appointment));
        }

        return response()->json([
            'success' => true,
            'message' => 'Appointment status updated successfully!'
        ]);
    }

    // (Optional) Delete method if required
    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->back()->with('success', 'Appointment deleted successfully!');
    }


}
