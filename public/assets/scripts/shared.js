$(document).ready(function () {
  'use strict';
  $('.scroll-icon').on('click', function () {
     $('html').animate({
         scrollTop: 0
     }, 800);
  });
  $(window).on('scroll', function () {
     if ($(window).scrollTop() > 400) {
         $('.scroll-icon').fadeIn();
     } else {
         $('.scroll-icon').fadeOut();
     }
  });
});