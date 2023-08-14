<?php
/**
 * Template Name: Страница категории
 */
get_header();

?>
<main class="container" id="item_list_name" item_list_name="Categories">
    <section>
        <h1><?php echo get_the_title()?></h1>
        <div class="cat cat__desctope">
            <div class="cat-filter__block">
                <div class="cat-filter">
                    <div class="cat-filter__items"></div>
                </div>
            </div>
            <div class="cat-detail">
                <div class="cat-detail__header">
                    <div class="cat-detail__header-img">
                        <img src="" alt="">
                    </div>
                    <div class="cat-detail__header-info">
                        <div class="cat-detail__header-info__h2" style="overflow: hidden;">
                            <div class="cat-detail__header-info__h2-eff">
                                <h2></h2>
                            </div>
                        </div>
                        <div class="cat-detail__header-info__p" style="overflow: hidden;">
                            <div class="cat-detail__header-info__p-eff">
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cat-detail__body">
                    <div class="cat-detail__body-items"></div>
                </div>
            </div>
        </div>
        <div class="cat-mobile">

        </div>
    </section>
</main>
<?php get_footer(); ?>
