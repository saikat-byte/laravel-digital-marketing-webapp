@if($section->status == 1)
<!-- Marketing section Start -->
<section class="container-fluid">
    <div class="row">
        <!-- Left 4 columns (Gradient + Logos) -->
        <div class="col-lg-4 gradient-col text-white text-end d-flex flex-column p-4">
            <div class="left-side">
                @if($section->multi_image && is_array($section->multi_image))
                @foreach($section->multi_image as $image)
                <div class="mb-4 logo-item text-start">
                    <img src="{{ asset('storage/' . $image) }}" alt="{{ $section->heading }}">
                    <hr class="white-separator">
                </div>
                @endforeach
                @endif
            </div>
        </div>

        <!-- Right 8 columns (Heading, Text, Image, Buttons) -->
        <div class="col-lg-8 content-col p-4">
            <!-- Heading Triangle icon -->
            <div class="right-side">
                <div class="d-flex align-items-center mb-3">
                    <div class="triangle-icon me-2"></div>
                    <h2 class="mb-0" style="color: #144a9b;">
                        {{ $section->heading }}
                    </h2>
                </div>

                <!-- Paragraph 1 -->
                <p>
                    {{ $section->paragraph }}
                </p>

                <div class="text-center my-3">
                    <div class="video-wrapper position-relative">
                        <video id="videoElement" class="w-100 rounded" src="{{ asset('storage/' . $section->video) }}" muted></video>
                        <div id="playButtonWrapper" class="play-button position-absolute top-50 start-50 translate-middle">
                            <button id="playButton" class="play_icon" style="background: transparent; border: none;">
                                <img id="playIcon" width="50" height="50" src="{{ asset('assets/image/icons/play_button.png') }}" alt="Play Icon">
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Paragraph 2 -->
                <p>
                    {{ $section->sub_heading }}
                </p>

                <!-- Buttons -->
                <div class="mt-4">
                    <a class="gradient-glow-button gradient-btn me-2 text-uppercase">
                        {{ $section->button_1_text }}
                    </a>
                    <a class="gradient-glow-button gradient-btn text-uppercase">
                        {{ $section->button_2_text }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Marketing section End -->
@endif




@push('custom_js')
<script>
    $(document).ready(function() {

        // Video play button click event listener
        // video element reference
        var video = document.getElementById('videoElement');

        // video play function
        function playVideo() {
            var playPromise = video.play();
            if (playPromise !== undefined) {
                playPromise.then(function() {
                    console.log("Video is playing.");
                }).catch(function(error) {
                    console.error("Video is not plying:", error);
                    // If play promise is rejected, show play button again
                    $('#playButtonWrapper').fadeIn('fast');
                });
            }
        }

        $('#playButton').on('click', function(e) {
            e.preventDefault();
            // play button hide
            $('#playButtonWrapper').fadeOut('fast');

            // readyState check
            if (video.readyState >= 2) {
                playVideo();
            } else {
                // loadeddata event listener
                $(video).one('loadeddata', playVideo);
            }
        });

        // video end event listener
        $('#videoElement').on('ended', function() {
            $('#playButtonWrapper').fadeIn('fast');
        });
    });

</script>
@endpush
