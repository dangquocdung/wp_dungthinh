<?php

class WPBakeryShortCode_page_title_slider extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract( shortcode_atts( array(
            "arrows" => 'show',
            "bullets" => "show",
            "list" => "",
            "extra_class" => ""
        ), $atts ) );
        
        $list = vc_param_group_parse_atts($list);
        $lists = '';
        
        $slider_arrows = "<div class='wpc-image-arrows'>
                                <div class='swiper-arrow-left image-arrow'><i class='fa fa-long-arrow-left'></i></div>
                                <div class='swiper-arrow-right image-arrow'><i class='fa fa-long-arrow-right'></i></div>
                            </div>";
        $slider_bullets = "<div class='pagination'></div>";
        
        if( is_array($list) ){
            foreach ($list as $item) {

                $title = isset($item['title']) ? $item['title'] : "";
                $title = !empty($title) ? "<h1 class='heading-title'>$title</h1>" : "";

                $link = isset($item['link']) ? $item['link'] : "";
                $link = !empty($link) ? "$link" : "";

                $button_link = isset($item['button_link']) ? $item['button_link'] : "";
                $button_link = !empty($button_link) ? "$button_link" : "";

                $link1 = isset($item['link1']) ? $item['link1'] : "";
                $link1 = !empty($link1) ? "$link1" : "";

                $button_link1 = isset($item['button_link1']) ? $item['button_link1'] : "";
                $button_link1 = !empty($button_link1) ? "$button_link1" : "";

                $subtitle = isset($item['subtitle']) ? $item['subtitle'] : "";
                $subtitle = !empty($subtitle) ? "<h3 class='heading-subtitle'>$subtitle</h3>" : "";

                $heading_desc = isset($item['heading_desc']) ? $item['heading_desc'] : "";
                $heading_desc = !empty($heading_desc) ? "<h5 class='heading-desc'>$heading_desc</h5>" : "";

                $paragraph = isset($item['paragraph']) ? $item['paragraph'] : "";
                $paragraph = !empty($paragraph) ? "<p class='heading-text'>$paragraph</p>" : "";

                $image = isset($item['image']) ? $item['image'] : "";
                $atach = wp_get_attachment_image($image, 'full', false, array('class'=> 'wpc-back-img') );

                $banner_style = isset($item['banner_style']) ? $item['banner_style'] : "";

                $banner_html='';
                $banner_head_style = '';

                if($banner_style=='style1'){
                    $banner_head_style.='style-1';
                    $banner_html.=" <section class='banner-heading style-1'>
                                        $subtitle
                                        $title
                                        $paragraph
                                        <div class='clearfix'></div>
                                        <a href='$link' class='wpc-btn size-3'>$button_link</a> 
                                    </section>";
                }elseif($banner_style=='style2'){
                     $banner_head_style.='style-2 text-center';
                    $banner_html.='<section class="banner-heading style-2"> 
                                        <i class="fa fa-connectdevelop"></i>
                                        '.$subtitle.'
                                        '.$title.'
                                        <a href="'.esc_url($link).'" class="wpc-btn size-3">'.$button_link.'</a> 
                                  </section>';
                }elseif($banner_style=='style3'){
                     $banner_head_style.='style-3';
                    $banner_html.="<section class='banner-heading style-3'>
                                    $subtitle
                                    $title
                                    $heading_desc
                                    $paragraph
                                    <a href='$link' class='wpc-btn size-3'>$button_link</a> 
                                    <a href='$link1' class='wpc-btn size-3 style-2'>$button_link1</a>                                                            
                                </section>";
                }elseif($banner_style=='style4'){
                     $banner_head_style.='style-4';
                    $banner_html.='<section class="banner-heading style-4">
                                        '.$subtitle.'
                                         '.$title.'
                                         '.$heading_desc.'
                                        <a href="'.esc_url($link).'" class="wpc-btn size-5 font-2">'.$button_link.'</a> 
                                    </section>';
                }elseif($banner_style=='style5'){
                     $banner_head_style.='style-5 text-center';
                    $banner_html.='<section class="banner-heading style-5"> 
                                        <i class="fa fa-connectdevelop"></i>
                                        '.$subtitle.'
                                         '.$title.'
                                         <a href="'.esc_url($link).'" class="wpc-btn size-3">'.$button_link.'</a> 
                                    </section>';
                }elseif($banner_style=='style6'){
                     $banner_head_style.='style-5 text-center';
                    $banner_html.='<section class="banner-heading style-5 dark"> 
                                        <i class="fa fa-connectdevelop"></i>
                                         '.$subtitle.'
                                         '.$title.'
                                         <a href="'.esc_url($link).'" class="wpc-btn size-3">'.$button_link.'</a>
                                    </section>';
                }

               
                    $lists .= "<div class='swiper-slide'>
                                    <div class='wpc-banner ".$banner_head_style."'> $atach
                                        <div class='container'>  
                                            <div class='row'>
                                                <div class='col-md-12'>
                                                   $banner_html
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>";               
            }
        }
        
        $result = "<div class='swiper-container wpc-main-slider' data-autoplay='5000' data-loop='1' data-speed='1000' data-slides-per-view='responsive' data-add-slides='1' data-xs-slides='1' data-sm-slides='1' data-md-slides='1' data-lg-slides='1'>
                <div class='swiper-wrapper'>
                    $lists                                         
                </div>
                $slider_bullets
                $slider_arrows 
            </div>";

        return $result;
    }
}
vc_map(array(
    "name" => esc_html__("Page top slider", 'onetheme'),
    "description" => esc_html__("Full screen slides", 'onetheme'),
    "base" => "page_title_slider",
    "class" => "",
    "icon" => "icon-wpb-themeton",
    "category" => 'One',
    "show_settings_on_create" => true,
    "params" => array(

        array(
            "type" => "dropdown",
            "param_name" => "arrows",
            "heading" => esc_html__("Slider Arrows", 'onetheme'),
            "value" => array(
                "Show" => "show",
                "Hide" => "hide"
            ),
            "std" => "show",
        ),
        array(
            'type' => 'param_group',
            'heading' => esc_html__('Values', 'onetheme'),
            'param_name' => 'list',
            'value' => '',
            'params' => array(
                 array(
                    'type' => 'attach_image',
                    "param_name" => "image",
                    "heading" => esc_html__("Image upload", 'onetheme'),
                ),
                array(
                        "type" => "dropdown",
                        "param_name" => "banner_style",
                        "heading" => esc_html__("Page title style", 'onetheme'),
                        "value" => array(
                            "Style 1" => "style1",
                            "Style 2" => "style2",
                            "Style 3" => "style3",
                            "Style 4" => "style4",
                            "Style 5" => "style5",
                            "Style 6" => "style6",
                        ),
                        "std" => "style1"
                    ),
                
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Title', 'onetheme'),
                    'param_name' => 'title',
                    'value' => 'One',
                    'holder' => 'div'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Subtitle', 'onetheme'),
                    'param_name' => 'subtitle',
                    'value' => '',
                    'holder' => 'div'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Description', 'onetheme'),
                    'param_name' => 'heading_desc',
                    'value' => ''
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Paragraph', 'onetheme'),
                    'param_name' => 'paragraph',
                    'value' => ''
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Button 1 name', 'onetheme'),
                    'param_name' => 'button_link',
                    'value' => 'read more'
                ),

                array(
                    'heading' => esc_html__('link', 'onetheme'),
                    'param_name' => 'link',
                    'label' => 'URL:',
                    'value' => '#',
                    'type' => 'textarea',
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Button 2 name', 'onetheme'),
                    'param_name' => 'button_link1',
                    "description" => esc_html__("style 2 can be used  ", 'onetheme'),
                    'value' => 'our team'
                ),

                array(
                    'heading' => esc_html__('link 2', 'onetheme'),
                    'param_name' => 'link1',
                    'label' => 'URL:',
                    "description" => esc_html__("style 2 can be used  ", 'onetheme'),
                    'value' => '#',
                    'type' => 'textarea',
                ),

            )
        ),
        array(
            "type" => "textfield",
            "param_name" => "extra_class",
            "heading" => esc_html__("Extra Class", 'onetheme'),
            "value" => "",
            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'onetheme'),
        )
    )
));