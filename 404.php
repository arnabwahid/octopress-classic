<?php
/**
 * Part: index.php
 *
 * @package    WordPress
 * @subpackage octopress-classic
 * @since      1.0
 */

?>

<?php get_header(); ?>

<div id="main">
	<div id="content">
		<div class="blog-index">
			<article <?php post_class( 'hentry' ); ?> role="article">
				<header>
					<h1 class="entry-title"><?php esc_html_e( '404, Page Not Found', 'octopress-classic' ); ?></h1>
				</header>

				<div class="entry-content">
					<?php get_search_form(); ?>
				</div>
			</article>
		</div>

		<aside class="sidebar thirds">
			<?php dynamic_sidebar(); ?>
		</aside>

	</div>
</div>

<?php echo get_footer(); ?>
