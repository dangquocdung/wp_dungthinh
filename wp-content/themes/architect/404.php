<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package architect
 */

get_header(); ?>
<!-- section begin -->
<section class="overlay-404" <?php if($architect_option['image_404'] != ''){ ?> style="background-image:url(<?php echo esc_url($architect_option['image_404']['url']); ?>)"<?php } ?>>
  <div class="inner-404">
    <span class="lnr lnr-sad"></span>
    <strong><?php esc_html_e('404','architect') ?></strong>
    <p><?php esc_html_e('Oop! We are sorry, the page not found!','architect'); ?></p>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="ot-btn btn-main-color long-btn text-cap"><?php echo esc_attr('Back to Prevew Page','architect'); ?></a>
  </div>
</section>
<?php get_footer(); ?>
