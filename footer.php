<?php
/**
 * Part: footer.php
 *
 * @package    WordPress
 * @subpackage octopress-classic
 * @since      1.0
 */

?>

<footer>
	<p>
		<?php esc_html_e('Copyright &copy;', 'octopress-classic');?> <?php echo wp_kses_post(date('Y')); // @TODO: Convert to theme option.  ?> - <span class="credit">Powered by  <a href="https://wordpress.org/">WordPress</a> and <a href="https://github.com/arnabwahid/octopress">Octopress Theme</a></span>
	</p>
</footer>
<?php wp_footer();?>
</body>
</html>
