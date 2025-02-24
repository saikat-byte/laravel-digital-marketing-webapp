    <!-- Navbar Start-->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ route('frontend.page.show', ['slug' => 'home']) }}">
                <img src="{{ asset('assets/frontend/media/common/logo/logo.jpg') }}" alt="Cloudspace Solutions Logo">
            </a>

            <!-- Toggler for mobile view -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-uppercase {{ request()->route('slug') == 'home' ? 'active' : '' }}" href="{{ route('frontend.page.show', ['slug' => 'home']) }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase {{ request()->route('slug') == 'service' ? 'active' : '' }}" href="{{ route('frontend.page.show', ['slug' => 'service']) }}">Service</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase {{ request()->route('slug') == 'case-studies' ? 'active' : '' }}" href="{{ route('frontend.page.show', ['slug' => 'case-studies']) }}">Case Studies</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase {{ request()->route('slug') == 'contact' ? 'active' : '' }}" href="{{ route('frontend.page.show', ['slug' => 'contact']) }}">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase {{ request()->route('slug') == 'about' ? 'active' : '' }}" href="{{ route('frontend.page.show', ['slug' => 'about']) }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase {{ request()->routeIs('frontend.blog.index') ? 'active' : '' }}" href="{{ route('frontend.blog.index') }}">Blog</a>
                    </li>
                </ul>
            </div>

            <!-- Consultation button -->
            <a href="{{ route('frontend.page.show', ['slug' => 'appointment']) }}" class="gradient-glow-button text-uppercase">Appointment</a>
        </div>
    </nav>
    <!-- Navbar End-->
