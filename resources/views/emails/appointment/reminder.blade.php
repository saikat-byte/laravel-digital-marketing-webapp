<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Appointment Reminder</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
        .container { background: #ffffff; padding: 20px; border-radius: 8px; }
        h1 { color: #0040ff; }
        p { font-size: 16px; }
        .button { background: #0040ff; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Appointment Reminder</h1>
        <p>Dear {{ $appointment->name }},</p>
        <p>This is a friendly reminder that you have an appointment scheduled on {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F j, Y') }} at {{ \Carbon\Carbon::parse($appointment->start_time)->format('g:i A') }}.</p>
        <p>Please contact us if you need to reschedule or cancel your appointment.</p>
        <p>Thank you!</p>
    </div>
</body>
</html>
