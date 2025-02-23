@extends('admin.layouts.master')

@section('content')
<div class="page-inner">
    <div class="page-header d-flex justify-content-between align-items-center">
        <h3 class="fw-bold mb-3">Edit Appointment</h3>
        <a href="{{ route('admin.appointments.index') }}" class="btn btn-secondary">Back to Appointments</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.appointments.update', $appointment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Your Name -->
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $appointment->name) }}" required>
        </div>

        <!-- Your Email -->
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $appointment->email) }}" required>
        </div>

        <!-- Your Phone -->
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $appointment->phone) }}">
        </div>

        <!-- Appointment Date -->
        <div class="form-group">
            <label for="appointment_date">Appointment Date:</label>
            <input type="text" name="appointment_date" id="appointment_date" class="form-control" value="{{ old('appointment_date', $appointment->appointment_date) }}" required>
        </div>

        <!-- Appointment Time -->
        <div class="form-group">
            <label for="start_time">Appointment Time:</label>
            <input type="text" name="start_time" id="start_time" class="form-control" value="{{ old('start_time', $appointment->start_time) }}" required>
        </div>

        <!-- Additional Notes -->
        <div class="form-group">
            <label for="notes">Notes:</label>
            <textarea name="notes" id="notes" class="form-control" rows="4" placeholder="Enter any additional information">{{ old('notes', $appointment->notes) }}</textarea>
        </div>

        <!-- Appointment Status -->
        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" id="status" class="form-control" required>
                <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="canceled" {{ $appointment->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                <option value="rescheduled" {{ $appointment->status == 'rescheduled' ? 'selected' : '' }}>Rescheduled</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Appointment</button>
    </form>
</div>
@endsection

@push('custom_js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Optionally, initialize a date picker (e.g., Flatpickr) for appointment_date and start_time
    flatpickr("#appointment_date", {
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
    });
    flatpickr("#start_time", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "h:i K",  // 12-hour format with AM/PM
        time_24hr: false,
    });
});
</script>
@endpush
