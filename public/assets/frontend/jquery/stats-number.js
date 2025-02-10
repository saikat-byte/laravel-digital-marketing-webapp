$(document).ready(function () {
    // Function to animate numbers
    function animateNumbers(element, start, end, duration, suffix = "") {
        $({ count: start }).animate(
            { count: end },
            {
                duration: duration,
                easing: "swing",
                step: function () {
                    $(element).text(Math.floor(this.count) + suffix);
                },
                complete: function () {
                    $(element).text(end + suffix); // Add suffix after animation
                },
            }
        );
    }

    // Animate each stat number
    $(".stat-card h3").each(function () {
        let $this = $(this);
        let finalText = $this.text().trim();
        let suffix = "";

        // Check for suffix (+ or %)
        if (finalText.includes("+")) {
            suffix = "+";
        } else if (finalText.includes("%")) {
            suffix = "%";
        }

        // Extract the number
        let finalNumber = parseInt(finalText.replace(/[^\d]/g, "")); // Remove non-numeric characters

        // Animate numbers with suffix
        animateNumbers($this, 0, finalNumber, 2000, suffix);
    });
});
