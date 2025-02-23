<?php
// app/Console/Commands/SendAppointmentReminders.php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentReminder;

class SendAppointmentReminders extends Command
{
    protected $signature = 'appointment:send-reminders';
    protected $description = 'Send reminder emails for upcoming appointments';

    public function handle()
    {
        $tomorrow = Carbon::tomorrow()->toDateString();
        $appointments = Appointment::where('appointment_date', $tomorrow)
                        ->where('status', 'confirmed')
                        ->get();

        foreach ($appointments as $appointment) {
            Mail::to($appointment->email)->send(new AppointmentReminder($appointment));
        }
        $this->info("Reminders sent successfully!");
    }
}

