<?php
	/**
	 * Part: page.php
	 *
	 * @package    WordPress
	 * @subpackage octopress-classic
	 * @since      1.0
	 */

?>

<?php get_header(); ?>

<div id="primary main" class="site-content">
	<div id="content" role="main">

		<div>
			<?php while ( have_posts() ): ?>
				<?php the_post(); ?>
				<?php get_template_part('content', 'page'); ?>
			<?php endwhile; ?>
		</div>

		<aside class="sidebar thirds">
			<?php dynamic_sidebar(); ?>
		</aside>

	</div><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>
