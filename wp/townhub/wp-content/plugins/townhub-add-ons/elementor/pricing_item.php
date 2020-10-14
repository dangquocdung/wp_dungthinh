<?php
/* add_ons_php */

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class CTH_Pricing_Item extends Widget_Base {

    /**
    * Get widget name.
    *
    * Retrieve alert widget name.
    *
    * 
    * @access public
    *
    * @return string Widget name.
    */
    public function get_name() {
        return 'pricing_item';
    }

    // public function get_id() {
    //    	return 'header-search';
    // }

    public function get_title() {
        return __( 'Pricing Item', 'townhub-add-ons' );
    }

    public function get_icon() {
        // Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
        return 'cth-elementor-icon';
    }

    /**
    * Get widget categories.
    *
    * Retrieve the widget categories.
    *
    * 
    * @access public
    *
    * @return array Widget categories.
    */
    public function get_categories() {
        return [ 'townhub-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Content', 'townhub-add-ons' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'townhub-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Extended',
                'label_block' => true,
                
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => __( 'SubTitle', 'townhub-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Developer',
                'label_block' => true,
                
            ]
        );

        $this->add_control(
            'price',
            [
                'label' => __( 'Price', 'townhub-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' => '99',
                'label_block' => true,
                
            ]
        );

        $this->add_control(
            'currency',
            [
                'label' => __( 'Currency', 'townhub-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' => '$',
                
            ]
        );

        $this->add_control(
            'period',
            [
                'label' => __( 'Currency', 'townhub-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Per month',
                
            ]
        );

        $this->add_control(
            'features',
            [
                'label' => __( 'Features', 'townhub-add-ons' ),
                'type' => Controls_Manager::TEXTAREA, //WYSIWYG,
                'default' => '<ul>
    <li>Ten Listings</li>
    <li>Lifetime Availability</li>
    <li>Featured In Search Results</li>
    <li>24/7 Support</li>
</ul>
<a href="#" class="price-link">Choose Extended</a>',
                
                'show_label' => false,
            ]
        );


        $this->add_control(
            'is_featured',
            [
                'label' => __( 'Featured Price', 'townhub-add-ons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' => _x( 'Yes', 'On/Off', 'townhub-add-ons' ),
                'label_off' => _x( 'No', 'On/Off', 'townhub-add-ons' ),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            're_icon',
            [
                'label' => __( 'Recommended Icon', 'townhub-add-ons' ),
                'type' => Controls_Manager::ICON,
                'default' => 'fa fa-check',
                'label_block' => true,
            ]
        );
        $this->add_control(
            're_text',
            [
                'label' => __( 'Recommended Text', 'townhub-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Recommended',
                'label_block' => true,
                
            ]
        );








        

        

        

        $this->end_controls_section();

        

    }

    protected function render( ) {
        $settings = $this->get_settings();



        ?>
        <div class="price-item<?php if($settings['is_featured'] == 'yes') echo ' best-price';?>">
            <div class="price-head op1">
                <?php if($settings['title'] !='') echo '<h3>'.$settings['title'].'</h3>'; ?>
                <?php if($settings['sub_title'] !='') echo '<h4>'.$settings['sub_title'].'</h4>'; ?>
            </div>
            <div class="price-content fl-wrap">
                <div class="price-num fl-wrap">
                    <?php 
                    if($settings['currency'] !='') echo '<span class="curen">'.$settings['currency'].'</span>'; 
                    if($settings['price'] !='') echo '<span class="price-num-item">'.$settings['price'].'</span>'; 
                    if($settings['period'] !='') echo '<div class="price-num-desc">'.$settings['period'].'</div>'; 
                    ?>
                </div>
                <div class="price-desc fl-wrap">
                    <?php 
                    if($settings['features'] !='') echo $settings['features'];
                    
                    if($settings['re_icon'] !='' || $settings['re_text'] != ''){ ?>
                        <div class="recomm-price">
                            <?php if($settings['re_icon'] !='') echo '<i class="'.$settings['re_icon'].'"></i>'; ?>
                            <?php if($settings['re_text'] !='') echo '<span class="recomm-text">'.$settings['re_text'].'</span>'; ?>
                        </div>
                    <?php
                    } 

                     ?>
                </div>
            </div>
        </div>
        <?php
    }

    protected function _content_template() {}

   
    

}



