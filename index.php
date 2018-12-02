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

			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : ?>
					<?php the_post(); ?>
					<?php get_template_part( 'content', get_post_format() ); ?>
				<?php endwhile; ?>
			<?php endif; ?>

			<?php octopress_pagination(); ?>
		</div>

		<aside class="sidebar thirds">
			<?php dynamic_sidebar(); ?>
		</aside>

	</div>
</div>

<?php echo get_footer(); ?>
