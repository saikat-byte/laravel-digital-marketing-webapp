
@if($section->status == 1)
<!-- Blog card section Start -->
<section class="blog-posts py-5">
    <div class="container">
        <div class="row">
            <!-- Blog Card 1 -->
            <!-- Blog Card 2 -->
            <div class="col-lg-6">
                <div class="card blog-card">
                    <img src="{{ asset('assets/frontend/media/pages/blog/images/youtube.jpg') }}" alt="Blog Image">
                    <div class="card-body">
                        <p class="blog-meta">
                            <span>Design</span> | <span>3 Comments</span> | <span>28th January</span>
                        </p>
                        <h5 class="blog-title">Interactivity connects consumers</h5>
                        <p class="blog-text">
                            Non ita quis blanditiis expedita laboriosam minima animi. Consectetur accusantium pariatur repudiandae!
                        </p>
                        <a href="#" class="gradient-glow-button read-more">Learn More</a>
                    </div>
                </div>
            </div>
            <!-- Repeat for other blog cards -->
            <!-- Blog Card 2 -->
            <div class="col-lg-6">
                <div class="card blog-card">
                    <img src="{{ asset('assets/frontend/media/pages/blog/images/youtube.jpg') }}" alt="Blog Image">
                    <div class="card-body">
                        <p class="blog-meta">
                            <span>Design</span> | <span>3 Comments</span> | <span>28th January</span>
                        </p>
                        <h5 class="blog-title">Interactivity connects consumers</h5>
                        <p class="blog-text">
                            Non ita quis blanditiis expedita laboriosam minima animi. Consectetur accusantium pariatur repudiandae!
                        </p>
                        <a href="#" class="gradient-glow-button read-more">Learn More</a>
                    </div>
                </div>
            </div>
            <!-- Add more blog cards -->
            <!-- Example Blog Cards -->
            <!-- Blog Card 3 -->
            <div class="col-lg-6">
                <div class="card blog-card">
                    <img src="{{ asset('assets/frontend/media/pages/blog/images/web_development.jpg') }}" alt="Blog Image">
                    <div class="card-body">
                        <p class="blog-meta">
                            <span>Marketing</span> | <span>7 Comments</span> | <span>30th January</span>
                        </p>
                        <h5 class="blog-title">Marketing Strategy to bring more effect</h5>
                        <p class="blog-text">
                            Non ita quis blanditiis expedita laboriosam minima animi. Consectetur accusantium pariatur repudiandae!
                        </p>
                        <a href="#" class="gradient-glow-button read-more">Learn More</a>
                    </div>
                </div>
            </div>
            <!-- Blog Card 4 -->
            <div class="col-lg-6">
                <div class="card blog-card">
                    <img src="{{ asset('assets/frontend/media/pages/blog/images/social_media.jpg') }}" alt="Blog Image">
                    <div class="card-body">
                        <p class="blog-meta">
                            <span>Community</span> | <span>4 Comments</span> | <span>28th January</span>
                        </p>
                        <h5 class="blog-title">Build better relationships with events</h5>
                        <p class="blog-text">
                            Non ita quis blanditiis expedita laboriosam minima animi. Consectetur accusantium pariatur repudiandae!
                        </p>
                        <a href="#" class="gradient-glow-button read-more">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pagination -->
        <nav>
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="#">Prev</a>
                </li>
                <li class="page-item active">
                    <a class="page-link" href="#">1</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</section>
<!-- Blog card section End -->
@endif
