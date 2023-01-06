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