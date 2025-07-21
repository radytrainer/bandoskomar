function charity_aid_mobile_menu_open() {
  jQuery(".side_nav").addClass('show');
}
function charity_aid_mobile_menu_close() {
  jQuery(".side_nav").removeClass('show');
}

jQuery(function($){
  $('.toggle').click(function () {
    charity_aid_Keyboard_loop($('.side_nav'));
  });
});

var charity_aid_Keyboard_loop = function (elem) {
  var charity_aid_tabbable = elem.find('select, input, textarea, button, a').filter(':visible');
  var charity_aid_firstTabbable = charity_aid_tabbable.first();
  var charity_aid_lastTabbable = charity_aid_tabbable.last();
  charity_aid_firstTabbable.focus();

  charity_aid_lastTabbable.on('keydown', function (e) {
    if ((e.which === 9 && !e.shiftKey)) {
      e.preventDefault();
      charity_aid_firstTabbable.focus();
    }
  });

  charity_aid_firstTabbable.on('keydown', function (e) {
    if ((e.which === 9 && e.shiftKey)) {
      e.preventDefault();
      charity_aid_lastTabbable.focus();
    }
  });

  elem.on('keyup', function (e) {
    if (e.keyCode === 27) {
      elem.hide();
    };
  });
};

jQuery('#banner-area .owl-carousel').owlCarousel({
  loop: true,
  margin: 0,
  nav: true,
  dots: false,
  navText: [
    '<i class="fas fa-chevron-left"></i>', // Left arrow
    '<i class="fas fa-chevron-right"></i>' // Right arrow
  ],
  responsive: {
    0: {
      items: 1,
    },
    600: {
      items: 1,
    },
    1000: {
      items: 1,
    }
  }
});

jQuery(".myHeading").each(function () {
  const $heading = jQuery(this);

  // Skip if already processed
  if ($heading.hasClass("processed-heading")) return;

  const text = $heading.text().trim();
  const words = text.split(" ");

  if (words.length > 3) {
      const lastThree = words.splice(-3).join(" ");
      const rest = words.join(" ");
      $heading.html(`${rest} <span>${lastThree}</span>`);
  } else {
      $heading.html(`<span>${text}</span>`);
  }

  // Mark as processed
  $heading.addClass("processed-heading");
});