//borrowed jquery code  will update to javascript later
//smooth scroll using jquery
function smoothScroll(duration) {
  $('a[href^="#"]').on("click", function(event) {
    var target = $($(this).attr("href"));

    if (target.length) {
      event.preventDefault();

      $("html, body").animate(
        {
          scrollTop: target.offset().top
        },
        duration
      );
    }
  });
}

smoothScroll(300);
