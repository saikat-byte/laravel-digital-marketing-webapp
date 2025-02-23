<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Appointment Rescheduled</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px; }
        .container { background: #ffffff; padding: 20px; border-radius: 8px; }
        h1 { color: #5cb85c; }
        p { font-size: 16px; line-height: 1.5; }
        ul { list-style: none; padding: 0; }
        li { margin-bottom: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Appointment Rescheduled</h1>
        <p>Dear {{ $appointment->name }},</p>
        <p>Your appointment has been rescheduled. The new appointment details are as follows:</p>
        <ul>
            <li><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F j, Y') }}</li>
            <li><strong>Time:</strong> {{ \Carbon\Carbon::parse($appointment->start_time)->format('g:i A') }}</li>
        </ul>
        <p>If you have any questions or need further assistance, please contact us.</p>
        <p>Thank you.</p>
    </div>
</body>
</html>
