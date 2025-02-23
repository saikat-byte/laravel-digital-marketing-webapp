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
    // Show appointment booking form
    public function create()
    {
        return view('frontend.modules.appointment.partials.appointment-booking');
    }

    // Store new appointment booking
    public function store(Request $request)
    {
        $request->validate([
            'appointment_date' => 'required|date|after_or_equal:today',
            'start_time'       => 'required',
            'name'             => 'required|string|max:255',
            'email'            => 'required|email',
            'phone'            => 'nullable|string|max:20',
            'notes'            => 'nullable|string',
        ]);

        // Convert start_time to 24-hour format
        $startTime = Carbon::parse($request->start_time)->format('H:i:s');

        // Check availability for the selected timeslot.
        // যদি প্রতি স্লটে শুধুমাত্র ১টি appointment অনুমোদিত থাকে:
        $existing = Appointment::where('appointment_date', $request->appointment_date)
                    ->where('start_time', $startTime)
                    ->count();

        if ($existing > 0) {
            return redirect()->back()
                ->withErrors(['time_slot' => 'An appointment has already been booked for this time slot, please choose another time.'])
                ->withInput();
        }

        $appointment = Appointment::create([
            'name'             => $request->name,
            'email'            => $request->email,
            'phone'            => $request->phone,
            'appointment_date' => $request->appointment_date,
            'start_time'       => $startTime,
            'status'           => 'pending',
            'notes'            => $request->notes,
        ]);

        Mail::to($request->email)->send(new AppointmentConfirmation($appointment));

        return redirect()->back()->with('success', 'Your appointment has been booked successfully! A confirmation email has been sent.');
    }





}
