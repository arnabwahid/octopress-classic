<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package    WordPress
 * @subpackage wp-octopress-2
 * @since      1.0
 */

?>

<?php get_header(); ?>

<div id="primary main" class="site-content">
	<div id="content" role="main">

		<div>
			<?php while ( have_posts() ) : ?>
				<?php the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; ?>
		</div>

		<aside class="sidebar thirds">
			<?php dynamic_sidebar(); ?>
		</aside>

	</div><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>
