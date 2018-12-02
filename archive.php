<?php
/**
 * Part: archive.php
 *
 * @package    WordPress
 * @subpackage octopress-classic
 * @since      1.0
 */

?>

<?php get_header(); ?>

<div id="main">
	<div id="content">
		<div class="container">
			<article role="article">
				<header>
					<?php if ( is_category() || is_tag() ) : ?>
						<h1 class="entry-title"><?php single_cat_title(); ?></h1>
					<?php else : ?>
						<h1 class="entry-title"><?php the_archive_title(); ?></h1>
					<?php endif; ?>
				</header>

				<div id="blog-archives">
					<h2>&darr;</h2>

					<?php if ( have_posts() ) : ?>
						<?php while ( have_posts() ) : ?>
							<?php the_post(); ?>


							<article>
								<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
								<time datetime="" pubdate>
									<span class="month"><?php echo wp_kses_post( get_the_time( 'M' ) ); ?></span>
									<span class="day"><?php echo wp_kses_post( get_the_time( 'd' ) ); ?></span>
									<span class="year"></span>
								</time>
							</article>
						<?php endwhile; ?>
					<?php endif; ?>

					<?php octopress_pagination(); ?>
				</div>
			</article>
		</div>

		<aside class="sidebar thirds">
			<?php dynamic_sidebar(); ?>
		</aside>
	</div>
</div>

<?php get_footer(); ?>
