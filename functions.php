<?php
/**
 * Theme Functions
 *
 * @package    WordPress
 * @subpackage octopress-classic
 * @since      1.0
 */

if ( function_exists( 'register_sidebar' ) ) {
	register_sidebar(
		array(
			'name'          => __( 'Sidebar', 'octopress-classic' ),
			'id'            => 'sidebar-1',
			'before_widget' => '',
			'after_widget'  => '</section>',
			'before_title'  => '<section><h1>',
			'after_title'   => '</h1>',
		)
	);
}

/**
 * Show the search value.
 *
 * @author Arnab Wahid <arnabwahid@gmail.com>
 * @since  1.0.0
 */
function octopress_s() {
	return isset( $_REQUEST['s'] ) ? esc_html( $_REQUEST['s'] ) : ''; // @codingStandardsIgnoreLine: REQUEST access okay here.
}

add_theme_support( 'title-tag' ); // Let WP handle the title tag.

/**
 * Pagination.
 *
 * @author Arnab Wahid <arnabwahid@gmail.com>
 * @since  1.0.0
 */
function octopress_pagination() {
	?>

	<?php if ( ! is_single() ) : ?>
		<div class="pagination">
			<?php next_posts_link( '&larr; Older' ); ?>
			<a href="<?php echo get_page_link( get_page_by_path( 'archives' ) ); ?>"><?php esc_html_e( 'Blog Archives', 'octopress-classic' ); ?></a>
			<?php previous_posts_link( 'Newer &rarr;' ); ?>
		</div>
	<?php endif; ?>

	<?php
}

/**
 * The avatar.
 *
 * @author Arnab Wahid <arnabwahid@gmail.com>
 * @since  1.0
 */
function octopress_avatar() {
	if ( defined( 'OCTOPRESS_AVATAR' ) && OCTOPRESS_AVATAR ) {
		echo get_avatar( get_option( 'admin_email' ), 96 );
	}
}

/**
 * Where can we get to the archive page.
 *
 * @author Arnab Wahid <arnabwahid@gmail.com>
 * @since  1.0
 */
function octopress_the_archive_link() {
	global $wpdb;
	$years = $wpdb->get_results( "SELECT YEAR(post_date) AS year FROM wp_posts WHERE post_type = 'post' AND post_status = 'publish' GROUP BY year DESC" );
	$year  = current( $years );
	echo esc_url( home_url( $year->year ) );
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

add_action( 'wp_head', function() {
	if ( defined( 'OCTOPRESS_STYLES' ) && is_string( OCTOPRESS_STYLES ) ) {
		echo OCTOPRESS_STYLES; // @codingStandardsIgnoreLine
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



function register_my_menu() {
  register_nav_menu( 'primary', __( 'Primary Menu', 'theme-slug' ) );
}
add_action( 'after_setup_theme', 'register_my_menu' );
