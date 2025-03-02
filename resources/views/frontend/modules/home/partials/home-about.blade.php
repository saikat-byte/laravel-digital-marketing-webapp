@if($section->status == 1)
<section class="about-section" style="background-image: url('{{ asset('storage/' . $section->image) }}');">
  {{-- <div class="overlay"></div> --}}
  <div class="about-content container d-flex flex-column justify-content-start align-items-center h-100">
    <!-- Banner Heading (full-width, single line) -->
    <div class="banner-heading text-center w-100">
      <h1 class="heading">{{ $section->heading }}</h1>
    </div>
    <!-- Card with gap below heading -->
    <div class="card-content text-center mt-4">
      <h3>{{ $section->sub_heading }}</h3>
      <p class="paragraph text-justify">{{ $section->paragraph }}</p>
      <a href="{{ $section->button_1_link }}" class="gradient-glow-button text-uppercase">{{ $section->button_1_text }}</a>
    </div>
  </div>
</section>
@endif
