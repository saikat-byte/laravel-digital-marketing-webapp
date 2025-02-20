@if($section->status == 1)
<!-- Video ribbon section Start -->
<section class="video-ribbon-section position-relative">
    <!-- Container-fluid ribbon upto right screen -->
    <div class="container-fluid py-5 position-relative">
        <div class="row g-0 align-items-center">
            <!-- Video Column left side -->
            <div class="col-auto video-col">
                <div class="video-wrapper position-relative">
                    <video id="videoElement" class="w-100 rounded" src="{{ asset('storage/' . $section->video) }}" muted></video>
                    <div id="playButtonWrapper" class="play-button position-absolute top-50 start-50 translate-middle">
                        <button id="playButton" class="gradient-glow-button">
                            <i id="playIcon" class="fa fa-play"></i>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Ribbon Column upto right screen -->
            <div class="col ribbon-col">
                <div class="ribbon d-flex align-items-center justify-content-start px-4">
                    <span class="text-white fw-bold fs-5">
                       {{ $section->heading }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Video ribbon section End -->
@endif
