<?php

class WPBakeryShortCode_tt_branch extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract( shortcode_atts( array(
            "image" => '',
            "address" => '',
            "title" => 'United Kingdom Branch',
            "description" => '',
            "address_text" => '674-475-0, 234-297-1 <br> yourmail@email.com',
            "fax" => '',
            "link" => '',
            "extra_class" => ""
        ), $atts ) );
        
        $atach = wp_get_attachment_image($image, 'large', false, array('class'=> 'img-responsive wpc-back-img') );
        $atach = str_replace('<img ', '<img data-s-hidden="1" ', $atach);
        $result = " <div class='wpc-branch'>
                        <div class='branch-img'>
                             $atach
                             <a href='$link' class='branch-details'>+</a>
                        </div>
                        <section class='branch-content'>
                            <h3 class='content-title'><a href='$link'>$title</a></h3>
                            <div class='container-fluid no-padd'>
                                <div class='row'>
                                    <div class='col-xxs-12 col-xs-6 col-sm-6'>
                                        <section class='branch-address'>
                                            <h6 class='address-title'><i class='fa fa-phone'></i> $address</h6>
                                            <div class='address-text'> $description </div>
                                        </section>
                                    </div>
                                    <div class='col-xxs-12 col-xs-6 col-sm-6'>
                                        <section class='branch-address'>
                                            <h6 class='address-title'><i class='fa fa-fax'></i> $fax</h6>
                                            <div class='address-text'>$address_text</div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>";
        return $result;
    }
}
vc_map(array(
    "name" => esc_html__("Branch", 'onetheme'),
    "description" => esc_html__("", 'onetheme'),
    "base" => "tt_branch",
    "class" => "",
    "icon" => "icon-wpb-themeton",
    "category" => 'One',
    "show_settings_on_create" => true,
    "params" => array(
                array(
                    'type' => 'attach_image',
                    "param_name" => "image",
                    "heading" => esc_html__("Image", 'onetheme')
                ),
                
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Title', 'onetheme'),
                    'param_name' => 'title',
                    'value' => 'United Kingdom Branch',
                    'holder' => 'div'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Sub title', 'onetheme'),
                    'param_name' => 'address',
                    'value' => ''
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Address detials', 'onetheme'),
                    'param_name' => 'description',
                    'value' => ''
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Subtitle :Fax/email', 'onetheme'),
                    'param_name' => 'fax',
                    'value' => ''
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('More link', 'onetheme'),
                    'param_name' => 'link',
                    'value' => ''
                ),
                 array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Branch detials', 'onetheme'),
                    'param_name' => 'address_text',
                    'value' => '674-475-0, 234-297-1 <br> yourmail@email.com'
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