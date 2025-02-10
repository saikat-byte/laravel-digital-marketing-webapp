
// ---- Frequently ask question (Accordion Code) ----
$(document).ready(function () {
    $(".accordion-toggle").click(function () {
      $(this).toggleClass("active");
      var content = $(this).parent().next(".accordion-content");
      $(".accordion-content").not(content).slideUp();
      content.stop(true, true).slideToggle();
  });
});
