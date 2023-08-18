<?php
/**
 * Template Name: Страница магазинов
 */
get_header();

require get_template_directory() .'/setting-pages/hidden-shops/hidden-shops.php';
global $hidden_shops_count;


?>
<main class="container" id="item_list_name" item_list_name="Stores">
    <section>
        <?php if( function_exists('kama_breadcrumbs') ): kama_breadcrumbs(); endif; ?>
        <h1><?php echo get_the_title()?></h1>
        <?php
        $terms = get_terms( 'categories-shops', ['hide_empty' => false, 'meta_key' => 'popular', 'meta_value' => '1'] );

        if( $terms && ! is_wp_error( $terms ) ):
        ?>
        <div class="categories">
            <?php
            foreach( $terms as $term ):
                if($term->count > $hidden_shops_count):
                ?>
                    <div class="category-card-shop">
                        <a href="<?php echo get_term_link( $term->term_id ); ?>">
                           <div class="category_shops__icon">
                            <?php if( $image = get_field('icon', 'categories-shops_'.$term->term_id) ): ?>
                                <img src="<?php echo $image['url']; ?>" alt="<?php echo esc_html( $term->name ); ?>">
                            <?php endif; ?>
                            </div>
                            <h2 class="category__name"><?php echo esc_html( $term->name ); ?></h2>
                            <div class="category__extra"><?php echo dc_cat_info($term->term_id); ?></div>
                        </a>
                    </div>
                <?php
                endif;
            endforeach; ?>
        </div>
        <?php endif; ?>
		
		
		<!--<div>
		<a href="#" class="changer">
      <span>Show All</span>
    </a>
	
		
		<div class="all_products">
		<h1>All Shops</h1>
        <?php
        $terms = get_terms( 'categories_shops', ['hide_empty' => false, 'meta_key' => 'vse', 'meta_value' => '1'] );

        if( $terms && ! is_wp_error( $terms ) ):
        ?>
        <div class="categories">
            <?php foreach( $terms as $term ): ?>
            <div class="category-card">
                <a href="<?php echo get_term_link( $term->term_id ); ?>">
                    <div class="category__icon">
                    <?php if( $image = get_field('icon', 'categories_shops_'.$term->term_id) ): ?>
                        <img src="<?php echo $image['url']; ?>" alt="<?php echo esc_html( $term->name ); ?>">
                    <?php endif; ?>
                    </div>
                    <div class="category__name"><?php echo esc_html( $term->name ); ?></div>
                    <div class="category__extra"><?php echo dc_cat_info($term->term_id); ?></div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
		</div>
		</div> -->
       <!-- <div class="nav">
            <?php
            $terms = get_terms( 'categories_shops', ['hide_empty' => false] );

            if( $terms && ! is_wp_error( $terms ) ) {
                echo '<ul>';
                foreach( $terms as $term ) {
                    echo '<li><a href="'.get_term_link( $term->term_id ).'">'. esc_html( $term->name ) .' <span>'.dc_cat_info($term->term_id).'</span></a></li>';
                }
                echo '</ul>';
            }
            ?>
        </div> -->
    </section>
</main>
<?php get_footer(); ?>