// ABOUT 画像スライドショー

// $('.aboutImage').slick({
//   dots: true,
//   infinite: true,
//   autoplay: true,
//   speed: 4000,
//   autoplaySpeed:300,
//   slidesToShow: 5,
//   prevArrow: '',
//   nextArrow: '',
//   adaptiveHeight: true
// });

// // メインビジュアル　テキストスライドショー
// $('.catchSlide').slick({
//     dots: false,
//     infinite: true,
//     autoplay: true,
//     speed: 1500,
//     autoplaySpeed:900,
//     slidesToShow: 1,
//     prevArrow: '',
//     nextArrow: ''
//   });

// スムーススクロール
$(function(){
  $('a[href^="#"]').click(function(){
    var speed = 500;
    var href= $(this).attr("href");
    var target = $(href == "#" || href == "" ? 'html' : href);
    var position = target.offset().top;
    $("html, body").animate({scrollTop:position}, speed = 1000, "swing");
    return false;
  });
});

// グロナビの固定表示
var _window = $(window),
    _header = $('#header'),
    heroBottom;
 
_window.on('scroll',function(){
    heroBottom = $('.mainVisual').height();
    if(_window.scrollTop() > heroBottom){
        _header.addClass('transform');   
    }
    else{
        _header.removeClass('transform');   
    }
});
 
_window.trigger('scroll');



jQuery(window).on("scroll", function($) {
  if (jQuery(this).scrollTop() > 100) {
    jQuery('.floating').show();
  } else {
    jQuery('.floating').hide();
  }
});

jQuery('.floating').click(function () {
  jQuery('body,html').animate({
    scrollTop: 0
  }, 500);
  return false;
});
