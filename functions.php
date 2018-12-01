<?php
/**
 * Theme Functions
 *
 * @package    WordPress
 * @subpackage wp-octopress
 * @since      1.0
 */

if ( function_exists( 'register_sidebar' ) ) {
	register_sidebar(
		array(
			'name'          => __( 'Sidebar', 'wp-octopress' ),
			'id'            => 'sidebar-1',
			'before_widget' => '',
			'after_widget'  => '</section>',
			'before_title'  => '<section><h1>',
			'after_title'   => '</h1>',
		)
	);
}

/**
 * Comment.
 *
 * @author Previous Author
 * @since  1.0
 *
 * @param  Mixed $comment Comment.
 * @param  array $args    Arguments.
 * @param  int   $depth   Depth.
 */
function octopress_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment; // @codingStandardsIgnoreLine: @TODO What is this even doing!?

	switch ( $comment->comment_type ) : // @TODO: Don't use switch!
		case 'pingback':
		case 'trackback':
			?>

			<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
				<p><?php esc_html_e( 'Pingback:', 'wp-octopress' ); ?><?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'wp-octopress' ), '<span class="edit-link">', '</span>' ); ?></p>
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

					echo get_avatar( $comment, 44 );

					printf(
						'<cite class="fn">%1$s</cite>',
						get_comment_author_link()
					);

					printf(
						'<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						wp_kses_post( sprintf( __( '%1$s at %2$s', 'wp-octopress' ), get_comment_date(), get_comment_time() ) )
					);

					?>

					</header><!-- .comment-meta -->

					<?php if ( 0 === absint( $comment->comment_approved ) ) : ?>
						<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'wp-octopress' ); ?></p>
					<?php endif; ?>

					<section class="comment-content comment">
						<?php comment_text(); ?>
						<?php edit_comment_link( __( 'Edit', 'wp-octopress' ), '<p class="edit-link">', '</p>' ); ?>
					</section><!-- .comment-content -->

					<div class="reply">
						<?php

						comment_reply_link(array_merge( $args, array(
							'reply_text' => __( 'Reply', 'wp-octopress' ),
							'after'      => ' <span>&darr;</span>',
							'depth'      => $depth,
							'max_depth'  => $args['max_depth'],
						) ) );

						?>
					</div><!-- .reply -->
				</article><!-- #comment-## -->
			</li>

			<?php
	endswitch;
}

add_filter( 'next_posts_link_attributes', function() {
	return 'class="prev"';
} );

add_filter( 'previous_posts_link_attributes', function() {
	return 'class="next"';
} );

add_action( 'widgets_init', function() {
	unregister_widget( 'WP_Widget_Search' );
}, 1 );

add_action( 'admin_init', function() {
	add_editor_style( 'css/editor-style.css' );
} );

add_action( 'after_setup_theme', function() {
	add_theme_support( 'title-tag' );
} );

add_theme_support( 'automatic-feed-links' );

add_action( 'wp_enqueue_scripts', function() {
	if ( is_singular() && comments_open() && absint( get_option( 'thread_comments' ) ) === 1 ) {
		wp_enqueue_script( 'comment-reply', 'wp-includes/js/comment-reply', array(), false, true );
	}
} );

/**
 * Legacy function.
 *
 * @author Previous Author
 * @since  1.0
 *
 * @return boolean false.
 */
function is_linked_list() {
	return false;
}
