<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Appointment Confirmation</title>
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
        <h1>Appointment Confirmed!</h1>
        <p>Dear {{ $appointment->name }},</p>
        <p>Your appointment on {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F j, Y') }} at {{ \Carbon\Carbon::parse($appointment->start_time)->format('g:i A') }} has been booked successfully.</p>
        <p>We look forward to serving you.</p>
        <p>Thank you!</p>
    </div>
</body>
</html>
