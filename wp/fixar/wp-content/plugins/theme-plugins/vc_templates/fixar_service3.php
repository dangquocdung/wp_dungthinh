<?php
/**
 * Shortcode attributes
 * @var $atts
 
 
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Box_Title
 */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
 
 
?><div class="b-home-features">
    <div class="b-features-columns-holder">
        <div class="container">
            <div class="row equal">
                <div class="col-xs-12 col-sm-12 col-md-4  "  >
                    <div class="b-features-column">
                        <div class="features-column-icon">
                            <i class="<?php echo esc_attr($icon1) ?>"></i>
                        </div>
                        <h6 class="features-column-title">
                            <?php echo esc_html($title1) ?>
                        </h6>
                        <div class="features-column-text">
                            <?php echo esc_html($text1) ?>
                        </div>
                    </div>
                </div>
                   <div class="col-xs-12 col-sm-12 col-md-4  "  >
                    <div class="b-features-column even-features-column">
                        <div class="features-column-icon">
                            <i class="<?php echo esc_attr($icon2) ?>"></i>
                        </div>
                        <h6 class="features-column-title">
                            <?php echo esc_html($title2) ?>
                        </h6>
                        <div class="features-column-text">
                            <?php echo esc_html($text2) ?>
                        </div>
                    </div>
                    <div class="page-arrow hidden-xs">
                    	<a href="<?php echo esc_attr($link) ?>">
                       		<i class="fa fa-angle-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                   <div class="col-xs-12 col-sm-12 col-md-4  "  >
                    <div class="b-features-column">
                        <div class="features-column-icon">
                            <i class="<?php echo esc_attr($icon3) ?>"></i>
                        </div>
                        <h6 class="features-column-title">
                            <?php echo esc_html($title3) ?>
                        </h6>
                        <div class="features-column-text">
                            <?php echo esc_html($text3) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>