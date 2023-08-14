<?php
/**
 * Template Name: Главная страница
 */
get_header();
?>
<main class="" id="item_list_name" item_list_name="home">
    <?php
    $object_json_link = file_get_contents(get_template_directory() .'/array-page/home/object.json');
    $object_json = json_decode($object_json_link, true);
    $new_arr = [];
    $new_arr["slider_1"] = $object_json[0]["slider_1"];
    $new_arr["slider_2"] = $object_json[1]["slider_2"];
    $new_arr["slider_3"] = $object_json[2]["slider_3"];
    $new_arr["best_deals"] = $object_json[3]["best_deals"];
    $new_arr["cat_with_posts"] = $object_json[4]["cat_with_posts"];
    $new_arr["shops"] = $object_json[5]["shops"];
    $obj =  (object)$new_arr;
    //    echo '<pre>';
    //    var_dump($obj->slider_1);
    //    echo '</pre>';
    ?>
    <section class="sliders container">
        <div class="sliders__big">
            <?php if( !empty($obj->slider_1) ): ?>
                <div class="slider-full">
                    <?php foreach( $obj->slider_1 as $row ): ?>
                        <div>
                            <div class="slider__item" >
                                <a href="<?php echo $row["link"]; ?>" id="click_products">
                                    <?php if( !empty($row["image_link"]) ): ?>
                                        <div class="slider__image"><img src="<?php echo $row["image_link"]; ?>" alt=""></div>
                                    <?php endif; ?>
                                    <div class="slider__body">
                                        <div class="slider__text">
                                            <!--                                                <small>--><?php //echo $row['title']; ?><!--</small>-->
                                            <!--                                                <span>--><?php //echo $row['caption']; ?><!--</span>-->
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php  endif; ?>
        </div>
        <div class="sliders__small">
            <?php if( !empty($obj->slider_2) ){ ?>
                <div class="slider-short">
                    <?php foreach( $obj->slider_2 as $row ): ?>
                        <div>
                            <div class="slider__item">
                                <a href="<?php echo $row["link"]; ?>" id="click_products">
                                    <?php if( !empty($row["image_link"]) ): ?>
                                        <div class="slider__image"><img src="<?php echo $row["image_link"]; ?>" alt=""></div>
                                    <?php endif; ?>
                                    <div class="slider__body">
                                        <div class="slider__text">
                                            <!--                                                <small>--><?php //echo $row['title']; ?><!--</small>-->
                                            <!--                                                <span>--><?php //echo $row['caption']; ?><!--</span>-->
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php } ?>
        </div>

        <div class="sliders__mobile">
            <?php if( !empty($obj->slider_3) ): ?>
                <div class="slider-short">
                    <?php foreach( $obj->slider_3 as $row ): ?>
                        <div>
                            <div class="slider__item">
                                <a href="<?php echo $row["link"]; ?>" id="click_products">
                                    <?php if( !empty($row["image_link"]) ): ?>
                                        <div class="slider__image"><img src="<?php echo $row["image_link"]; ?>" alt=""></div>
                                    <?php endif; ?>
                                    <div class="slider__body">
                                        <div class="slider__text">
                                            <!--                                                <small>--><?php //echo $row['title']; ?><!--</small>-->
                                            <!--                                                <span>--><?php //echo $row['caption']; ?><!--</span>-->
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <section class="home_cat_slider-section container">
        <div class="swiper-butt-prev">
            <svg width="6" height="13" viewBox="0 0 6 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 1L1.09337 6.20046C1.06377 6.23976 1.04029 6.28645 1.02427 6.33785C1.00825 6.38925 1 6.44435 1 6.5C1 6.55565 1.00825 6.61075 1.02427 6.66215C1.04029 6.71355 1.06377 6.76024 1.09337 6.79954L5 12"  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <div class="swiper home_cat_slider">
            <div class="swiper-wrapper">
                <?php
                foreach ($obj->shops as $shop) { ?>
                    <div class="swiper-slide">
                        <a href="<?php echo $shop['url']; ?>" count="<?php echo $shop['count']; ?>">
                            <img src="<?php  echo $shop['image_url']; ?>" alt="">
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="swiper-butt-next">
            <svg width="6" height="13" viewBox="0 0 6 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 1L4.90663 6.20046C4.93623 6.23976 4.95971 6.28645 4.97573 6.33785C4.99175 6.38925 5 6.44435 5 6.5C5 6.55565 4.99175 6.61075 4.97573 6.66215C4.95971 6.71355 4.93623 6.76024 4.90663 6.79954L1 12"  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
    </section>
    <?php foreach ($obj->best_deals as $sliders){?>
        <section class="best_deals container">
            <div>
                <a href="<?php echo $sliders["url_more"]; ?>">
                    <h2 style="display: flex; justify-content: space-between;align-items: baseline;"><?php echo $sliders["category_name"]; ?> <span class="show_more_main">More Deals</span></h2>

                </a>
            </div>
            <div class="products">
                <?php foreach( $sliders["post"] as $item ): ?>
                    <div>
                        <div class="product__item views-click" product-id="<?php echo $item["id"]; ?>" views-click="<?php echo $item["views_click"]; ?>">
                            <div class="product__thumb">
                                <?php if( $item["image_url"] ): ?>
                                    <a href="<?php echo $item["permalink"]; ?>" class="view_click" id="click_products">
                                        <img src="<?php echo $item["image_url"]; ?>" alt="<?=$item["post_title"]; ?>">
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div style="margin-left: 10px;">
                                <div class="product__price">
                            <span style="text-decoration-line: line-through; margin-right: 10px">
                                 <?php echo '₹ '.$item["old_price"]; ?>
                            </span><?php echo '₹ '.$item["price"] ; ?><?php echo '('. $item["sale_size"] .'%)'; ?>
                                </div>
                            </div>
                            <div class="product__name_compact">
                                <a href="<?php echo $item["permalink"]; ?>" class="view_click" id="click_products">
                                    <?php echo $item["post_title"]; ?>
                                </a>
                            </div>
                            <div class="exp_time_compact">
                                <div class= shop_icon_single_compact>
                                    <a href="../../categories-shops/<?php echo $item["shop_slug"] ?>">
                                        <img src="<?php echo $item["shop_image_url"]; ?>">
                                        <span> | <?php echo $item["shop_name"];?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php } ?>
    <div class="quare-code">
<!--        <div class="quare-code_block"></div>-->
        <div class="quare-code_container container">
            <div class="quare-code__code">
                <div class="quare-code__code-img">
                    <img src="<?php echo get_template_directory_uri(). '/'; ?>images/block-quare-code/guare.png" alt="">
                </div>
            </div>
            <div class="quare-code__name">
                <h4>Best discounts from all famous stores in one app</h4>
                <a href="https://play.google.com/store/apps/details?id=com.digeltech.discountone" target="_blank">
                    <img src="<?php echo get_template_directory_uri(). '/'; ?>images/block-quare-code/gplay.png" alt="">
                </a>
            </div>
            <div class="quare-code__phone">
                <img src="<?php echo get_template_directory_uri(). '/'; ?>images/block-quare-code/phones.png" alt="">
            </div>
        </div>
    </div>
    <?php foreach ($obj->cat_with_posts as $sl){?>
        <section class="cat_with_posts container">
            <div class="cat__name">
                <a>
                    <h2 style="display: flex; justify-content: space-between;align-items: baseline;"><?php echo $sl["category_name"]; ?>: </h2>
                </a>
            </div>
            <?php foreach ($sl['subcategories'] as $sliders){?>
                <div class="cat__subname">
                    <a href="<?php echo $sliders["url_more"]; ?>">
                        <h3 style="display: flex; justify-content: space-between;align-items: baseline;"><?php echo $sliders["category_name"]; ?> <span class="show_more_main">More Deals</span></h3>
                    </a>
                </div>
                <div class="products">
                    <?php foreach( $sliders["post"] as $item ): ?>
                        <div>
                            <div class="product__item views-click" product-id="<?php echo $item["id"]; ?>" views-click="<?php echo $item["views_click"]; ?>">
                                <div class="product__thumb">
                                    <?php if( $item["image_url"] ): ?>
                                        <a href="<?php echo $item["permalink"]; ?>" class="view_click" id="click_products">
                                            <img src="<?php echo $item["image_url"]; ?>" alt="<?=$item["post_title"]; ?>">
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <div style="margin-left: 10px;">
                                    <div class="product__price">
                             <span style="text-decoration-line: line-through; margin-right: 10px">
                                 <?php echo '₹ '.$item["old_price"]; ?>
                            </span><?php echo '₹ '.$item["price"] ; ?><?php echo '('. $item["sale_size"] .'%)'; ?>
                                    </div>
                                </div>
                                <div class="product__name_compact">
                                    <a href="<?php echo $item["permalink"]; ?>" class="view_click" id="click_products">
                                        <?php echo $item["post_title"]; ?>
                                    </a>
                                </div>
                                <div class="exp_time_compact">
                                    <div class= shop_icon_single_compact>
                                        <a href="../../categories-shops/<?php echo $item["shop_slug"] ?>">
                                            <img src="<?php echo $item["shop_image_url"]; ?>">
                                            <span> | <?php echo $item["shop_name"];?></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php } ?>
        </section>
    <?php } ?>
</main>
<?php get_footer(); ?>
