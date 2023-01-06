<?php
/**
 * The template for displaying footer.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<footer id="site-footer" class="site-footer dynamic-footer <?php echo esc_attr( $footer_class ); ?>" role="contentinfo">
	<div class="footer-inner">
		<img src="<?php echo get_stylesheet_directory_uri () . '/assets/images/cans.svg' ?>" alt="cannettes">
	</div>
	<a href="#"><p>Mentions légales</p></a>
</footer>
