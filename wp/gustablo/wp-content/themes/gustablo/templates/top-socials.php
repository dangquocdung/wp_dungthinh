<?php
/**
 * Top Bar / Socials
 *
 * @package gustablo
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} ?>

<div class="top-bar-socials">
    <?php
    // Top Languages
    if ( class_exists( 'SitePress' ) ) {
        echo '<div class="languages-switcher">';
        $languages = icl_get_languages('skip_missing=N&orderby=KEY&order=DIR&link_empty_to=str');

        foreach ( $languages as $l ) {
            $url =  $l['url'];
            $active = $l['active'];
            $name = $l['native_name'];
            $langs = array();

            if ( $active == 1 ) { ?>
                <a class="active" href="<?php echo esc_url( $url ); ?>">
                    <?php echo esc_html( $name ); ?>
                </a>
            <?php }
        }
        if ( 1 < count( $languages ) ) {
            echo '<div class="sub-lang">';
            foreach( $languages as $l ) {
                if ( !$l['active'] )
                    $langs[] = '<a href="'. esc_url( $l['url'] ) .'">'. esc_html( $l['translated_name'] ) .'</a>';
            }

            echo join(' ', $langs);
            echo '</div>';
        }
        echo '</div>';
    }

    ?>
    <div class="inner">
    <?php
    // Top menu
    wp_nav_menu( array(
        'theme_location' => 'top',
        'fallback_cb'    => false,
        'container'      => false,
        'menu_class'     => 'top-bar-menu',
    ) );
    ?>
    
    <span class="icons">
    <?php
    // Get social options array
    $profiles =  wprt_get_mod( 'top_bar_social_profiles' );
    $social_options = wprt_topbar_social_options();



    foreach ( $social_options as $key => $val ) :
        // Get URL from the theme mods
        $url = isset( $profiles[$key] ) ? $profiles[$key] : '';

        if ( $url ) :
            // Display link
            echo '<a href="'. esc_url($url) .'" title="'. esc_attr($val['label']) .'"><span class="'. esc_attr($val['icon_class']) .'"></span></a>';
        endif;
    endforeach; ?>
    </span>
    </div>
</div><!-- /.top-bar-socials -->
