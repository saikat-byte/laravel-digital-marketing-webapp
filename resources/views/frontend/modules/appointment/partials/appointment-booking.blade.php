@if($section->status == 1)
<section class="appointment-booking bg-light py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-sm rounded-3">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <h3>Book Your Appointment</h3>
                        </div>
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
                            <div class="mb-3">
                                <label for="name" >Your Name:</label>
                                <input type="text" name="name" id="name" class="form-control custom-input" placeholder="Enter your name" required>
                            </div>

                            <!-- Your Email -->
                            <div class="mb-3">
                                <label for="email" >Your Email:</label>
                                <input type="email" name="email" id="email" class="form-control custom-input" placeholder="Enter your email" required>
                            </div>

                            <!-- Your Phone -->
                            <div class="mb-3">
                                <label for="phone" >Your Phone:</label>
                                <input type="text" name="phone" id="phone" class="form-control custom-input" placeholder="Enter your phone number">
                            </div>

                            <!-- Appointment Date -->
                            <div class="mb-3">
                                <label for="appointment_date" >Appointment Date:</label>
                                <input type="text" name="appointment_date" id="appointment_date" class="form-control custom-input" placeholder="Select Date" required>
                            </div>

                            <!-- Appointment Time -->
                            <div class="mb-3">
                                <label for="start_time" >Appointment Time:</label>
                                <input type="text" name="start_time" id="start_time" class="form-control custom-input" placeholder="Select Time" required>
                            </div>

                            <!-- Additional Notes -->
                            <div class="mb-3">
                                <label for="notes" >Additional Notes:</label>
                                <textarea name="notes" id="notes" class="form-control custom-input" rows="4" placeholder="Enter any additional information"></textarea>
                            </div>

                            <button type="submit" class="gradient-glow-button w-100 mt-2">Book Appointment</button>
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
