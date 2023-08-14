$(document).ready(function(){
    /**
     *
     *
     * Сбор кликов при нажатии на .views_click который поставлен на каждую запись
     *
     */
    $(document).on('click' , '.views_click', function(){
        // e.preventDefault();
        //отправка id поста на сервер
        let post = $(this).attr('product-id');
        $.ajax( '/riza/wp-content/themes/theme/server/views.php', {
            method: 'post',
            data: {
                "post": post
            },
            datatype: "html",
            success: function (data) {
                // console.log(data);
            },
            error: function (error) {
                console.log(error);
            }
        });
        console.log(post);
    })
    /**
     * КОНЕЦ
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
        slug: '',
        page: ''
    };

    /**
     *
     * Функция для ajax запроса (получение данных и вывод на сайт)
     *
     * @param args
     */
    function ajax_scroll( args ){
        // console.log( args );

        $.ajax('/riza/wp-content/themes/theme/server/filter-blog.php', {
            method: 'POST',
            data: {
                'slug':          args.slug,
                'page':          args.page,
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
                        $('.posts .products__list').append('<div class="product__card clone__pattern views-click post__item" views-click=""><div class="product__medium"><a href="" class="product__card-a views_click" product-id=""><img src="" alt="" class="product__card-a__img"><div class="product__medium-viewed">Viewed</div></a></div><div class="product__desc"><div><div class="product__published"></div><h2 class="product__title"><a href="" class="product__card-a views_click" product-id=""></a></h2><div class="content_card"></div></div><div class="product__buttons"></div></div></div>');


                        /**
                         *
                         * Здесь начинается заполнение шаблона
                         *
                         */
                        $('.product__card.clone__pattern .product__card-a').attr('product-id', i.id);
                        $('.product__card.clone__pattern .product__title .product__card-a').html(i.title);
                        $('.product__card.clone__pattern').attr('views-click', i.views_click);
                        $('.product__card.clone__pattern .product__card-a ').attr('href', i.link);
                        if (i.img_url.length > 0) {
                            $('.product__card.clone__pattern .product__card-a img').attr('src', i.img_url);
                            $('.product__card.clone__pattern .product__card-a img').attr('alt', i.title);
                        }
                        $('.product__card.clone__pattern .product__published ').html(i.published_date);

                        if(i.cat !== undefined){
                            for(let c of i.cat){
                                $('.product__card.clone__pattern .product__buttons').append('<a class="product__btn" slug="'+ c.slug +'">'+ c.name+'</a>');
                            }
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
                    // console.log('включаем скролл');

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
                    $('.deals__content .products__list').append('<div className="product__card views-click">Deals not found. Try other filter settings.</div>');
                }
                else{
                    /**
                     *
                     * отключаем скролл так как ничего не пришло
                     *
                     */
                    startScroll = false;
                    // console.log('не включаем скролл');
                }
                dealContentHeight = $('.posts .products__list').height();
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
    $('.posts-filter .posts-filter__item:first-child').addClass('active');
    args.slug = $('.posts-filter .posts-filter__item.active').attr('slug');


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
    let dealContentHeightTop = $('.posts .products__list').offset().top;
    var dealContentHeight = $('.posts .products__list').height();
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
                    dealContentHeight = $('.posts .products__list').height();
                },500);
            })
        }
    })
    /**
     * КОНЕЦ Скрипт для работы скролла , чтоб выполнялась загрузка при скролле
     */




    $('.posts-filter__item').click(function(){
        $('.posts-filter__item').removeClass('active');
        $(this).addClass('active');
        $('.poroduct__list_all_deals').html('<div class="preloader"><img src="/wp-content/themes/theme/images/preloader.gif" alt=""></div> ');
        args.page = 1;
        args.slug = $(this).attr('slug');
        ajax_scroll( args );
    })


})


