<!-- Navbar Start-->
@php
    $header = $header ?? null;
@endphp
<nav class="navbar navbar-expand-lg">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Logo (Left) -->
        <a class="navbar-brand" href="{{ route('frontend.page.show', ['slug' => 'home']) }}">
            <img src="{{ asset('storage/' . $header->logo) }}" alt="Cloudspace Solutions Logo">
        </a>

        <!-- Custom Toggler Button (Visible on Mobile) -->
        <button class="navbar-toggler collapsed d-block d-lg-none" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <!-- Hamburger Icon (Default) -->
            <i class="fa fa-bars hamburger-icon"></i>
            <!-- Close (X) Icon (Shown when expanded) -->
            <i class="fa fa-times close-icon"></i>
        </button>

        <!-- Collapsible Navbar Links -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                @if(optional($header)->nav_links)
                    @foreach($header->nav_links as $link)
                        <li class="nav-item">
                            <a class="nav-link text-uppercase {{ url()->current() == $link['url'] ? 'active' : '' }}" href="{{ $link['url'] }}">
                                {{ $link['name'] }}
                            </a>
                        </li>
                    @endforeach
                @endif

                <!-- Mobile View: Consultation Button inside Menu -->
                @if(optional($header)->button_text && optional($header)->button_link)
                    <li class="nav-item d-lg-none">
                        <a href="{{ $header->button_link }}" class="gradient-glow-button text-uppercase">
                            {{ $header->button_text }}
                        </a>
                    </li>
                @endif
            </ul>
        </div>

        <!-- Desktop View: Consultation Button on Right -->
        @if(optional($header)->button_text && optional($header)->button_link)
            <a href="{{ $header->button_link }}" class="gradient-glow-button text-uppercase d-none d-lg-inline-block">
                {{ $header->button_text }}
            </a>
        @endif
    </div>
</nav>
<!-- Navbar End-->
