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
    if( !empty($gallery) ) {
        $gallery[]['sizes']['large'] = get_the_post_thumbnail_url();
    } else {
        $gallery = [];
        $gallery[]['sizes']['large'] = get_the_post_thumbnail_url();
    }
    ?>
    <main class="container">
        <section>
            <?php if( function_exists('kama_breadcrumbs') ): kama_breadcrumbs(); endif; ?>
            <div class="product-page">
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
                                    <div class="beauty_border">

                                        <a href="#" class="action_fav" style="height: 25px" data-id="<?php echo get_the_ID(); ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" viewBox="0 0 12 14" fill="none">
                                                <path d="M9.23333 12.84L6.1 10.1533C5.85333 9.94 5.48 9.94 5.23333 10.1533L2.1 12.84C1.66667 13.2133 1 12.9067 1 12.3333V1.66667C1 1.3 1.3 1 1.66667 1H9.66667C10.0333 1 10.3333 1.3 10.3333 1.66667V12.3333C10.3333 12.9 9.66667 13.2133 9.23333 12.84Z" stroke="#A5ABB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="product__slider">
                                        <?php if($gallery): ?>
                                            <?php foreach($gallery as $image): ?>
                                                <div>
                                                    <img src="<?=$image['sizes']['large'] ?>" alt="<?php echo get_the_title(); ?>">
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
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
                                    <!-- <div class="product__rating" data-id="<?php echo get_the_ID(); ?>">
                                <button type="button" class="product__rating-plus"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="28" viewBox="0 0 8 5" fill="none">
                                <path d="M3.74182 0.120897C3.87962 -0.0402993 4.12038 -0.040299 4.25818 0.120898L7.91077 4.39372C8.11093 4.62786 7.95245 5 7.65259 5H0.347407C0.0475472 5 -0.110926 4.62786 0.0892264 4.39372L3.74182 0.120897Z" fill="#A5ABB8"/>
                                </svg></button>
                                <span><?php the_field('rating'); ?></span>
								 <button type="button" class="product__rating-min"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 8 5" fill="none">
                                <path d="M3.74182 4.8791C3.87962 5.0403 4.12038 5.0403 4.25818 4.8791L7.91077 0.606277C8.11093 0.372138 7.95245 6.0837e-08 7.65259 6.0837e-08H0.347407C0.0475472 6.0837e-08 -0.110926 0.372138 0.0892264 0.606278L3.74182 4.8791Z" fill="#A5ABB8"/>
                                </svg></button>
                            </div> -->
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
                                        <div class="single_title"><?php
                                            //                                    if($amazon_asin){
                                            //                                        echo ($amazon_info->SearchResult->Items[0]->ItemInfo->Title->DisplayValue);
                                            //                                    }
                                            //                                    else{
                                            echo get_the_title();
                                            //                                    }
                                            ?>
                                        </div>

                                    </div>


                                    <?php $term = get_term_by( 'name', get_field('source'), 'categories-shops' ); ?>
                                    <!--<a href="https://discount.one/categories-shops/<?php echo $term->slug ?>">
									<div class="store_name_single"> <?php the_field('source', $post->ID) ?></div>
									</a> -->
                                    <div>
                                        <div class= shop_icon_single>
                                            <?php $term = get_term_by( 'name', get_field('source'), 'categories-shops' );
                                            $image = get_field('icon', 'categories-shops_'.$term->term_id);
                                            ?>
                                            <a href="https://discount.one/categories-shops/<?php echo $term->slug ?>">
                                                <img src="<?php echo $image['url']; ?>"> | <?php echo $term->name;?>
                                            </a>
                                        </div>
                                        <div class="product__buttons_single">
                                            <div class="product__actions">
                                                <?php if( $link = get_field('link') ): ?>
                                                    <a href="<?=$link ?>" target="_blank" class="btn">Shop now</a>
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
                                                <!-- <a href="#comments" class="btn btn-border">
										<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20.3 21.3L18 19H4C3.45 19 2.97933 18.8043 2.588 18.413C2.196 18.021 2 17.55 2 17V5C2 4.45 2.196 3.979 2.588 3.587C2.97933 3.19567 3.45 3 4 3H20C20.55 3 21.021 3.19567 21.413 3.587C21.8043 3.979 22 4.45 22 5V20.575C22 21.025 21.796 21.3373 21.388 21.512C20.9793 21.6873 20.6167 21.6167 20.3 21.3Z" fill="#404040"/></svg> <span><?php echo wp_count_comments(get_the_ID())->approved; ?></span>
									</a> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--            <div class="hidden_pc">-->
                        <!--                <div class="product__card_single_mobile">-->
                        <!--                    <div class="product__medium">-->
                        <!--                        <div class="beauty_border">-->
                        <!--                            <a href="#" class="action_fav" style="height: 25px" data-id="--><?php //echo get_the_ID(); ?><!--">-->
                        <!--                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" viewBox="0 0 12 14" fill="none">-->
                        <!--                                    <path d="M9.23333 12.84L6.1 10.1533C5.85333 9.94 5.48 9.94 5.23333 10.1533L2.1 12.84C1.66667 13.2133 1 12.9067 1 12.3333V1.66667C1 1.3 1.3 1 1.66667 1H9.66667C10.0333 1 10.3333 1.3 10.3333 1.66667V12.3333C10.3333 12.9 9.66667 13.2133 9.23333 12.84Z" stroke="#A5ABB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>-->
                        <!--                                </svg>-->
                        <!--                            </a>-->
                        <!--                        </div>-->
                        <!--						<div class="product__slider">-->
                        <!--							--><?php //if($gallery): ?>
                        <!--								--><?php //foreach($gallery as $image): ?>
                        <!--                                    <div>-->
                        <!--                                        <img src="--><?//=$image['sizes']['large'] ?><!--" alt="--><?php //echo get_the_title(); ?><!--">-->
                        <!--                                    </div>-->
                        <!--								--><?php //endforeach; ?>
                        <!--							--><?php //endif; ?>
                        <!--                        </div>-->
                        <!--                    </div>-->
                        <!--                    <div class="product__desc_single_mobile">-->
                        <!--				     --><?php
                        //                        if ($amazon_asin) {
                        //                            $price = $amazon_info->SearchResult->Items[0]->Offers->Listings[0]->Price->DisplayAmount;
                        //                            $old_price = $amazon_info->SearchResult->Items[0]->Offers->Listings[0]->Price->Savings->Amount + $amazon_info->SearchResult->Items[0]->Offers->Listings[0]->Price->Amount;
                        //                            echo '<div class="product__price"><span style="text-decoration-line: line-through; margin-right: 10px">₹'.$old_price.'</span><div class="product__price">'.$price.'</div></div>';
                        //                        }else {
                        //                             echo dc_price(get_the_ID());
                        //                         }
                        //                     ?>
                        <!--                        <div class="product__published">Published --><?php //echo dc_passed(get_the_date("Y-m-d H:i:s")); ?><!--</div>-->
                        <!--                            <div class="product__title_single_mobile">-->
                        <!--                                <h1>--><?php //
                        //									if($amazon_asin){
                        //									echo ($amazon_info->SearchResult->Items[0]->ItemInfo->Title->DisplayValue);
                        //											}
                        //									else{
                        //										echo get_the_title();
                        //									}
                        //									?>
                        <!--                                </h1>-->
                        <!--                                <div class="exp_raito_single_mobile">-->
                        <!--                                    --><?php //if( $expiration_date ): ?>
                        <!--                                        <div class="product__expires_single_mobile">-->
                        <!--                                            <span class="timer_expiers_single_mobile">-->
                        <!--                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">-->
                        <!--                                                    <path d="M8.00001 2C9.1867 2 10.3467 2.35189 11.3334 3.01118C12.3201 3.67047 13.0892 4.60754 13.5433 5.7039C13.9974 6.80025 14.1162 8.00666 13.8847 9.17054C13.6532 10.3344 13.0818 11.4035 12.2427 12.2426C11.4035 13.0818 10.3344 13.6532 9.17056 13.8847C8.00667 14.1162 6.80027 13.9974 5.70391 13.5433C4.60756 13.0891 3.67049 12.3201 3.0112 11.3334C2.35191 10.3467 2.00001 9.18669 2.00001 8C1.99639 6.28088 2.65794 4.627 3.84617 3.38462" stroke="#A5ABB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>-->
                        <!--                                                    <path d="M2 3.84618L3.84615 3.38464L4.30769 5.2308" stroke="#A5ABB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>-->
                        <!--                                                    <path d="M8 4.76929V8.46159L10.4 9.66159" stroke="#A5ABB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>-->
                        <!--                                                </svg>-->
                        <!--                                            </span>Expires&nbsp; --><?php //echo $expiration_date; ?>
                        <!--                                        </div>						-->
                        <!--								</div>-->
                        <!--                            </div>-->
                        <!--                            <div class="product__buttons_single_mobile">-->
                        <!--                                <div class="product__actions_single_mobile">-->
                        <!--									--><?php //if( $link = get_field('link') ): ?>
                        <!--                                        <a href="--><?//=$link ?><!--" target="_blank" class="btn">Shop now</a>-->
                        <!--									--><?php //endif; ?>
                        <!--									    <div class="product__author_single_mobile">-->
                        <!--                                    --><?php //if( $promocode = get_field('promocode') ): ?>
                        <!--                                        <div class="product__promocode_single_mobile">-->
                        <!--                                            --><?//=$promocode ?>
                        <!--                                            <span data-val="--><?//=$promocode ?><!--" class="action_copy_single">-->
                        <!--                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">-->
                        <!--                                                    <path d="M10 2H3.33333C2.59695 2 2 2.59695 2 3.33333V10C2 10.7364 2.59695 11.3333 3.33333 11.3333H10C10.7364 11.3333 11.3333 10.7364 11.3333 10V3.33333C11.3333 2.59695 10.7364 2 10 2Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>-->
                        <!--                                                    <path d="M13.9993 4.66663V12C13.9993 13.1066 13.106 14 11.9993 14H4.66602" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>-->
                        <!--                                                </svg>-->
                        <!--                                            </span>-->
                        <!--                                        </div>-->
                        <!--                                    --><?php //endif; ?>
                        <!--                                    --><?php //if(0): ?>
                        <!--                                        <div class="account__pill-picture">-->
                        <!--                                            --><?php //echo get_avatar(get_the_author_ID(), 50); ?>
                        <!--                                        </div>-->
                        <!--                                        <div class="account__pill-name">--><?php //echo get_the_author(); ?><!--</div>-->
                        <!--                                    --><?php //endif; ?>
                        <!--                                </div>-->
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!--							<div class="shop_icon_single_mobile">-->
                        <!--								--><?php //$term = get_term_by( 'name', get_field('source'), 'categories-shops' );
                        //									  $image = get_field('icon', 'categories-shops_'.$term->term_id)?><!-- -->
                        <!--								<a href="https://discount.one/categories-shops/--><?php //echo $term->slug ?><!--">-->
                        <!--									<img src="--><?php //echo $image['url']; ?><!--"class="shop_icon_single_mobile"> | --><?php //echo $term->name;?>
                        <!--								</a>-->
                        <!--							</div>-->
                        <!--                        </div>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <div class="product__text">
                            <h3>More about the discount</h3>
                            <?php the_content(); ?>
                            <div class="disclaimer_card_box">
						<span class="disclaimer_card">
							Disclosure: If you follow a link or buy an item from a post, Discount One may receive a commission from the store, but this does not affect what discounts are posted on the site. <a href="https://discount.one/affiliate-disclosure" class="href_text">Affiliate Disclosure.</a>
						</span>
                            </div>
                        </div>
                    </div>
                    <?php
                    $tmp_category_slug = get_the_terms($post->ID, 'categories');
                    $tmp_category_slug = $tmp_category_slug[0]->slug;
                    $items = new WP_Query(array(
                        'post_type' 		=> 'products',
                        'post_status' 		=> 'publish',
                        //					'categories' 		=> $tmp_category_slug->taxonomy,
                        'meta_query' => 'meta_value',
                        'orderby' => 'meta_value_num',
                        'meta_key' => 'price',
                        'order'             =>  'ASC',
                        "s" =>  get_the_title(),
                        'post__not_in' 		=> [ get_the_ID() ],
                        'posts_per_page' 	=> 5
                    ));
                    $items = $items->get_posts();
                    if( $items ): ?>
                        <div class="similar" style="display: none">
                            <div class="h2_parody">Similar products</div>
                            <div class="products products-4x">
                                <?php foreach( $items as $item ): ?>
                                    <div>
                                        <?php get_template_part( 'templates/product', 'compact', ['item' => $item] ); ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php
                    $term = get_term_by('slug', strtolower(get_field('source')), 'categories-shops');
                    $query = new WP_Query( [
                        'post_type' => 'products',
                        'post_status' => 'publish',
                        'tax_query' => array(
                            array(
                                'taxonomy' => $term->taxonomy,
                                'field' => 'slug',
                                'terms' => $term->slug,
                            ),
                        ),
                        'meta_key' => 'sale_size',
                        'orderby' => 'meta_value_num',
                        'order' => 'DESC',
                        'posts_per_page' => 5
                    ] );
                    $items = $query->get_posts();
                    if( $items ): ?>
                        <div class="similar">
                            <div class="h2_parody">Other deals from
                                <a href="https://discount.one/categories-shops/<?php echo $term->slug ?>">
                                    <?php echo get_field('source') ?>
                                </a>
                            </div>
                            <div class="products products-4x">
                                <?php foreach( $items as $item ): ?>
                                    <div>
                                        <?php get_template_part( 'templates/product', 'compact', ['item' => $item] ); ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="product__aside">
                    <?php
                    $term = get_the_terms($post->ID, 'categories');
                    $query = new WP_Query( [
                        'post_type' => 'products',
                        'post_status' => 'publish',
                        'tax_query' => array(
                            array(
                                'taxonomy' => $term[0]->taxonomy,
                                'field' => 'slug',
                                'terms' => $term[0]->slug,
                            ),
                        ),
                        'post__not_in' 		=> [ get_the_ID() ],
                        'orderby' => 'views_click',
                        'order' => 'DESC',
                        'posts_per_page' => 5
                    ] ); ?>
                    <div class="aside__block">
                        <div class="aside__head">Daily Top</div>
                        <div class="aside__items">
                            <?php $rows = $query->get_posts();
                            foreach($rows as $row){ ?>
                                <div views_click="<?php echo $row->views_click; ?>">
                                    <div class="aside__item">
                                        <div class="aside__pic">
                                            <?php if( $image = get_the_post_thumbnail_url($row->ID, 'thumbnail') ): ?>
                                                <img src="<?php echo $image; ?>" alt="<?php echo $row->post_title; ?>">
                                            <?php endif; ?>
                                        </div>
                                        <div class="aside__desc">
                                            <a href="<?php echo get_permalink($row->ID); ?>" class="aside__desc-text">
                                                <div class="aside__caption">
                                                    <div class="aside__title">
                                                        <?php echo $row->post_title; ?>
                                                    </div>
                                                </div>
                                                <?php echo dc_price($row->ID); ?>
                                            </a>


                                            <?php $term = get_the_terms( $row->ID, 'categories-shops' ); ?>
                                            <a href="<?php echo get_term_link( $term[0]->term_id ); ?>" class="company__item">
                                                <div class="category__icon">
                                                    <?php if( $image = get_field('icon', 'categories-shops_'.$term[0]->term_id) ): ?>
                                                        <img src="<?php echo $image['url']; ?>" alt="<?php echo esc_html( $term[0]->term_id ); ?>">
                                                    <?php endif; ?>
                                                </div>
                                                <span> | <?php echo $term[0]->name; ?></span>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- <?php
                    $terms = get_terms( 'categories-shops', ['hide_empty' => false, 'meta_key' => 'popular', 'meta_value' => '1'] );
                    if( $terms && ! is_wp_error( $terms ) ):
                        ?>
        			<div class="aside__block">
						<div class="aside__head">Best Stores</div>
						<div class="aside__companies">
            			<?php foreach( $terms as $term ): ?>
            			<div class="company__item">
                			<a href="<?php echo get_term_link( $term->term_id ); ?>">
                    			<div class="category__icon">
                    				<?php if( $image = get_field('icon', 'categories-shops_'.$term->term_id) ): ?>
                        				<img src="<?php echo $image['url']; ?>" alt="<?php echo esc_html( $term->name ); ?>">
                    				<?php endif; ?>
                    			</div>
                			</a>
            			</div>
            			<?php endforeach; ?>
						</div>
        			</div>
                    <?php endif; ?> -->
                </div>
            </div>
        </section>
    </main>
<?php endwhile;


get_footer();