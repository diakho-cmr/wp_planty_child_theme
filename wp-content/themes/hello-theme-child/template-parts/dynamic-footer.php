<?php
/**
 * The template for displaying footer.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$footer_class = did_action( 'elementor/loaded' ) ? esc_attr( hello_get_footer_layout_class() ) : '';
$template = basename(get_page_link());
$pages = get_pages(); 
foreach ( $pages as $page ) {
  if($page->post_name == 'politique-de-confidentialite') {
	  $legal_notices_link = get_permalink($page->ID);
	}
}
?>

<footer id="site-footer" class="site-footer dynamic-footer <?php echo esc_attr( $footer_class ); ?>" role="contentinfo">
	<div class="footer-inner <?php if($template == 'nous-rencontrer') echo 'footer-pink-background'; ?>">
		<?php if($template != 'commander') : ?>
			<img src="<?php echo get_stylesheet_directory_uri () . '/assets/images/cans.svg' ?>" alt="cannettes">
		<?php endif; ?>
	</div>
	<a href="<?php echo $legal_notices_link; ?>"><p>Mentions légales</p></a>
</footer>