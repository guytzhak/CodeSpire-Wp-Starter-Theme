<!doctype html>
<!--[if lt IE 7]>
<html class="no-js ie6 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>
<html class="no-js ie7 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>
<html class="no-js ie8 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!-->
<html <?php language_attributes(); ?>> <!--<![endif]-->
<head>

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta charset="<?php bloginfo( 'charset' ); ?>"/>

	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS2 Feed"
	      href="<?php bloginfo( 'rss2_url' ); ?>"/>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>

	<!--[if lt IE 9]>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/html5shiv.js"></script>
	<![endif]-->

</head>
<body <?php body_class(); ?>>
<a class="skip-link screen-reader-text" href="#page_content"><?php esc_html_e( 'Skip to content', 'te' ); ?></a>
<header id="header" role="banner">
	<div class="container">
        <div class="logo">
            <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php echo get_field( 'logo', 'options' ); ?>" alt="<?php bloginfo('url'); ?>"></a>
        </div>
        <div id="menu">
            <nav class="navbar navbar-default" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar icon-bar-two"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <?php
                wp_nav_menu( array(
                        'menu'            => 'header_menu',
                        'theme_location'  => 'header_menu',
                        'depth'           => 2,
                        'container'       => 'div',
                        'container_class' => 'collapse navbar-collapse',
                        'container_id'    => 'bs-example-navbar-collapse-1',
                        'menu_class'      => 'nav navbar-nav',
                        'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
                        'walker'          => new wp_bootstrap_navwalker()
                    )
                );
                ?>

            </nav>
        </div>
	</div>
</header>

