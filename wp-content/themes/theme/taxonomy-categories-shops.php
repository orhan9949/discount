<?php
get_header();

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$term = get_queried_object();
//var_dump($term);
?>
    <main class="container">
        <div class="aside__block_item" style="display: none;">
            <div class="aside__items_s aside__items_shops">
                <div class="filter-blockDeals__header-and-body" id="cat_shop">
                    <div class="filter-blockDeals__header" tax-cat="categories-shops" data-filter-cat="<?php echo $term->slug; ?>"></div>
                </div>
            </div>
        </div>
        <section>
            <?php if( function_exists('kama_breadcrumbs') ): kama_breadcrumbs(); endif; ?>
            <div class="shop_description_block">
                <?php
                $otherDeals = file_get_contents(get_template_directory() .'/array-page/categories-shops/jsons/'.get_queried_object()->slug.'.json');
                $otherDeals_json = json_decode($otherDeals, true);
                ?>
                <div>
                    <img src="<?php echo $otherDeals_json['img_url']; ?>" >
                </div>
                <div class="shop_desc">
                    <h1 class="shop_desc_title"><?php echo $otherDeals_json['term-name']; ?></h1>
                    <div class="shop_description">
                        <?php echo $otherDeals_json['description']; ?>
                    </div>
                </div>
            </div>
            <div class="filter" data-cat="categories-shops" data-filter-cat="<?php echo $term->slug; ?>">
                <form class="filter-form" action="">
                    <div class="filter-sort">
                        <div class="filter-sort__name">Sort By
                            <svg width="24" height="23" viewBox="0 0 24 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7 9.58333L12 14.375L17 9.58333" stroke="#4F5460" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </div>

                        <div class="filter-sort__sort">
                            <div class="filter-sort__labels">
                                <div class="filter-sort__labels_items">
                                    <label>New deals
                                        <input type="radio" name="sortBy" value="date" sort="DESC">
                                    </label>
                                    <label>Most popular
                                        <input type="radio" name="sortBy" value="views_click" sort="DESC">
                                    </label>
                                    <label>High discount
                                        <input type="radio" name="sortBy" value="sale_size" sort="DESC">
                                    </label>
                                    <label>Price (low - high)
                                        <input type="radio" name="sortBy" value="price" sort="ASC">
                                    </label>
                                    <label>Price (high - low)
                                        <input type="radio" name="sortBy" value="price" sort="DESC">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="filter-price-discount">
                        <div class="filter__price">
                            <div class="filter__price_name">
                                <p>Price</p>
                                <svg width="24" height="23" viewBox="0 0 24 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7 9.58333L12 14.375L17 9.58333" stroke="#4F5460" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </div>
                            <div class="filter__price_block">
                                <div class="filter__discount_list">
                                    <div class="filter__discount_inputs-header">
                                        <div class="filter__discount_block-exit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="14" viewBox="0 0 13 14" fill="none">
                                                <path d="M1 13L12.3391 1" stroke="#313131" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M12.3391 13L1 1" stroke="#313131" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                        <p>Price</p>
                                        <div class="filter__submit">Clear all</div>
                                    </div>
                                    <div class="filter__price_inputs">
                                        <input type="number" class="filter-price-discount__input" id="price-from" placeholder="From, ₹">
                                        <input type="number" class="filter-price-discount__input" id="price-to" placeholder="To, ₹">
                                    </div>
                                    <div class="filter__discount_inputs-footer">
                                        <div class="filter__discount_inputs-footer-btn">Apply</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter__discount">
                            <div class="filter__discount_name">
                                <p>Discount</p>
                                <svg width="24" height="23" viewBox="0 0 24 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7 9.58333L12 14.375L17 9.58333" stroke="#4F5460" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </div>
                            <div class="filter__discount_block">
                                <div class="filter__discount_list">
                                    <div class="filter__discount_inputs-header">
                                        <div class="filter__discount_block-exit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="14" viewBox="0 0 13 14" fill="none">
                                                <path d="M1 13L12.3391 1" stroke="#313131" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M12.3391 13L1 1" stroke="#313131" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                        <p>Discount</p>
                                        <div class="filter__submit">Clear all</div>
                                    </div>
                                    <div class="filter__discount_inputs">
                                        <input type="number" class="filter-price-discount__input" id="discount-from" placeholder="From, %">
                                        <input type="number" class="filter-price-discount__input" id="discount-to" placeholder="To, %">
                                    </div>
                                    <div class="filter__discount_inputs-footer">
                                        <div class="filter__discount_inputs-footer-btn">Apply</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter__submit">Clear all</div>
                    </div>
                </form>
            </div>
            <div class="deals">
                <div class="deals__content">
                    <div class="noflex_deals">
                        <div class="poroduct__list_all_deals products__list products__list_nopadding"
                             id="item_list_name" item_list_name="Stores">
                            <?php
                            if ( $otherDeals_json['posts'] ):
                                foreach($otherDeals_json['posts'] as $post): ?>
                                    <?php get_template_part( 'templates/archive-product', 'card-json'); ?>
                                <?php
                                endforeach;
                            else:
                                ?>
                                <div>No have coupons.</div>
                            <?php endif; ?>

                        </div>
                    </div>


                    <div class="deals__aside">
                        <?php
                        //                        $term =  get_queried_object();

                        $otherDeals = file_get_contents(get_template_directory() .'/array-page/categories-shops/top-deals.json');
                        $otherDeals_json = json_decode($otherDeals, true);
                        foreach ($otherDeals_json as $term_item):
//                            var_dump($term_item['term_slug'].' ');
                            if($term_item['term_slug'] == $term->slug):

                                ?>
                                <div class="aside__block" id="item_list_name" item_list_name="Popular deals">
                                    <div class="aside__head">Popular deals</div>
                                    <div class="aside__items">
                                        <?php foreach($term_item['posts'] as $i => $row){
                                            if($i < 5):
                                                ?>
                                                <div views_click="<?php echo $row['views_click']; ?>">
                                                    <div class="aside__item">
                                                        <a href="<?php echo $row['permalink']; ?>" class="aside__pic" id="click_products">
                                                            <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['post_title']; ?>">
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
            </div>
        </section>
    </main>
<?php
get_footer();
?>