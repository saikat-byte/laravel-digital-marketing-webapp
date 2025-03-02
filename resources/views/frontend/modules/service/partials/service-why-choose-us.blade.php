@if($section->status == 1)
<section class="why-choose-us py-5">
    <div class="container">
        <!-- Heading -->
        <div class="text-center mb-5">
            <h4 class="text-primary fw-bold">
                WHY CHOOSE US <br>YOUR TRUSTED DIGITAL MARKETING AGENCY
            </h4>
        </div>

        <!-- Video Section -->
        <div class="video-wrapper text-center mb-5">
            <div class="video-container position-relative">
                <video id="videoElement" class="w-100 rounded" src="{{ asset('assets/frontend/media/pages/service/video/banner_video.mp4') }}" muted preload="auto"></video>
                <div id="playButtonWrapper" class="play-button position-absolute top-50 start-50 translate-middle">
                    <button id="playButton">
                        <!-- Image icon for play button -->
                        <img id="playIcon" width="50" height="50" src="{{ asset('assets/image/icons/play_button.png') }}" alt="Play Icon">
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
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
