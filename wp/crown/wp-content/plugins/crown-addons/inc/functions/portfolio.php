<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

add_action('template_redirect', 'gta_change_single_portfolio_navigation');
function gta_change_single_portfolio_navigation() {
    if ( ! function_exists( 'G5CORE' ) || ! function_exists( 'G5PORTFOLIO' ) ) {
        return;
    }
    remove_action('g5portfolio_after_single', 'g5portfolio_template_single_navigation', 10);
    add_action('g5portfolio_after_single', 'g5portfolio_template_single_navigation', 25);

    if (is_singular('portfolio') && !g5core_has_sidebar()) {
        $content_padding = G5CORE()->options()->layout()->get_option('content_padding');
        if (is_array($content_padding) && isset($content_padding['bottom'])) {
            $content_padding['bottom'] = 0;
            G5CORE()->options()->layout()->set_option('content_padding',$content_padding);
        }
    }
}
