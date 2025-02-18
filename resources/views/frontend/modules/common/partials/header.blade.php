<!-- Navbar Start-->
@php
    $header = $header ?? null;
@endphp
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="#">
            <img src="{{ asset('storage/' . $header->logo) }}" alt="Cloudspace Solutions Logo">
        </a>

        <!-- Toggler for mobile view -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                @if(optional($header)->nav_links)
                    @foreach($header->nav_links as $link)
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" href="{{ $link['url'] }}">{{ $link['name'] }}</a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>

        <!-- Consultation button -->
        @if(optional($header)->button_text && optional($header)->button_link)
            <a href="{{ $header->button_link }}" class="gradient-glow-button text-uppercase">{{ $header->button_text }}</a>
        @endif
    </div>
</nav>
<!-- Navbar End-->
