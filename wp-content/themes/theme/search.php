<?php get_header();?>
    <main class="container search__page">
        <section>
        <?php if( function_exists('kama_breadcrumbs') ): kama_breadcrumbs(); endif; ?>
            <h1 name="<?php echo get_search_query(); ?>">
                <?php
                    if (!have_posts()) : echo 'Nothing found for this query'; else:  echo 'Search results for ”<span>'.get_search_query(). '</span>”'; endif;
                ?>
            </h1>
            <div class="header__search ">
                <form role="search" method="get" id="searchformpage" action="<?php echo home_url( '/' ) ?>">
                    <div class="header__search-form">
                       <input type="text" id="s" value="<?php echo get_search_query() ?>"  name="s" placeholder="Search for shops, categories, offers, coupons..." />
<!--                        <span class="action__search">-->
<!--                            <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                            <path d="M9.16667 16.5C12.8486 16.5 15.8333 13.5152 15.8333 9.83329C15.8333 6.15139 12.8486 3.16663 9.16667 3.16663C5.48477 3.16663 2.5 6.15139 2.5 9.83329C2.5 13.5152 5.48477 16.5 9.16667 16.5Z" stroke="#A3A3A3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                            <path d="M17.5 18.1666L13.875 14.5416" stroke="#A3A3A3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                            </svg>-->
<!--                        </span>-->
                    </div>
<!--                    <div class="header__search-result">-->
<!--                        <div class="header__search-title">Result</div>-->
<!--                        <div class="header__search-list" >-->
<!--                            Searching...-->
<!--                        </div>-->
<!--                    </div>-->
                </form>
                <div class="deals__aside"></div>
            </div>
            <div class="deals">
<!--                <h2 style="width: 100%;">In Coupons & Offers</h2>-->
                <div class="deals__content">
<!--                    <div class="noflex_deals">-->
                        <div class="noflex_deals__one">

                            <div class="products__list products__list_nopadding">
                                <?php
                                $wp_query = new WP_Query( [
                                    'post_type' => 'products',
                                    'post_status' => 'publish',
//                                    'orderby' => 'date',
//                                    'order' => 'DESC',
                                    'orderby' => 'views_click',
                                    'order' => 'DESC',
                                    "s" =>  get_search_query(),
                                    'posts_per_page' => 100,
                                    'paged' => get_query_var('paged') ?: 1
                                ] );
                                if ( $wp_query->have_posts() ):
                                    while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
                                        <?php get_template_part( 'templates/product', 'card'); ?>
                                    <?php
                                    endwhile;
                                else:
                                    ?>
<!--                                    <div>No have coupons.</div>-->
                                <?php endif; ?>

<!--                                <div class="hidden_mobile">-->
<!--                                    --><?php //echo the_posts_pagination([
//                                        'mid_size' => 4,
//                                        'prev_text' => '<svg width="8" height="15" viewBox="0 0 8 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 14L1 7.5L7 1" stroke="#A3A3A3" stroke-linecap="round" stroke-linejoin="round"/></svg>',
//                                        'next_text' => '<svg width="8" height="15" viewBox="0 0 8 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 14L7 7.5L0.999999 1" stroke="#A3A3A3" stroke-linecap="round" stroke-linejoin="round"/></svg>',
//                                        'screen_reader_text' => ''
//                                    ]) ?>
<!--                                </div>-->
                            </div>
                        </div>
<!--                    </div>-->
                    <div class="deals__aside">
                        <?php
                        $terms = get_terms( 'categories-shops', ['meta_key' => 'popular', 'meta_value' => '1','hide_empty' => 0,'number' => 4 ] );
//
//                        if( $terms && ! is_wp_error( $terms ) && 0):
                        ?>
                            <div class="aside__block">

                                <div class="aside__items">
                                    <div class="aside__head">Popular stores</div>
                                    <?php foreach( $terms as $term ): ?>
                                        <div class="category-card-shop">
                                            <a href="<?php echo get_term_link( $term->term_id ); ?>">
                                                <div class="category_shops__icon">
                                                    <?php if( $image = get_field('icon', 'categories-shops_'.$term->term_id) ): ?>
                                                        <img src="<?php echo $image['url']; ?>" alt="<?php echo esc_html( $term->name ); ?>">
                                                    <?php endif; ?>
                                                </div>
                                                <div class="category_shops__text">
                                                    <div>
                                                        <h2 class="category__name"><?php echo esc_html( $term->name ); ?></h2>
                                                        <div class="category__extra"><?php echo dc_cat_info($term->term_id); ?></div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>

                                    <?php endforeach; ?>
                                </div>
                            </div>
<!--                        --><?php //endif; ?>

<!--                    <div class="hidden_pc">-->
<!--                        --><?php //echo the_posts_pagination([
//                            'mid_size' => 4,
//                            'prev_text' => '<svg width="8" height="15" viewBox="0 0 8 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 14L1 7.5L7 1" stroke="#A3A3A3" stroke-linecap="round" stroke-linejoin="round"/></svg>',
//                            'next_text' => '<svg width="8" height="15" viewBox="0 0 8 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 14L7 7.5L0.999999 1" stroke="#A3A3A3" stroke-linecap="round" stroke-linejoin="round"/></svg>',
//                            'screen_reader_text' => ''
//                        ]) ?>
<!--                    </div>-->
                </div>
            </div>
        </section>
    </main>
    <script>
        // $(document).ready(function(){
            $('title').text('Search | Discount One');
        // })
    </script>
<?php

get_footer();