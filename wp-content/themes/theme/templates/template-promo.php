<?php
/**
 * Template Name: Страница промокодов
 */
get_header();
?>
<main class="container">
    <section>
        <?php if( function_exists('kama_breadcrumbs') ): kama_breadcrumbs(); endif; ?>
        <h1><? echo 'Product '.get_the_title().' in Discount One'; ?></h1>
        <?php
        $terms = get_terms( 'promocodes', ['hide_empty' => false, 'meta_key' => 'popular', 'meta_value' => '1'] );

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
                    <h2 class="category__name"><?php echo esc_html( $term->name ); ?></h2>
                    <div class="category__extra"><?php echo dc_cat_info($term->term_id); ?></div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
       <!-- <div class="nav">
            <?php
            $terms = get_terms( 'promocodes', ['hide_empty' => false] );

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