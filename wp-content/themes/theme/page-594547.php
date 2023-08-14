<?php
get_header();
?>
<main class="container">
    <section>
        <?php if( function_exists('kama_breadcrumbs') ): kama_breadcrumbs(); endif; ?>
        <div class="posts__header">
            <h1>Popular posts</h1>
        </div>
        <?php

            $items = new WP_Query(array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'orderby' => 'views_click',
                'order' => 'DESC',
                'posts_per_page' => 5,
            ));
            $items = $items->get_posts();
        ?>
        <div class="top-posts">
            <div class="top-posts__first">
            <?php
            foreach($items as $i => $post):
                if($i == 0): ?>
                    <a href="<?php echo $post->guid;?>" class="product__card-a views_click" product-id="<?php echo $post->ID; ?>" views-click="<?php echo $post->views_click; ?>">
                        <div class="product__card">
                            <div class="product__card-img">
                                <img src="<?php echo get_the_post_thumbnail_url($post->ID, 'meduim'); ?>" alt="<?php echo $post->post_title;?>" class="product__card-a__img">
<!--                                <div class="btn">Training</div>-->
                            </div>
                            <h2 class="product__title">
                                <?php echo $post->post_title;?>
                            </h2>
                        </div>
                    </a>
                <?php
                endif;
            endforeach;
            ?>
            </div>
            <div class="top-posts__throo-posts">
                <?php
                foreach($items as $i => $post):
                    if($i > 0 && $i < 5): ?>
                        <a href="<?php echo $post->guid;?>" class="product__card-a views_click" product-id="<?php echo $post->ID; ?>" views-click="<?php echo $post->views_click; ?>">
                            <div class="product__card views-click">
                                <div class="product__card-img">
                                    <img src="<?php echo get_the_post_thumbnail_url($post->ID, 'meduim'); ?>" alt="<?php echo $post->post_title;?>" class="product__card-a__img">
                                </div>
                                <h2 class="product__title">
                                    <?php echo $post->post_title;?>
                                </h2>
                            </div>
                        </a>
                    <?php
                    endif;
                endforeach;
                ?>

            </div>
        </div>
        <h2 class="name-posts">Posts</h2>
        <div class="posts-filter">
            <div class="posts-filter__item ">All</div>
            <?php
                $terms = get_terms(
                  array(
                    'taxonomy'   => 'category',
                    'hide_empty' => true,
                    'pad_counts'  => true,
                    'orderby' => 'count',
                    'order' => 'DESC',
                  )
                );
                foreach($terms as $t):
                    if($t->name == 'Без рубрики'):
                        continue;
                    endif;
                    echo '<div class="posts-filter__item " slug="'.$t->slug.'">' .$t->name. '</div>';
                endforeach;
            ?>
        </div>
        <div class="posts">
            <div class="posts__content">
                <div class="poroduct__list_all_deals products__list products__list_nopadding">
                    <?php
                    $items2 = new WP_Query(array(
                        'post_type' => 'post',
                        'post_status' => 'publish',
                        'orderby' => 'data',
                        'order' => 'DESC',
                        'posts_per_page' => 100,
                    ));
                    $items2 = $items2->get_posts();
                    foreach($items2 as $post):
                        ?>
                        <div class="product__card views-click post__item" views-click="<?php echo $post->views_click; ?>">
                            <a class="product__medium views_click" href="<?php echo $post->guid;?>" product-id="<?php echo $post->ID; ?>">
                                    <img src="<?php echo get_the_post_thumbnail_url($post->ID, 'meduim'); ?>" alt="<?php echo $post->post_title;?>" class="product__card-a__img">
                                    <div class="product__medium-viewed">Viewed</div>
                            </a>
                            <div class="product__desc">
                                <div>
                                    <div class="product__published"><?php echo  'Published ' .get_the_date('Y-m-d', $post->ID); ?></div>
                                    <h2 class="product__title">
                                        <a href="<?php echo $post->guid;?>" class="product__card-a views_click" product-id="<?php echo $post->ID; ?>">
                                            <?php echo $post->post_title;?>
                                        </a>
                                    </h2>
                                    <div class="content_card"></div>
                                </div>
                                <div class="product__buttons">
                                    <?php
                                    $tags = get_the_tags();
                                    if($tags):
                                        foreach($tags as $i => $t):
                                            if($i < 3):
                                                ?>
                                                <a class="product__btn" href="/riza/tag/<?php echo $t->slug; ?>" rel="tag"><?php echo $t->name; ?></a>
                                            <?php
                                            endif;
                                        endforeach;
                                    endif;
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="deals__aside">
                    <div class="aside__block">
                        <div class="aside__items">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php
get_footer();
?>