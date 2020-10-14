<?php
/**
 * Top Bar / Right
 *
 * @package weberium
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get default values
$button_text = weberium_get_mod( 'top_bar_button_text', 'FREE TRIAL' );
$button_link = weberium_get_mod( 'top_bar_button_link' );
?>

<div class="top-bar-right">
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

    <div class="top-bar-menu-wrap">
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
        </div>
    </div><!-- /.top-bar-menu -->

    <?php if ( weberium_get_mod( 'top_bar_button', false ) ) : ?>
    <div class="top-bar-button">
        <a target="_blank" href="<?php echo esc_url( $button_link ); ?>">
            <span><?php echo do_shortcode( $button_text ); ?></span>
        </a>
    </div><!-- /.top-bar-button -->
    <?php endif; ?>
</div><!-- /.top-bar-right -->