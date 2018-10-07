<?php get_header(); ?>

<div id="main">
    <div id="content">
        <div class="blog-index">
			<?php if( have_posts() ): ?>
				<?php while ( have_posts() ): the_post(); ?>
					<?php get_template_part('content', get_post_format()); ?>
				<?php endwhile; ?>
			<?php endif; ?>




			<?php if( !is_single() ): ?>
                <div class="pagination">

					<?php next_posts_link('← Older'); ?>

                    <a href="/blog/archives">Blog Archives</a>

					<?php previous_posts_link('Newer →'); ?>

                </div>
			<?php endif; ?>

        </div>
        <aside class="sidebar thirds">
			<?php dynamic_sidebar(); ?>
        </aside>
    </div>
</div>


<?php echo get_footer(); ?>
