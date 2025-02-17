<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Appointment;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentReminder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;




class SendAppointmentReminders extends Command
{
    protected $signature = 'appointment:send-reminders';
    protected $description = 'Send reminder emails for appointments 30 minutes before they start';

    public function handle()
    {
        // hour minute format
        $targetTime = Carbon::now()->addMinutes(30)->format('H:i');
        $today = Carbon::today()->toDateString();

        // Approved appointments (status = 1) for today,  appointment_time  H:i
        $appointments = Appointment::where('appointment_date', $today)
            ->where('status', 1)
            ->whereRaw("DATE_FORMAT(appointment_time, '%H:%i') = ?", [$targetTime])
            ->get();

        foreach ($appointments as $appointment) {
            Mail::to($appointment->user->email)->send(new AppointmentReminder($appointment));
        }
    }


}
