<?php

// Core Functions

function cs_embed_html( $html ) {
    return '<div class="embed-responsive embed-responsive-16by9">' . $html . '</div>';
}
 
add_filter( 'embed_oembed_html', 'cs_embed_html', 10, 3 );
add_filter( 'video_embed_html', 'cs_embed_html' );

//Remove Unnecessary Code
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'start_post_rel_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link');

?>
