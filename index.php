<?php
/**
 * Part: index.php
 *
 * @package    WordPress
 * @subpackage wp-octopress-classic-2
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

			<?php if ( ! is_single() ) : ?>
				<div class="pagination">
					<?php next_posts_link( '&larr; Older' ); ?>
					<a href="<?php octopress_the_archive_link(); ?>"><?php esc_html_e( 'Blog Archives', 'wp-octopress-classic-2' ); ?></a>
					<?php previous_posts_link( 'Newer &rarr;' ); ?>
				</div>
			<?php endif; ?>

		</div>

		<aside class="sidebar thirds">
			<?php dynamic_sidebar(); ?>
		</aside>

	</div>
</div>

<?php echo get_footer(); ?>
