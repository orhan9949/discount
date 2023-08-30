$(document).ready(function(){


    // Передача информации о товаре в Аналитику dataLayer
    let data_analitics = $('.data_analitics');
    dataLayer.push({
        event: 'view_item', /// не изменяется,
        ecommerce: {
            currency: 'IDR',  /// Indian Rupee, постоянная величина
            value: data_analitics.attr('new-price'), /// передаем стоимость продукта
            items: [
                {
                    item_id: data_analitics.attr('item_id'), //// передаем идентификатор продукта, если имеется;
                    item_name: data_analitics.attr('item_name'), //// передаем название продукта
                    affiliation: data_analitics.attr('affiliation'), /// передаем название кампании-партнера: Amazon, Ekaro, ExtraPet
                    item_brand: data_analitics.attr('item_brand'), /// передаем магазины продуктов: Amazon, Boat и др.
                    item_category: data_analitics.attr('item_category'), /// передаем категорию продуктов: Fashion, Travel, Pets и др.
                    item_list_name: data_analitics.attr('item_list_name'), /// передаем значение того как пользователь нашел продукт: Categories, Shops, Coupons, Daily Tops
                    price: data_analitics.attr('price'), /// передаем стоимость продукта
                    quantity: 1 /// передаем количество; в нашем случае всегда равна 1
                }
            ]
        }
    });





    $('.aside__items > div:nth-child(6)').remove();
    setTimeout(() => {
        if($('body div').hasClass('product_mySwiper__slider')){
            if ($(window).width() <= 450 ){
                var product_mySwiper__slider_mobile = new Swiper(".product_mySwiper__slider", {
                    pagination: {
                        el: ".swiper-pagination",
                        dynamicBullets: true,
                    },
                });
            }else{
                var product_mySwiper__slider = new Swiper(".product_mySwiper__slider", {
                    direction: "vertical",
                    slidesPerView: 3,
                    spaceBetween: 5,
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },
                    navigation: {
                        nextEl: ".swiper-button-n",
                        prevEl: ".swiper-button-p",
                    },
                    breakpoints: {
                        768: {
                            slidesPerView: 3,
                            spaceBetween: 8,
                        }
                    }
                });
            }
        }
        $(".product_mySwiper__slider .swiper-slide").hover(
            function(){
                $(".product_mySwiper__slider .swiper-slide").removeClass("active");
                $(this).addClass("active");
                $('.product__slider-img img').attr('src',$(this).find('img').attr('src'));
            },
        );
    },100)


    $(".products-4x").slick({
        infinite: true,
        slidesToScroll: 1,
        slidesToShow: 4,
        dots: false,
        arrows: true,
        responsive: [
            {
                breakpoint: 1600,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
            breakpoint: 1200,
            settings: {
                slidesToShow: 3,
            }
        }, {
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

