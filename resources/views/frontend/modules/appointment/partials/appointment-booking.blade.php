@if($section->status == 1)
<section class="appointment-booking bg-light py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-sm rounded-3">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <h3 class="card-title">Book Your Appointment</h3>
                        </div>
                        {{-- @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}
                    </div>
                    @endif --}}
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('appointment.store') }}" method="POST">
                        @csrf
                        <!-- Your Name -->
                        <div class="form-group">
                            <label for="name">Your Name:</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name" required>
                        </div>

                        <!-- Your Email -->
                        <div class="form-group">
                            <label for="email">Your Email:</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
                        </div>

                        <!-- Your Phone -->
                        <div class="form-group">
                            <label for="phone">Your Phone:</label>
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter your phone number">
                        </div>

                        <!-- Appointment Date -->
                        <div class="form-group">
                            <label for="appointment_date">Appointment Date:</label>
                            <input type="text" name="appointment_date" id="appointment_date" class="form-control" placeholder="Select Date" required>
                        </div>

                        <!-- Appointment Time -->
                        <div class="form-group">
                            <label for="start_time">Appointment Time:</label>
                            <input type="text" name="start_time" id="start_time" class="form-control" placeholder="Select Time" required>
                        </div>

                        <!-- Additional Notes -->
                        <div class="form-group">
                            <label for="notes">Additional Notes:</label>
                            <textarea name="notes" id="notes" class="form-control" rows="4" placeholder="Enter any additional information"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Book Appointment</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endif

@push('custom_js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Date picker configuration
        flatpickr("#appointment_date", {
            altInput: true
            , altFormat: "F j, Y"
            , dateFormat: "Y-m-d"
        , });

        // Time picker configuration with 12-hour format
        flatpickr("#start_time", {
            enableTime: true
            , noCalendar: true
            , dateFormat: "h:i K", // 12-hour format with AM/PM
            time_24hr: false
        , });
    });

</script>

@endpush
