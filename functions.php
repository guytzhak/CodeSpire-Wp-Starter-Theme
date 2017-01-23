<?php

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
}

/** END Reset Wordpress **/

/**
 * Setup Theme Functions
 */
if (!function_exists('cs_theme_setup')):
	function cs_theme_setup() {
		load_theme_textdomain( 'cs', get_template_directory() . '/languages' );

		add_theme_support( 'custom-logo', array(
			'height'      => 100,
			'width'       => 400,
			'flex-width' => true,
		) );

		add_theme_support('automatic-feed-links');
		add_theme_support('post-thumbnails');
		add_theme_support('post-formats', array( 'image', 'gallery', 'video' ));
		add_theme_support( 'title-tag' );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );


		// load custom walker menu class file
		require 'wp_bootstrap_navwalker.php';
	}
endif;

add_action( 'after_setup_theme', 'cs_theme_setup' );


/** Call to JS & CSS **/
function cs_scripts() {

    wp_enqueue_style( 'bootstrap-css', get_stylesheet_directory_uri() .'/css/bootstrap.min.css' );
	if(is_rtl()){
		wp_enqueue_style( 'bootstrap-rtl-css', get_stylesheet_directory_uri() .'/css/bootstrap-rtl.min.css' );
	}
	wp_enqueue_style( 'font-awesome-css', get_stylesheet_directory_uri() .'/css/font-awesome.min.css' );
	wp_enqueue_style( 'slick-css', get_stylesheet_directory_uri() .'/css/slick.css' );
	wp_enqueue_style( 'slick-theme-css', get_stylesheet_directory_uri() .'/css/slick-theme.css' );
    wp_enqueue_style( 'main-css', get_stylesheet_uri() );
    
    
    wp_enqueue_script( 'bootstrap-js', get_stylesheet_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.3.5', true );
    wp_enqueue_script( 'owl-carousel-rtl', get_stylesheet_directory_uri() . '/js/slick.min.js', array('jquery'), '1.6.0', true );
    wp_enqueue_script( 'myscripts', get_stylesheet_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0', true );

}

add_action( 'wp_enqueue_scripts', 'cs_scripts' );

include_once('inc/core_func.php');

/** Sidebars **/



// Register Navigation Menus
function cs_menus() {

	$locations = array(
		'header_menu' => __( 'Header Menu', 'cs' ),
		'footer_menu' => __( 'Footer Menu', 'cs' ),
	);
	register_nav_menus( $locations );

}
add_action( 'init', 'cs_menus' );


/**
 * Wrap function to the_custom_logo for old wp versions, Print out the logo
 * @return bool
 */
function cs_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
		return true;
	}

	return false;
}

add_filter( 'get_custom_logo', 'cs_change_logo_class' );

function cs_change_logo_class( $html ) {

	$html = str_replace( 'custom-logo', 'navbar-brand', $html );
	return $html;
}

?>
