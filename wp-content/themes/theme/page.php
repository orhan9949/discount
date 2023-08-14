<?php
get_header();

while ( have_posts() ) :
	the_post();
?>
<main class="container">
    <?php if( function_exists('kama_breadcrumbs') ): kama_breadcrumbs(); endif; ?>
    <h1><?php the_title(); ?></h1>
    <article>
        <?php the_content(); ?>
    </article>
</main>
<?php
endwhile;

get_footer(); 
?>