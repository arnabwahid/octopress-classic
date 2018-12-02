<?php
/**
 * Part: footer.php
 *
 * @package    WordPress
 * @subpackage wp-octopress-classic-2
 * @since      1.0
 */

?>

<footer role="contentinfo">
	<p>
		<?php esc_html_e( 'Copyright &copy;', 'wp-octopress-classic-2' ); ?> <?php echo wp_kses_post( date( 'Y' ) ); // @TODO: Convert to theme option. ?>
	</p>
</footer>
<?php wp_footer(); ?>
</body>
</html>
