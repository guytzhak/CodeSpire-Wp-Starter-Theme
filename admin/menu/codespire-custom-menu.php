<?php


class codespire_custom_menu {

	/*--------------------------------------------*
	 * Constructor
	 *--------------------------------------------*/

	/**
	 * Initializes the plugin by setting localization, filters, and administration functions.
	 */
	function __construct() {
		
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'codespire_add_custom_nav_fields' ) );
		add_action( 'wp_update_nav_menu_item', array( $this, 'codespire_update_custom_nav_fields'), 10, 3 );
		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'codespire_edit_walker'), 10, 2 );

	}
	
	function codespire_add_custom_nav_fields( $menu_item ) {
	
	    $menu_item->color = get_post_meta( $menu_item->ID, '_menu_item_color', true );
	    return $menu_item;
	    
	}
	
	function codespire_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {
	
	    // Check if element is properly sent
	    if ( is_array( $_REQUEST['menu-item-color']) ) {
	        $color_value = $_REQUEST['menu-item-color'][$menu_item_db_id];
	        update_post_meta( $menu_item_db_id, '_menu_item_color', $color_value );
	    }
	    
	}
	
	function codespire_edit_walker($walker,$menu_id) {
	    return 'Walker_Nav_Menu_Edit_Custom_CS';
	    
	}

}

// instantiate plugin's class
$GLOBALS['codespire_custom_menu'] = new codespire_custom_menu();


include_once( 'edit_custom_walker.php' );
