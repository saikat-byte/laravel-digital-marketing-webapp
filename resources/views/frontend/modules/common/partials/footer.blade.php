<!-- Footer -->
@php
$footer = $footer ?? null;
@endphp

<footer class="footer pt-5">
    <div class="container-fluid">
        <!-- Wrap content in a container to center it -->
        <div class="container">
            <div class="row align-items-center g-5">
                <!-- Footer Left Section -->
                <div class="col-lg-4 footer-left">
                    <div class="footer-logo text-center text-lg-start">
                        <a href="{{ route('frontend.page.show', ['slug' => 'home']) }}">
                            <img src="{{ asset('storage/' . (optional($footer)->logo ?? 'assets/frontend/media/common/logo/logo.jpg')) }}" alt="Cloudspace Solutions Logo">
                        </a>
                    </div>
                    <div class="subscribe-section mt-3">
                        <p class="text-muted footer-left-heading text-center text-lg-start">
                            {{ optional($footer)->header_text ?? 'Join our newsletter to stay up to date on features and releases.
' }}
                        </p>
                        <form action="{{ route('lead.submit') }}" method="POST">
                            @csrf
                            <div class="row g-2 mb-3">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" placeholder="Enter Your Name">
                                    @error('name')
                                    <span>{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" placeholder="Enter Your Email">
                                    @error('email')
                                    <span>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="gradient-glow-button w-100">SUBSCRIBE</button>
                            <p class="mt-2 small text-muted">
                                By subscribing you agree to our
                                <a href="{{ route('frontend.page.show', ['slug' => 'privacy-policy']) }}" class="text-primary">Privacy Policy</a>
                                and provide consent to receive updates from our company.
                            </p>
                        </form>
                    </div>
                    <div class="social-icons mt-4 text-center text-lg-start">
                        @if(optional($footer)->social_icons)
                        @foreach($footer->social_icons as $social)
                        <a href="{{ $social['url'] }}"><i class="{{ $social['icon'] }}"></i></a>
                        @endforeach
                        @else
                        <!-- Default icons -->
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-whatsapp"></i></a>
                        <a href="#"><i class="fab fa-behance"></i></a>
                        <a href="#"><i class="fab fa-x-twitter"></i></a>
                        <a href="#"><i class="fab fa-pinterest"></i></a>
                        @endif
                    </div>
                </div>

                <!-- Footer Right Section -->
                <div class="col-lg-8 col-sm-12 footer-right">
                    <div class="row">
                        @if(optional($footer)->sections)
                        @foreach($footer->sections as $sectionKey => $sectionData)
                        <div class="col-lg-3 col-md-6 col-6 mb-4">
                            <h6>{{ $sectionData['heading'] ?? ucfirst($sectionKey) }}</h6>
                            <ul>
                                @if(isset($sectionData['links']) && is_array($sectionData['links']))
                                @foreach($sectionData['links'] as $link)
                                <li class="pt-3"><a href="{{ $link['url'] }}">{{ $link['text'] }}</a></li>
                                @endforeach
                                @endif
                            </ul>
                        </div>
                        @endforeach
                        @else
                        <!-- Default sections if no data -->
                        <div class="col-lg-3 col-md-6 col-6 mb-4">
                            <h6>LOREM IPSUM</h6>
                            <ul>
                                <li class="pt-3"><a href="#">Lorem Ipsum</a></li>
                                <li class="pt-3"><a href="#">Lorem Ipsum</a></li>
                                <li class="pt-3"><a href="#">Lorem Ipsum</a></li>
                                <li class="pt-3"><a href="#">Lorem Ipsum</a></li>
                                <li class="pt-3"><a href="#">Lorem Ipsum</a></li>
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Bottom Footer Section -->
            <div class="bottom-footer d-flex flex-column flex-sm-row justify-content-center justify-content-sm-between align-items-center mt-4">
                <p class="mb-2 mb-sm-0"> &#169; {{ date('Y') }} CLOUDSPACE SOLUTIONS. ALL RIGHT RESERVED.</p>
                <div>
                    <a href="{{ route('frontend.page.show', ['slug' => 'privacy-policy']) }}" class="text-primary me-3">Privacy Policy</a>
                    <a href="{{ route('frontend.page.show', ['slug' => 'terms-condition']) }}" class="text-primary">Terms & Conditions</a>
                </div>
            </div>
        </div>
    </div>
</footer>


<!-- Footer end-->

<!-- Icon Container holding both icons -->
<div id="iconContainer">
    <!-- WhatsApp Chat Icon -->
    <a href="https://wa.me/8538896100" target="_blank" class="whatsapp-chat mb-2">
        <i class="fab fa-whatsapp"></i>
    </a>

    <!-- Back to Top Icon -->
    <a href="#" id="backToTop" class="back-to-top">
        <i class="fa fa-arrow-up"></i>
    </a>
</div>


@push('custom_js')
<script>
    $(document).ready(function() {

        $('#iconContainer').hide();

        $(window).scroll(function() {
            if ($(this).scrollTop() > 150) {
                $('#iconContainer').fadeIn();
            } else {
                $('#iconContainer').fadeOut();
            }
        });

        $('#backToTop').click(function(e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: 0
            }, 'slow');
        });
    });

</script>
@endpush
