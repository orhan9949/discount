<div id="comments" class="product__comments">
	<h3>Comments</h3>
	
	<?php
	if ( post_password_required() ) {
		return;
	}

	if ( comments_open() || pings_open() ) {
		comment_form(
			array(
				'class_container'    => '',
				'class_form'         => 'comment__form',
				'title_reply'        => '',
				'title_reply_before' => '<div class="comment__replyto">',
				'title_reply_after'  => '</div>',
				'class_submit'       => 'btn btn-border',
				'comment_field'        => '<div class="comment__input comment-form-comment">
					<textarea id="comment" name="comment" cols="25" rows="4" aria-required="true" placeholder="' . _x( 'Comment', 'noun' ) . '" required="required"></textarea>',
				'must_log_in'          => '<div>' .
					sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), get_permalink( 87 ) ) . '
				</div>',
				'logged_in_as'         => '<div class="comment__pic">' . get_avatar( wp_get_current_user(), 80 ) . '</div>',
				'submit_field'         => '<div class="comment__submit">%1$s %2$s</div></div>',
			)
		);
	} elseif ( is_single() ) {
		?>
		<p class="comments-closed">Comments are closed.</p>
		<?php
	}

	if ( $comments ) {
		$comments_number = absint( get_comments_number() );
		?>
		<div class="comments">
			<?php
			wp_list_comments(
				array(
					'avatar_size' => 80,
					'callback'    => 'dc_comment',
				)
			);

			$comment_pagination = paginate_comments_links(
				array(
					'echo'      => false,
					'end_size'  => 0,
					'mid_size'  => 0,
					'next_text' => __( 'Newer Comments', 'theme' ) . ' <span aria-hidden="true">&rarr;</span>',
					'prev_text' => '<span aria-hidden="true">&larr;</span> ' . __( 'Older Comments', 'theme' ),
				)
			);

			if ( $comment_pagination ) {
				$pagination_classes = '';

				// If we're only showing the "Next" link, add a class indicating so.
				if ( false === strpos( $comment_pagination, 'prev page-numbers' ) ) {
					$pagination_classes = ' only-next';
				}
				?>

				<nav class="comments-pagination pagination<?php echo $pagination_classes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output ?>">
					<?php echo wp_kses_post( $comment_pagination ); ?>
				</nav>

				<?php
			}
			?>
		</div>
		<?php
	}
	?>
</div>