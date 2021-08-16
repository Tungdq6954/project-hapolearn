$(function () {
  $('.feedback-slide').slick({
    infinite: true,
    slidesToShow: 2,
    slidesToScroll: 1,
    prevArrow: '<button class="slide-arrow prev-arrow"><i class="fas fa-angle-left"></i></button>',
    nextArrow: '<button class="slide-arrow next-arrow"><i class="fas fa-angle-right"></i></button>',
    responsive: [{
      breakpoint: 769,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true
      }
    },
    {
      breakpoint: 414,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
      }
    }
    ]
  });

  $('[data-toggle="popover"]').popover();

  $('.custom-button-navbar-toggler').on("click", function () {
    if ($('.custom-button-navbar-toggler .fas.fa-bars').hasClass('hidden') && !$('.custom-button-navbar-toggler .fas.fa-times').hasClass('hidden')) {
      $('.custom-button-navbar-toggler .fas.fa-bars').removeClass('hidden');
      $('.custom-button-navbar-toggler .fas.fa-times').addClass('hidden');
      $('.addition-class').addClass('hidden');
      $('#body').removeClass('hidden');
      $('footer').removeClass('hidden');
    } else {
      $('.custom-button-navbar-toggler .fas.fa-bars').addClass('hidden');
      $('.custom-button-navbar-toggler .fas.fa-times').removeClass('hidden');
      $('.addition-class').removeClass('hidden');
      $('#body').addClass('hidden');
      $('footer').addClass('hidden');
    }
  });

  $('.navbar-light .navbar-nav .nav-link').on('click', function () {
    $('.navbar-light .navbar-nav .nav-link').removeClass('active');
    $(this).addClass('active');

    if ($('.custom-navbar-collapse').hasClass('show')) {
      $('.custom-navbar-collapse').removeClass('show')
      $('.custom-button-navbar-toggler').removeClass('collapsed');
      $('.custom-button-navbar-toggler .fas.fa-bars').removeClass('hidden');
      $('.custom-button-navbar-toggler .fas.fa-times').addClass('hidden');
      $('.addition-class').addClass('hidden');
      $('#body').removeClass('hidden');
      $('footer').removeClass('hidden');
    }
  });

  $('.logo-messenger').on('click', function () {
    if ($('.chatbox').hasClass('active')) {
      $('.chatbox').removeClass('active');
    } else {
      $('.chatbox').addClass('active');
    }
  });

  $('.close-button').on('click', function () {
    $('.chatbox').removeClass('active');
  })

  $('#login-nav-tab').on('click', function () {
    if ($('#register-nav-tab').hasClass('active-tab')) {
      $('#register-nav-tab').removeClass('active-tab');
    }

    $(this).addClass('active-tab');
  });

  $('#register-nav-tab').on('click', function () {
    if ($('#login-nav-tab').hasClass('active-tab')) {
      $('#login-nav-tab').removeClass('active-tab');
    }

    $(this).addClass('active-tab');
  });

  $('#logout-nav').on('click', function (event) {
    event.preventDefault();
    $('#logout-form').submit();
  });

  if ($("#register-tab input").hasClass("is-invalid")) {
    $("#login-register").modal("show");
    $("#register-nav-tab").trigger("click");
  }

  if ($("#login-tab input").hasClass("is-invalid")) {
    $("#login-register").modal("show");
    $("#login-nav-tab").trigger("click");
  }

  $('.close-button-login-register').on("click", function () {
    $("#login-register input").removeClass("is-invalid");
    $("#login-register input").val("");
    $('.login-tab').hide();
  });

  setTimeout(function () {
    $('.success-msg').fadeOut('fast');
  }, 3000);
});
