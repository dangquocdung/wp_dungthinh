<?php
/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this WPBakeryShortCode_fixar_History
 */

$out = '';
$type = 'horizontal';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if($type == 'vertical'){

    $per_page_count = $count_group = '';
    $count_item = 0;
    $moments_out = $moments_out_2 = array();

    $moments = vc_param_group_parse_atts( $atts['moments_v'] );
    $count_item = count($moments);


    foreach ($moments as $item) {
    
        $moments_content = '';
        $img_link = '';
        if(isset($item['image'])) {
            $img_link = wp_get_attachment_image_src($item['image'], 'full');
            $img_link = $img_link[0];
            $image_meta = fixar_wp_get_attachment($item['image']);
            $image_alt = $image_meta['alt'] == '' ? $image_meta['title'] : $image_meta['alt'];
        }

        if ( $item['position'] == 'right' ) :

            $moments_content .= '
                <div class="row right-row">
                    <div class="round-ico big"></div>
                    <div class="col-md-6 col-sm-6"></div>
                    <div class="col-md-6 col-sm-6 time-item">
                        <div class="date">'.wp_kses_post($item['d_v']).'</div>
                        <div class="title">'.wp_kses_post($item['title_v']).'</div>
            ';
            if ( $img_link != '' ) :
                $moments_content .= '
                        <div class="time-image">
                            <img src="'.esc_url($img_link).'" alt="'.esc_attr($image_alt).'" >
                        </div>
                ';
            endif;
            $moments_content .= '
                        <div class="time-content">'.do_shortcode($item['content_v']).'</div>
                    </div>
                </div>
            ';

        else :

            $moments_content .= '
                <div class="row left-row ">
                    <div class="round-ico little"></div>
                    <div class="col-md-6 col-sm-6 time-item" data-wow-duration="2s" >
                        <div class="date">'.wp_kses_post($item['d_v']).'</div>
                        <div class="title">'.wp_kses_post($item['title_v']).'</div>
            ';
            if ( $img_link != '' ) :
                $moments_content .= '
                        <div class="time-image">
                            <img src="'.esc_url($img_link).'" alt="'.esc_attr($image_alt).'" >
                        </div>
                ';
            endif;
            $moments_content .= '
                        <div class="time-content">'.do_shortcode($item['content_v']).'</div>
                    </div>
                </div>
            ';

        endif;

        $moments_out[] = $moments_content;

    }

    $per_page_count = is_numeric($count) && $count > 0 ? $count : $count_item;

    $count_group = ceil( $count_item / $per_page_count );
    if ( $count_group && is_array($moments_out) && !empty( $moments_out ) ) {
        for ( $i = 0; $i < $count_group; $i++ ) {
            $moments_out_2[$i] = '';
            for ( $j = 0; $j < $per_page_count; $j++ ) {
                if ( ! isset($moments_out[$per_page_count*$i + $j]) ) { $moments_out[$per_page_count*$i + $j] = ''; }
                $moments_out_2[$i] .= $moments_out[$per_page_count*$i + $j];
            }

        }
    }

    $out .= '
        <div class="wrap-timeline">
            <div class="container-timeline">
                <div class="row top-row">
                    <div class="col-md-12">
                        <div class="time-title" id="timel"><div class="round-ico big"></div>
                        </div>
                    </div>
                </div>
    ';

    foreach ($moments_out_2 as $key => $value) {
        if ( $key === 0 ) {
            $out .= '<div>'.$value.'</div>';
        } else {
            $out .= '<div class="hidden">'.$value.'</div>';
        }
    }

    if ( $per_page_count < $count_item ) :
        $out .= '
                <div class="plus">
                    <span data-group="' . esc_attr($count_group) . '" class="plus-ico">+</span>
                </div>
        ';
    else :
        $out .= '
                <span class="plus">
                    <span class="plus-ico inactive"></span>
                </span>
        ';
    endif;

    $out .= '
            </div>
        </div>
    ';

} else {

    $moments = vc_param_group_parse_atts( $atts['moments_h'] );
    $moments_nav = $moments_content = '';
    $count = 0;
    foreach ($moments as $item) {

        $moments_nav .= '
            <a data-slide-index="' . esc_attr($count) . '" href="">
                <span class="pager-title">
                    ' . esc_html($item['d_h']) . '
                </span>
                <span class="circle">
                    <span class="inner-circle"></span>
                </span>
            </a>
        ';

        $moments_content .= '<li>
                <div class="pager-item">
                    <div class="pager-item-title">
                        '.wp_kses_post($item['title_h']).'
                    </div>
                    <div class="pager-item-description">
                         '.do_shortcode($item['content_h']).'
                    </div>
                </div>
            </li>
        ';

        $count++;

    }

    $out = '
        <div class="b-history">
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                       
                        <div class="b-pager-slideshow-holder">
                            <ul class="pager-slideshow bxslider-pager bxslider-history">
                                '.$moments_content.'
                            </ul>
                            <div class="custom-slideshow-controls hidden-xs">
                                <span id="pager-history-prev">
                                    <a class="bx-prev" href=""><i class="fa fa-angle-left"></i></a>
                                </span>
                                <span id="pager-history-next">
                                    <a class="bx-next" href=""><i class="fa fa-angle-right"></i></a>
                                </span>
                            </div>
                        </div>
              
                        <div class="bx-pager bx-pager-history   custom-pager">
                            '.$moments_nav.'
                        </div>
                
                    </div>
                </div>
        </div>
    ';

}

echo $out;