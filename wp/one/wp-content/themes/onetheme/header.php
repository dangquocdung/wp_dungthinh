<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no" />
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="wrapper">
    <?php
    $preloader = TT::get_mod('preloader');
    if( $preloader== 1) {
    ?>
    <div class="wpc-preload">
        <div class="preload-wrap">
            <div data-loader="jumping"></div>
        </div>
    </div>
    <!-- end the loading screen -->
    <?php } ?>

<?php
    $header_layout = TT::get_mod('header_layout');
    global $onetheme_header_layout;
    $header_layout = !empty($onetheme_header_layout) ? $onetheme_header_layout : $header_layout;
    switch($header_layout){
        case 'header_full':
            get_template_part('layouts/header', 'menu-full-bg');
            break;
        default:
            // menu_below_logo
            get_template_part('layouts/header', 'menu-top');
            break;
    }
?>