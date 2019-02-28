<?php
/*
Template Name: Octopress Archives Template
 */
get_header();?>

<!-- Static Starts -->
<div id="main">
    <div id="content">
        <div>
            <article role="article">

                <header>
                    <h1 class="entry-title">Blog Archive</h1>

                </header>

                <div id="blog-archives">

                    <!--start -->
					<?php
// get years that have posts
$years = $wpdb->get_results("SELECT YEAR(post_date) AS year FROM wp_posts WHERE post_type = 'post' AND post_status = 'publish' GROUP BY year DESC");

foreach ($years as $year) {
    // get posts for each year
    $posts_this_year = $wpdb->get_results("SELECT post_title,id FROM wp_posts WHERE post_type = 'post' AND post_status = 'publish' AND YEAR(post_date) = '" . $year->year . "'");

    echo '<h2>' . $year->year . '</h2>';
    foreach ($posts_this_year as $post) {
        echo '<article><h1><a href="' . get_the_permalink($post->id) . '">' . $post->post_title . '</a></h1>';
        echo "<time datetime=\"" . get_the_time('c', $post->id) . "\" pubdate><span class='month'>" . get_the_time('M', $post->id) . "</span> <span class='day'>" . get_the_time('d', $post->id) . "</span> <span class='year'>" . get_the_time('Y', $post->id) . "</span></time>";
        echo '</article>';
    }
}
?>
                    <!--end-->
                </div><!-- blog archives -->

            </article>
        </div>
        <aside class="sidebar thirds">
			<?php dynamic_sidebar();?>
        </aside>
    </div><!-- #content -->

</div> <!-- content-->

<?php get_footer();?>
