<?php
/**
 * Part: content.php
 *
 * @package    WordPress
 * @subpackage wp-octopress
 * @since      1.0
 */

?>

<?php if ( is_page() ) : ?>
	<article class="hentry" id="page" role="article">
<?php else : ?>
	<article class="hentry" role="article">
<?php endif; ?>

	<header>
		<h1 class="entry-title">
			<?php if ( is_single() || is_page() ) : ?>
				<?php if ( is_linked_list() ) : ?>
					<?php the_title(); ?><a class="linked-post-permalink" href="<?php the_permalink(); ?>"><span id="post-permalink">&infin;</span></a>
				<?php else : ?>
					<?php the_title(); ?>
				<?php endif; ?>
			<?php else : ?>
				<?php if ( is_linked_list() ) : ?>
					<a href="<?php the_linked_list_link(); ?>"><?php the_title(); ?></a><a class="linked-post-permalink" href="<?php the_permalink(); ?>"><span id="post-permalink">&infin;</span></a>
				<?php else : ?>
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				<?php endif; ?>
			<?php endif; ?>
		</h1>

		<?php if ( is_single() ) : ?>
			<?php if ( is_linked_list() ) : ?>
				<p class="meta">
					<time datetime="<?php the_time(); ?>" pubdate><?php the_time( get_option( 'date_format' ) ); ?></time> | <a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Permalink', 'wp-octopress' ); ?></a> | <a href="<?php the_linked_list_link(); ?>"><?php esc_html_e( 'External Link', 'wp-octopress' ); ?></a>
				</p>
			<?php else : ?>
				<p class="meta">
					<time datetime="<?php the_time(); ?>" pubdate><?php the_time( get_option( 'date_format' ) ); ?></time> | <a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Permalink', 'wp-octopress' ); ?></a>
				</p>
			<?php endif; ?>

		<?php else : ?>
			<?php if ( is_linked_list() ) : ?>
				<p class="meta">
					<time datetime="<?php the_time(); ?>" pubdate><?php the_time( get_option( 'date_format' ) ); ?></time> |
					<a href="<?php echo( the_permalink() . '#comments' ); ?>"><?php comments_number( 'comments', '1 comment', '% comments' ); ?></a>
				</p>
			<?php else : ?>
				<p class="meta">
					<time datetime="<?php the_time(); ?>" pubdate><?php the_time( get_option( 'date_format' ) ); ?></time> | <a href="<?php echo( the_permalink() . '#comments' ); ?>"><?php comments_number( 'comments', '1 comment', '% comments' ); ?></a>
				</p>
			<?php endif; ?>
		<?php endif; ?>
	</header>

	<div class="entry-content">
		<?php if ( is_single() ) : ?>
			<?php the_content(); ?>
		<?php else : ?>
			<?php the_content( '(Read more...)' ); ?>
		<?php endif; ?>
	</div>

	<?php if ( is_single() ) : ?>
		<footer>
			<p class="meta">
				<span class="byline author vcard">
					<?php esc_html_e( 'Posted by ', 'wp-octopress' ); ?><span class="fn"><?php the_author(); ?></span>
				</span>

				<time datetime="<?php the_time(); ?>" pubdate><?php the_time( get_option( 'date_format' ) ); ?></time>
				<span class="categories"><?php the_tags( '' ); ?></span>
			</p>
		</footer>
	<?php endif; ?>

</article>

<section>
	<?php if ( is_single() ) : ?>
		<?php comments_template(); ?>
	<?php endif; ?>
</section>
