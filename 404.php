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
			<?php if ($page = get_page_by_title('404')): // @codingStandardsIgnoreLine: I like it this way. ?>
						<article <?php post_class('hentry');?> role="article">
							<header>
								<h1 class="entry-title"><?php echo get_the_title($page->ID); ?></h1>
							</header>

							<div class="entry-content">
								<?php echo wp_kses_post(apply_filters('the_content', $page->post_content)); ?>
							</div>
						</article>
					<?php else: ?>
				<article <?php post_class('hentry');?> role="article">
					<header>
						<h1 class="entry-title"><?php esc_html_e('404', 'octopress-classic');?></h1>
					</header>

					<div class="entry-content">
						<p><img class="size-medium aligncenter noborder" src="<?php echo get_template_directory_uri(); ?>/images/dinosaur.gif"></p>
						<!--<?php get_search_form();?>-->
					</div>
				</article>
			<?php endif;?>
		</div>

		<aside class="sidebar thirds">
			<?php dynamic_sidebar();?>
		</aside>

	</div>
</div>

<?php echo get_footer(); ?>
