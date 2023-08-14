<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>
<main>
	<div class="container">
		<?php
		if ( have_posts() ) {

			while ( have_posts() ) {
				the_post();

				the_content();
			}
		}
		?>
	</div>
</main>
<?php get_footer(); ?>