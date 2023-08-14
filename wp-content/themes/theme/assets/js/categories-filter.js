$(document).ready(function(){
    /**
     *
     * кнопка фильтра который Sort by
     *
     */
    $('.filter-sort__name').click(function(){
        if(!$(this).parent().find('.filter-sort__sort').hasClass('active')){
            $(this).parent().find('.filter-sort__sort').addClass('active');
            $(this).parent().addClass('active');
            let filter_sort__labels_Height = $(this).parent().find('.filter-sort__sort .filter-sort__labels').height();
            $(this).parent().find('.filter-sort__sort').animate({
                height: filter_sort__labels_Height
            },100,function(){
                $(this).parent().find('.filter-sort__sort .filter-sort__labels label').animate({
                    opacity: 1
                },100);
            });
        }else{
            $(this).parent().find('.filter-sort__sort .filter-sort__labels label').animate({
                opacity: 0
            },100,function(){
                setTimeout(() => {
                    $(this).parents('.filter-sort__sort').animate({
                        height: 0
                    },100);
                },200)
            });
            $(this).parent().find('.filter-sort__sort').removeClass('active');
            $(this).parent().removeClass('active');
        }

    })





    /**
     *
     * Функция в Sort by которая срабатывает при наведении
     *
     */
    $(".filter-sort__sort label input").hover(
        function(){
            $(this).parent().addClass("hover");
        },
        function(){
            $(this).parent().removeClass("hover");
        }
    );





    /**
     *
     * Функции открывание и закрывание фильтров в адаптиве до 992 пикселей
     *
     */
    if($(window).width() <= 992){
        $('.filter__price_name').click(function(){
            $(this).parent().find('.filter__price_block').css('display','flex');
        })
        $('.filter__discount_name').click(function(){
            $(this).parent().find('.filter__discount_block').css('display','flex');
        })
        $('.filter__discount_block-exit').click(function(){
            $(this).parents('.filter__discount_block').hide();
        })
        $('.filter__discount_block-exit').click(function(){
            $(this).parents('.filter__price_block').hide();
        })

    }




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




    /**
     *
     * @param page           Передача числа страницы по которой будут загружаться купоны
     * @param sortBy         Название по которой будет проходить сортировка (data,vievs_click,name)
     * @param sort           Передача сортировки(ASC, DESC)
     * @param cat            Передача таксономии(Categories, Categories-shops)
     * @param tax_slug       Передача названия слага магазина товара или категории
     * @param priceFrom      Передача цены от
     * @param priceTo        Передача цены до
     * @param discountFrom   Передача скидки от
     * @param discountTo     Передача скидки до
     *
     */
    let args = {
        page: '' ,
        sortBy: '',
        sort: '',
        cat: '',
        tax_slug: '',
        priceFrom: '',
        priceTo: '',
        discountFrom: '',
        discountTo: '',
    };

    /**
     *
     * Функция для ajax запроса (получение данных и вывод на сайт)
     *
     * @param args
     */
    function ajax_scroll( args ){
        if(args.sortBy === ''){
            args.sortBy = 'date';
        }
        if(args.sort === ''){
            args.sort = 'DESC';
        }
        if(args.priceFrom === ''){
            args.priceFrom = 1;
        }
        if(args.discountFrom === ''){
            args.discountFrom = 1;
        }
        if(args.priceTo === ''){
            args.priceTo = 100000000000;
        }
        if(args.discountTo === ''){
            args.discountTo = 1000000000;
        }
        console.log( args );

        $.ajax('/riza/wp-content/themes/theme/server/cat-filter.php', {
            method: 'POST',
            data: {
                'page':          args.page,
                'sortBy':        args.sortBy,
                'sort':          args.sort,
                'cat':           args.cat,
                'tax_slug':      args.tax_slug,
                'priceFrom':     args.priceFrom,
                'priceTo':       args.priceTo,
                'discountFrom':  args.discountFrom,
                'discountTo':    args.discountTo,
            },
            /**
             *
             * Получаем данные с сервера в формате JSON
             *
             */
            dataType: "json",
            success: function (data) {
                console.log(data);
                preloader();
                console.log(Number(args.priceFrom) < Number(args.priceTo));
                console.log(Number(args.discountFrom) < Number(args.discountTo));

                /**
                 *
                 * Поставил условие если длина JSON не равен нулю ( тоесть не пустой ) то выполни цикл
                 * также использую args.priceFrom < args.priceTo и args.discountFrom < args.discountTo
                 * чтобы цена от была больше цены до так и по скидкам, если вдруг клиент наберёт в инпуте наоборот чтоб ничего не выводил
                 *
                 */
                if(data !== null
                    && Number(args.priceFrom) < Number(args.priceTo) && Number(args.discountFrom) < Number(args.discountTo)
                ) {
                    data.forEach(i => {
                        $('.deals__content .products__list .product__card.deals-not-found').detach();
                        /**
                         *
                         * Это шаблон который создаётся в конце в div с классом (deals__content products__list) который находится в файле template-deals.php
                         * Заметьте что в шаблоне есть класс clone__pattern который будет удалятся когда шаблон полностью заполнится
                         *
                         */
                        $('.deals__content .products__list').append('<div class="product__card clone__pattern views-click" date="" product-id="" views-click=""> <div class="product__medium"> <div class="beauty_border"> <a href="#" class="action_fav" style="height: 20px; margin-top: 0; background:none" data-id=""> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" viewBox="0 0 12 14" fill="none"> <path d="M9.23333 12.84L6.1 10.1533C5.85333 9.94 5.48 9.94 5.23333 10.1533L2.1 12.84C1.66667 13.2133 1 12.9067 1 12.3333V1.66667C1 1.3 1.3 1 1.66667 1H9.66667C10.0333 1 10.3333 1.3 10.3333 1.66667V12.3333C10.3333 12.9 9.66667 13.2133 9.23333 12.84Z" stroke="#A5ABB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg></a></div><a href="" class="product__card-a view_click"><img src="" alt="" class="product__card-a__img"></a><div class="hidden_mobile"></div></div><div class="product__desc"><div class="hidden_mobile"><div class="product__published"></div><div class="shop_icon"><a href=""><img src="" alt="" class="product__card-shop_icon__img"></a></div><h2 class="product__title"><a href="" class="product__card-a view_click"></a></h2><div class="content_card"></div></div><div class="hidden_pc"><div class="product__published"></div><div class="product__title"><a href="" class="product__card-a view_click"></a></div><div class="shop_icon"><a href=""><img src="" alt=""></a></div></div><div class="product__buttons"><div class="" style="display: inline-flex; align-items: center"><div id="alert_promo__message"></div></div><div class="product__actions"><a href="" target="_blank" class="btn">SHOP NOW</a><div class="product__author"></div></div></div></div></div>');


                        /**
                         *
                         * Здесь начинается заполнение шаблона
                         *
                         */
                        $('.product__card.clone__pattern').attr('product-id', i.id);
                        $('.product__card.clone__pattern .product__title .product__card-a').html(i.title);
                        $('.product__card.clone__pattern .content_card').html(i.content);
                        $('.product__card.clone__pattern').attr('views-click', i.views_click);
                        $('.product__card.clone__pattern').attr('date', i.published_date);
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
                        $('.product__card.clone__pattern .hidden_mobile .shop_icon a').append(' | ' + i.term_name + '');
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
                    // console.log('не включаем скролл');
                    $('.poroduct__list_all_deals').html('');
                    $('.deals__content .products__list').append('<div className="product__card deals-not-found views-click">Deals not found. Try other filter settings.</div>');
                    console.log('Зашёл сюда');
                }
                else{
                    /**
                     *
                     * отключаем скролл так как ничего не пришло
                     *
                     */
                    startScroll = false;
                    // console.log('не включаем скролл');
                    console.log('Зашёл сюда1');
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
    args.page          = 1;
    args.sortBy        = "";
    args.sort          = "";
    args.cat           = $('.filter').attr('data-cat');
    args.tax_slug      = $('.filter').attr('data-filter-cat');
    args.priceFrom     = "";
    args.priceTo       = "";
    args.discountFrom  = "";
    args.discountTo    = "";

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


    $('.filter-sort__labels_items input').click(function(){
        $('.filter-sort__labels_items input').parent().removeClass('active');
        $('.filter-sort__name').parent().find('.filter-sort__sort .filter-sort__labels label').animate({
            opacity: 0
        },100,function(){
            setTimeout(() => {
                $(this).parents('.filter-sort__sort').animate({
                    height: 0
                },100);
            },200)
        });
        $('.filter-sort__name').parent().find('.filter-sort__sort').removeClass('active');
        $('.filter-sort__name').parent().removeClass('active');
        $(this).parent().addClass('active');
        args.sortBy = $(this).val();
        args.sort = $(this).attr('sort');
        $('.poroduct__list_all_deals').html('');
        total_ajax_scroll(args);

    })





    /**
     *
     * filter_price_discount__input - это инпуты с диапазонами цен и скидок
     * если ширина окна больше 992 пикселей то сортировка срабатывает при наборе цифр
     * если ширина меньше то при клике на кнопку с классом filter__discount_inputs-footer-btn
     *
     */
    let filter_price_discount__input = $('.filter-price-discount__input');
    if($(window).width() <= 992){
        $('.filter__discount_inputs-footer-btn').click(function(){
            args.priceFrom     = filter_price_discount__input.parent().find('#price-from').val();
            args.priceTo       = filter_price_discount__input.parent().find('#price-to').val();
            args.discountFrom  = filter_price_discount__input.parent().find('#discount-from').val();
            args.discountTo    = filter_price_discount__input.parent().find('#discount-to').val();
            $('.poroduct__list_all_deals').html('');
            total_ajax_scroll(args);
            $(this).parents('.filter__discount_block').hide();
            $(this).parents('.filter__price_block').hide();
        })
        /**
         *
         * Когда вы нажимаете не по фильтру, срабатывает эта функция, которая закрывает фильтр
         *
         */
        $("body").mouseup( function(e){ // событие клика по веб-документу
            var div = $( ".filter__discount_list" ); // тут указываем ID элемента
            if ( !div.is(e.target) // если клик был не по нашему блоку
                && div.has(e.target).length === 0 ) { // и не по его дочерним элементам
                $('.filter__discount_block').hide();
                $('.filter__price_block').hide();
            }
        });
    }else{
        /**
         * @name priceFrom
         * @name priceTo
         * @name discountFrom
         * @name discountTo
         * эти @name сделаны для условия сверки, то-есть при наборе в инпуте с каждым нажатием происходит запрос на сервер
         * и чтобы уменьшить запрос и сделать только один запрос то я поставил срабатывание функции total_ajax_scroll(args)
         * в setTimeout на 1секунду(тоесть за секунду человек что-то уже наберёт)
         * и поставил условие, что если args.priceFrom != priceFrom и тд. не равны то сработай и присвой priceFrom = args.priceFrom
         *
         */
        let priceFrom, priceTo, discountFrom ,discountTo;
        filter_price_discount__input.keyup(function() {
            args.priceFrom     = filter_price_discount__input.parent().find('#price-from').val();
            args.priceTo       = filter_price_discount__input.parent().find('#price-to').val();
            args.discountFrom  = filter_price_discount__input.parent().find('#discount-from').val();
            args.discountTo    = filter_price_discount__input.parent().find('#discount-to').val();
            setTimeout(()=>{
                if(
                    args.priceFrom     != priceFrom ||
                    args.priceTo       != priceTo ||
                    args.discountFrom  != discountFrom ||
                    args.discountTo    != discountTo
                ){
                    $('.poroduct__list_all_deals').html('');
                    total_ajax_scroll(args);
                    priceFrom = args.priceFrom;
                    priceTo = args.priceTo ;
                    discountFrom = args.discountFrom;
                    discountTo = args.discountTo;
                }
            },1000)
        });

    }



    /**
     *
     * filter__submit - при нажатии на кнопку Trow off идёт сброс данных
     *
     */
    $('.filter__submit').click(function(){
        args.page = 1;
        args.sortBy        = "date";
        args.cat           = $('.filter').attr('data-cat');
        args.tax_slug      = $('.filter').attr('data-filter-cat');
        args.priceFrom     = "";
        args.priceTo       = "";
        args.discountFrom  = "";
        args.discountTo    = "";
        $('.filter-price-discount .filter__discount_list input').val('');
        $('.poroduct__list_all_deals').html('');
        total_ajax_scroll(args);
        $('.filter-sort__labels_items input').parent().removeClass('active');
        $(this).parents('.filter__discount_block').hide();
        $(this).parents('.filter__price_block').hide();
    })
})