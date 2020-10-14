<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}
return array(
    'base' => 'g5element_portfolio',
    'name' => esc_html__('Portfolio', 'g5-portfolio'),
    'description' => esc_html__( 'Display list of portfolio', 'g5-portfolio' ),
    'category' => G5ELEMENT()->shortcode()->get_category_name(),
    'icon'        => 'g5element-vc-icon-portfolio',
    'params' => array_merge(
        array(
            array(
                'param_name' => 'cate_filter_enable',
                'heading' => esc_html__('Category Filter', 'g5-portfolio'),
                'type' => 'g5element_switch',
                'std' => '',
            ),
	        array(
		        'param_name' => 'cate_filter_align',
		        'heading' => esc_html__('Category Filter Align', 'g5-portfolio'),
		        'type' => 'g5element_button_set',
		        'value' => array_flip(G5CORE()->settings()->get_category_filter_align()),
		        'std' => '',
		        'dependency' => array('element' => 'cate_filter_enable', 'value' => 'on'),
	        ),
            array(
                'param_name' => 'post_layout',
                'heading' => esc_html__('Layout', 'g5-portfolio'),
                'description' => esc_html__('Specify your portfolio layout', 'g5-portfolio'),
                'type' => 'g5element_image_set',
                'value' => G5PORTFOLIO()->settings()->get_portfolio_layout(),
                'std' => 'grid',
                'admin_label' => true
            ),
            array(
                'param_name' => 'item_skin',
                'heading' => esc_html__('Item Skin', 'g5-portfolio'),
                'description' => esc_html__('Specify your portfolio item skin, Note: Skin 01, Skin 02 only apply for layout Grid, Masonry', 'g5-portfolio'),
                'type' => 'g5element_image_set',
                'value' => G5PORTFOLIO()->settings()->get_portfolio_skins(),
                'std' => 'skin-01',
                'admin_label' => true
            ),
            array(
                'param_name' => 'item_custom_class',
                'heading' => esc_html__( 'Item Css Classes', 'g5-portfolio' ),
                'description' => esc_html__( 'Add custom css classes to item', 'g5-portfolio' ),
                'type' => 'textfield'
            ),
            array(
                'param_name' => 'category_enable',
                'heading' => esc_html__('Show Category','g5-portfolio'),
                'type' => 'g5element_switch',
                'std' => 'on',
            ),
            array(
                'param_name' => 'excerpt_enable',
                'heading' => esc_html__('Show Excerpt','g5-portfolio'),
                'type' => 'g5element_switch',
                'std' => '',
            ),
            array(
                'param_name' => 'columns_gutter',
                'heading' => esc_html__('Columns Gutter', 'g5-portfolio'),
                'description' => esc_html__('Specify your horizontal space between portfolio.', 'g5-portfolio'),
                'type' => 'dropdown',
                'value' => array_flip(G5CORE()->settings()->get_post_columns_gutter()),
                'std' => '30',
            ),
            array(
                'param_name' => 'posts_per_page',
                'heading' => esc_html__('Portfolio Per Page', 'g5-portfolio'),
                'description' => esc_html__('Enter number of portfolio per page you want to display. Default 10', 'g5-portfolio'),
                'type' => 'g5element_number',
                'std' => '',
            ),
            array(
                'param_name' => 'offset',
                'heading' => esc_html__('Offset posts', 'g5-portfolio'),
                'description' => esc_html__('Start the count with an offset. If you have a block that shows 4 posts before this one, you can make this one start from the 5\'th post (by using offset 4)', 'g5-portfolio'),
                'type' => 'g5element_number',
                'std' => '',
            ),
            array(
                'param_name' => 'post_paging',
                'heading' => esc_html__('Paging', 'g5-portfolio'),
                'description' => esc_html__('Specify your post paging mode', 'g5-portfolio'),
                'type' => 'dropdown',
                'value' => array_flip(G5ELEMENT()->settings()->get_post_paging()),
                'std' => 'none'
            ),
            array(
                'param_name' => 'post_animation',
                'heading' => esc_html__('Animation', 'g5-portfolio'),
                'description' => esc_html__('Specify your portfolio animation', 'g5-portfolio'),
                'type' => 'dropdown',
                'value' => array_flip(G5CORE()->settings()->get_animation()),
                'std' => 'none'
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Append Categories', 'g5-portfolio' ),
                'param_name'  => 'append_tabs',
                'std'         => '',
                'dependency' => array('element' => 'cate_filter_enable', 'value' => 'on'),
                'description' => esc_html__( 'Change where the categories are attached (Selector, htmlString, Array, Element, jQuery object)', 'g5-portfolio' ),
            ),
            g5element_vc_map_add_element_id(),
            g5element_vc_map_add_extra_class(),
        ),
        g5portfolio_vc_map_add_filter(),
        g5element_vc_map_add_columns(array(), esc_html__('Columns', 'g5-portfolio')),
        array(
            array(
                'param_name' => 'post_image_size',
                'heading' => esc_html__('Image size', 'g5-portfolio'),
                'description' => esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 300x400).', 'g5-portfolio'),
                'type' => 'textfield',
                'std' => 'medium',
                'dependency' => array('element' => 'post_layout', 'value_not_equal_to' => array('masonry','justified')),
                'group' => esc_html__('Image Size', 'g5-portfolio'),
            ),
            array(
                'param_name' => 'post_image_width',
                'heading' => esc_html__('Image width', 'g5-portfolio'),
                'type' => 'g5element_number',
                'std' => '400',
                'dependency' => array('element' => 'post_layout', 'value' => 'masonry'),
                'group' => esc_html__('Image Size', 'g5-portfolio'),
            ),
            array(
                'param_name' => 'post_image_ratio_width',
                'heading' => esc_html__('Image ratio width', 'g5-portfolio'),
                'description' => esc_html__('Enter width for image ratio', 'g5-portfolio'),
                'type' => 'g5element_number',
                'std' => '',
                'edit_field_class' => 'vc_col-sm-6 vc_column',
                'dependency' => array('element' => 'post_image_size', 'value' => 'full'),
                'group' => esc_html__('Image Size', 'g5-portfolio'),
            ),
            array(
                'param_name' => 'post_image_ratio_height',
                'heading' => esc_html__('Image ratio height', 'g5-portfolio'),
                'description' => esc_html__('Enter height for image ratio', 'g5-portfolio'),
                'type' => 'g5element_number',
                'std' => '',
                'edit_field_class' => 'vc_col-sm-6 vc_column',
                'dependency' => array('element' => 'post_image_size', 'value' => 'full'),
                'group' => esc_html__('Image Size', 'g5-portfolio'),
            ),

            array(
                'param_name' => 'justified_row_height',
                'heading' => esc_html__('Justified Row Height', 'g5-portfolio'),
                'description' => esc_html__('Enter your portfolio row height', 'g5-portfolio'),
                'type' => 'g5element_number',
                'std' => '200',
                'edit_field_class' => 'vc_col-sm-6 vc_column',
                'dependency' => array('element' => 'post_layout', 'value' => 'justified'),
                'group' => esc_html__('Image Size', 'g5-portfolio'),
            ),
            array(
                'param_name' => 'justified_row_max_height',
                'heading' => esc_html__('Justified Row Max Height', 'g5-portfolio'),
                'description' => esc_html__('Enter your portfolio row max height', 'g5-portfolio'),
                'type' => 'g5element_number',
                'std' => '',
                'edit_field_class' => 'vc_col-sm-6 vc_column',
                'dependency' => array('element' => 'post_layout', 'value' => 'justified'),
                'group' => esc_html__('Image Size', 'g5-portfolio'),
            ),
        ),
        array(
            g5element_vc_map_add_css_animation(),
            g5element_vc_map_add_animation_duration(),
            g5element_vc_map_add_animation_delay(),
            g5element_vc_map_add_css_editor(),
            g5element_vc_map_add_responsive(),
        )
    )
);