
// Banner image changes

$(document).ready(function () {
    const images = [
        "assets/frontend/media/pages/blog/images/social_media_marketing.jpg",
        "assets/frontend/media/pages/blog/images/youtube.jpg",
        "assets/frontend/media/pages/blog/images/web_development.jpg",
        "assets/frontend/media/pages/blog/images/social_media_marketing.jpg",
    ];

    let currentIndex = 0;
    let interval;

    $("#hover-image").hover(
        function () {
            const imageElement = $(this);

            interval = setInterval(function () {
                currentIndex = (currentIndex + 1) % images.length; // Cycle through images
                imageElement.fadeOut(250, function () {
                    $(this).attr("src", images[currentIndex]).fadeIn(250);
                });
            }, 500); // Change every 500ms
        },
        function () {
            clearInterval(interval); // Stop the interval when hover ends
            $(this).attr("src", images[0]); // Reset to the first image
        }
    );
});
