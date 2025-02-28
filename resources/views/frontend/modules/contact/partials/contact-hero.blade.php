@if($section->status == 1)
     <!-- Contact Hero Banner Section Start -->
     <section class="contact-banner container-fluid p-0">
        <div class="row g-0">
            <div class="col-12 position-relative">
                <video class="banner-video" autoplay loop muted playsinline <!-- iOS Safari inline play -->
                    poster="assets/images/video-poster.jpg"
                    >
                    <source src="{{ asset('assets/frontend/media/pages/contact/video/contact_map_video.mp4') }}" type="video/mp4" />
                    <!-- Fallback text -->
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
    </section>
    <!-- Contact Hero Banner Section End -->
@endif
