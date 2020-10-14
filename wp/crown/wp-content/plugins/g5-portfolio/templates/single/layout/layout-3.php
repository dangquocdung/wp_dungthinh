<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}
$sticky_options = array(
    'stickTo' => '.g5portfolio__single-content-wrap'
);
?>
<div class="g5portfolio__single-wrap">
    <article id="post-<?php the_ID() ?>" <?php post_class('g5portfolio__single row'); ?>>
        <div class="g5portfolio__single-gallery-wrap col-lg-7 order-lg-last">
            <?php g5portfolio_template_single_gallery(); ?>
        </div>
        <div class="g5portfolio__single-content-wrap col-lg-5 order-lg-first">
            <div class="g5portfolio__single-content g5core-sticky" data-sticky-options="<?php echo esc_attr(json_encode($sticky_options))?>">
                <?php g5portfolio_template_single_title() ?>
                <div class="entry-content clearfix">
                    <?php the_content();?>
                </div>
                <?php g5portfolio_template_single_meta(); ?>
            </div>
        </div>
    </article>
    <?php
    /**
     * @hooked - g5portfolio_template_single_navigation - 10
     * @hooked - g5portfolio_template_single_related - 20
     * @hooked - g5portfolio_template_single_comment - 30
     */
    do_action('g5portfolio_after_single');
    ?>
</div>
