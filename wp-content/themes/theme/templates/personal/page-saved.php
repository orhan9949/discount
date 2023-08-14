<?php
$saved = get_user_meta( get_current_user_id(), 'saved', true );

if( empty($saved) ) $saved = [];
?>
<div class="account__content">
    <h4>Publications saved: <?php echo count($saved); ?></h4>
    <?php if( $saved ): ?>
    <div class="products__list">
        <?php
        $query = new WP_Query( [
            'post_type' => 'products',
            'orderby' => 'date',
            'post__in' => array_keys($saved)
        ] );
        
        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();

                get_template_part( 'templates/product', 'card');
            }
        } else {
            echo 'No have items.';
        }
        
        wp_reset_postdata();
        ?>
    </div>
    <?php endif; ?>
</div>