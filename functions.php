<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

Class CodeSpire_FrameWork {
    
    public function __construct() {
        
        $this->create_acf_support();

        add_action( 'after_setup_theme', array($this, 'cs_theme_setup') );
        add_action( 'wp_enqueue_scripts', array($this, 'cs_style_and_scripts'));
        add_action( 'init', array($this, 'cs_menus') );
        $this->helper();
    }

    public function create_acf_support() {
        if( function_exists('acf_add_options_page') ) {

            acf_add_options_page(array(
                'page_title' 	=> 'Theme General Settings',
                'menu_title'	=> 'Theme Settings',
                'menu_slug' 	=> 'theme-general-settings',
                'capability'	=> 'edit_posts',
                'redirect'		=> false
            ));

        }
    }

    /**
     * Setup Theme Functions
     */
    public function cs_theme_setup() {
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

    }

    /** Call to JS & CSS **/
    function cs_style_and_scripts() {

        wp_enqueue_style( 'bootstrap-css', get_stylesheet_directory_uri() .'/css/bootstrap.min.css' );
        if(is_rtl()){
            wp_enqueue_style( 'bootstrap-rtl-css', get_stylesheet_directory_uri() .'/css/bootstrap-rtl.min.css' );
        }
        wp_enqueue_style( 'bootstrap-accessibility-css', get_stylesheet_directory_uri() .'/css/bootstrap-accessibility.css' );
        wp_enqueue_style( 'main-css', get_stylesheet_uri() );


        wp_enqueue_script( 'bootstrap-js', get_stylesheet_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.3.5', true );
        wp_enqueue_script( 'bootstrap-accessibility-js', get_stylesheet_directory_uri() . '/js/bootstrap-accessibility.min.js', array('jquery'), '1.6.0', true );
        wp_enqueue_script( 'myscripts', get_stylesheet_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0', true );

    }


    // Register Navigation Menus
    public function cs_menus() {
        $locations = array(
            'header_menu' => __( 'Header Menu', 'cs' ),
            'footer_menu' => __( 'Footer Menu', 'cs' ),
        );
        register_nav_menus( $locations );
    }
    
    public function helper(){
        // Admin
        include_once('admin/theme_admin.php');
        include_once('admin/post_types.php');
        
        // Includes
        require 'inc/wp_bootstrap_navwalker.php';
        include_once('inc/core_func.php');
    } 
    
}
// Install Theme
$theme = new CodeSpire_FrameWork();


?>
