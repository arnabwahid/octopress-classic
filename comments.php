<?php
	/**
	 * Part: comments.php
	 *
	 * @package    WordPress
	 * @subpackage octopress-classic
	 * @since      1.0
	 */

?>

<?php

	if( post_password_required() ) {
		return;
	}

?>

<div id="comments" class="comments-area">
	<?php if( have_comments() ): ?>

		<h2 class="comments-title">
			<?php

				// translators.
				echo wp_kses_post(sprintf(_n('One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'octopress-classic'), number_format_i18n(get_comments_number()), '<span>' . get_the_title() . '</span>')); // @codingStandardsIgnoreLine: @TODO: Fix _n here.

			?>
		</h2>

		<ul class="commentlist">
			<?php

				wp_list_comments(array(
					'callback' => function ($comment, $args, $depth) {
						$GLOBALS['comment'] = $comment; // @codingStandardsIgnoreLine: @TODO What is this even doing!?

						switch ( $comment->comment_type ): // @TODO: Don't use switch!
							case 'pingback':
							case 'trackback':
								?>

								<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
									<p><?php esc_html_e('Pingback:', 'octopress-classic'); ?><?php comment_author_link(); ?><?php edit_comment_link(__('(Edit)', 'octopress-classic'), '<span class="edit-link">', '</span>'); ?></p>
								</li>

								<?php

								break;
							default:
								global $post;

								?>

								<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
									<article id="comment-<?php comment_ID(); ?>" class="comment">
										<header class="comment-meta comment-author vcard">

											<?php

												printf(
													'<cite class="fn">%1$s</cite>',
													get_comment_author_link()
												);

												echo '&nbsp;';

												printf(
													'<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
													esc_url(get_comment_link($comment->comment_ID)),
													get_comment_time('c'),
													/* translators: 1: date, 2: time */
													wp_kses_post(sprintf(__('%1$s at %2$s', 'octopress-classic'), get_comment_date(), get_comment_time()))
												);

											?>

										</header><!-- .comment-meta -->

										<?php if( 0 === absint($comment->comment_approved) ): ?>
											<p class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'octopress-classic'); ?></p>
										<?php endif; ?>

										<section class="comment-content comment">
											<?php comment_text(); ?>
											<?php edit_comment_link(__('Edit', 'octopress-classic'), '<p class="edit-link">', '</p>'); ?>
										</section><!-- .comment-content -->

										<div class="reply">
											<?php

												comment_reply_link(array_merge($args, array(
													'reply_text' => __('Reply', 'octopress-classic'),
													'after' => ' <span>&darr;</span>',
													'depth' => $depth,
													'max_depth' => $args['max_depth'],
												)));

											?>
										</div><!-- .reply -->
									</article><!-- #comment-## -->
								</li>

							<?php
						endswitch;
					},
					'style' => 'ul',
				));

			?>
		</ul><!-- .commentlist -->

		<?php if( get_comment_pages_count() > 1 && get_option('page_comments') ): ?>
			<nav id="comment-nav-below" class="navigation" role="navigation">
				<h1 class="assistive-text section-heading"><?php esc_html_e('Comment navigation', 'octopress-classic'); ?></h1>
				<div class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments', 'octopress-classic')); ?></div>
				<div class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;', 'octopress-classic')); ?></div>
			</nav>
		<?php endif; ?>

		<?php if( !comments_open() && get_comments_number() ): ?>
			<p class="nocomments"><?php esc_html_e('Comments are closed.', 'octopress-classic'); ?></p>
		<?php endif; ?>

	<?php endif; // Has comments. ?>

	<?php comment_form(); ?>
</div>
