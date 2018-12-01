<?php
/**
 * Part: archive.php
 *
 * @package    WordPress
 * @subpackage wp-octopress
 * @since      1.0
 */

?>

<?php get_header(); ?>

<div id="main">
	<div id="content">
		<div class="container">
			<article role="article">
				<header>
					<h1 class="entry-title"><?php esc_html_e( 'Blog Archive', 'wp-octopress' ); ?></h1>
				</header>

				<div id="blog-archives">
					<?php
						$years = $wpdb->get_results( "SELECT YEAR(post_date) AS year FROM wp_posts WHERE post_type = 'post' AND post_status = 'publish' GROUP BY year DESC" );

						foreach ( $years as $year ) {

							$posts_this_year = $wpdb->get_results( $wpdb->prepare( "SELECT post_title,ID FROM wp_posts WHERE post_type = 'post' AND post_status = 'publish' AND YEAR(post_date) = %s", $year->year ) );

							echo wp_kses_post( "<h2>{$year->year}</h2>" );

							foreach ( $posts_this_year as $post ) {
								echo wp_kses_post( '<article><h1><a href="' . get_permalink( $post->ID ) . '">' . $post->post_title . '</a></h1>' );
								echo wp_kses_post( '<time datetime=QQ' . get_the_time( 'c' ) . "QQ pubdate><span class='month'>" . get_the_time( 'M' ) . "</span> <span class='day'>" . get_the_time( 'd' ) . "</span> <span class='year'>" . get_the_time( 'Y' ) . '</span></time>' );
								echo wp_kses_post( '</article>' );
							}
						}
				?>
				</div>
			</article>
		</div>

		<aside class="sidebar thirds">
			<?php dynamic_sidebar(); ?>
		</aside>
	</div>
</div>

<?php get_footer(); ?>
