<?php
/**
 * The template for displaying 404 content layout
 *
 * @since 1.0
 * @version 1.0
 */
?>
<div class="content-404-wrapper">
    <h2><?php esc_html_e('404','crown'); ?></h2>
    <h4 class="page-main-title"><?php esc_html_e( 'THAT PAGE CAN&rsquo;T BE FOUND.', 'crown' ); ?></h4>
    <p class="gray-text-color"><?php echo wp_kses_post(__('We are sorry, but the page you are looking for does not exist. <br/> Please check entered address and try again or', 'crown')) ?></p>
    <a href="<?php echo esc_url( home_url('/') ); ?>" class="btn btn-secondary"><?php esc_html_e('BACK TO HOMEPAGE', 'crown'); ?></a>
</div><!-- .wrap -->
