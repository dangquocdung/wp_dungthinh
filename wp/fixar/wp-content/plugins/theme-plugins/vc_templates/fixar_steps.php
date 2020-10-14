<?php
/**
 * Shortcode attributes
 * @var $atts
 
 * @var $text
 
 * @var $title
 
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_fixar_Steps
 */
 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
 
 

echo $out = $css_animation != '' && $css_animation != 'none' ? '<div class="stats row-counters pix-easy-chart animated" data-animation="' . esc_attr($css_animation) . '">' : '<div class="stats row-counters pix-easy-chart">';
 
	  ?>
<div class="b-info-columns-holder b-steps-list  "   >
    <div class="row equal fixar_steps">
        <div class="b-info-column col-xs-12 col-sm-4 col-md-4 wow fadeIn " data-animation="fadeIn" data-wow-duration="1.5s" data-wow-delay="0.1s">
            <div class="info-column-icon " >
                <i class="<?php echo esc_attr($icon1) ?>"></i>
                <span class="step-number">
                        1
                    </span>
            </div>
            <h6 class="info-column-title">
                <?php echo wp_kses_post($title1) ?>
            </h6>
            <div class="info-column-text">
                <p>
                    <?php echo wp_kses_post($text1) ?>
                </p>
            </div>
        </div>
		 <div class="b-info-column col-xs-12 col-sm-4 col-md-4 wow fadeIn " data-animation="fadeIn" data-wow-duration="1.5s" data-wow-delay="0.4s">
            <div class="info-column-icon " >
                <i class="<?php echo esc_attr($icon2) ?>"></i>
                <span class="step-number">
                        2
                    </span>
            </div>
            <h6 class="info-column-title">
                <?php echo wp_kses_post($title2) ?>
            </h6>
            <div class="info-column-text">
                <p>
                    <?php echo wp_kses_post($text2) ?>
                </p>
            </div>
        </div>
		  <div class="b-info-column col-xs-12 col-sm-4 col-md-4 wow fadeIn " data-animation="fadeIn" data-wow-duration="1.5s" data-wow-delay="0.7s">
            <div class="info-column-icon" >
                <i class="<?php echo esc_attr($icon3) ?>"></i>
                <span class="step-number">
                        3
                    </span>
            </div>
            <h6 class="info-column-title">
                <?php echo wp_kses_post($title3) ?>
            </h6>
            <div class="info-column-text">
                <p>
                    <?php echo wp_kses_post($text3) ?>
                </p>
            </div>
        </div>
    </div>
</div>

 <?php echo '</div>';