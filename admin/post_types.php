<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

Class CodeSpire_Post_Types {
    
    public function __construct() {
        //add_action( 'init', array($this, 'cs_add_post_types') );
    }

}

$post_types_class = new CodeSpire_Post_Types;

?>