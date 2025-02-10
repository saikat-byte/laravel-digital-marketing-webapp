// Video play button

$(document).ready(function () {
    // jQuery দিয়ে DOM সিলেক্ট
    const video = $("#videoElement")[0]; // HTMLVideoElement নিতে [0] লাগবে
    const $playButtonWrapper = $("#playButtonWrapper");
    const $playButton = $("#playButton");
    const $playIcon = $("#playIcon");

    // Play Button Click
    $playButton.on("click", function () {
        if (video.paused) {
            video.play();
            $playButtonWrapper.addClass("hidden"); // Hide the play button
        } else {
            video.pause();
        }
    });

    // Video paused -> Show play button
    $(video).on("pause", function () {
        $playButtonWrapper.removeClass("hidden"); 
        $playIcon.removeClass("fa-pause").addClass("fa-play");
    });

    // Video playing -> Hide play button icon
    $(video).on("play", function () {
        $playIcon.removeClass("fa-play").addClass("fa-pause");
    });
});
