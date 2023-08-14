<?php
$expiration_date = get_field('expiration_date');
$amazon_asin = null;
$amazon_info = null;
if (0 && $amazon_asin = get_field('asin_code')) {
    $amazon_info = amazon_request($amazon_asin);
    $amazon_info = json_decode($amazon_info);
};

get_header();

while ( have_posts() ) :
    the_post();

    $gallery = get_field('gallery');
//    if( !empty($gallery) ) {
//        $gallery[]['sizes']['large'] = get_the_post_thumbnail_url();
//    } else {
//        $gallery = [];
//        $gallery[]['sizes']['large'] = get_the_post_thumbnail_url();
//    }
    ?>
    <main class="container">
        <section>
            <?php if( function_exists('kama_breadcrumbs') ): kama_breadcrumbs(); endif; ?>
            <div class="product-page" >
                <div class="product__inside">
                    <div class="product__content">
                        <div class="hidden_mobile">
                            <div class="product__card">
                                <div class="product__medium">
                                    <form>
                                        <a href="#" class="page__back" onClick="history.back()">
                                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12.8333 6.41927L8.25 11.0026L12.8333 15.5859" stroke="#A5ABB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                    </form>
                                    <div class="product_mySwiper">
                                        <div class="product_mySwiper-block">
                                            <div class="swiper-button-n">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="59" height="20" viewBox="0 0 59 20" fill="none">
                                                    <path d="M41.7982 12.9762L29.5065 3.75L17.2148 12.9762" stroke="#808080" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </div>
                                            <div class="swiper product_mySwiper__slider">
                                                <div class="swiper-wrapper">

                                                    <?php
                                                    $get_the_post_thumbnail_url = get_the_post_thumbnail_url();
                                                    $image = get_field('image_url');
                                                    if($get_the_post_thumbnail_url):
                                                        ?>
                                                        <div class="swiper-slide active">
                                                            <div class="swiper-slide-item">
                                                                <img src="<?php echo $get_the_post_thumbnail_url; ?>" alt="<?php echo get_the_title(); ?>">
                                                            </div>
                                                        </div>
                                                    <?php
                                                    else:
                                                        ?>
                                                        <div class="swiper-slide active">
                                                            <div class="swiper-slide-item">
                                                                <img src="<?=$image ?>" alt="<?php echo get_the_title(); ?>">
                                                            </div>
                                                        </div>
                                                    <?php
                                                    endif;
                                                    ?>
                                                    <?php foreach($gallery as $image): ?>
                                                        <div class="swiper-slide">
                                                            <div class="swiper-slide-item">
                                                                <img src="<?=$image['sizes']['large'] ?>" alt="<?php echo get_the_title(); ?>">
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>

                                            </div>
                                            <div class="swiper-pagination"></div>
                                            <div class="swiper-button-p">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="59" height="20" viewBox="0 0 59 20" fill="none">
                                                    <path d="M41.7982 7.02381L29.5065 16.25L17.2148 7.02381" stroke="#808080" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="product__slider">
                                            <div class="beauty_border">
                                                <a href="#" class="action_fav" style="height: 25px" data-id="<?php echo get_the_ID(); ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" viewBox="0 0 12 14" fill="none">
                                                        <path d="M9.23333 12.84L6.1 10.1533C5.85333 9.94 5.48 9.94 5.23333 10.1533L2.1 12.84C1.66667 13.2133 1 12.9067 1 12.3333V1.66667C1 1.3 1.3 1 1.66667 1H9.66667C10.0333 1 10.3333 1.3 10.3333 1.66667V12.3333C10.3333 12.9 9.66667 13.2133 9.23333 12.84Z" stroke="#A5ABB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                </a>
                                            </div>
                                            <div class="product__slider-img">
                                                <?php
                                                if($get_the_post_thumbnail_url):
                                                    ?>
                                                    <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo get_the_title(); ?>">
                                                    <?php
                                                else:
                                                    $image = get_field('image_url');
                                                    ?>
                                                    <img src="<?=$image ?>" alt="<?php echo get_the_title(); ?>">
<!--                                                --><?php // var_dump($image); ?>
                                                <?php
                                                endif;
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product__desc">
                                    <?php if( $expiration_date ): ?>
                                        <div class="product__expires">
			                        <span class="timer_expiers">
			                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                            <path d="M8.00001 2C9.1867 2 10.3467 2.35189 11.3334 3.01118C12.3201 3.67047 13.0892 4.60754 13.5433 5.7039C13.9974 6.80025 14.1162 8.00666 13.8847 9.17054C13.6532 10.3344 13.0818 11.4035 12.2427 12.2426C11.4035 13.0818 10.3344 13.6532 9.17056 13.8847C8.00667 14.1162 6.80027 13.9974 5.70391 13.5433C4.60756 13.0891 3.67049 12.3201 3.0112 11.3334C2.35191 10.3467 2.00001 9.18669 2.00001 8C1.99639 6.28088 2.65794 4.627 3.84617 3.38462" stroke="#A5ABB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M2 3.84618L3.84615 3.38464L4.30769 5.2308" stroke="#A5ABB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M8 4.76929V8.46159L10.4 9.66159" stroke="#A5ABB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
				                    </span>
                                            Expires <?php echo $expiration_date; ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="product__title">
                                        <?php if ($amazon_asin) {
                                            $price = $amazon_info->SearchResult->Items[0]->Offers->Listings[0]->Price->DisplayAmount;
                                            $old_price = $amazon_info->SearchResult->Items[0]->Offers->Listings[0]->Price->Savings->Amount + $amazon_info->SearchResult->Items[0]->Offers->Listings[0]->Price->Amount;
                                            echo '<div class="product__price"><span style="text-decoration-line: line-through; margin-right: 10px">₹'.$old_price.'</span><div class="product__price">'.$price.'</div></div>';
                                        } else {
                                            echo dc_price(get_the_ID());
                                        }
                                        ?>
                                        <div class="product__published">Published <?php echo dc_passed(get_the_date("Y-m-d H:i:s")); ?></div>
                                        <div class="single_title">
                                            <?php echo get_the_title(); ?>
                                        </div>
                                    </div>
                                    <?php $term = get_term_by( 'slug', strtolower(get_field('source')), 'categories-shops' ); ?>
                                    <div>
                                        <div class= shop_icon_single>
                                            <?php $term = get_term_by( 'slug', get_field('source'), 'categories-shops' );
                                            $image = get_field('icon', 'categories-shops_'.$term->term_id);
                                            ?>
                                            <a href="https://discount.one/categories-shops/<?php echo $term->slug ?>">
                                                <img src="<?php echo $image['url']; ?>"> | <?php echo $term->name;?>
                                            </a>
                                        </div>
                                        <div class="product__buttons_single">
                                            <div class="product__actions">

                                                <!--   этот див c классом data_analitics_click чисто для передачи данных для аналитики    -->
                                                <?php
                                                $term = get_term_by('slug', get_field('source'), 'categories-shops');
                                                $cat_post = get_the_terms( get_the_ID(), 'categories' );
                                                $item_category = '';
                                                foreach($cat_post as $ct):
                                                    if($ct->parent == false): $item_category = $ct->name;
                                                    endif;
                                                endforeach;
                                                ?>
                                                <div
                                                        style="display:none;"
                                                        class="data_analitics_click"
                                                        item_id="<?php the_ID(); ?>"
                                                        new-price="<?php the_field('price'); ?>"
                                                        item_name="<?php echo get_the_title(); ?>"
                                                        affiliation="<?php echo $term->name; ?>"
                                                        item_brand="<?php echo $term->name; ?>"
                                                        item_category="<?php echo $item_category; ?>"
                                                        price="<?php the_field('price'); ?>"
                                                        quantity="1"
                                                        item_list_name="<?php echo htmlspecialchars($_COOKIE["item_list_name"]); ?>"
                                                >
                                                </div>
                                                <!--   КОНЕЦ    -->


                                                <?php if( $link = get_field('link') ): ?>
                                                    <a href="<?=$link ?>" target="_blank" class="btn" id="data_analitics">Shop now</a>
                                                <?php endif; ?>
                                                <div class="product__author">
                                                    <?php if( $promocode = get_field('promocode') ): ?>
                                                        <div class="product__promocode_single hidden_mobile">
                                                            <?=$promocode ?>
                                                            <span data-val="<?=$promocode ?>" class="action_copy action_copy-desctop">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                    <path d="M10 2H3.33333C2.59695 2 2 2.59695 2 3.33333V10C2 10.7364 2.59695 11.3333 3.33333 11.3333H10C10.7364 11.3333 11.3333 10.7364 11.3333 10V3.33333C11.3333 2.59695 10.7364 2 10 2Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M13.9993 4.66663V12C13.9993 13.1066 13.106 14 11.9993 14H4.66602" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </span>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if(0): ?>
                                                        <div class="account__pill-picture">
                                                            <?php echo get_avatar(get_the_author_ID(), 50); ?>
                                                        </div>
                                                        <div class="account__pill-name"><?php echo get_the_author(); ?></div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product__text">
                            <?php if (get_the_content()):?>
                                <h3>Product Information</h3>
                            <?php endif;?>
                            <?php the_content(); ?>
                            <div class="disclaimer_card_box">
						<span class="disclaimer_card">
							Disclosure: If you follow a link or buy an item from a post, Discount One may receive a commission from the store, but this does not affect what discounts are posted on the site. <a href="https://discount.one/affiliate-disclosure" class="href_text">Affiliate Disclosure.</a>
						</span>
                            </div>
                        </div>
                    </div>
                    <?php
                    $term = get_term_by('slug', get_field('source'), 'categories-shops');
                    $otherDeals = file_get_contents(get_template_directory() .'/array-page/single-page/other-deals.json');
                    $otherDeals_json = json_decode($otherDeals, true);
                    foreach ($otherDeals_json as $term_item):
                        if($term_item['slug'] == $term->slug):
                            ?>
                            <div class="similar" id="item_list_name" item_list_name="Other deals">
                                <div class="h2_parody">Other deals from
                                    <a href="<?php echo $term_item['shop-url']; ?>">
                                        <?php echo $term_item['shop-name']; ?>
                                    </a>
                                </div>
                                <div class="products products-4x">

                                    <?php foreach( $term_item['posts'] as $item ): ?>
                                        <div>
                                            <?php get_template_part( 'templates/product', 'compact-json', ['item' => $item] ); ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php
                        endif;
                    endforeach;
                    ?>

                </div>
                <div class="product__aside">
                    <?php
                    $term = get_the_terms(get_the_ID(), 'categories');
                    $otherDeals = file_get_contents(get_template_directory() .'/array-page/single-page/top-deals.json');
                    $otherDeals_json = json_decode($otherDeals, true);
                    //                    echo '<pre>';
                    //                    var_dump($term);
                    //                    echo '</pre>';
                    foreach ($otherDeals_json as $term_item):
                        /**
                         *
                         * Вывод родительской категории
                         *
                         */
                        $name_parent_term = '';
                        foreach($term as $t):
                            if($t->parent == 0):
                                $name_parent_term = $t->slug;
                            endif;
                        endforeach;
                        /**
                         * КОНЕЦ Вывод родительской категории
                         */



                        if($term_item['term_slug'] == $name_parent_term):

                            ?>
                            <div class="aside__block" id="item_list_name" item_list_name="Daily Top">
                                <div class="aside__head">Daily Top</div>
                                <div class="aside__items">
                                    <?php foreach($term_item['posts'] as $i => $row){
                                        if(get_the_ID() != $row['ID']):
                                            ?>
                                            <div views_click="<?php echo $row['views_click']; ?>">
                                                <div class="aside__item">
                                                    <a href="<?php echo $row['permalink']; ?>" class="aside__pic" id="click_products">
                                                        <img src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['post_title']; ?>">
                                                    </a>
                                                    <div class="aside__desc">
                                                        <a href="<?php echo $row['permalink']; ?>" class="aside__desc-text" id="click_products">
                                                            <div class="aside__caption">
                                                                <div class="aside__title">
                                                                    <?php echo $row['post_title']; ?>
                                                                </div>
                                                            </div>
                                                            <div class="product__price">
                                                                <span style="text-decoration-line: line-through; margin-right: 10px">₹<?php echo $row['old_price']; ?></span>
                                                                ₹<?php echo $row['price']. ' ('. $row['sale_size'] .'%)' ?>
                                                            </div>
                                                        </a>
                                                        <?php $term = get_the_terms( $row['ID'], 'categories-shops' ); ?>
                                                        <a href="<?php echo  $row['shop_link'] ; ?>" class="company__item">
                                                            <div class="category__icon">
                                                                <img src="<?php echo $row['shop_image_url']; ?>" alt="<?php echo esc_html( $term[0]->term_id ); ?>">
                                                            </div>
                                                            <span> | <?php echo $term[0]->name; ?></span>
                                                        </a>

                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php } ?>
                                </div>
                            </div>

                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </main>
    <!--   этот див c классом data_analitics чисто для передачи данных для аналитики    -->
    <?php
    $term = get_term_by('slug', get_field('source'), 'categories-shops');
    $cat_post = get_the_terms( get_the_ID(), 'categories' );
    $item_category = '';
    foreach($cat_post as $ct):
        if($ct->parent == false): $item_category = $ct->name;
        endif;
    endforeach;
    ?>
    <div
            style="display:none;"
            class="data_analitics"
            item_id="<?php the_ID(); ?>"
            new-price="<?php the_field('price'); ?>"
            item_name="<?php echo get_the_title(); ?>"
            affiliation="<?php echo $term->name; ?>"
            item_brand="<?php echo $term->name; ?>"
            item_category="<?php echo $item_category; ?>"
            price="<?php the_field('price'); ?>"
            quantity="1"
            item_list_name="<?php echo htmlspecialchars($_COOKIE["item_list_name"]); ?>"
    >
    </div>
    <!--   КОНЕЦ    -->

<?php endwhile;


get_footer();