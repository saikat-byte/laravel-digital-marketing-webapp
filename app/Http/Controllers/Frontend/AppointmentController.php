<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\AppointmentConfirmation;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{
    // Display appointment booking form
    public function create()
    {

        return view('frontend.modules.appointment.index');
    }

    // Store the appointment
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|date_format:H:i',
            'appointment_with' => 'required|string|max:255',
            'reason'           => 'nullable|string',
        ]);

        // Convert appointment date and time into Carbon instance for comparison
        $appointmentDate = Carbon::parse($request->appointment_date);
        $appointmentTime = Carbon::createFromFormat('H:i', $request->appointment_time);

        // Check if there is already an appointment for this date and time
        $existing = Appointment::where('appointment_date', $appointmentDate->toDateString())
            ->where('appointment_time', $appointmentTime->format('H:i'))
            ->first();

        if ($existing) {
            return redirect()->back()->withErrors(['appointment_time' => 'This appointment slot is already booked. Please choose another time.'])->withInput();
        }

        // Create the appointment record
        $appointment = Appointment::create([
            'user_id'           => Auth::id(),
            'appointment_with'  => $request->appointment_with,
            'appointment_date'  => $appointmentDate->toDateString(),
            'appointment_time'  => $appointmentTime->format('H:i'),
            'reason'            => $request->reason,
            'status'            => 0, // Pending approval
        ]);

        // Send confirmation email (implement using Mailables)
        // Send confirmation email to the user
        Mail::to(Auth::user()->email)->send(new AppointmentConfirmation($appointment));

        // Schedule reminder email 30 minutes before appointment using Laravel scheduler (setup a command)

        return redirect()->back()->with('success', 'Appointment booked successfully. It is pending approval.');
    }
}
