<?php

class WPBakeryShortCode_Google_Map extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract( shortcode_atts( array(
            "lat" => '55.6468',
            "lng" => '37.581',
            "color" => '',
            "zoom" => '10',
            "map_height" => '400',
            "marker" => ''
        ), $atts ) );

        wp_enqueue_script( 'google-map', '//maps.googleapis.com/maps/api/js?sensor=false&amp;language=en');
        wp_enqueue_script( 'google-map-config', get_template_directory_uri() . '/includes/vc-elements/google-maps.js', false, false, true );

        $image_src = !empty($marker) ? wp_get_attachment_image_src($marker, 'thumbnail') : '';
        $marker = !empty($image_src) ? $image_src[0] : '';

        $map_height = abs($map_height) . "px";

        $result = "<div id='tt-google-map' style='height:$map_height' class='tt-google-map' data-lat='$lat' data-lng='$lng' data-color='$color' data-zoom='$zoom' data-marker='$marker'>
                     <div id='gmap_content'>
                            <div class='gmap-item'>
                                <label>". $content ."</label>
                            </div>
                        </div>
        </div>";

        return $result;
    }
}

vc_map( array(
    "name" => esc_html__("Google Map", 'onetheme'),
    "description" => esc_html__("Google Maps Latitude, Longitude", 'onetheme'),
    "base" => "google_map",
    "class" => "",
    "icon" => "icon-wpb-themeton",
    "category" => esc_html__('One', 'onetheme'),
    "show_settings_on_create" => true,
    "front_enqueue_js" => 'http://maps.googleapis.com/maps/api/js?sensor=false&amp;language=en',
    "params" => array(
        array(
            'type' => 'textfield',
            "param_name" => "lat",
            "heading" => esc_html__("Latitude", 'onetheme'),
            "value" => '55.6468',
            'holder' => 'div'
        ),
        array(
            'type' => 'textfield',
            "param_name" => "lng",
            "heading" => esc_html__("Longitude", 'onetheme'),
            "value" => '37.581',
            'holder' => 'div'
        ),
        array(
            'type' => 'colorpicker',
            "param_name" => "color",
            "heading" => esc_html__("Hue Color", 'onetheme'),
            "value" => '',
        ),
        array(
            'type' => 'textfield',
            "param_name" => "zoom",
            "heading" => esc_html__("Zoom", 'onetheme'),
            "value" => '10',
            "desc"  => 'Zoom levels 0 to 18'
        ),
        array(
            'type' => 'textfield',
            "param_name" => "map_height",
            "heading" => esc_html__("Height", 'onetheme'),
            "value" => '400'
        ),
        array(
            'type' => 'attach_image',
            "param_name" => "marker",
            "heading" => esc_html__("Marker Image", 'onetheme'),
            "value" => ''
        ),
        array(
            'type' => 'textarea_html',
            "param_name" => "content",
            "heading" => esc_html__("Content", 'onetheme'),
            "value" => '<h3>Our address</h3><p>Sydney road, Street Board Avenue,<br>2219-11C. Our Town, Your Country.</p>'
        )

    )
) );