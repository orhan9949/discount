$(document).ready(function(){
    $(window).scroll(function() {
        if ($(this).scrollTop() > 50 && $(window).width() > 992) {
            // console.log($(window).width());
            $('.header').addClass('scroll_active');
        }else{
            $('.header').removeClass('scroll_active');
        }
    })
})