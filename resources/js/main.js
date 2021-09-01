$(function () {
  $('.fa-bars').click(function () {
    $(this).toggleClass('fa-times');
    $('header').toggleClass('header-active');
    $('.navbar').toggleClass('navbar-active');
    $('header').toggleClass('ip-header-active');
  });

  $('.header-link').click(function () {
    $('.header-link').removeClass('header-link-active');
    $(this).addClass('header-link-active');
    $('.fa-bars').removeClass('fa-times');
    $('.navbar-toggler').addClass('collapsed');
    $('.collapse').removeClass('show');
    $('header').removeClass('ip-header-active');
    $('.navbar').removeClass('navbar-active');
    $('header').removeClass('header-active');
  });

  $('.slider').slick({
    infinite: true,
    slidesToShow: 2,
    slidesToScroll: 1,
    prevArrow: '<div class="left-arrow"><i class="fas fa-angle-left"></i></div>',
    nextArrow: '<div class="right-arrow"><i class="fas fa-angle-right"></i></div>',
    autoplay: true,
    autoplaySpeed: 2000,
    responsive: [{
        breakpoint: 769,
        settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
        }
      },

      {
        breakpoint: 425,
        settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
        }
      }
    ]
  });

  $('.chat-button').click(function () {
    $('.chat-content').addClass('content-show');
  });

  $('.cancel-button').click(function () {
    $('.chat-content').removeClass('content-show');
  });

  $('[data-toggle="tooltip"]').tooltip();

  $('#logout').click(function (event) {
    event.preventDefault();
    $('#logout-form').submit();
  });

  if ($("#loginForm input").hasClass("is-invalid")) {
    $("#loginModal").modal("show");
  }

  if ($("#registerForm input").hasClass("is-invalid")) {
    $("#loginModal").modal("show");
    $("#register-tab").trigger("click");
  }

  window.setTimeout(function () {
    $(".alert").fadeTo(200, 0).slideUp(200, function () {
        $(this).remove();
    });
  }, 1000);

  $('.filter-select2-menu').select2();

  $("#clearFilter").click(function(){
    //$("input:radio").val("latest").change();
    $(".search-input").val("").change();
    $("#latest").prop("checked", true);
    $("select").val("").change();
  });

  $('#five-star-progress-bar').width(document.getElementById("five-star").value);
  $('#four-star-progress-bar').width(document.getElementById("four-star").value);
  $('#three-star-progress-bar').width(document.getElementById("three-star").value);
  $('#two-star-progress-bar').width(document.getElementById("two-star").value);
  $('#one-star-progress-bar').width(document.getElementById("one-star").value);

  $('.edit-review-button').click(function(){
    var key = $(this).attr('id');
    var rate = document.getElementsByClassName("rating_value")[key].value;
    var id = document.getElementsByClassName("rating_value")[key].id;
    if(rate !=0) {
      $("#" + id + "-" + rate).attr("checked", "true");
    }
  });
});
