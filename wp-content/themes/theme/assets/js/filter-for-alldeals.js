/**
 *
 *
 *
 ****************** ПРЕЖДЕ ЧЕМ ПЕРЕДЕЛЫВАТЬ СКРИПТ ИЗУЧИТЕ ПОЛНОСТЬЮ ОПИСАНИЕ *************************************
 *************** И НЕ ЗАБУДЬТЕ ПРИ НАПИСАНИИ НОВОГО СКРИПТА ОСТАВИТЬ КОММЕНТАРИЙ **********************************
 *
 *
 *
 */



/**
 *
 * Прелоадер
 *
 */
function preloader(){
    $('.preloader').animate({
        opacity: 0
    }, 300 , function(){
        $('.preloader').remove();
    })
}



$(document).ready(function(){

    /**
     *
     * @param page           Передача числа страницы по которой будут загружаться купоны
     * @param nameOrder      Название по которой будет проходить сортировка (data,vievs_click,name)
     * @param cat            Передача названия таксономии товара
     * @param tax_slug       Передача названия категории товара
     * @param cat_shop       Передача названия таксономии магазина товара
     * @param tax_slug_shop  Передача название магазина товара
     * @param searchName     Слово из страницы поиска по которому и будет проходить фильтр
     *
     */
    let args = {
        page: '' ,
        nameOrder: '',
        cat: '' ,
        tax_slug: '',
        cat_shop: '',
        tax_slug_shop: '',
        searchName: ''
    };

    /**
     *
     * Функция для ajax запроса (получение данных и вывод на сайт)
     *
     * @param args
     */
    function ajax_scroll( args ){
        // console.log( args );

        $.ajax('/riza/wp-content/themes/theme/server/filter-views-discount.php', {
            method: 'POST',
            data: {
                'filterName':    args.nameOrder,
                'page':          args.page,
                'cat':           args.cat,
                'tax_slug':      args.tax_slug,
                'cat_shop':      args.cat_shop,
                'tax_slug_shop': args.tax_slug_shop,
                'searchName':    args.searchName
            },
            /**
             *
             * Получаем данные с сервера в формате JSON
             *
             */
            dataType: "json",
            success: function (data) {
                // console.log(data);
                preloader();

                /**
                 *
                 * Поставил условие если длина JSON не равен нулю ( тоесть не пустой ) то выполни цикл
                 *
                 */
                if(data !== null) {
                    data.forEach(i => {
                        /**
                         *
                         * Это шаблон который создаётся в конце в div с классом (deals__content products__list) который находится в файле template-deals.php
                         * Заметьте что в шаблоне есть класс clone__pattern который будет удалятся когда шаблон полностью заполнится
                         *
                         */
                        $('.deals__content .products__list').append('<div class="product__card clone__pattern views-click" product-id="" views-click=""> <div class="product__medium"> <div class="beauty_border"> <a href="#" class="action_fav" style="height: 20px; margin-top: 0; background:none" data-id=""> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" viewBox="0 0 12 14" fill="none"> <path d="M9.23333 12.84L6.1 10.1533C5.85333 9.94 5.48 9.94 5.23333 10.1533L2.1 12.84C1.66667 13.2133 1 12.9067 1 12.3333V1.66667C1 1.3 1.3 1 1.66667 1H9.66667C10.0333 1 10.3333 1.3 10.3333 1.66667V12.3333C10.3333 12.9 9.66667 13.2133 9.23333 12.84Z" stroke="#A5ABB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg></a></div><a href="" class="product__card-a view_click"><img src="" alt="" class="product__card-a__img"></a><div class="hidden_mobile"></div></div><div class="product__desc"><div class="hidden_mobile"><div class="product__published"></div><div class="shop_icon"><a href=""><img src="" alt="" class="product__card-shop_icon__img"><span></span></a></div><h2 class="product__title"><a href="" class="product__card-a view_click"></a></h2><div class="content_card"></div></div><div class="hidden_pc"><div class="product__published"></div><div class="product__title"><a href="" class="product__card-a view_click"></a></div><div class="shop_icon"><a href=""><img src="" alt=""><span></span></a></div></div><div class="product__buttons"><div class="" style="display: inline-flex; align-items: center"><div id="alert_promo__message"></div></div><div class="product__actions"><a href="" target="_blank" class="btn">SHOP NOW</a><div class="product__author"></div></div></div></div></div>');


                        /**
                         *
                         * Здесь начинается заполнение шаблона
                         *
                         */
                        $('.product__card.clone__pattern').attr('product-id', i.id);
                        $('.product__card.clone__pattern .product__title .product__card-a').html(i.title);
                        $('.product__card.clone__pattern .content_card').html(i.content);
                        $('.product__card.clone__pattern').attr('views-click', i.views_click);
                        $('.product__card.clone__pattern .action_fav').attr('data-id', i.id);
                        $('.product__card.clone__pattern .product__card-a ').attr('href', i.link);
                        if (i.img_url.length > 0) {
                            $('.product__card.clone__pattern .product__card-a img').attr('src', i.img_url);
                            $('.product__card.clone__pattern .product__card-a img').attr('alt', i.title);
                        }
                        $('.product__card.clone__pattern .hidden_mobile .product__published ').html(i.published_date);
                        $('.product__card.clone__pattern .hidden_pc .product__published ').html('Published ' + i.published_date);
                        $('.product__card.clone__pattern .product__desc > .hidden_mobile').append(i.price);
                        $('.product__card.clone__pattern .product__desc > .hidden_pc').prepend(i.price);
                        $('.product__card.clone__pattern .shop_icon a').attr('src', 'https://discount.one/categories-shops/' + i.term_slug);
                        $('.product__card.clone__pattern .hidden_mobile .shop_icon a span').append(' | ' + i.term_name + '');
                        $('.product__card.clone__pattern .shop_icon a img').attr('src', i.icon);
                        if (i.promocode != undefined) {
                            $('.product__card.clone__pattern .product__actions .btn').attr('src', i.link);
                        } else if (i.link_2 != undefined) {
                            $('.product__card.clone__pattern .product__actions .btn').attr('src', i.link_2);
                        }
                        if (i.promocode != undefined) {
                            $('.product__card.clone__pattern .product__author ').html('<div class="product__promocode"><span style="display: none">' + i.promocode + '</span><div class="socials"><span data-val="' + i.promocode + '" class="action_copy"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none"> <path d="M10 2H3.33333C2.59695 2 2 2.59695 2 3.33333V10C2 10.7364 2.59695 11.3333 3.33333 11.3333H10C10.7364 11.3333 11.3333 10.7364 11.3333 10V3.33333C11.3333 2.59695 10.7364 2 10 2Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path d="M13.9993 4.66663V12C13.9993 13.1066 13.106 14 11.9993 14H4.66602" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span></div></div>');
                        }
                        /**
                         * Здесь заканчивается заполнение шаблона
                         */



                        /**
                         *
                         * Как я говорил в конце заполнения удаляется класс clone__pattern и в итоге получается чисто карточка как и другие
                         *
                         */
                        $('.product__card.clone__pattern').removeClass('clone__pattern');


                    });


                    /**
                     *
                     * включаем скролл
                     *
                     */
                    startScroll = true;
                    console.log('включаем скролл');

                }
                else if(data == null && args.page == 1){
                    /**
                     *
                     * Показываю что товаров нет
                     * отключаем скролл так как ничего не пришло
                     *
                     */
                    startScroll = false;
                    console.log('не включаем скролл');
                    $('.deals__content .products__list').append('<div className="product__card views-click">Deals not found. Try other filter settings.</div>');
                }
                else{
                    /**
                     *
                     * отключаем скролл так как ничего не пришло
                     *
                     */
                    startScroll = false;
                    console.log('не включаем скролл');
                }

            },
            error: function (jqXHR, exception) {
                preloader()
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                console.log(msg);
            }
        });
    }
    /**
     * КОНЕЦ Функция для ajax запроса
     */


    /**
     *
     * Данные из вильтров которые будут стоять по умолчанию
     *
     */
    args.page = 1;
    args.nameOrder     = "views-size";
    args.cat           = $(this).find('.filter-blockDeals__header-and-body#cat .filter-blockDeals__header').attr('tax-cat');
    args.tax_slug      = $(this).find('.filter-blockDeals__header-and-body#cat .filter-blockDeals__header').attr('data-filter-cat');
    args.cat_shop      = $(this).find('.filter-blockDeals__header-and-body#cat_shop .filter-blockDeals__header').attr('tax-cat');
    args.tax_slug_shop = $(this).find('.filter-blockDeals__header-and-body#cat_shop .filter-blockDeals__header').attr('data-filter-cat');
    args.searchName    = $(this).find('h1').attr('name');
    // let nameOrder = $('.filter-blockDeals__header-and-body#views-size .filter-blockDeals__header').attr('data-filter');
    // console.log(args.searchName);

    /**
     *
     * startScroll создан для того чтобы включать и отключать скролл, к примеру по AJAX запросу ничего не пришло,
     * значит надо вырубить скролл чтобы не перегружать сервер, потому что идёт отправка данных на сервер
     *
     */
    let startScroll = true;


    /**
     *
     * Скрипт для работы скролла , чтоб выполнялась загрузка при скролле
     *
     */
    let dealContentHeightTop = $('.deals__content .products__list').offset().top;
    var dealContentHeight = $('.deals__content .products__list').height();
    $(window).scroll(function(){
        let totalDealContentHeight = dealContentHeightTop + dealContentHeight;
        let scrollHeight = $(window).scrollTop() + $(window).height();
        if( scrollHeight > totalDealContentHeight - 1000) {
            args.page++;
            var promise = new Promise((resolve) => resolve(1));
            promise.then( function f3() {
                dealContentHeight = dealContentHeight + ($('.product__card').height() * 10);
            })
            promise.then( function f1() {
                if(startScroll == true){
                    ajax_scroll( args );
                }

            })

            promise.then( function f2() {
                setTimeout(() => {
                    dealContentHeight = $('.deals__content .products__list').height();
                },500);
            })
        }
    })
    /**
     * КОНЕЦ Скрипт для работы скролла , чтоб выполнялась загрузка при скролле
     */



    /**
     *
     * Работа кнопок фильтра на странице All deals
     *
     */
    $('.filter-blockDeals__header').click(function(){
        $(this).parents('.filter-blockDeals__header-and-body').find('.filter-blockDeals__body').toggle();
        if($(this).parents('.filter-blockDeals__header-and-body').find('.filter-blockDeals__body').css('display') == 'none'){
            $(this).parents('.filter-blockDeals__header-and-body').removeClass('active');
        }else{
            $(this).parents('.filter-blockDeals__header-and-body').addClass('active');
        }
    })



    /**
     *
     * При нажатии в фильтре по просмотрам и размеру скидок
     *
     */
    $('.filter-blockDeals__header-and-body#views-size .filter-blockDeals__item').click(function(){
        $(this).parents('.filter-blockDeals__header-and-body').find('.filter-blockDeals__header').html($(this).html());
        $(this).parents('.filter-blockDeals__header-and-body').find('.filter-blockDeals__header').attr('data-filter', $(this).attr('data-filter'));
        $(this).parents('.filter-blockDeals__header-and-body').removeClass('active');
        $(this).parents('.filter-blockDeals__header-and-body').find('.filter-blockDeals__body').toggle();
        args.nameOrder = $(this).attr('data-filter');
        total_ajax_scroll(args);
    })



    /**
     *
     * При выборе в фильтре категории
     *
     */
    $('.filter-blockDeals__header-and-body#cat .filter-blockDeals__item').click(function(){
        $(this).parents('.filter-blockDeals__header-and-body').find('.filter-blockDeals__header').html($(this).html());
        $(this).parents('.filter-blockDeals__header-and-body').find('.filter-blockDeals__header').attr('data-filter-cat', $(this).attr('data-filter-cat'));
        $(this).parents('.filter-blockDeals__header-and-body').find('.filter-blockDeals__header').attr('tax-cat', $(this).attr('tax-cat'));
        $(this).parents('.filter-blockDeals__header-and-body').removeClass('active');
        $(this).parents('.filter-blockDeals__header-and-body').find('.filter-blockDeals__body').toggle();
        args.cat = $(this).attr('data-filter-cat');
        args.tax_slug = $(this).attr('tax-cat');
        total_ajax_scroll(args);
    })



    /**
     *
     * При выборе в фильтре  магазина
     *
     */
    $('.filter-blockDeals__header-and-body#cat_shop .filter-blockDeals__item').click(function(){
        $(this).parents('.filter-blockDeals__header-and-body').find('.filter-blockDeals__header').html($(this).html());
        $(this).parents('.filter-blockDeals__header-and-body').find('.filter-blockDeals__header').attr('data-filter-cat', $(this).attr('data-filter-cat'));
        $(this).parents('.filter-blockDeals__header-and-body').find('.filter-blockDeals__header').attr('tax-cat', $(this).attr('tax-cat'));
        $(this).parents('.filter-blockDeals__header-and-body').removeClass('active');
        $(this).parents('.filter-blockDeals__header-and-body').find('.filter-blockDeals__body').toggle();
        args.cat_shop = $(this).attr('data-filter-cat');
        args.tax_slug_shop = $(this).attr('tax-cat');
        total_ajax_scroll(args);
    })



    /**
     *
     * Все данные по всем фильтрам приходят сюда и отправлятся ajax запросом на сервер
     *
     */
    function total_ajax_scroll
    ( args ){
        args.page = 1;
        $('.poroduct__list_all_deals').html('<div class="preloader"><img src="/wp-content/themes/theme/images/preloader.gif" alt=""></div> ');
        ajax_scroll(args);
        dealContentHeight = $('.deals__content .products__list').height();

    }




    /**
     *
     * Когда вы нажимаете не по фильтру, срабатывает эта функция, которая закрывает фильтр
     *
     */
    $("body").mouseup( function(e){ // событие клика по веб-документу
        var div = $( ".filter-blockDeals__header-and-body" ); // тут указываем ID элемента
        if ( !div.is(e.target) // если клик был не по нашему блоку
            && div.has(e.target).length === 0 ) { // и не по его дочерним элементам
            $('.filter-blockDeals__body').hide();
            $('.filter-blockDeals__header-and-body').removeClass('active');
        }
    });
    $('.deals__aside .aside__items').each(function(index){
        // console.log(index);
        $(this).find('.filter-blockDeals__header-and-body').css('z-index', (1000 - index));
    })
    /**
     * конец Работа кнопок фильтра на странице All deals
     */
});