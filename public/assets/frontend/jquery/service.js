
// card slider and accordion code and banner image change on hover
$(document).ready(function () {
    // মূল ইমেজের লিংক সংগ্রহ করে রাখুন
    let originalSrc = $("#bannerLeftImage").attr("src");

    // ইভেন্ট ডেলিগেশন (card-slider এ Hover লিস্টেনার)
    $(".card-slider").on("mouseenter", ".service-card", function () {
        let hoveredImgSrc = $(this).find("img").attr("src");

        // ধাপে ধাপে ফেইডিং ইফেক্ট
        $("#bannerLeftImage").fadeOut(300, function () {
            // ইমেজ সোর্স পরিবর্তন
            $(this).attr("src", hoveredImgSrc);
            // আবার ফেইড ইন
            $(this).fadeIn(1000);
        });
    });

    $(".card-slider").on("mouseleave", ".service-card", function () {
        // আগের ইমেজে ফিরে যাওয়ার সময়ও ফেইড ইফেক্ট
        $("#bannerLeftImage").fadeOut(300, function () {
            $(this).attr("src", originalSrc);
            $(this).fadeIn(300);
        });
    });

    // ---- আগের slider কোড (Infinite Loop) ----
    const $slider = $(".card-slider");
    let $cards = $slider.find(".service-card");
    const cardWidth = $cards.outerWidth(true);

    // Clone cards for seamless loop
    $slider.append($cards.clone());
    $slider.append($cards.clone());
    $cards = $slider.find(".service-card"); // নতুন কার্ড আপডেট

    let translateX = 0;
    const speed = 1; // scrolling speed

    function animateSlider() {
        translateX -= speed;
        if (Math.abs(translateX) >= $cards.length * cardWidth) {
            translateX = 0;
        }
        $slider.css("transform", `translateX(${translateX}px)`);
        requestAnimationFrame(animateSlider);
    }

    let animationFrame = requestAnimationFrame(animateSlider);

    // Pause animation on hover
    $slider.hover(
        function () {
            cancelAnimationFrame(animationFrame);
        },
        function () {
            animationFrame = requestAnimationFrame(animateSlider);
        }
    );
});
