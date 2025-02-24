<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\AppointmentConfirmation;
use App\Models\Appointment;
use App\Models\Holiday;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{
    // Show appointment booking form
    public function create()
    {
        return view('frontend.modules.appointment.partials.appointment-booking');
    }

    // Store new appointment bookinguse App\Models\Holiday; // Holiday model import করুন
    public function store(Request $request)
    {
        $request->validate([
            'appointment_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
        ]);

        $appointmentDate = Carbon::parse($request->appointment_date);

        // Check if the date is a weekend
        if ($appointmentDate->isWeekend()) {
            return redirect()->back()
                ->withErrors(['appointment_date' => 'Appointments cannot be booked on weekends.'])
                ->withInput();
        }

        // Holiday check:
        if (Holiday::where('holiday_date', $appointmentDate->toDateString())->exists()) {
            return redirect()->back()
                ->withErrors(['appointment_date' => 'Appointments cannot be booked on this date as it is marked as a holiday.'])
                ->withInput();
        }

        // Convert start_time from 12-hour format to 24-hour format
        $startTime = Carbon::parse($request->start_time)->format('H:i:s');

        // Check availability for the selected timeslot.
        $existing = Appointment::where('appointment_date', $request->appointment_date)
            ->where('start_time', $startTime)
            ->count();

        if ($existing > 0) {
            return redirect()->back()
                ->withErrors(['time_slot' => 'An appointment has already been booked for this time slot, please choose another time.'])
                ->withInput();
        }

        $appointment = Appointment::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'appointment_date' => $appointmentDate->toDateString(),
            'start_time' => $startTime,
            'status' => 'pending',
            'notes' => $request->notes,
        ]);

        Mail::to($request->email)->send(new AppointmentConfirmation($appointment));

        return redirect()->back()->with('success', 'Your appointment has been booked successfully! A confirmation email has been sent.');
    }


}
