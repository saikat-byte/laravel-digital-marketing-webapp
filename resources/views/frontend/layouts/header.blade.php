    <!-- Navbar Start-->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/frontend/media/common/logo/logo.jpg') }}" alt="Cloudspace Solutions Logo">
            </a>

            <!-- Toggler for mobile view -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    {{-- <li class="nav-item"><a class="nav-link text-uppercase" href="{{ route('frontend.home', ['slug' => 'home']) }}">Home</a></li> --}}
                    <li class="nav-item"><a class="nav-link text-uppercase" href="{{ route('frontend.page.show', ['slug' => 'home']) }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-uppercase" href="{{ route('frontend.page.show', ['slug' => 'service']) }}">Service</a></li>
                    <li class="nav-item"><a class="nav-link text-uppercase" href="{{ route('frontend.page.show', ['slug' => 'case-studies']) }}">Case Studies</a></li>
                    <li class="nav-item"><a class="nav-link text-uppercase" href="{{ route('frontend.page.show', ['slug' => 'contact']) }}">Contact</a></li>
                    <li class="nav-item"><a class="nav-link text-uppercase" href="{{ route('frontend.page.show', ['slug' => 'about']) }}">About</a></li>
                    <li class="nav-item"><a class="nav-link text-uppercase" href="{{ route('frontend.blog-posts.index',['slug' => 'blog-post']) }}">Blog</a></li>
                </ul>
            </div>

            <!-- Consultation button -->
            <a href="#" class="gradient-glow-button text-uppercase">Appointment</a>
        </div>
    </nav>
    <!-- Navbar End-->
