
@if($section->status == 1)
<!-- About Banner section start -->
<section class="appointment-banner pt-5" style="background-image: url('{{ asset('storage/' . $section->image) }}')">
    <div class="appointment-banner-overlay"></div>
    <div class="container">
        <div class="row pt-5">
            <div class="col-lg-6 appointment-banner-content py-5">
                <h2 class="display-4 fw-bold">{{ $section->heading }}</h2>
                <h1 class="lead">{{ $section->sub_heading }}</h1>
                <p class="text-white">{{ $section->paragraph }}</p>
            </div>
        </div>
    </div>
</section>
<!-- Appointment Banner section End -->
@endif
