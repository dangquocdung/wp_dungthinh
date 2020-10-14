<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $reviews_per_page
 * @var $disable_carousel
 * @var $skin
 * @var $autoplay
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Section_Reviews
 */
$type = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );


if($type != 'single'){
    $carousel = $carousel == 1 ? 'enable-owl-carousel' : 'disable-owl-carousel';

    $reviews = vc_param_group_parse_atts( $atts['reviews_d'] );
    $reviews_out = array();
    $count = 1;
    $cnt = count($reviews);
    foreach($reviews as $item){
        $out = '';
        $class = $count % 2 == 1 ? 'left' : 'right';

        $href = isset($item['link']) ? vc_build_link( $item['link'] ) : '';
        $href = empty($href['url']) ? '#' : $href['url'];
        $blank = empty($href['target']) ? '_self' : $href['target'];

        $img = wp_get_attachment_image_src( $item['image_d'], 'large' );
        $img_output = $img[0];

        $out_c = '
            <div class="client '.esc_attr($class).'">
                <div class="comment-review"">'.wp_kses_post($item['content_d']).'</div>
                <div class="media-review">
                    <div class="media-left">
                        <a target="'.esc_attr($blank).'" href="'.esc_url($href).'" target= >
                            <img class="avatar media-object " src="'.esc_attr($img_output).'" alt="'.esc_attr($item['name_d']).'">
                        </a>
                    </div>
                    <div class="media-body-review">
                        <h5 class="media-heading-review">'.wp_kses_post($item['name_d']).'</h5>
                        <p>'.wp_kses_post($item['position']).'</p>
                    </div>
                </div>
            </div>
        ';

        if( ($count % 2 == 1) && ($count != $cnt) ){
            $out = '
                <div class="reviews">
                    '.$out_c;
        }
        elseif($count % 2 == 0){
            $out = 	$out_c.'
                </div>
            ';
        }
        elseif( ($count % 2 == 1) && ($count == $cnt) ){
            $out = '
                <div class="reviews">
                '.$out_c.'
                </div>
            ';
        }

        $reviews_out[] = $out;

        $count ++;
    }

    $out = '
        <div class="owl-carousel owl-theme '.esc_attr($carousel).'" data-items="1" data-responsive-items="1" data-pagination="true"  data-navigation="false" data-autoplay="true">

            '.implode( "\n", $reviews_out ).'

        </div>';


    echo $out;
} else {

    $reviews = vc_param_group_parse_atts( $atts['reviews_s'] );
    $reviews_out = '';
    $images = '';
    $count = 0;
    foreach($reviews as $item){

        $img = wp_get_attachment_image_src( $item['image_s'], 'large' );
        $img_output = $img[0];

        $images .= '
		<a data-slide-index="'.$count.'" href="">
            <img src="'.$img_output .'" class="img-circle">
        </a>';

        $stars = '';
        for ($i=1; $i<6; $i++)	{
            $star_empty='';
            if ($item['rating'] < $i)
                $star_empty='star-empty';
            $stars .= '
            <li class="'.$star_empty.'">
                <i class="fa fa-star" aria-hidden="true"></i>
            </li>';
        }

        $reviews_out .= '
            <li>
                <div class="pager-item">
                    <div class="review-item text-center">
                        <div class="b-stars">
                            <ul class="list-inline">
                                '.$stars.'

                            </ul>
                        </div>
                        <h4 class="review-title">
                            '.wp_kses_post($item['title']).'
                        </h4>
                        <div class="review-text">
                           " '.do_shortcode($item['content_s']).' "
                        </div>
                        <div class="review-author">
                            <span class="pre-line"></span> '.wp_kses_post($item['name_s']).'
                        </div>
                    </div>
                </div>
            </li>
        ';

        $count ++;
    }

  ?>


<div class="b-reviews">
    <div class="b-reviews-content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <!-- bxslider with custom pager -->
                    <div class="b-pager-slideshow-holder-mod">
                        <ul class="pager-slideshow bxslider-reviews">
                            
                            <?php echo $reviews_out ?>
                           
                        </ul>
                        <div class="custom-slideshow-controls hidden-xs">
                            <span id="pager-reviews-prev"></span>
                            <span id="pager-reviews-next"></span>
                        </div>
                    </div>
                    <!-- END bxslider with custom pager -->
                </div>
            </div>
        </div>
    </div>
    <!-- custom bxslider pager -->
    <div class="bx-pager reviews-pager text-center">
        <?php echo $images ?>
    </div>
</div>

<?php } ?>