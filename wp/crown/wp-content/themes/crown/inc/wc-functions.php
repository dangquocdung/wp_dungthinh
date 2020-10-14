<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

// This theme doesn't have a traditional sidebar.
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

add_filter('crown_has_sidebar', 'crown_wc_sidebar', 100);
function crown_wc_sidebar($has_sidebar)
{
    if (function_exists('WC') && (is_woocommerce() || is_cart() || is_checkout()) ) {
        return false;
    }
    return $has_sidebar;
}