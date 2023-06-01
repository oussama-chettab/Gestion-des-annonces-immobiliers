$(document).ready(function() {
    var slideCount = $('.slides img').length;
    var slideWidth = $('.slides img').width();
    var slideHeight = $('.slides img').height();
    var sliderWidth = slideCount * slideWidth;
    $('.slides').css({ width: sliderWidth, height: slideHeight });
    
    var currentPosition = 0;
    $('.arrow.next').click(function() {
      if (currentPosition < slideCount - 1) {
        currentPosition++;
        $('.slides').animate({ left: -currentPosition * slideWidth }, 500);
      }
    });
    $('.arrow.prev').click(function() {
      if (currentPosition > 0) {
        currentPosition--;
        $('.slides').animate({ left: -currentPosition * slideWidth }, 500);
      }
    });
});