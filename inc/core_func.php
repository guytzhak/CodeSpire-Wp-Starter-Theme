<?php

// Core Functions

function alx_embed_html( $html ) {
    return '<div class="embed-responsive embed-responsive-16by9">' . $html . '</div>';
}
 
add_filter( 'embed_oembed_html', 'alx_embed_html', 10, 3 );
add_filter( 'video_embed_html', 'alx_embed_html' ); // Jetpack

?>
