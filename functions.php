<?php
	if( function_exists('register_sidebar') ) {
		register_sidebar(
			array(
				'name' => ('Sidebar'),

				'id' => 'sidebar-1', // Add this line

				'before_widget' => '',
				'after_widget' => '</section>',
				'before_title' => '<section><h1>',
				'after_title' => '</h1>',
			)
		);
	}

	function octopress_comment($comment, $args, $depth)
	{
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ):
			case 'pingback':
			case 'trackback':
				// Display trackbacks differently than normal comments.
				?>
                <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
                <p><?php _e('Pingback:', 'octopress'); ?><?php comment_author_link(); ?><?php edit_comment_link(__('(Edit)', 'octopress'), '<span class="edit-link">', '</span>'); ?></p>
				<?php
				break;
			default:
				// Proceed with normal comments.
				global $post;
				?>
                <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                <article id="comment-<?php comment_ID(); ?>" class="comment">
                    <header class="comment-meta comment-author vcard">
						<?php
							echo get_avatar($comment, 44);
							printf(
								'<cite class="fn">%1$s</cite>',
								get_comment_author_link()
							);
							printf(
								'<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
								esc_url(get_comment_link($comment->comment_ID)),
								get_comment_time('c'),
								/* translators: 1: date, 2: time */
								sprintf(__('%1$s at %2$s', 'octopress'), get_comment_date(), get_comment_time())
							);
						?>
                    </header><!-- .comment-meta -->

					<?php if( '0' == $comment->comment_approved ): ?>
                        <p class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'octopress'); ?></p>
					<?php endif; ?>

                    <section class="comment-content comment">
						<?php comment_text(); ?>
						<?php edit_comment_link(__('Edit', 'octopress'), '<p class="edit-link">', '</p>'); ?>
                    </section><!-- .comment-content -->

                    <div class="reply">
						<?php comment_reply_link(array_merge($args, array('reply_text' => __('Reply', 'octopress'), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                    </div><!-- .reply -->
                </article><!-- #comment-## -->
				<?php
				break;
		endswitch; // end comment_type check
	} ?>


<?php

// Start custom
//To return the URL of the previous page, use the following php code:
	add_filter('next_posts_link_attributes', 'posts_link_attributes_previous');
	add_filter('previous_posts_link_attributes', 'posts_link_attributes_next');

	function posts_link_attributes_previous()
	{
		return 'class="prev"';
	}

	function posts_link_attributes_next()
	{
		return 'class="next"';
	}

// Custom end ?>


<?php
// unregister all default WP Widgets
	function unregister_default_wp_widgets()
	{

		//unregister_widget('WP_Widget_Pages');

		//unregister_widget('WP_Widget_Calendar');

		//unregister_widget('WP_Widget_Archives');

		//unregister_widget('WP_Widget_Links');

		//unregister_widget('WP_Widget_Meta');

		unregister_widget('WP_Widget_Search');

		//unregister_widget('WP_Widget_Text');

		//unregister_widget('WP_Widget_Categories');

		//unregister_widget('WP_Widget_Recent_Posts');

		//unregister_widget('WP_Widget_Recent_Comments');

		//unregister_widget('WP_Widget_RSS');

		//unregister_widget('WP_Widget_Tag_Cloud');
	}

	add_action('widgets_init', 'unregister_default_wp_widgets', 1);

?>

<?php
	/**
	 * Registers an editor stylesheet for the theme.
	 */
	function octopress_add_editor_styles()
	{
		add_editor_style('css/editor-style.css');
	}

	add_action('admin_init', 'octopress_add_editor_styles');
// Add theme support - title tag

	add_action('after_setup_theme', 'octopress_theme_setup');
	function octopress_theme_setup()
	{
		/*
					 * Let WordPress manage the document title.
					 * By adding theme support, we declare that this theme does not use a
					 * hard-coded <title> tag in the document head, and expect WordPress to
					 * provide it for us.
			*/
		add_theme_support('title-tag');
	}

	add_theme_support('automatic-feed-links');

	/**
	 * Add .js script if "Enable threaded comments" is activated in Admin
	 * Codex: {@link https://developer.wordpress.org/reference/functions/wp_enqueue_script/}
	 */
	function octopress_enqueue_comments_reply()
	{

		if( is_singular() && comments_open() && (get_option('thread_comments') == 1) ) {
			// Load comment-reply.js (into footer)
			wp_enqueue_script('comment-reply', 'wp-includes/js/comment-reply', array(), false, true);
		}
	}

	add_action('wp_enqueue_scripts', 'octopress_enqueue_comments_reply');