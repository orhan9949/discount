$(document).ready(function() {
    $('.aside__items > div:nth-child(6)').remove();
    setTimeout(()=>{
        $(".product__slider").slick({
            infinite: true,
            slidesToScroll: 1,
            slidesToShow: 1,
            dots: true,
            arrows: false,
        });
    }
    , 100)

    $(".products-4x").slick({
        infinite: true,
        slidesToScroll: 1,
        slidesToShow: 4,
        dots: false,
        arrows: true,
        responsive: [{
            breakpoint: 1600,
            settings: {
                slidesToShow: 3,
            }
        }, {
            breakpoint: 1200,
            settings: {
                slidesToShow: 3,
            }
        }, {
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
            }
        }]
    });
    var width = $(window).width();
    if( width < 992 ) {

        $(".aside__items").slick({
            infinite: true,
            slidesToShow: 2,
            slidesToScroll: 1,
            arrows: true,
            dots: false,
            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 3,
                    }
                }, {
                    breakpoint: 567,
                    settings: {
                        slidesToShow: 2,
                    }
                }]
        });
    }
})
