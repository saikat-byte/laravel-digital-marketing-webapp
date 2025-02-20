@if($section->status == 1)
<section class="testimonials-section py-5">
    <div class="container">
        <!-- Heading -->
        <div class="row text-center">
            <div class="col">
                <h2 class="fw-bold text-primary">WHAT OUR CLIENTS LOVE ABOUT OUR SERVICES</h2>
            </div>
        </div>
        <!-- Grid of Cards up -->
        <div class="row mt-5 gy-4 grid-up ">
            <!-- Card 1 -->
            @foreach($posts as $post)
            <div class="col-md-3">
                <div class="testimonial-card"  style="background-image: url('{{ asset('assets/image/postimage/thumbnail/' . pathinfo($post->post_image, PATHINFO_FILENAME) . '_thumb.' . pathinfo($post->post_image, PATHINFO_EXTENSION)) }}')">
                    <h5 class="blog-title">{{ $post->title }}</h5>
                    <a href="{{ route('frontend.blog.show', $post->slug) }}" class="gradient-glow-button read-more">Read more</a>
                </div>
            </div>
            @endforeach
        </div>
        <!-- Grid of Cards down -->
        {{-- <div class="row mt-2 gy-4 grid-down">
            <!-- Card 5 -->
            <div class="col-md-3">
                <div class="testimonial-card"></div>
            </div>
            <!-- Card 6 -->
            <div class="col-md-3">
                <div class="testimonial-card"></div>
            </div>
            <!-- Card 7 -->
            <div class="col-md-3">
                <div class="testimonial-card"></div>
            </div>
            <!-- Card 8 -->
            <div class="col-md-3">
                <div class="testimonial-card"></div>
            </div>
        </div> --}}
    </div>
</section>
@endif
