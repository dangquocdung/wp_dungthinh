<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}
/**
 * @var $image_size
 * @var $image_ratio
 * @var $post_class
 * @var $post_inner_class
 * @var $placeholder
 * @var $post_inner_attributes
 * @var $image_mode
 */
$thumbnail_data = g5core_get_thumbnail_data( array(
    'image_size'  => $image_size,
    'placeholder' => $placeholder
));
if ($thumbnail_data['url'] !== '') {
    $post_class .= ' g5blog__has-post-featured';
}
?>
<article <?php post_class( $post_class ) ?>>
    <div <?php echo join( ' ', $post_inner_attributes ) ?> class="<?php echo esc_attr( $post_inner_class ); ?>">
        <?php if ( $thumbnail_data['url'] !== '' ): ?>
            <div class="g5core__post-featured g5blog__post-featured">
                <?php g5core_render_thumbnail_markup( array(
                    'image_size'         => $image_size,
                    'image_mode' => $image_mode
                ) ); ?>
            </div>
        <?php endif; ?>
        <div class="g5blog__post-content">
            <?php g5blog_template_post_meta( array(
                'date'    => true,
                'author'    => true
            ) ); ?>
            <?php g5blog_template_post_title(); ?>
            <div class="g5blog__post-excerpt">
                <?php the_excerpt(); ?>
            </div>
        </div>
    </div>
</article>
