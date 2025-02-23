<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Appointment Cancellation</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px; }
        .container { background: #ffffff; padding: 20px; border-radius: 8px; }
        h1 { color: #d9534f; }
        p { font-size: 16px; line-height: 1.5; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Appointment Cancelled</h1>
        <p>Dear {{ $appointment->name }},</p>
        <p>We regret to inform you that your appointment scheduled on {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F j, Y') }} at {{ \Carbon\Carbon::parse($appointment->start_time)->format('g:i A') }} has been cancelled.</p>
        <p>If you have any questions or wish to reschedule, please contact us.</p>
        <p>Thank you.</p>
    </div>
</body>
</html>
