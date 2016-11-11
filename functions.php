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

add_theme_support( 'post-thumbnails' );
//add_image_size( 'slider_img', 1920, 1000, true );

add_action( 'after_setup_theme', 'cs_theme_setup' );
function cs_theme_setup(){
    load_theme_textdomain( 'cs', get_template_directory() . '/languages' );
}

function cs_after_setup_theme() {
    add_theme_support( 'html5', array( 'search-form' ) );
}
add_action( 'after_setup_theme', 'cs_after_setup_theme' );

/** Call to JS & CSS **/
function cs_scripts() {

    wp_enqueue_style( 'bootstrap-css', get_stylesheet_directory_uri() .'/css/bootstrap.min.css' );
	wp_enqueue_style( 'bootstrap-rtl-css', get_stylesheet_directory_uri() .'/css/bootstrap-rtl.min.css' );
	wp_enqueue_style( 'font-awesome-css', get_stylesheet_directory_uri() .'/css/font-awesome.min.css' );
	wp_enqueue_style( 'slick-css', get_stylesheet_directory_uri() .'/css/slick.css' );
	wp_enqueue_style( 'slick-theme-css', get_stylesheet_directory_uri() .'/css/slick-theme.css' );
    wp_enqueue_style( 'main-css', get_stylesheet_uri() );
    
    
    wp_enqueue_script( 'bootstrap-js', get_stylesheet_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.3.5', true );
    wp_enqueue_script( 'owl-carousel-rtl', get_stylesheet_directory_uri() . '/js/slick.min.js', array('jquery'), '1.6.0', true );
    wp_enqueue_script( 'myscripts', get_stylesheet_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0', true );

}

add_action( 'wp_enqueue_scripts', 'cs_scripts' );

include_once('wp_bootstrap_navwalker.php');

/** Sidebars **/



// Register Navigation Menus
function cs_menus() {

	$locations = array(
		'header_menu' => __( 'Header Menu', 'cs' ),
		'footer_menu' => __( 'Footer Menu', 'cs' ),
	);
	register_nav_menus( $locations );

}
add_action( 'init', 'cs_menus' );*/



?>
