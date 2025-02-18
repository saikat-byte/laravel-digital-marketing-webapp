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
                        <div class="alert alert-success">{{ session('success') }}</div>
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
                            <div class="form-control mb-3">
                                <label for="appointment_date" class="form-label">Select Date</label>
                                <input type="date" class="form-control" id="appointment_date" name="appointment_date" value="{{ old('appointment_date') }}" required>
                            </div>
                            <div class="form-control  mb-3">
                                <label for="appointment_time" class="form-label">Select Time</label>
                                <input type="time" class="form-control" id="appointment_time" name="appointment_time" value="{{ old('appointment_time') }}" placeholder="Time format: 23:59:00" required>
                            </div>
                            <div class="form-control  mb-3">
                                <label for="appointment_with" class="form-label">Appointment With</label>
                                <input type="text" class="form-control" id="appointment_with" name="appointment_with" placeholder="Enter the name or department" value="{{ old('appointment_with') }}" required>
                            </div>
                            <div class="form-control  mb-3">
                                <label for="reason" class="form-label">Reason for Appointment</label>
                                <textarea class="form-control" id="reason" name="reason" rows="3" placeholder="Enter your reason">{{ old('reason') }}</textarea>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">Book Appointment</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

