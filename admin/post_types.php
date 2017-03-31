<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

Class CodeSpire_Post_Types {
    // Register Custom Post Type
    
    public $option = 'cs_post_types';
    public $option_tax = 'cs_taxonomies';
    
    public function __construct() {
        //add_action( 'init', array($this, 'cs_add_post_types') );
        $this->cs_add_post_types();
        $this->cs_add_taxonomies();
        
    }
    
    private function cs_create_post_type($name, $names, $slug) {

        $labels = array(
            'name'                  => $names,
            'singular_name'         => $name,
            'menu_name'             => $names,
            'name_admin_bar'        => $name,
            'archives'              => __( 'Item Archives', 'cs' ),
            'attributes'            => __( 'Item Attributes', 'cs' ),
            'parent_item_colon'     => __( 'Parent Item:', 'cs' ),
            'all_items'             => __( 'All Items', 'cs' ),
            'add_new_item'          => __( 'Add New Item', 'cs' ),
            'add_new'               => __( 'Add New', 'cs' ),
            'new_item'              => __( 'New Item', 'cs' ),
            'edit_item'             => __( 'Edit Item', 'cs' ),
            'update_item'           => __( 'Update Item', 'cs' ),
            'view_item'             => __( 'View Item', 'cs' ),
            'view_items'            => __( 'View Items', 'cs' ),
            'search_items'          => __( 'Search Item', 'cs' ),
            'not_found'             => __( 'Not found', 'cs' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'cs' ),
            'featured_image'        => __( 'Featured Image', 'cs' ),
            'set_featured_image'    => __( 'Set featured image', 'cs' ),
            'remove_featured_image' => __( 'Remove featured image', 'cs' ),
            'use_featured_image'    => __( 'Use as featured image', 'cs' ),
            'insert_into_item'      => __( 'Insert into item', 'cs' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'cs' ),
            'items_list'            => __( 'Items list', 'cs' ),
            'items_list_navigation' => __( 'Items list navigation', 'cs' ),
            'filter_items_list'     => __( 'Filter items list', 'cs' ),
        );
        $args = array(
            'label'                 => $name,
            'description'           => __( 'Post Type Description', 'cs' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields', ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => false,		
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
        );
        register_post_type( $slug, $args );

    }
    
    // Register Custom Taxonomy
    private function cs_create_taxonomy($name, $names, $slug, $post_type) {

        $labels = array(
            'name'                       => _x( $names, 'Taxonomy General Name', 'cs' ),
            'singular_name'              => _x( $name, 'Taxonomy Singular Name', 'cs' ),
            'menu_name'                  => __( $name, 'cs' ),
            'all_items'                  => __( 'All Items', 'cs' ),
            'parent_item'                => __( 'Parent Item', 'cs' ),
            'parent_item_colon'          => __( 'Parent Item:', 'cs' ),
            'new_item_name'              => __( 'New Item Name', 'cs' ),
            'add_new_item'               => __( 'Add New Item', 'cs' ),
            'edit_item'                  => __( 'Edit Item', 'cs' ),
            'update_item'                => __( 'Update Item', 'cs' ),
            'view_item'                  => __( 'View Item', 'cs' ),
            'separate_items_with_commas' => __( 'Separate items with commas', 'cs' ),
            'add_or_remove_items'        => __( 'Add or remove items', 'cs' ),
            'choose_from_most_used'      => __( 'Choose from the most used', 'cs' ),
            'popular_items'              => __( 'Popular Items', 'cs' ),
            'search_items'               => __( 'Search Items', 'cs' ),
            'not_found'                  => __( 'Not Found', 'cs' ),
            'no_terms'                   => __( 'No items', 'cs' ),
            'items_list'                 => __( 'Items list', 'cs' ),
            'items_list_navigation'      => __( 'Items list navigation', 'cs' ),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
        );
        register_taxonomy( 'taxonomy', array( $post_type ), $args );

    }
    
    private function get_post_types_admin(){
        // List of Post types
        $args = array(
           'public'   => true,
           '_builtin' => false
        );
        $output = 'objects'; // names or objects, note names is the default
        $operator = 'and'; // 'and' or 'or'
        $post_types = get_post_types( $args, $output, $operator ); 
        return $post_types;
    }

    public function display_list_post_types() {
        $post_types = $this->get_post_types_admin();
        $return = '<ul>';
        foreach($post_types as $type){
            $return .= '<li>';
                $return .= $type->label;
            $return .= '</li>';
        }
        $return .= '</ul>';
        
        return $return;
    }
    
    public function display_selectlist_post_types() {
        $post_types = $this->get_post_types_admin();
        $return = '<select name="post_type_to_tax" id="post_type_to_tax">';
        foreach($post_types as $type){
            $return .= '<option value="'. $type->name .'">';
                $return .= $type->label;
            $return .= '</option>';
        }
        $return .= '</select>';
        
        return $return;
    }
    
    public function cs_add_post_types(){
        if ( get_option( $this->option ) !== false && !empty(get_option( $this->option )) ) {
            $cs_post_types = get_option($this->option);
            foreach($cs_post_types as $type){
                $this->cs_create_post_type($type['name'], $type['names'], $type['slug']);
            }
        }
    }
    
    public function cs_add_taxonomies(){
        if ( get_option( $this->option_tax ) !== false && !empty(get_option( $this->option_tax )) && get_option( $this->option_tax ) !== '' ) {
            $cs_taxs = get_option($this->option_tax);
            foreach($cs_taxs as $tax){
                $this->cs_create_taxonomy($tax['name'], $tax['names'], $tax['slug'], $tax['post_type']);
            }
        }
    }
    
    
}

$post_types_class = new CodeSpire_Post_Types;

?>