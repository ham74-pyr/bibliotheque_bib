(function () {
  var aboutEl = $("div.anim");
  var aboutElOffset = aboutEl.offset().top / 2;
  var documentEl = $(document);
  documentEl.on("scroll", function () {
    if (documentEl.scrollTop() > aboutElOffset && aboutEl.hasClass("hidden")) {
      aboutEl.removeClass("hidden");
    }
  });
})();

(function () {
  var aboutEl = $(".anim-lists");
  var aboutElOffset = aboutEl.offset().top / 2;
  var documentEl = $(document);
  documentEl.on("scroll", function () {
    if (documentEl.scrollTop() > aboutElOffset && aboutEl.hasClass("hidden")) {
      aboutEl.removeClass("hidden");
    }
  });
})();

(function () {
  var aboutEl = $("div.anim-contact-us");
  var aboutElOffset = aboutEl.offset().top / 2;
  var documentEl = $(document);
  documentEl.on("scroll", function () {
    if (documentEl.scrollTop() > aboutElOffset && aboutEl.hasClass("hidden")) {
      aboutEl.removeClass("hidden");
    }
  });
})();

(function () {
  var aboutEl = $("div.anim-about-us");
  var aboutElOffset = aboutEl.offset().top / 2;
  var documentEl = $(document);
  documentEl.on("scroll", function () {
    if (documentEl.scrollTop() > aboutElOffset && aboutEl.hasClass("hidden")) {
      aboutEl.removeClass("hidden");
    }
  });
})();
