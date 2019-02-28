<?php
/**
 * Part: index.php
 *
 * @package    WordPress
 * @subpackage octopress-classic
 * @since      1.0
 */

?>

<?php get_header();?>

<div id="main">
	<div id="content">
		<div class="blog-index">
			<article>
				<?php if (is_search()): ?>
					<header>
						<h1><?php echo esc_html(sprintf(__('Search for "%s"', 'octopress-classic'), octopress_s())); // @codingStandardsIgnoreLine: No translators, please!  ?></h1>
					</header>
				<?php endif;?>

				<?php if (have_posts()): ?>
					<?php while (have_posts()): ?>
						<?php the_post();?>
						<?php get_template_part('content', get_post_format());?>
					<?php endwhile;?>
				<?php endif;?>

			</article>

			<?php octopress_pagination();?>
		</div>

		<aside class="sidebar thirds">
			<?php dynamic_sidebar();?>
		</aside>
	</div>
</div>

<?php echo get_footer(); ?>
