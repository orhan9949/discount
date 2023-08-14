<?php
/**
 * Template Name: Предложения
 */

get_header();
?>
<?php
$object_json_link = file_get_contents(get_template_directory() .'/array-page/best-deals/object.json');
$object_json = json_decode($object_json_link, true);
?>
<main class="container" id="item_list_name" item_list_name="Best deals">
    <section>
        <?php if( function_exists('kama_breadcrumbs') ): kama_breadcrumbs(); endif; ?>
        <div class="allDeals__header">
            <h1 style="margin-left: 30px">Best Deals</h1>
            <div class="aside__block_item">
                <div class="aside__items_s aside__items_categories">
                    <div class="aside__head">Categories</div>
                    <div class="filter-blockDeals__header-and-body" id="cat" style="z-index: 1001">
                        <svg width="24" height="23" viewBox="0 0 24 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 9.58333L12 14.375L17 9.58333" stroke="#4F5460" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <div class="filter-blockDeals__header" tax-cat="" data-filter-cat="">
                            All
                        </div>
                        <div class="filter-blockDeals__body" style="display: none;">
                            <div class="filter-blockDeals__item" tax-cat="" data-filter-cat=""> All </div>
                            <?php

                            foreach ($object_json[0]["categories"] as $cat){
//                                if($cat["child"] != false){
                                echo '<div class="filter-blockDeals__item-big" tax-cat="' .$cat["slug"]. '" data-filter-cat="' .$cat["taxonomy"]. '">' .$cat["name"]. ':</div>';
//                                var_dump($cat);

                                    foreach ($cat["child"] as $c) {
                                        echo '<div class="filter-blockDeals__item under_category" tax-cat="' . $c["slug"] . '" data-filter-cat="' . $c["taxonomy"] . '">' . $c["name"] . '</div>';
                                    }
//                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="aside__items_s aside__items_shops">
                    <div class="aside__head">Stores</div>
                    <div class="filter-blockDeals__header-and-body" id="cat_shop">
                        <svg width="24" height="23" viewBox="0 0 24 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 9.58333L12 14.375L17 9.58333" stroke="#4F5460" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <div class="filter-blockDeals__header" tax-cat="" data-filter-cat="">
                            All
                        </div>
                        <div class="filter-blockDeals__body" style="display: none;">
                            <div class="filter-blockDeals__item" tax-cat="" data-filter-cat=""> All </div>
                            <?php

                            foreach ($object_json[1]["categories_shops"] as $cat) {
                                echo '<div class="filter-blockDeals__item" tax-cat="' . $cat["slug"] . '" data-filter-cat="' . $cat["taxonomy"] . '">' . $cat["name"] . '</div>';

                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="deals">
            <div class="deals__content">
                <div class="poroduct__list_all_deals products__list products__list_nopadding">
                    <?php
                    foreach ($object_json[2]["posts"] as $post) { get_template_part( 'templates/best-deals-product', 'card'); }
                    ?>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>