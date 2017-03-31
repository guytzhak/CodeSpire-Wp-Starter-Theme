<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

Class CodeSpire_FrameWork_Admin {
    
    public $page_name = 'CodeSpire Setup';
    public $page_title = 'CodeSpire Setup';
    public $page_dashicon = 'dashicons-editor-code';
    
    public function __construct() {
        add_action( 'admin_menu', array($this, 'cs_admin_menu') );
        add_action( 'admin_enqueue_scripts', array($this, 'cs_admin_scripts') );
    }


    public function cs_admin_scripts() {
        // Add the color picker css file       
        wp_enqueue_style( 'wp-color-picker' );
        
        wp_enqueue_script( 'cs_admin_js', get_stylesheet_directory_uri() .'/admin/assets/js/app.js', array('jquery'), '1.6.0', true );
        wp_enqueue_style( 'cs_admin_css', get_stylesheet_directory_uri() .'/admin/assets/css/style.css' );
    }
    
    public function cs_admin_menu() {
        add_menu_page( $this->page_title, $this->page_name, 'manage_options', 'codespire/codespire-admin-page.php', array($this, 'cs_admin_page'), $this->page_dashicon, 2  );
    }

    
    public function cs_admin_page(){
        include_once('admin_page.php');
        // Customized Menu Navigation
        include_once('menu/codespire-custom-menu.php');
    }
    
}

$obj = new CodeSpire_FrameWork_Admin;

?>