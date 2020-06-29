import $ from 'jquery';

/**
 * Scroll towards element on click.
 *
 * Usage:
 * $('a[href*="#"]').scrollTo();
 */
$.fn.scrollTo = function(options) {
  var config = $.extend({ offset : 0}, options);
  return this.each(function(){
    $(this).on('click', function(event){
      event.preventDefault();
      var target = $(this).attr('href');
      $('html, body').stop().animate({
        scrollTop: $(target).offset().top + config.offset
      }, 300);
    });
  });
}
