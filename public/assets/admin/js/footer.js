document.addEventListener("DOMContentLoaded", function(){
    var backToTopBtn = document.getElementById("backToTop");

    backToTopBtn.addEventListener("click", function(e){
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
});
