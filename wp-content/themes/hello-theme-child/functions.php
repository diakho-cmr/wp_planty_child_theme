<?php
/**
 * Theme functions and definitions
 *
 * @package HelloElementorChild
 */

/**
 * Load child theme css and optional scripts
 *
 * @return void
 */

function hello_elementor_child_enqueue_scripts() {
	wp_enqueue_style(
		'hello-elementor-child-style',
		get_stylesheet_directory_uri() . '/style.css');
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_enqueue_scripts', 20 );


function planty_scripts() {
	wp_enqueue_script( 'script', get_stylesheet_directory_uri() . '/script.js', array(), false, false );
}
add_action( 'wp_enqueue_scripts', 'planty_scripts' );

/*
function custom_logo_setup() {
	$args = [
		'height'               => 19,
		'width'                => 192,
		'flex-height'          => true,
		'flex-width'           => true,
        'header-text'          => array( 'site-title', 'site-description' ),
		'unlink-homepage-logo' => true, 
	];
	add_theme_support( 'custom-logo', $args );
}
add_action( 'after_setup_theme', 'custom_logo_setup' );
*/


/*if(is_user_logged_in()) :?>
	<a href="<?php echo admin_url(); ?>">Admin</a>
<?php endif;*/

require_once('order-widget.php');
require_once('flavour-type.php');
require_once('flavours-widget.php');
require_once('admin-menu-item.php');