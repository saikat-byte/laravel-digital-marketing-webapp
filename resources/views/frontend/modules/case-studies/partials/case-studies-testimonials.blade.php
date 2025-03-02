@if($section->status == 1)
<section class="case_study_testimonials-section py-5">
    <div class="container-fluid">

        <!-- Heading -->
        <div class="row text-center">
            <div class="col">
                <h2 class="fw-bold text-primary">{{ $section->heading }}</h2>
            </div>
        </div>

        <!-- 1st Row: Left-to-Right Slide -->
        <div class="carousel-row first-row">
            <div class="carousel-track left-to-right">
                @for ($i = 0; $i < 2; $i++)
                    @foreach($posts as $post)
                        <div class="testimonial-card"
                             style="background-image: url('{{ asset('assets/image/postimage/thumbnail/'.pathinfo($post->post_image, PATHINFO_FILENAME).'_thumb'.'.'.pathinfo($post->post_image, PATHINFO_EXTENSION)) }}" alt="{{ $post->post_image }}');">
                            <div class="testimonial-card-content">
                                <p class="blog-title text-uppercase">{{ $post->title }}</p>
                                <a href="{{ route('frontend.blog.show', $post->slug) }}" class="gradient-glow-button read-more">Read more</a>
                            </div>
                        </div>
                    @endforeach
                @endfor
            </div>
        </div>

        <!-- 2nd Row: Right-to-Left Slide -->
        <div class="carousel-row second-row">
            <div class="carousel-track right-to-left">
                @for ($i = 0; $i < 2; $i++)
                    @foreach($posts as $post)
                        <div class="testimonial-card"
                             style="background-image: url('{{ asset('assets/image/postimage/thumbnail/'.pathinfo($post->post_image, PATHINFO_FILENAME).'_thumb'.'.'.pathinfo($post->post_image, PATHINFO_EXTENSION)) }}" alt="{{ $post->post_image }}');">
                            <div class="testimonial-card-content">
                                <p class="blog-title text-uppercase">{{ $post->title }}</p>
                                <a href="{{ route('frontend.blog.show', $post->slug) }}" class="gradient-glow-button read-more">Read more</a>
                            </div>
                        </div>
                    @endforeach
                @endfor
            </div>
        </div>

    </div>
</section>
@endif
