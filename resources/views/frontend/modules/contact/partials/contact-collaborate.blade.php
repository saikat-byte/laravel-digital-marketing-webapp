@if($section->status == 1)
<!-- Collaborate Section Start -->
<section class="collaborate-section position-relative">
    <!-- Overlay & Background Image Wrapper -->
    <div class="bg-image-wrapper">
        <img src="{{ asset('assets/frontend/media/pages/contact/images/contact-banner.jpg') }}" alt="Collaborate Background" class="bg-image">
        <div class="gradient-overlay"></div>
    </div>
    <div class="container position-relative h-100">
        <div class="row h-100">
            <div class="col-12 collaborate-section-content d-flex flex-column align-items-start justify-content-end">
                <h2 class="collab-heading text-white mb-3">
                    WE ARE ALWAYS <br />
                    READY TO COLLABORATE <br />
                    WITH YOU!
                </h2>
                <button class="gradient-glow-button">
                    GET FREE QUOTE
                </button>

            </div>
        </div>
    </div>
</section>
<!-- Collaborate Section End -->
@endif
