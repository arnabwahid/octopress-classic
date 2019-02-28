<?php
/**
 * Theme Functions
 *
 * @package    WordPress
 * @subpackage octopress-classic
 * @since      1.0
 */

if (function_exists('register_sidebar')) {
    register_sidebar(
        array(
            'name' => __('Sidebar', 'octopress-classic'),
            'id' => 'sidebar-1',
            'before_widget' => '',
            'after_widget' => '</section>',
            'before_title' => '<section><h1>',
            'after_title' => '</h1>',
        )
    );
}

/**
 * Show the search value.
 *
 * @author Arnab Wahid <arnabwahid@gmail.com>
 * @since  1.0.0
 */
function octopress_s()
{
    return isset($_REQUEST['s']) ? esc_html($_REQUEST['s']) : ''; // @codingStandardsIgnoreLine: REQUEST access okay here.
}

add_theme_support('title-tag'); // Let WP handle the title tag.

/**
 * Pagination.
 *
 * @author Arnab Wahid <arnabwahid@gmail.com>
 * @since  1.0.0
 */
function octopress_pagination()
{
    ?>

	<?php if (!is_single()): ?>
		<div class="pagination">
			<?php next_posts_link('&larr; Older');?>
			<a href="<?php echo get_page_link(get_page_by_path('archives')); ?>"><?php esc_html_e('Blog Archives', 'octopress-classic');?></a>
			<?php previous_posts_link('Newer &rarr;');?>
		</div>
	<?php endif;?>

	<?php
}

/**
 * The avatar.
 *
 * @author Arnab Wahid <arnabwahid@gmail.com>
 * @since  1.0
 */
function octopress_avatar()
{
    if (defined('OCTOPRESS_AVATAR') && OCTOPRESS_AVATAR) {
        echo get_avatar(get_option('admin_email'), 96);
    }
}

/**
 * Where can we get to the archive page.
 *
 * @author Arnab Wahid <arnabwahid@gmail.com>
 * @since  1.0
 */
function octopress_the_archive_link()
{
    global $wpdb;
    $years = $wpdb->get_results("SELECT YEAR(post_date) AS year FROM wp_posts WHERE post_type = 'post' AND post_status = 'publish' GROUP BY year DESC");
    $year = current($years);
    echo esc_url(home_url($year->year));
}

add_filter('next_posts_link_attributes', function () {
    return 'class="prev"';
});

add_filter('previous_posts_link_attributes', function () {
    return 'class="next"';
});

add_action('widgets_init', function () {
    unregister_widget('WP_Widget_Search');
}, 1);

add_action('admin_init', function () {
    add_editor_style('css/editor-style.css');
});

add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
});

add_theme_support('automatic-feed-links');

add_action('wp_enqueue_scripts', function () {
    if (is_singular() && comments_open() && absint(get_option('thread_comments')) === 1) {
        wp_enqueue_script('comment-reply', 'wp-includes/js/comment-reply', array(), false, true);
    }
});

add_action('wp_head', function () {
    if (defined('OCTOPRESS_STYLES') && is_string(OCTOPRESS_STYLES)) {
        echo OCTOPRESS_STYLES; // @codingStandardsIgnoreLine
    }
});

/**
 * Legacy function.
 *
 * @author Previous Author
 * @since  1.0
 *
 * @return boolean false.
 */
function is_linked_list()
{
    return false;
}

function register_my_menu()
{
    register_nav_menu('primary', __('Primary Menu', 'theme-slug'));
}
add_action('after_setup_theme', 'register_my_menu');

// post formats
add_theme_support('post-formats', array('aside', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video', 'audio'));

// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// soil
add_theme_support('soil-clean-up');
//add_theme_support('soil-relative-urls');
//add_theme_support('soil-nice-search');


add_filter( 'show_recent_comments_widget_style', '__return_false', 99 );


// comments field
function my_update_comment_fields( $fields ) {

    $commenter = wp_get_current_commenter();
    $req       = get_option( 'require_name_email' );
    $label     = $req ? '*' : ' ' . __( '(optional)', 'text-domain' );
    $aria_req  = $req ? "aria-required='true'" : '';

    $fields['author'] =
        '<p class="comment-form-author">
            <label for="author">' . __( "Name", "text-domain" ) . $label . '</label>
            <input id="author" name="author" type="text" placeholder="' . esc_attr__( " Chuck Norris", "text-domain" ) . '" value="' . esc_attr( $commenter['comment_author'] ) .
        '" size="30" ' . $aria_req . ' />
        </p>';

    $fields['email'] =
        '<p class="comment-form-email">
            <label for="email">' . __( "Email", "text-domain" ) . $label . '</label>
            <input id="email" name="email" type="email" placeholder="' . esc_attr__( " name@email.com", "text-domain" ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) .
        '" size="30" ' . $aria_req . ' />
        </p>';

    $fields['url'] =
        '<p class="comment-form-url">
            <label for="url">' . __( "Website", "text-domain" ) . '</label>
            <input id="url" name="url" type="url"  placeholder="' . esc_attr__( " http://google.com", "text-domain" ) . '" value="' . esc_attr( $commenter['comment_author_url'] ) .
        '" size="30" />
            </p>';

    return $fields;
}
add_filter( 'comment_form_default_fields', 'my_update_comment_fields' );

function my_update_comment_field( $comment_field ) {

  $comment_field =
    '<p class="comment-form-comment">
            <label for="comment">' . __( "Comment", "text-domain" ) . '</label>
            <textarea required id="comment" name="comment" placeholder="' . esc_attr__( " Enter comment here...", "text-domain" ) . '" cols="45" rows="8" aria-required="true"></textarea>
        </p>';

  return $comment_field;
}
add_filter( 'comment_form_field_comment', 'my_update_comment_field' );



class comment_walker extends Walker_Comment {
        var $tree_type = 'comment';
        var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );
 
        // constructor – wrapper for the comments list
        function __construct() { ?>

            <section class="comments-list">

        <?php }

        // start_lvl – wrapper for child comments list
        function start_lvl( &$output, $depth = 0, $args = array() ) {
            $GLOBALS['comment_depth'] = $depth + 2; ?>
            
            <section class="child-comments comments-list">

        <?php }
    
        // end_lvl – closing wrapper for child comments list
        function end_lvl( &$output, $depth = 0, $args = array() ) {
            $GLOBALS['comment_depth'] = $depth + 2; ?>

            </section>

        <?php }

        // start_el – HTML for comment template
        function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
            $depth++;
            $GLOBALS['comment_depth'] = $depth;
            $GLOBALS['comment'] = $comment;
            $parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' ); 
    
            if ( 'article' == $args['style'] ) {
                $tag = 'article';
                $add_below = 'comment';
            } else {
                $tag = 'article';
                $add_below = 'comment';
            } ?>

            <article <?php comment_class(empty( $args['has_children'] ) ? '' :'parent') ?> id="comment-<?php comment_ID() ?>" itemprop="comment" itemscope itemtype="http://schema.org/Comment">
                <figure class="gravatar"><?php echo get_avatar( $comment, 65, '[default gravatar URL]', 'Author’s gravatar' ); ?></figure>
                <div class="comment-meta post-meta" role="complementary">
                    <h2 class="comment-author">
                        <a class="comment-author-link" href="<?php comment_author_url(); ?>" itemprop="author"><?php comment_author(); ?></a>
                    </h2>
                    <time class="comment-meta-item" datetime="<?php comment_date('Y-m-d') ?>T<?php comment_time('H:iP') ?>" itemprop="datePublished"><?php comment_date('jS F Y') ?>, <a href="#comment-<?php comment_ID() ?>" itemprop="url"><?php comment_time() ?></a></time>
                    <?php edit_comment_link('<p class="comment-meta-item">Edit this comment</p>','',''); ?>
                    <?php if ($comment->comment_approved == '0') : ?>
                    <p class="comment-meta-item">Your comment is awaiting moderation.</p>
                    <?php endif; ?>
                </div>
                <div class="comment-content post-content" itemprop="text">
                    <?php comment_text() ?>
                    <?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                </div>

        <?php }

        // end_el – closing HTML for comment template
        function end_el(&$output, $comment, $depth = 0, $args = array() ) { ?>

            </article>

        <?php }

        // destructor – closing wrapper for the comments list
        function __destruct() { ?>

            </section>
        
        <?php }

    }