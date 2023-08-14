<?php // Silence is golden.

get_header();
?>
<main class="container">
	<?php
	$archive_title    = '';
	$archive_subtitle = '';

	if ( is_search() ) {
		global $wp_query;

		$archive_title = sprintf(
			'%1$s %2$s',
			'<span class="color-accent">' . __( 'Search:', 'theme' ) . '</span>',
			'&ldquo;' . get_search_query() . '&rdquo;'
		);

		if ( $wp_query->found_posts ) {
			$archive_subtitle = sprintf(
				/* translators: %s: Number of search results. */
				_n(
					'We found %s result for your search.',
					'We found %s results for your search.',
					$wp_query->found_posts,
					'theme'
				),
				number_format_i18n( $wp_query->found_posts )
			);
		} else {
			$archive_subtitle = __( 'We could not find any results for your search. You can give it another try through the search form below.', 'theme' );
		}
	} elseif ( is_archive() && ! have_posts() ) {
		$archive_title = __( 'Nothing Found', 'theme' );
	} elseif ( ! is_home() ) {
		$archive_title    = get_the_archive_title();
		$archive_subtitle = get_the_archive_description();
	}

	if ( $archive_title || $archive_subtitle ) {
		?>
		<?php if ( $archive_title ) { ?>
			<h1><?php echo wp_kses_post( $archive_title ); ?></h1>
		<?php } ?>

		<?php if ( $archive_subtitle ) { ?>
			<div><?php echo wp_kses_post( wpautop( $archive_subtitle ) ); ?></div>
		<?php } ?>
		<?php
	}

	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();

			the_content();
		}
	} elseif ( is_search() ) {
		get_search_form(
			array(
				'aria_label' => __( 'search again', 'theme' ),
			)
		);
	}
	?>
</main>
<?php
get_footer();