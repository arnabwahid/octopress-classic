<?php
/**
 * Part: footer.php
 *
 * @package    WordPress
 * @subpackage octopress-classic
 * @since      1.0
 */

?>

<footer role="contentinfo">
	<p>
		<?php esc_html_e( 'Copyright &copy;', 'octopress-classic' ); ?> <?php echo wp_kses_post( date( 'Y' ) ); // @TODO: Convert to theme option. ?>
	</p>
</footer>
<?php wp_footer(); ?>
</body>
</html>
