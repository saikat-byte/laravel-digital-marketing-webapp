@if($section->status == 1)
<section class="custom-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2 class="text-uppercase">{{ $section->heading }}</h2>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('storage/'. $section->image) }}" alt="Workspace" class="img-fluid rounded">
            </div>
        </div>
    </div>
    <div class="speech-box">
        <p>
            Our passionate and pragmatic approach has enabled our clients to digitally transform their businesses
            with cutting-edge technology. Our journey since conception has followed our vision to collaborate with
            companies worldwide, whilst helping them experience the strength of technology in leading the evolution
            of the industrial landscape.
            <br><br>
            <span>&mdash; Deborshee Bannerjee, CEO, Cloudspace</span>
        </p>
    </div>
</section>
@endif
