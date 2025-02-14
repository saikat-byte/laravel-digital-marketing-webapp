
@if($section->status == 1)
<!-- Vission section start -->
<section class="vision-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4">
                <h3 class="vision-title">Our Vision</h3>
                <p class="vision-highlight">{{ $section->heading }}</p>
            </div>
            <div class="col-md-8">
                <p class="vision-description">
                    {{ $section->paragraph }}
                </p>
            </div>
        </div>
    </div>
</section>
<!-- Vission section End -->
@endif
