<?php
get_header();
$post = get_post();
?>
    <main class="container">
        <section>
            <?php if( function_exists('kama_breadcrumbs') ): kama_breadcrumbs(); endif; ?>
            <div class="product-page">
                <div class="product__inside">
                    <div class="product__content">
                        <div class="hidden_mobile">
                            <div class="product__card">
                                <div class="product__desc">
                                    <div class="product__title">
                                        <div class="product__published"><?php echo  'Published ' .get_the_date('Y-m-d', $post->ID); ?></div>
                                        <h1 class="single_title">
                                            <?php echo $post->post_title;?>
                                        </h1>
                                        <?php $tags = get_the_tags();
                                        if($tags): ?>
                                            <div class="product__buttons">
                                                <?php foreach($tags as $i => $t):
                                                    if($i < 3):  ?>
                                                        <a class="product__btn"
                                                           rel="tag"><?php echo $t->name; ?></a>
                                                    <?php endif;
                                                endforeach; ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if(get_the_post_thumbnail_url($post->ID, 'meduim')): ?>
                                            <div class="product__img">
                                                <img src="<?php echo get_the_post_thumbnail_url($post->ID, 'meduim'); ?>" alt="<?php echo $post->post_title;?>">
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product__text">
                            <?php
                            the_content();
                            $info = get_field('block_text');
                            if($info):
                                foreach ($info as $i):
                                    if($i['title']):
                                        echo '<h3>'.$i['title'].'</h3>';
                                    endif;
                                    if($i['text']):
                                        echo '<p>'.$i['text'].'</p>';
                                    endif;
                                    if($i['image']):
                                        echo '<img src="' .$i['image']. '" alt="">';
                                    endif;
                                endforeach;
                            endif;

                            ?>
                            <div class="disclaimer_card_box">
                                <div class="disclaimer_card">
                                    <?php
                                    $tags = get_the_tags();
                                    if($tags):
                                        foreach($tags as $t):
                                        /**
                                         * href="<?php echo get_home_url(); ?>/tag/<?php echo $t->slug; ?>
                                         */
                                            ?>
                                            <a rel="tag">#<?php echo $t->name; ?></a>
                                        <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        $items = new WP_Query(array(
                            'post_type' => 'post',
                            'post_status' => 'publish',
                            'orderby' => 'views_click',
                            'order' => 'DESC',
                            'posts_per_page' => 5,
                            's' => $post->post_title,
                            'post__not_in'  => [ $post->ID ]
                        ));
                        $items = $items->get_posts();
                        if($items):
                        ?>
                        <div class="similar">
                            <div class="h2_parody">Similar posts</div>
                            <div class="products-4x products">
                                <?php foreach($items as $i => $p): ?>
                                <div class="product__item views-click" product-id="<?php echo $p->ID; ?>" views-click="<?php echo $p->views_click; ?>">
                                    <div class="product__thumb">
                                        <a href="<?php echo $p->guid;?>" class="view_click">
                                            <img src="<?php echo get_the_post_thumbnail_url($p->ID, 'meduim'); ?>" alt="">
                                        </a>
                                    </div>
                                    <div class="product__name_2" style="margin-left: 10px;">
                                        <?php
                                        $cat = get_the_category( $p->ID );
                                        foreach($cat as $i => $c):
                                            if($i < 1):
                                                echo $c->name;
                                            endif;
                                        endforeach;
                                        ?>
                                    </div>
                                    <div class="product__name_compact">
                                        <a href="<?php echo $p->guid;?>" class="view_click">
                                            <?php echo $p->post_title;?>
                                        </a>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                </div>
                <?php
                    $items2 = new WP_Query(array(
                        'post_type' => 'post',
                        'post_status' => 'publish',
                        'orderby' => 'views_click',
                        'order' => 'DESC',
                        'posts_per_page' => 5,
                    ));
                    $items2 = $items2->get_posts();
                    if($items2):
                ?>
                <div class="product__aside">
                    <div class="aside__block">
                        <div class="aside__head">Popular posts</div>
                        <div class="aside__items">
                            <?php foreach($items2 as $i => $p): ?>
                                <div class="views-click" product-id="<?php echo $p->ID; ?>" views_click="<?php echo $p->views_click; ?>">
                                    <div class="aside__item">
                                        <a href="<?php echo $p->guid;?>" class="aside__pic view_click">
                                            <img src="<?php echo get_the_post_thumbnail_url($p->ID, 'meduim'); ?>" alt="<?php echo $p->post_title;?>">
                                        </a>
                                        <div class="aside__desc">
                                            <a href="<?php echo $p->guid;?>" class="aside__desc-text view_click">
                                                <div class="product__price">
                                                    <?php
                                                    $cat = get_the_category( $p->ID );
                                                    foreach($cat as $i => $c):
                                                        if($i < 1):
                                                            echo $c->name;
                                                        endif;
                                                    endforeach;
                                                    ?>
                                                </div>
                                                <div class="aside__caption">
                                                    <div class="aside__title"><?php echo $p->post_title;?></div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </section>
    </main>
<?php
get_footer();


