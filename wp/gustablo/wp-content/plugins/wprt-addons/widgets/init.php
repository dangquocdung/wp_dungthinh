<?php 
/*
Plugin Name: WPRT Widgets
Plugin URI: http://rollthemes.com/plugins/
Description: Some simple widgets for theme
Version: 3.6.8
Author: RollThemes
Author URI: http://rollthemes.com
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Register widgets
add_action( 'widgets_init', 'widgetRegister' );
function widgetRegister() {
    register_widget( 'WPRT_Spacer' );
    register_widget( 'WPRT_Socials' );
    register_widget( 'WPRT_Links' );
    register_widget( 'WPRT_Information' );
    register_widget( 'WPRT_Cf7' );
    register_widget( 'WPRT_recent_news' );
    register_widget( 'WPRT_Instagram_Widget' );
    register_widget( 'Lastest_Tweets' );  
}

class WPRT_Spacer extends WP_Widget {
    // Holds widget settings defaults, populated in constructor.
    protected $defaults;

    // Constructor
    function __construct() {
        $this->defaults = array(
            'desktop'   => '40',
            'mobi'   => '30',
        );

        parent::__construct(
            'widget_spacer',
            esc_html__( 'Empty Space', 'gustablo' ),
            array(
                'classname'   => 'widget_spacer',
                'description' => esc_html__( 'Blank space with custom height.', 'gustablo' )
            )
        );
    }

    // Display widget
    function widget( $args, $instance ) {
        $instance = wp_parse_args( $instance, $this->defaults );
        extract( $instance );
        extract( $args );        

        echo $before_widget;

        if ( ! empty( $title ) ) { echo $before_title . $title . $after_title; } ?>

        <div class="spacer clearfix" data-desktop="<?php echo esc_attr( $desktop ); ?>" data-mobi="<?php echo esc_attr( $mobi ); ?>">
        </div>

		<?php echo $after_widget;
    }

    // Update widget
    function update( $new_instance, $old_instance ) {
        $instance               = $old_instance;
        $instance['desktop']    = intval( $new_instance['desktop'] );
        $instance['mobi']       = intval( $new_instance['mobi'] );
        
        return $instance;
    }

    // Widget setting
    function form( $instance ) {
        $instance = wp_parse_args( $instance, $this->defaults );       
        ?>

        <p><label for="<?php echo esc_attr( $this->get_field_id( 'desktop' ) ); ?>"><?php esc_html_e( 'Desktop screen:', 'gustablo' ); ?></label>
        <input class="widefat" type="number" id="<?php echo esc_attr( $this->get_field_id( 'desktop' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'desktop' ) ); ?>" value="<?php echo esc_attr( $instance['desktop'] ); ?>">
        </p>
        <p><label for="<?php echo esc_attr( $this->get_field_id( 'mobi' ) ); ?>"><?php esc_html_e( 'Mobile screen:', 'gustablo' ); ?></label>
        <input class="widefat" type="number" id="<?php echo esc_attr( $this->get_field_id( 'mobi' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'mobi' ) ); ?>" value="<?php echo esc_attr( $instance['mobi'] ); ?>">
        </p>
    <?php
    }
} // end WPRT_Spacer

class WPRT_Socials extends WP_Widget {
    // Holds widget settings defaults, populated in constructor.
    protected $defaults;

    // Constructor
    function __construct() {
        $this->defaults = array(
            'title' 	=> '',
            'style' => 'style-1',
            'width' => '',
            'height' => '',
            'gap' => '',
            'size' => '',
            'rounded' => '',
            'facebook' => '', 
            'twitter' => '', 
            'youtube' => '', 
            'google-plus' => '',
            'vimeo' => '', 
            'tumblr' => '',
            'linkedin' => '',
            'pinterest' => '',
            'instagram' => '', 
            'behance' => '',
            'dribbble' => '',
            'flickr' => '',
        );

        parent::__construct(
            'widget_socials',
            esc_html__( 'Socials', 'gustablo' ),
            array(
                'classname'   => 'widget_socials',
                'description' => esc_html__( 'Display the socials.', 'gustablo' )
            )
        );
    }

    // Display widget
    function widget( $args, $instance ) {
        $instance = wp_parse_args( $instance, $this->defaults );
        extract( $instance );
        extract( $args );
        
        echo $before_widget;

        if ( ! empty( $title ) ) { echo $before_title . $title . $after_title; }

        $width = intval( $width );
        $height = intval( $height );
        $gap = intval( $gap );
        $size = intval( $size );
        $rounded = intval( $rounded );

        $icon_bottom = 10;
        $css = '';
        $inner_css = '';
        if ( ! empty( $gap ) ) {
            $inner_css = 'padding: 0 '. ($gap/2) .'px;';
            $css = 'margin: 0 -'. ($gap/2) .'px';
            $icon_bottom = $gap/2;
        }

        $icon_css = 'margin-bottom:'. $icon_bottom .'px';
        if ( ! empty( $width ) )
            $icon_css .= ';width:'. $width .'px';

        if ( ! empty( $height ) )
            $icon_css .= ';height:'. $height .'px;line-height:'. $height .'px';

        if ( ! empty( $size ) )
            $icon_css .= ';font-size:'. $size .'px';

        if ( ! empty( $rounded ) )
            $icon_css .= ';border-radius:'. $rounded .'px';

        $html = '';
        foreach ( $instance as $k => $v ) {
            if ( $v != '' && ! in_array( $k , array( 'title', 'width', 'height', 'size', 'rounded', 'gap', 'style' ) ) ) 
                $html .= '<div class="icon '. $k .'" style="'. $inner_css .'"><a target="_blank" href="'. $v .'" style="'. $icon_css .'"><i class="gustablo-'. $k .'"></i></a></div>';
        }

        if ( $html )
            printf( '<div class="socials clearfix %3$s" style="%2$s">%1$s</div>', $html, $css, $style );

		echo $after_widget;
    }

    // Update widget
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['width']         = strip_tags( $new_instance['width'] );
        $instance['height']         = strip_tags( $new_instance['height'] );
        $instance['size']         = strip_tags( $new_instance['size'] );
        $instance['rounded']         = strip_tags( $new_instance['rounded'] );
        $instance['gap']         = strip_tags( $new_instance['gap'] );
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['style'] = $new_instance['style'];

        $instance['facebook'] = strip_tags( $new_instance['facebook'] );
        $instance['twitter'] = strip_tags( $new_instance['twitter'] );
        $instance['youtube'] = strip_tags( $new_instance['youtube'] );
        $instance['google-plus'] = strip_tags( $new_instance['google-plus'] );
        $instance['vimeo'] = strip_tags( $new_instance['vimeo'] );
        $instance['tumblr'] = strip_tags( $new_instance['tumblr'] );
        $instance['linkedin'] = strip_tags( $new_instance['linkedin'] );
        $instance['pinterest'] = strip_tags( $new_instance['pinterest'] );
        $instance['instagram'] = strip_tags( $new_instance['instagram'] );
        $instance['behance'] = strip_tags( $new_instance['behance'] );
        $instance['dribbble'] = strip_tags( $new_instance['dribbble'] );
        $instance['flickr'] = strip_tags( $new_instance['flickr'] );
                
        return $instance;
    }

    // Widget setting
    function form( $instance ) {
        $instance = wp_parse_args( $instance, $this->defaults );

        $fields = array(
            'facebook' => esc_html__( 'Facebook URL:', 'gustablo' ),
            'twitter' => esc_html__( 'Twitter URL:', 'gustablo' ),
            'youtube' => esc_html__( 'Youtube URL:', 'gustablo' ),
            'google-plus' => esc_html__( 'Google-Plus URL:', 'gustablo' ),
            'vimeo' => esc_html__( 'Vimeo URL:', 'gustablo' ),
            'tumblr' => esc_html__( 'Tumblr URL:', 'gustablo' ),
            'pinterest' => esc_html__( 'Pinterest URL:', 'gustablo' ),
            'linkedin' => esc_html__( 'LinkedIn URL:', 'gustablo' ),
            'instagram' => esc_html__( 'Instagram URL:', 'gustablo' ),
            'behance' => esc_html__( 'Behance URL:', 'gustablo' ),
            'dribbble' => esc_html__( 'Dribbble URL:', 'gustablo' ),    
            'flickr' => esc_html__( 'Flickr URL:', 'gustablo' ),
        ); ?>

        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'gustablo' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'style' ) ); ?>"><?php esc_html_e( 'Style', 'gustablo' ); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'style' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'style' ) ); ?>">
                <option value="style-1" <?php selected( 'style-1', $instance['style'] ); ?>><?php esc_html_e( 'Style 1', 'gustablo' ) ?></option>
                <option value="style-2" <?php selected( 'style-2', $instance['style'] ); ?>><?php esc_html_e( 'Style 2', 'gustablo' ) ?></option>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'width' ) ); ?>"><?php esc_html_e('Width:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'width' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'width' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['width'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>"><?php esc_html_e('Height:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'height' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['height'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>"><?php esc_html_e('Icon Font Size:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'size' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['size'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'rounded' ) ); ?>"><?php esc_html_e('Rounded:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'rounded' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'rounded' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['rounded'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'gap' ) ); ?>"><?php esc_html_e('Spacing Between Items:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'gap' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'gap' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['gap'] ); ?>">
        </p>

        <?php
        foreach ( $fields as $k => $v ) {
            printf(
                '<p>
                    <label for="%s">%s</label>
                    <input type="text" class="widefat" id="%s" name="%s" value="%s">
                </p>',
                $this->get_field_id( $k ),
                $v,
                $this->get_field_id( $k ),
                $this->get_field_name( $k ),
                $instance[$k]
            );
        }
        ?>
    <?php
    }
} // end WPRT_Socials

class WPRT_Links extends WP_Widget {
    // Holds widget settings defaults, populated in constructor.
    protected $defaults;

    // Constructor
    function __construct() {
        $this->defaults = array(
            'title'                 => 'Short Navigation',
            'link_color'            => '',
            'column'                => 1,
            'item_count'            => 4,
            'arrow_style'           => 1,
            'bottom_margin'         => '',
            'icon_color' => '',
            'link_text1'            => 'Link item 1',
            'link_text2'            => 'Link item 2',
            'link_text3'            => 'Link item 3',
            'link_text4'            => 'Link item 4',
            'link_text5'            => 'Link item 5',
            'link_text6'            => 'Link item 6',
            'link_text7'            => 'Link item 7',
            'link_text8'            => 'Link item 8',
            'link_text9'            => 'Link item 9',
            'link_text10'           => 'Link item 10',
            'link_text11'           => 'Link item 11',
            'link_text12'           => 'Link item 12',
            'link_text13'           => 'Link item 13',
            'link_text14'           => 'Link item 14',
            'link_url1'             => 'http://your-link.com',
            'link_url2'             => 'http://your-link.com',
            'link_url3'             => 'http://your-link.com',
            'link_url4'             => 'http://your-link.com',
            'link_url5'             => 'http://your-link.com',
            'link_url6'             => 'http://your-link.com',
            'link_url7'             => 'http://your-link.com',
            'link_url8'             => 'http://your-link.com',
            'link_url9'             => 'http://your-link.com',
            'link_url10'            => 'http://your-link.com',
            'link_url11'            => 'http://your-link.com',
            'link_url12'            => 'http://your-link.com',
            'link_url13'            => 'http://your-link.com',
            'link_url14'            => 'http://your-link.com',
        );

        parent::__construct(
            'widget_links',
            esc_html__( 'Links', 'gustablo' ),
            array(
                'classname'   => 'widget_links',
                'description' => esc_html__( 'Display Links', 'gustablo' )
            )
        );
    }

    // Display widget
    function widget( $args, $instance ) {
        $instance = wp_parse_args( $instance, $this->defaults );
        extract( $instance );
        extract( $args );        

        echo $before_widget;

        if ( ! empty( $title ) ) { echo $before_title . $title . $after_title; }

        if ( $link_color )
            $link_color = 'color:'. $link_color;

        $cls = ( $column == 2 ) ? 'col2' : '';
        $link_text = '';
        $link_url = '';
        $arrow = '';

        $bottom_margin = intval( $bottom_margin );

        $css = '';
          if ( ! empty( $bottom_margin ) )
            $css = 'margin-bottom:'. $bottom_margin .'px';
       
        $icon_css = '';
        if ( ! empty( $icon_color ) )
            $icon_css = 'color:'. $icon_color;

        switch ( $arrow_style ) {
            case 1: $arrow = 'angle-right'; break;
            case 2: $arrow = 'check'; break;
            case 3: $arrow = 'angle-double-right'; break;
            case 4: $arrow = 'arrow-circle-o-right'; break;
            case 5: $arrow = 'arrow-circle-right'; break;
            case 6: $arrow = 'chevron-circle-right'; break;
            case 7: $arrow = 'arrow-right'; break;
            case 8: $arrow = 'chevron-right'; break;
            case 9: $arrow = 'check-square'; break;
            case 10: $arrow = 'check-circle'; break;
            case 11: $arrow = 'check-circle-o'; break;
            case 12: $arrow = 'circle-o'; break;
            case 13: $arrow = 'circle-thin'; break;
            case 14: $arrow = 'check-square-o'; break;
            case 15: $arrow = 'caret-right'; break;
        }
        ?>
        <ul class="wprt-links clearfix <?php echo esc_attr( $cls ); ?>">
            <?php for ( $i = 1; $i <= $item_count; $i++ ) {
                switch ( $i ) {
                    case 1:
                        $link_text = $link_text1;
                        $link_url = $link_url1;
                        break;
                    case 2:
                        $link_text = $link_text2;
                        $link_url = $link_url2;
                        break;
                    case 3:
                        $link_text = $link_text3;
                        $link_url = $link_url3;
                        break;
                    case 4:
                        $link_text = $link_text4;
                        $link_url = $link_url4;
                        break;
                    case 5:
                        $link_text = $link_text5;
                        $link_url = $link_url5;
                        break;
                    case 6:
                        $link_text = $link_text6;
                        $link_url = $link_url6;
                        break;
                    case 7:
                        $link_text = $link_text7;
                        $link_url = $link_url7;
                        break;
                    case 8:
                        $link_text = $link_text8;
                        $link_url = $link_url8;
                        break;
                    case 9:
                        $link_text = $link_text9;
                        $link_url = $link_url9;
                        break;
                    case 10:
                        $link_text = $link_text10;
                        $link_url = $link_url10;
                        break;
                    case 11:
                        $link_text = $link_text11;
                        $link_url = $link_url11;
                        break;
                    case 12:
                        $link_text = $link_text12;
                        $link_url = $link_url12;
                        break;
                    case 13:
                        $link_text = $link_text13;
                        $link_url = $link_url13;
                        break;
                    case 14:
                        $link_text = $link_text14;
                        $link_url = $link_url14;
                        break;
                }

                if ( $link_url && $link_text ) 
                    printf( '
                        <li style="%5$s">
                            <a href="%1$s" style="%6$s">
                                <i class="fa fa-%3$s" style="%4$s"></i>
                                %2$s
                            </a>
                        </li>',
                        esc_url( $link_url ),
                        esc_html( $link_text ),
                        $arrow,
                        $icon_css,
                        $css,
                        $link_color
                    );
            } ?>
        </ul>

		<?php echo $after_widget;
    }

    // Update widget
    function update( $new_instance, $old_instance ) {
        $instance               = $old_instance;

        $instance['title']              = strip_tags( $new_instance['title'] );
        $instance['link_color']         = strip_tags( $new_instance['link_color'] );
        $instance['column']             = $new_instance['column'];
        $instance['item_count']         = $new_instance['item_count'];
        $instance['icon_color']         = strip_tags( $new_instance['icon_color'] );
        $instance['arrow_style']        = $new_instance['arrow_style'];
        $instance['bottom_margin']      = strip_tags( $new_instance['bottom_margin'] );

        $instance['link_text1']         = strip_tags( $new_instance['link_text1'] );
        $instance['link_text2']         = strip_tags( $new_instance['link_text2'] );
        $instance['link_text3']         = strip_tags( $new_instance['link_text3'] );
        $instance['link_text4']         = strip_tags( $new_instance['link_text4'] );
        $instance['link_text5']         = strip_tags( $new_instance['link_text5'] );
        $instance['link_text6']         = strip_tags( $new_instance['link_text6'] );
        $instance['link_text7']         = strip_tags( $new_instance['link_text7'] );
        $instance['link_text8']         = strip_tags( $new_instance['link_text8'] );
        $instance['link_text9']         = strip_tags( $new_instance['link_text9'] );
        $instance['link_text10']        = strip_tags( $new_instance['link_text10'] );
        $instance['link_text11']        = strip_tags( $new_instance['link_text11'] );
        $instance['link_text12']        = strip_tags( $new_instance['link_text12'] );
        $instance['link_text13']        = strip_tags( $new_instance['link_text13'] );
        $instance['link_text14']        = strip_tags( $new_instance['link_text14'] );

        $instance['link_url1']         = strip_tags( $new_instance['link_url1'] );
        $instance['link_url2']         = strip_tags( $new_instance['link_url2'] );
        $instance['link_url3']         = strip_tags( $new_instance['link_url3'] );
        $instance['link_url4']         = strip_tags( $new_instance['link_url4'] );
        $instance['link_url5']         = strip_tags( $new_instance['link_url5'] );
        $instance['link_url6']         = strip_tags( $new_instance['link_url6'] );
        $instance['link_url7']         = strip_tags( $new_instance['link_url7'] );
        $instance['link_url8']         = strip_tags( $new_instance['link_url8'] );
        $instance['link_url9']         = strip_tags( $new_instance['link_url9'] );
        $instance['link_url10']        = strip_tags( $new_instance['link_url10'] );
        $instance['link_url11']        = strip_tags( $new_instance['link_url11'] );
        $instance['link_url12']        = strip_tags( $new_instance['link_url12'] );
        $instance['link_url13']        = strip_tags( $new_instance['link_url13'] );
        $instance['link_url14']        = strip_tags( $new_instance['link_url14'] );
        
        return $instance;
    }

    // Widget setting
    function form( $instance ) {
        $instance = wp_parse_args( $instance, $this->defaults );       
        ?>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'gustablo' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'column' ) ); ?>"><?php esc_html_e( 'Number of column', 'gustablo' ); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'column' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'column' ) ); ?>">
                <option value="1" <?php selected( '1', $instance['column'] ); ?>><?php esc_html_e( '1', 'gustablo' ) ?></option>
                <option value="2" <?php selected( '2', $instance['column'] ); ?>><?php esc_html_e( '2', 'gustablo' ) ?></option>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'item_count' ) ); ?>"><?php esc_html_e( 'Number of links to show', 'gustablo' ); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'item_count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'item_count' ) ); ?>">
                <option value="1" <?php selected( '1', $instance['item_count'] ); ?>><?php esc_html_e( '1', 'gustablo' ) ?></option>
                <option value="2" <?php selected( '2', $instance['item_count'] ); ?>><?php esc_html_e( '2', 'gustablo' ) ?></option>
                <option value="3" <?php selected( '3', $instance['item_count'] ); ?>><?php esc_html_e( '3', 'gustablo' ) ?></option>
                <option value="4" <?php selected( '4', $instance['item_count'] ); ?>><?php esc_html_e( '4', 'gustablo' ) ?></option>
                <option value="5" <?php selected( '5', $instance['item_count'] ); ?>><?php esc_html_e( '5', 'gustablo' ) ?></option>
                <option value="6" <?php selected( '6', $instance['item_count'] ); ?>><?php esc_html_e( '6', 'gustablo' ) ?></option>
                <option value="7" <?php selected( '7', $instance['item_count'] ); ?>><?php esc_html_e( '7', 'gustablo' ) ?></option>
                <option value="8" <?php selected( '8', $instance['item_count'] ); ?>><?php esc_html_e( '8', 'gustablo' ) ?></option>
                <option value="9" <?php selected( '9', $instance['item_count'] ); ?>><?php esc_html_e( '9', 'gustablo' ) ?></option>
                <option value="10" <?php selected( '10', $instance['item_count'] ); ?>><?php esc_html_e( '10', 'gustablo' ) ?></option>
                <option value="11" <?php selected( '11', $instance['item_count'] ); ?>><?php esc_html_e( '11', 'gustablo' ) ?></option>
                <option value="12" <?php selected( '12', $instance['item_count'] ); ?>><?php esc_html_e( '12', 'gustablo' ) ?></option>
                <option value="13" <?php selected( '13', $instance['item_count'] ); ?>><?php esc_html_e( '13', 'gustablo' ) ?></option>
                <option value="14" <?php selected( '14', $instance['item_count'] ); ?>><?php esc_html_e( '14', 'gustablo' ) ?></option>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_color' ) ); ?>"><?php esc_html_e('Link Color (ex: #303030):', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_color' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_color'] ); ?>">
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'icon_color' ) ); ?>"><?php esc_html_e('Icon Color (ex: #303030):', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'icon_color' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['icon_color'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'bottom_margin' ) ); ?>"><?php esc_html_e('Item Bottom Margin (ex: 5px):', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'bottom_margin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'bottom_margin' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['bottom_margin'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'arrow_style' ) ); ?>"><?php esc_html_e( 'Arrow style', 'gustablo' ); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'arrow_style' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'arrow_style' ) ); ?>">
                <option value="1" <?php selected( '1', $instance['arrow_style'] ); ?>><?php esc_html_e( 'Style 1', 'gustablo' ) ?></option>
                <option value="2" <?php selected( '2', $instance['arrow_style'] ); ?>><?php esc_html_e( 'Style 2', 'gustablo' ) ?></option>
                <option value="3" <?php selected( '3', $instance['arrow_style'] ); ?>><?php esc_html_e( 'Style 3', 'gustablo' ) ?></option>
                <option value="4" <?php selected( '4', $instance['arrow_style'] ); ?>><?php esc_html_e( 'Style 4', 'gustablo' ) ?></option>
                <option value="5" <?php selected( '5', $instance['arrow_style'] ); ?>><?php esc_html_e( 'Style 5', 'gustablo' ) ?></option>
                <option value="6" <?php selected( '6', $instance['arrow_style'] ); ?>><?php esc_html_e( 'Style 6', 'gustablo' ) ?></option>
                <option value="7" <?php selected( '7', $instance['arrow_style'] ); ?>><?php esc_html_e( 'Style 7', 'gustablo' ) ?></option>
                <option value="8" <?php selected( '8', $instance['arrow_style'] ); ?>><?php esc_html_e( 'Style 8', 'gustablo' ) ?></option>
                <option value="9" <?php selected( '9', $instance['arrow_style'] ); ?>><?php esc_html_e( 'Style 9', 'gustablo' ) ?></option>
                <option value="10" <?php selected( '10', $instance['arrow_style'] ); ?>><?php esc_html_e( 'Style 10', 'gustablo' ) ?></option>
                <option value="11" <?php selected( '11', $instance['arrow_style'] ); ?>><?php esc_html_e( 'Style 11', 'gustablo' ) ?></option>
                <option value="12" <?php selected( '12', $instance['arrow_style'] ); ?>><?php esc_html_e( 'Style 12', 'gustablo' ) ?></option>
                <option value="13" <?php selected( '13', $instance['arrow_style'] ); ?>><?php esc_html_e( 'Style 13', 'gustablo' ) ?></option>
                <option value="14" <?php selected( '14', $instance['arrow_style'] ); ?>><?php esc_html_e( 'Style 14', 'gustablo' ) ?></option>
                <option value="15" <?php selected( '15', $instance['arrow_style'] ); ?>><?php esc_html_e( 'Style 15', 'gustablo' ) ?></option>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_text1' ) ); ?>"><?php esc_html_e('Link Text 1:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_text1' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_text1' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_text1'] ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_url1' ) ); ?>"><?php esc_html_e('Link URL 1:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_url1' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_url1' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_url1'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_text2' ) ); ?>"><?php esc_html_e('Link Text 2:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_text2' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_text2' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_text2'] ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_url2' ) ); ?>"><?php esc_html_e('Link URL 2:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_url2' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_url2' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_url2'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_text3' ) ); ?>"><?php esc_html_e('Link Text 3:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_text3' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_text3' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_text3'] ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_url3' ) ); ?>"><?php esc_html_e('Link URL 3:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_url3' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_url3' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_url3'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_text4' ) ); ?>"><?php esc_html_e('Link Text 4:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_text4' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_text4' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_text4'] ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_url4' ) ); ?>"><?php esc_html_e('Link URL 4:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_url4' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_url4' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_url4'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_text5' ) ); ?>"><?php esc_html_e('Link Text 5:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_text5' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_text5' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_text5'] ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_url5' ) ); ?>"><?php esc_html_e('Link URL 5:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_url5' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_url5' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_url5'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_text6' ) ); ?>"><?php esc_html_e('Link Text 6:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_text6' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_text6' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_text6'] ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_url6' ) ); ?>"><?php esc_html_e('Link URL 6:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_url6' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_url6' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_url6'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_text7' ) ); ?>"><?php esc_html_e('Link Text 7:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_text7' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_text7' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_text7'] ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_url7' ) ); ?>"><?php esc_html_e('Link URL 7:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_url7' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_url7' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_url7'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_text8' ) ); ?>"><?php esc_html_e('Link Text 8:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_text8' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_text8' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_text8'] ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_url8' ) ); ?>"><?php esc_html_e('Link URL 8:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_url8' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_url8' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_url8'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_text9' ) ); ?>"><?php esc_html_e('Link Text 9:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_text9' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_text9' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_text9'] ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_url9' ) ); ?>"><?php esc_html_e('Link URL 9:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_url9' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_url9' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_url9'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_text10' ) ); ?>"><?php esc_html_e('Link Text 10:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_text10' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_text10' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_text10'] ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_url10' ) ); ?>"><?php esc_html_e('Link URL 10:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_url10' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_url10' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_url10'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_text11' ) ); ?>"><?php esc_html_e('Link Text 11:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_text11' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_text11' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_text11'] ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_url11' ) ); ?>"><?php esc_html_e('Link URL 11:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_url11' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_url11' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_url11'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_text12' ) ); ?>"><?php esc_html_e('Link Text 12:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_text12' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_text12' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_text12'] ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_url12' ) ); ?>"><?php esc_html_e('Link URL 12:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_url12' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_url12' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_url12'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_text13' ) ); ?>"><?php esc_html_e('Link Text 13:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_text13' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_text13' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_text13'] ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_url13' ) ); ?>"><?php esc_html_e('Link URL 13:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_url13' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_url13' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_url13'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_text14' ) ); ?>"><?php esc_html_e('Link Text 14:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_text14' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_text14' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_text14'] ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_url14' ) ); ?>"><?php esc_html_e('Link URL 14:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_url14' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_url14' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_url14'] ); ?>">
        </p>
    <?php
    }
} // end WPRT_Links

class WPRT_Information extends WP_Widget {
    // Holds widget settings defaults, populated in constructor.
    protected $defaults;

    // Constructor
    function __construct() {
        $this->defaults = array(
            'title'                 => 'Contact',
            'text' => '',
            'address'            => '',
            'email'            => '',
            'phone'            => '',
            'hour'            => '',
            'icon_color' => '',
            'icon_size' => '',
            'icon_margin' => '',
            'text_color' => '',
            'border_color' => '',
            'text_left_pad' => '',
            'bottom_margin' => '5px',
            'margin' => ''
        );

        parent::__construct(
            'widget_information',
            esc_html__( 'Information', 'gustablo' ),
            array(
                'classname'   => 'widget_information',
                'description' => esc_html__( 'Display Information', 'gustablo' )
            )
        );
    }

    // Display widget
    function widget( $args, $instance ) {
        $instance = wp_parse_args( $instance, $this->defaults );
        extract( $instance );
        extract( $args );        

        echo $before_widget;

        if ( ! empty( $title ) ) { echo $before_title . $title . $after_title; }

        $bottom_margin = intval( $bottom_margin );
        $text_left_pad = intval( $text_left_pad );
        $icon_size = intval( $icon_size );
        $icon_margin = intval( $icon_margin );
        
        $wrap_css = $css = $icon_css = $text_css = '';

        if ( ! empty( $margin ) ) $wrap_css .= 'margin:'. $margin .';';
        if ( ! empty( $bottom_margin ) ) $css .= 'padding-top:'. $bottom_margin/2 .'px;margin-top:'. $bottom_margin/2 .'px;';
        if ( ! empty( $icon_color ) ) $icon_css .= 'color:'. $icon_color .';';
        if ( ! empty( $icon_size ) ) $icon_css .= 'font-size:'. $icon_size .'px;';
        if ( ! empty( $icon_margin ) ) $icon_css .= 'margin-top:'. $icon_margin .'px;';
        if ( ! empty( $text_color ) ) $text_css .= 'color:'. $text_color .';';
        if ( ! empty( $border_color ) ) $css .= 'border-color:'. $border_color .';';
        if ( ! empty( $text_left_pad ) ) $text_css .= 'padding-left:'. $text_left_pad .'px;display:block;';

        if ( $text ) printf( '<div class="texts">%1$s</div>', esc_html( $text ) ); ?>

        <ul class="clearfix" style="<?php echo esc_attr( $wrap_css ); ?>">
            <?php

            if ( $address ) 
                printf( '<li class="address" style="%1$s"><i class="gustablo-map" style="%2$s"></i><span style="%3$s">%4$s</span></li>', esc_attr( $css ), esc_attr( $icon_css ), esc_attr( $text_css ), esc_html( $address ) );

            if ( $email ) 
                printf( '<li class="email" style="%1$s"><i class="gustablo-black-envelope" style="%2$s"></i><span style="%3$s">%4$s</span></li>', esc_attr( $css ), esc_attr( $icon_css ), esc_attr( $text_css ), esc_html( $email ) );

            if ( $phone ) 
                printf( '<li class="phone" style="%1$s"><i class="gustablo-telephone2" style="%2$s"></i><span style="%3$s">%4$s</span></li>', esc_attr( $css ), esc_attr( $icon_css ), esc_attr( $text_css ), esc_html( $phone ) );

            if ( $hour ) 
                printf( '<li class="hour" style="%1$s"><i class="gustablo-time1" style="%2$s"></i><span style="%3$s">%4$s</span></li>', esc_attr( $css ), esc_attr( $icon_css ), esc_attr( $text_css ), esc_html( $hour ) );

            ?>
        </ul>

		<?php echo $after_widget;
    }

    // Update widget
    function update( $new_instance, $old_instance ) {
        $instance               = $old_instance;

        $instance['title']              = strip_tags( $new_instance['title'] );
        $instance['text']              = strip_tags( $new_instance['text'] );
        $instance['address']         = strip_tags( $new_instance['address'] );
        $instance['email']         = strip_tags( $new_instance['email'] );
        $instance['phone']         = strip_tags( $new_instance['phone'] );
        $instance['hour']         = strip_tags( $new_instance['hour'] );
        $instance['icon_color']         = strip_tags( $new_instance['icon_color'] );
        $instance['icon_size']         = strip_tags( $new_instance['icon_size'] );
        $instance['icon_margin']         = strip_tags( $new_instance['icon_margin'] );
        $instance['text_color']         = strip_tags( $new_instance['text_color'] );
        $instance['border_color']         = strip_tags( $new_instance['border_color'] );
        $instance['text_left_pad']         = strip_tags( $new_instance['text_left_pad'] );       
        $instance['bottom_margin']         = strip_tags( $new_instance['bottom_margin'] );
        $instance['margin']         = strip_tags( $new_instance['margin'] );
        
        return $instance;
    }

    // Widget setting
    function form( $instance ) {
        $instance = wp_parse_args( $instance, $this->defaults );       
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'gustablo' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php esc_html_e('Text:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['text'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>"><?php esc_html_e('Address:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'address' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['address'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>"><?php esc_html_e('Email:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'email' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['email'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>"><?php esc_html_e('Phone:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'phone' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['phone'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'hour' ) ); ?>"><?php esc_html_e('Hour:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'hour' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hour' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['hour'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'icon_color' ) ); ?>"><?php esc_html_e('Icon Color (ex: #ffb600):', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'icon_color' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['icon_color'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'icon_size' ) ); ?>"><?php esc_html_e('Icon: Font Size (ex: 18px):', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon_size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'icon_size' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['icon_size'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'icon_margin' ) ); ?>"><?php esc_html_e('Icon: Top Margin (ex: 10px):', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon_margin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'icon_margin' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['icon_margin'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'text_color' ) ); ?>"><?php esc_html_e('Item Color (ex: #e3e3e3):', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text_color' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['text_color'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'border_color' ) ); ?>"><?php esc_html_e('Border Color (ex: #303030):', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'border_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'border_color' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['border_color'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'text_left_pad' ) ); ?>"><?php esc_html_e('Item: Left Padding (ex: 10px):', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text_left_pad' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text_left_pad' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['text_left_pad'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'bottom_margin' ) ); ?>"><?php esc_html_e('Item: Bottom Margin (ex: 15px):', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'bottom_margin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'bottom_margin' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['bottom_margin'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'margin' ) ); ?>"><?php esc_html_e('Item Wrap: Margin (ex: 50px 0px 0px 0px)', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'margin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'margin' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['margin'] ); ?>">
        </p>
    <?php
    }
} // end WPRT_Information

class WPRT_Cf7 extends WP_Widget {
    // Holds widget settings defaults, populated in constructor.
    protected $defaults;

    // Constructor
    function __construct() {
        $this->defaults = array(
            'title' 	=> 'Contact Us',
            'texts' => '',
            'form' => ''
        );

        parent::__construct(
            'widget_cf7',
            esc_html__( 'Contact Form 7', 'gustablo' ),
            array(
                'classname'   => 'widget_cf7',
                'description' => esc_html__( 'Display Contact Form 7 for Widgets.', 'gustablo' )
            )
        );
    }

    // Display widget
    function widget( $args, $instance ) {
        $instance = wp_parse_args( $instance, $this->defaults );
        extract( $instance );
        extract( $args );        

        echo $before_widget;

        if ( ! empty( $title ) ) { echo $before_title . $title . $after_title; } ?>

        <div class="clearfix">
            <?php
            if ( ! empty ($texts) )
                echo '<p class="contact-texts">'. esc_html( $texts ) .'</p>';

            $widget_text = empty($instance['form']) ? '' : stripslashes($instance['form']);
            echo apply_filters('widget_text','[contact-form-7 id="' . $widget_text . '"]');
            ?>
        </div>

		<?php echo $after_widget;
    }

    // Update widget
    function update( $new_instance, $old_instance ) {
        $instance               = $old_instance;
        $instance['title']      = strip_tags( $new_instance['title'] );
        $instance['form']      = strip_tags( $new_instance['form'] );
        $instance['texts']      = strip_tags( $new_instance['texts'] );
        
        return $instance;
    }

    // Widget setting
    function form( $instance ) {
        $instance = wp_parse_args( $instance, $this->defaults );       
        ?>
        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'gustablo' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'texts' ) ); ?>"><?php esc_html_e('Some Texts:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'texts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'texts' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['texts'] ); ?>">
        </p>

        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'form' ) ); ?>"><?php esc_html_e( 'Form:', 'gustablo' ); ?></label>
        <?php
        $cf7posts = new WP_Query( array( 'post_type' => 'wpcf7_contact_form' ) );

        if ( $cf7posts->have_posts() ) : ?>
            <select class="widefat" name="<?php echo esc_attr( $this->get_field_name('form') ); ?>" id="<?php echo esc_attr( $this->get_field_id('form') ); ?>">
            <?php while( $cf7posts->have_posts() ) : $cf7posts->the_post(); ?>
                <option value="<?php the_id(); ?>"<?php selected(get_the_id(), $instance['form']); ?>><?php the_title(); ?></option>
            <?php endwhile; ?>
        <?php else : ?>
            <select class="widefat" disabled>
            <option disabled="disabled">No Forms Found</option>
        <?php endif; ?>
        </select></p> 
        <?php
    }
} // end WPRT_Cf7

class WPRT_recent_news extends WP_Widget {
    // Holds widget settings defaults, populated in constructor.
    protected $defaults;

    // Constructor
    function __construct() {
        $this->defaults = array(
            'title' 	=> 'Recent Posts', 
            'category'  => '',
            'count'     => 3,
            'bottom_margin' => '20px',
            'thumb_width' => '56px',
            'thumb_style' => 'icon',
            'thumb_right_margin' => '18px',
            'title_size' => '',
            'title_color' => '',
            'border_color' => '',
            'date_color' => '',
            'show_date' => 'on',
            'excerpt_length' => '0',
            'title_length' => '6'
        );

        parent::__construct(
            'widget_news_post',
            esc_html__( 'Recent Posts Advanced', 'gustablo' ),
            array(
                'classname'   => 'widget_recent_posts',
                'description' => esc_html__( 'Display recent blog posts.', 'gustablo' )
            )
        );
    }

    // Display widget
    function widget( $args, $instance ) {
        $instance = wp_parse_args( $instance, $this->defaults );
        extract( $instance );
        extract( $args );

        echo $before_widget;

        if ( ! empty( $title ) ) { echo $before_title . $title . $after_title; }

        $bottom_margin = intval( $bottom_margin );
        $thumb_width = intval( $thumb_width );
        $thumb_right_margin = intval( $thumb_right_margin );
        $title_size = intval( $title_size );

        $item_css = '';
        if ( ! empty( $bottom_margin ) )
            $item_css .= 'padding-top:'. $bottom_margin/2 .'px;margin-top:'. $bottom_margin/2 .'px;';

        if ( ! empty( $border_color ) )
            $item_css .= 'border-color:'. $border_color .';';

        $icon_css = $thumb_css = '';
        if ( isset( $thumb_width ) ) {
            $thumb_css .= 'width:'. $thumb_width .'px;height:'. $thumb_width .'px;';
            $icon_css .= 'width:'. $thumb_width .'px;height:'. $thumb_width .'px;line-height:'. $thumb_width .'px;';
        }

        if ( isset( $thumb_right_margin ) )
            $thumb_css .= 'margin-right:'. $thumb_right_margin .'px;';

        $title_css = '';
        if ( ! empty( $title_size ) )
            $title_css .= 'font-size:'. $title_size .'px;';

        if ( ! empty( $title_color ) )
            $title_css .= 'color:'. $title_color .';';

        $date_css = '';
        if ( ! empty( $date_color ) )
            $date_css .= 'color:'. $date_color .';';

        $query_args = array(
            'post_type' => 'post',
            'posts_per_page' => intval($count)
        );

        if ( ! empty( $category ) )
            $query_args['tax_query'] = array(
                array(
                    'taxonomy' => 'category',
                    'terms'    => $category,
                ),
            );             
       
        $query = new WP_Query( $query_args ); ?>

        <ul class="recent-news clearfix">
		<?php $i = 0; if ( $query->have_posts() ) :
            while ( $query->have_posts() ) : $query->the_post(); ?>
				<li class="clearfix" style="<?php if ( $i != 0 ) echo esc_attr( $item_css ); ?>">
                    <?php if ( $thumb_width ) : ?>
                    <div class="thumb <?php echo esc_attr( $thumb_style ); ?>" style="<?php echo esc_attr( $thumb_css ); ?>">
                        <?php
                        if ( $thumb_style == 'image' ) {
                            $size = 'wprt-post-widget';

                            if ( has_post_thumbnail() ) {
                                the_post_thumbnail( $size );
                            } elseif ( get_post_format() == 'gallery' ) {
                                $images = wprt_metabox( 'gallery_images', "type=image&size=$size" );
                                
                                if ( ! empty( $images ) ) {
                                    foreach ( $images as $image ) {
                                        if ( $image === reset( $images ) )
                                        printf( '<img src="%s" alt="gallery">', esc_url( $image['url'] ) );
                                    }
                                }
                            }
                        } else {
                            printf( '<i class="gustablo-pencil" style="%1$s"></i>', $icon_css );
                        } ?>
                    </div>
                    <?php endif; ?>
                    <?php 
                    $excerpt = '';
                    $title = get_the_title();
                    if ( !empty( $title_length ) ) {
                        $title = wprt_trim_words( $title, $title_length );
                    }

                    if ( !empty( $excerpt_length ) ) {
                        $excerpt = sprintf('<div class="excerpt">%1$s</div>', wp_trim_words( get_the_content(), $excerpt_length, '...' ) );
                    }

                    $date = ''; 
                    if ( !empty( $show_date ) ) {
                        $date = sprintf('
                            <span class="post-date" style="%2$s"><span class="entry-date">%1$s</span></span>',
                            get_the_date(),
                            esc_attr( $date_css )
                        );
                    }

                    printf( '
                        <div class="texts"><h3><a href="%1$s" style="%5$s">%2$s</a></h3>%3$s %4$s</div>',
                        esc_url( get_the_permalink() ),
                        $title,
                        $excerpt,
                        $date,
                        esc_attr( $title_css )
                    );
                    ?>
                </li>
			<?php $i++; endwhile; wp_reset_postdata(); ?>
		<?php endif; ?>        
        </ul>
        
		<?php echo $after_widget;
    }

    // Update widget
    function update( $new_instance, $old_instance ) {
        $instance                   = $old_instance;
        $instance['title']          = strip_tags( $new_instance['title'] );
        $instance['bottom_margin']         = strip_tags( $new_instance['bottom_margin'] );
        $instance['thumb_width']         = strip_tags( $new_instance['thumb_width'] );
        $instance['thumb_right_margin'] = strip_tags( $new_instance['thumb_right_margin'] );
        $instance['title_size']         = strip_tags( $new_instance['title_size'] );
        $instance['title_color']         = strip_tags( $new_instance['title_color'] );
        $instance['date_color']         = strip_tags( $new_instance['date_color'] );
        $instance['border_color']         = strip_tags( $new_instance['border_color'] );
        $instance['bottom_margin']         = strip_tags( $new_instance['bottom_margin'] );
        $instance['category']       = array_filter( $new_instance['category'] );
        $instance['count']          = intval( $new_instance['count'] );
        $instance['excerpt_length']  = intval( $new_instance['excerpt_length'] );
        $instance['title_length']  = intval( $new_instance['title_length'] );
        $instance[ 'show_date' ] = $new_instance[ 'show_date' ];
        $instance[ 'thumb_style' ] = $new_instance[ 'thumb_style' ];

        return $instance;
    }

    // Widget setting
    function form( $instance ) {
        $instance = wp_parse_args( $instance, $this->defaults );       
        ?>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'gustablo' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php esc_html_e( 'Count:', 'gustablo' ); ?></label>
            <input class="widefat" type="number" id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" value="<?php echo esc_attr( $instance['count'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>"><?php esc_html_e( 'Select Category:', 'gustablo' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'category' ) ); ?>[]">
                <option value=""<?php selected( empty( $instance['category'] ) ); ?>><?php esc_html_e( 'All', 'gustablo' ); ?></option>
                <?php               
                $categories = get_categories();
                foreach ( $categories as $category ) {
                    printf(
                        '<option value="%1$s" %4$s>%2$s (%3$s)</option>',
                        esc_attr( $category->term_id ),
                        $category->name,
                        $category->count,
                        ( in_array( $category->term_id, $instance['category'] ) ) ? 'selected="selected"' : '');
                }               

                ?>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title_length' ) ); ?>"><?php esc_html_e( 'Title Word Count Length (ex: 4):', 'gustablo' ); ?></label>
            <input class="widefat" type="number" id="<?php echo esc_attr( $this->get_field_id( 'title_length' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title_length' ) ); ?>" value="<?php echo esc_attr( $instance['title_length'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'excerpt_length' ) ); ?>"><?php esc_html_e( 'Excerpt Word Count Length (ex: 4):', 'gustablo' ); ?></label>
            <input class="widefat" type="number" id="<?php echo esc_attr( $this->get_field_id( 'excerpt_length' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'excerpt_length' ) ); ?>" value="<?php echo esc_attr( $instance['excerpt_length'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'bottom_margin' ) ); ?>"><?php esc_html_e('Item Bottom Margin:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'bottom_margin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'bottom_margin' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['bottom_margin'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'thumb_style' ) ); ?>"><?php esc_html_e( 'Thumbnail  Style', 'gustablo' ); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'thumb_style' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'thumb_style' ) ); ?>">
                <option value="icon" <?php selected( 'icon', $instance['thumb_style'] ); ?>><?php esc_html_e( 'Icon', 'gustablo' ) ?></option>
                <option value="image" <?php selected( 'image', $instance['thumb_style'] ); ?>><?php esc_html_e( 'Image', 'gustablo' ) ?></option>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'thumb_width' ) ); ?>"><?php esc_html_e('Thumbnail Width (enter 0 to hide):', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'thumb_width' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'thumb_width' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['thumb_width'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'thumb_right_margin' ) ); ?>"><?php esc_html_e('Thumbnail Right Margin:', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'thumb_right_margin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'thumb_right_margin' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['thumb_right_margin'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title_size' ) ); ?>"><?php esc_html_e('Title Size (ex: 18px):', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title_size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title_size' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['title_size'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title_color' ) ); ?>"><?php esc_html_e('Title Color (ex: #e3e3e3):', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title_color' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['title_color'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'date_color' ) ); ?>"><?php esc_html_e('Date Color (ex: #303030):', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'date_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'date_color' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['date_color'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'border_color' ) ); ?>"><?php esc_html_e('Border Color (ex: #303030):', 'gustablo') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'border_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'border_color' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['border_color'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>"><?php esc_html_e( 'Show Date:', 'gustablo' ); ?></label>
            <input class="checkbox" type="checkbox" <?php checked( $instance[ 'show_date' ], 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_date' ) ); ?>" /> 
        </p>
    <?php
    }
} // end WPRT_recent_news

class WPRT_Instagram_Widget extends WP_Widget {
    // Holds widget settings defaults, populated in constructor.
    protected $defaults;

    // Constructor
    function __construct() {
        $this->defaults = array(
            'title'     => 'Instagram Photos',
            'username'  => '', 
            'count'     => '6',
            'item_column' => '3',
            'gutter'    => '1'  
        );

        parent::__construct(
            'widget_instagram',
            esc_html__( 'Instagram Photos', 'hairsaloon' ),
            array(
                'classname'   => 'widget_instagram',
                'description' => esc_html__( 'Display images from Instagram.', 'hairsaloon' )
            )
        );
    }

    // Display widget
    function widget( $args, $instance ) {
        $instance = wp_parse_args( $instance, $this->defaults );
        extract( $instance );
        extract( $args );
        
        echo $before_widget;

        if ( ! empty( $title ) ) { echo $before_title . $title . $after_title; }

        $item_column = 'col'. $item_column;
        $gutter = 'g'. $gutter;

        if ( $username != '' ) {
            $media_array = $this->scrape_instagram( $username );

            if ( is_wp_error( $media_array ) ) {
                echo wp_kses_post( $media_array->get_error_message() );
            } else {
                // filter for images only?
                if ( $images_only = apply_filters( 'wpiw_images_only', false ) ) {
                    $media_array = array_filter( $media_array, array( $this, 'images_only' ) );
                }

                // slice list down to required limit.
                $media_array = array_slice( $media_array, 0, $count );
                
                echo '<div class="instagram-wrap clearfix ' . $item_column .' '. $gutter .'">';
                foreach ( $media_array as $item ) {
                    echo '<div class="instagram_badge_image"><a href="'. esc_url( $item['link'] ) .'" target="_blank"><div class="item"><img src="'.esc_url( $item['thumbnail'] ).'"  alt="image" /></div></a></div>';
                }
                echo '</div>';
            }
        }

        echo $after_widget;
    }

    // Update widget
    function update( $new_instance, $old_instance ) {
        $instance               = $old_instance;
        $instance['title']      = strip_tags( $new_instance['title'] );
        $instance['username']   = strip_tags( $new_instance['username'] );
        $instance['count']      = intval( $new_instance['count'] );
        $instance['item_column']      = $new_instance['item_column'];
        $instance['gutter']      = $new_instance['gutter'];
        
        return $instance;
    }

    // Widget setting
    function form( $instance ) {
        $instance = wp_parse_args( $instance, $this->defaults );       
        ?>
        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'hairsaloon' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
        </p>

        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>"><?php esc_html_e( 'Username:', 'hairsaloon' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'username' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['username'] ); ?>" />
        </p>

        <p><label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php esc_html_e( 'Count:', 'hairsaloon' ); ?></label>
        <input class="widefat" type="number" id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" value="<?php echo esc_attr( $instance['count'] ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'item_column' ) ); ?>"><?php esc_html_e( 'Number of column?', 'hairsaloon' ); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'item_column' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'item_column' ) ); ?>">
                <option value="2" <?php selected( '2', $instance['item_column'] ); ?>><?php esc_html_e( '2', 'hairsaloon' ) ?></option>
                <option value="3" <?php selected( '3', $instance['item_column'] ); ?>><?php esc_html_e( '3', 'hairsaloon' ) ?></option>
                <option value="4" <?php selected( '4', $instance['item_column'] ); ?>><?php esc_html_e( '4', 'hairsaloon' ) ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'gutter' ) ); ?>"><?php esc_html_e( 'Gutter', 'hairsaloon' ); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'gutter' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'gutter' ) ); ?>">
                <option value="0" <?php selected( '0', $instance['gutter'] ); ?>><?php esc_html_e( '0', 'hairsaloon' ) ?></option>
                <option value="1" <?php selected( '1', $instance['gutter'] ); ?>><?php esc_html_e( '1', 'hairsaloon' ) ?></option>
                <option value="5" <?php selected( '5', $instance['gutter'] ); ?>><?php esc_html_e( '5', 'hairsaloon' ) ?></option>
                <option value="12" <?php selected( '12', $instance['gutter'] ); ?>><?php esc_html_e( '12', 'hairsaloon' ) ?></option>
                <option value="15" <?php selected( '15', $instance['gutter'] ); ?>><?php esc_html_e( '15', 'hairsaloon' ) ?></option>
            </select>
        </p>
    <?php
    }

    // based on https://gist.github.com/cosmocatalano/4544576.
    function scrape_instagram( $username ) {

        $username = trim( strtolower( $username ) );

        switch ( substr( $username, 0, 1 ) ) {
            case '#':
                $url              = 'https://instagram.com/explore/tags/' . str_replace( '#', '', $username );
                $transient_prefix = 'h';
                break;

            default:
                $url              = 'https://instagram.com/' . str_replace( '@', '', $username );
                $transient_prefix = 'u';
                break;
        }

        if ( false === ( $instagram = get_transient( 'insta-a10-' . $transient_prefix . '-' . sanitize_title_with_dashes( $username ) ) ) ) {

            $remote = wp_remote_get( $url );

            if ( is_wp_error( $remote ) ) {
                return new WP_Error( 'site_down', esc_html__( 'Unable to communicate with Instagram.', 'hairsaloon' ) );
            }

            if ( 200 !== wp_remote_retrieve_response_code( $remote ) ) {
                return new WP_Error( 'invalid_response', esc_html__( 'Instagram did not return a 200.', 'hairsaloon' ) );
            }

            $shards      = explode( 'window._sharedData = ', $remote['body'] );
            $insta_json  = explode( ';</script>', $shards[1] );
            $insta_array = json_decode( $insta_json[0], true );

            if ( ! $insta_array ) {
                return new WP_Error( 'bad_json', esc_html__( 'Instagram has returned invalid data.', 'hairsaloon' ) );
            }

            if ( isset( $insta_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'] ) ) {
                $images = $insta_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'];
            } elseif ( isset( $insta_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'] ) ) {
                $images = $insta_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'];
            } else {
                return new WP_Error( 'bad_json_2', esc_html__( 'Instagram has returned invalid data.', 'hairsaloon' ) );
            }

            if ( ! is_array( $images ) ) {
                return new WP_Error( 'bad_array', esc_html__( 'Instagram has returned invalid data.', 'hairsaloon' ) );
            }

            $instagram = array();

            foreach ( $images as $image ) {
                if ( true === $image['node']['is_video'] ) {
                    $type = 'video';
                } else {
                    $type = 'image';
                }

                $caption = __( 'Instagram Image', 'hairsaloon' );
                if ( ! empty( $image['node']['edge_media_to_caption']['edges'][0]['node']['text'] ) ) {
                    $caption = wp_kses( $image['node']['edge_media_to_caption']['edges'][0]['node']['text'], array() );
                }

                $instagram[] = array(
                    'description' => $caption,
                    'link'        => trailingslashit( '//instagram.com/p/' . $image['node']['shortcode'] ),
                    'time'        => $image['node']['taken_at_timestamp'],
                    'comments'    => $image['node']['edge_media_to_comment']['count'],
                    'likes'       => $image['node']['edge_liked_by']['count'],
                    'thumbnail'   => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][0]['src'] ),
                    'small'       => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][2]['src'] ),
                    'large'       => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][4]['src'] ),
                    'original'    => preg_replace( '/^https?\:/i', '', $image['node']['display_url'] ),
                    'type'        => $type,
                );
            } // End foreach().

            // do not set an empty transient - should help catch private or empty accounts.
            if ( ! empty( $instagram ) ) {
                $instagram = base64_encode( serialize( $instagram ) );
                set_transient( 'insta-a10-' . $transient_prefix . '-' . sanitize_title_with_dashes( $username ), $instagram, apply_filters( 'null_instagram_cache_time', HOUR_IN_SECONDS * 2 ) );
            }
        }

        if ( ! empty( $instagram ) ) {

            return unserialize( base64_decode( $instagram ) );

        } else {

            return new WP_Error( 'no_images', esc_html__( 'Instagram did not return any images.', 'hairsaloon' ) );

        }
    }

    function images_only( $media_item ) {

        if ( 'image' === $media_item['type'] ) {
            return true;
        }

        return false;
    }
} // end WPRT_Instagram_Widget

class Lastest_Tweets extends WP_Widget {
    // Holds widget settings defaults, populated in constructor.
    protected $defaults;

    // Constructor
    function __construct() {
        $this->defaults = array(
            'title'                 => 'Latest Tweets',
            'username'              => '',
            'count'                 => '3',
            'consumer_key'          => '',
            'consumer_secret'       => '',
            'access_token'          => '',
            'access_token_secret'   => '',
            'cachetime'             => '1',
            'dtime'                 => 'date'
        );

        parent::__construct(
            'widget_twitter',
            esc_html__( 'Lastest Tweets', 'roll' ),
            array(
                'classname'   => 'widget_twitter',
                'description' => esc_html__( 'Display Lastest Tweets.', 'roll' )
            )
        );
    }

    function parseTweet( $text ) {
        $text = preg_replace( '#http://[a-z0-9._/-]+#i', '<a  target="_blank" href="$0">$0</a>', $text ); 
        $text = preg_replace( '#@([a-z0-9_]+)#i', '@<a  target="_blank" href="http://twitter.com/$1">$1</a>', $text ); 
        $text = preg_replace( '# \#([a-z0-9_-]+)#i', ' #<a target="_blank" href="http://twitter.com/search?q=%23$1">$1</a>', $text ); 
        $text = preg_replace( '#https://[a-z0-9._/-]+#i', '<a  target="_blank" href="$0">$0</a>', $text ); 
        
        return $text;
    }

    function twitterTime( $a ) {
        $b = strtotime( 'now' ); 
        $c = strtotime( $a );
        $d = $b - $c;

        $minute = 60;
        $hour = $minute * 60;
        $day = $hour * 24;
        $week = $day * 7;
            
        if ( is_numeric( $d ) && $d > 0 ) {
            //if less then 3 seconds
            if ( $d < 3 ) return 'Right now';
            //if less then minute
            if ( $d < $minute ) return floor( $d ) . ' seconds ago';
            //if less then 2 minutes
            if ( $d < $minute * 2 ) return 'About 1 minute ago';
            //if less then hour
            if ( $d < $hour ) return floor($d / $minute) . ' minutes ago';
            //if less then 2 hours
            if ( $d < $hour * 2 ) return 'About 1 hour ago';
            //if less then day
            if ( $d < $day ) return floor( $d / $hour ) . ' hours ago';
            //if more then day, but less then 2 days
            if ( $d > $day && $d < $day * 2 ) return 'Yesterday';
            //if less then year
            if ( $d < $day * 365 ) return floor( $d / $day ) . ' days ago';
            //else return more than a year
            return 'Over a year ago';
        }
    }

    // Display widget
    function widget( $args, $instance ) {
        $instance = wp_parse_args( $instance, $this->defaults );
        extract( $instance );
        extract( $args );        

        echo $before_widget;

        if ( ! empty($title) ) { echo  $before_title.$title.$after_title; }

        $count = intval( $count );

        if ( ! empty( $consumer_key ) ) $consumer_key = trim( $consumer_key );
        if ( ! empty( $consumer_secret ) ) $consumer_secret = trim( $consumer_secret );
        if ( ! empty( $access_token ) ) $access_token = trim( $access_token );
        if ( ! empty( $access_token_secret ) ) $access_token_secret = trim( $access_token_secret );

        if ( empty( $consumer_key ) || empty( $consumer_secret ) || empty( $access_token ) || empty( $access_token_secret ) )
            return;

        /* Cache */
        $cache = dirname( __FILE__ ) .'/cache/twitter.txt';
        if ( time() - filemtime( $cache ) > $cachetime ) {
            /* Require Twitter OAuth class */
            if ( ! class_exists('TwitterOAuth') )
                require_once 'twitter/twitteroauth.php';

            /* Twitter connection */
            $twitterConnection = new TwitterOAuth(
                $consumer_key,
                $consumer_secret,
                $access_token,
                $access_token_secret
            );

            /* Get tweets */
            $tweets = $twitterConnection->get(
                'statuses/user_timeline', array(
                'screen_name' => $username,
                'count' => $count
            ) );

            file_put_contents( $cache, serialize( $tweets ) );

        } else {
            $tweets = unserialize( file_get_contents( $cache ) );
        }

        /* Show message if errors */
        if ( isset( $tweets->errors ) ) {
            echo 'No tweets available or bad configuration...';
            return;
        }

        /* Output */
        if ( $tweets ) {

            echo '<div class="item-wrap">';
            foreach ( $tweets as $tweet ) {
                $retweet        = $tweet->id_str;
                $text           = $this->parseTweet( $tweet->text );
                $screen_name    = $tweet->user->screen_name;
                $time           = date( 'd M Y', strtotime( $tweet->created_at ) );
                if ( $dtime == 'timeago' )
                    $time = $this->twitterTime( $tweet->created_at );

                echo '<div class="tweet-item">';
                echo '<div class="tweet-icon"><i class="gustablo-twitter"></i></div>';
                echo '<div class="text-wrap">';
                echo '<div class="tweet-text">'. $text .'</div>'; ?>
                <?php
                echo '
                <div class="timestamp">
                    <a href="https://twitter.com/'. $screen_name .'/status/'. $retweet .'" target="_blank">'.$time. '</a>
                </div>';
                echo '</div>';
                echo '</div>';
            }

            echo '</div>';
        }

        echo $after_widget;
    }

    // Update widget
    function update( $new_instance, $old_instance ) {
        $instance               = $old_instance;
        $instance['title']      = strip_tags( $new_instance['title'] );
        $instance['username']   = strip_tags( $new_instance['username'] );
        $instance['count']      = intval( $new_instance['count'] );
        $instance['consumer_key']      = strip_tags( $new_instance['consumer_key'] );
        $instance['consumer_secret']      = strip_tags( $new_instance['consumer_secret'] );
        $instance['access_token']      = strip_tags( $new_instance['access_token'] );
        $instance['access_token_secret']      = strip_tags( $new_instance['access_token_secret'] );
        $instance['cachetime']   = strip_tags( $new_instance['cachetime'] );
        $instance['dtime']   = $new_instance['dtime'];

        return $instance;
    }

    // Widget setting
    function form( $instance ) {
        $instance = wp_parse_args( $instance, $this->defaults );       
        ?>

        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'roll' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
        </p>

        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>"><?php esc_html_e( 'Username:', 'roll' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'username' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['username'] ); ?>" />
        </p>

        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php esc_html_e( 'Count:', 'roll' ); ?></label>
        <input class="widefat" type="number" id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" value="<?php echo esc_attr( $instance['count'] ); ?>">
        </p>

        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'consumer_key' ) ); ?>"><?php esc_html_e( 'Consumer Key:', 'roll' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'consumer_key' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'consumer_key' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['consumer_key'] ); ?>" />
        </p>

        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'consumer_secret' ) ); ?>"><?php esc_html_e( 'Consumer Secret:', 'roll' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'consumer_secret' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'consumer_secret' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['consumer_secret'] ); ?>" />
        </p>

        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'access_token' ) ); ?>"><?php esc_html_e( 'Access Token:', 'roll' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'access_token' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'access_token' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['access_token'] ); ?>" />
        </p>

        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'access_token_secret' ) ); ?>"><?php esc_html_e( 'Access Token Secret:', 'roll' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'access_token_secret' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'access_token_secret' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['access_token_secret'] ); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'dtime' ) ); ?>"><?php esc_html_e( 'Date Type:', 'mature' ); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'dtime' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'dtime' ) ); ?>">
                <option value="date" <?php selected( 'date', $instance['dtime'] ); ?>><?php esc_html_e( 'Date', 'mature' ) ?></option>
                <option value="timeago" <?php selected( 'timeago', $instance['dtime'] ); ?>><?php esc_html_e( 'Time Ago', 'mature' ) ?></option>
            </select>
        </p>
        
        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'cachetime' ) ); ?>"><?php esc_html_e( 'Time of cache : (in second)', 'roll' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'cachetime' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'cachetime' )); ?>" type="text" value="<?php echo esc_attr( $instance['cachetime'] ); ?>" />
        </p>
    <?php
    }
} // end Lastest_Tweets

?>