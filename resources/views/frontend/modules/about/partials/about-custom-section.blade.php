@if($section->status == 1)
<section class="custom-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2 class="text-uppercase text-white">{{ $section->heading }}</h2>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('storage/'. $section->image) }}" alt="Workspace" class="img-fluid rounded">
            </div>
        </div>
    </div>
    <div class="speech-box">
        <p>
            {{ $section->paragraph }}
            <br><br>
            <span>&mdash; {{ $section->sub_heading }}</span>
        </p>
    </div>
</section>
@endif
