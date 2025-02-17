<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Appointment Reminder</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; }
        .container { max-width: 600px; margin: 0 auto; background: #fff; padding: 20px; }
        .header { text-align: center; }
        .content { margin-top: 20px; }
        .footer { margin-top: 30px; text-align: center; font-size: 0.9rem; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>{{ config('app.name') }}</h2>
        </div>
        <div class="content">
            <p>Dear {{ $appointment->user->name }},</p>
            <p>This is a reminder that your appointment is scheduled for:</p>
            <ul>
                <li><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M, Y') }}</li>
                <li><strong>Time:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</li>
            </ul>
            <p>This is a reminder sent 30 minutes before your appointment.</p>
        </div>
        <div class="footer">
            <p>Thank you for choosing us.</p>
        </div>
    </div>
</body>
</html>
