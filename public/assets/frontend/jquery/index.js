// Card queue scroll 

$(document).ready(function () {
    const $cardQueueSection = $("#cardQueueSection");
    const $cardContainer = $("#cardContainer");
    const $cards = $cardContainer.find(".card-item");

    let currentIndex = 3; // মূলত মধ্যের কার্ড

    function arrangeCards() {
        $cards.each(function (i, card) {
            let offset = i - currentIndex;
            let scale = 1 - Math.abs(offset) * 0.1;
            let translateX = offset * 100;
            let zIndex = -Math.abs(offset);

            // CSS প্রোপার্টিগুলো জেকুয়েরি দিয়ে সেট করা
            $(card).css({
                transform: `translateX(${translateX}px) scale(${scale})`,
                zIndex: zIndex
            });
        });
    }
    arrangeCards();

    // স্ক্রল (wheel) ইভেন্ট
    $cardQueueSection.on("wheel", function (e) {
        // jQuery-তে স্ক্রলের actual মান পেতে e.originalEvent.deltaY ব্যবহার করতে হয়
        let deltaY = e.originalEvent.deltaY;

        // স্ক্রল আপ
        if (deltaY < 0) {
            if (currentIndex > 0) {
                e.preventDefault();
                currentIndex--;
                arrangeCards();
            }
        } 
        // স্ক্রল ডাউন
        else {
            if (currentIndex < $cards.length - 1) {
                e.preventDefault();
                currentIndex++;
                arrangeCards();
            }
        }
    });
});
