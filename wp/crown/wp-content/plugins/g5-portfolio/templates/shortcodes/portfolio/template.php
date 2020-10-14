<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}
/**
 * Shortcode attributes
 * @var $atts
 * @var $cate_filter_enable
 * @var $cate_filter_align
 * @var $post_layout
 * @var $item_skin
 * @var $item_custom_class
 * @var $category_enable
 * @var $excerpt_enable
 * @var $columns_gutter
 * @var $posts_per_page
 * @var $offset
 * @var $post_paging
 * @var $post_animation
 * @var $append_tabs
 * @var $el_id
 * @var $el_class
 * @var $show
 * @var $cat
 * @var $ids
 * @var $orderby
 * @var $order
 * @var $columns_xl
 * @var $columns_lg
 * @var $columns_md
 * @var $columns_sm
 * @var $columns
 * @var $post_image_size
 * @var $post_image_width
 * @var $post_image_ratio_width
 * @var $post_image_ratio_height
 * @var $justified_row_height
 * @var $justified_row_max_height
 * @var $animation_style
 * @var $animation_duration
 * @var $animation_delay
 * @var $css_editor
 * @var $responsive
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Element_Portfolio
 */

$cate_filter_enable = $cate_filter_align = $post_layout = $item_skin = $item_custom_class = $category_enable = $excerpt_enable = $columns_gutter =
$posts_per_page = $offset = $post_paging = $post_animation =
$el_id = $el_class = $append_tabs =
$show = $cat = $ids = $orderby = $order =
$columns_xl = $columns_lg = $columns_md = $columns_sm = $columns =
$post_image_size = $post_image_width = $post_image_ratio_width = $post_image_ratio_height =
$justified_row_height = $justified_row_max_height =
$animation_style = $animation_duration = $animation_delay = $css_editor = $responsive = '';
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$wrapper_classes = array(
    'g5element__portfolio',
    $this->getExtraClass($el_class),
    $this->getCSSAnimation($css_animation),
    vc_shortcode_custom_css_class($css)
);

$query_args = array(
    'post_type' => 'portfolio'
);
$settings = array(
    'image_size' => $post_image_size,
    'image_ratio' => array(
        'width' => absint($post_image_ratio_width),
        'height' => absint($post_image_ratio_height)
    ),
    'image_width' => $post_image_width,
    'category_enable' => $category_enable,
    'excerpt_enable' => $excerpt_enable
);

if ($post_layout === 'justified') {
    $justified_row_height = absint($justified_row_height);
    $justified_row_max_height = absint($justified_row_max_height);
    $justified_options = array(
        'rowHeight' => $justified_row_height > 0 ? $justified_row_height : 200,
        'maxRowHeight' => $justified_row_max_height > 0 ? $justified_row_max_height : false,
        'margins' => absint($columns_gutter),
        'selector' => '.g5portfolio__post-default',
        'imgSelector' => '.g5core__entry-thumbnail-image > img'
    );
    $settings['justified'] = $justified_options;

    $settings['image_size'] = 'full';
    $settings['image_mode'] = 'image';
}

if (!in_array($post_layout,array('grid','masonry','masonry-2'))) {
    if (in_array($item_skin,array('skin-01','skin-2'))) {
        $settings['item_skin'] = 'skin-03';
    }
}


$this->prepare_display($atts,$query_args,$settings);
$class_to_filter =  implode(' ', array_filter($wrapper_classes));
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->getShortcode(), $atts );
$wrapper_attributes = array();
if ( ! empty( $el_id ) ) {
    $wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
?>
<div class="<?php echo esc_attr($css_class)?>" <?php echo implode( ' ', $wrapper_attributes ) ?>>
    <?php G5PORTFOLIO()->listing()->render_content($this->_query_args, $this->_settings); ?>
</div>
