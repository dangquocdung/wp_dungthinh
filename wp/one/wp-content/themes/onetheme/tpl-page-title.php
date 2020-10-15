<?php
global $post;
$title_attr = '';
// background image
$bg_img = TT::get_option_bg_value('page_title_image');
if( !empty($bg_img) ){
    $title_attr = $bg_img;
}
$title_bg_img = TT::get_meta_bg_value('title_bg');
if( !empty($title_bg_img) ){
    $title_attr = $title_bg_img;
}
$title_padding_top = TT::getmeta('title_padding_top');
$title_padding_bottom = TT::getmeta('title_padding_bottom');
$title_backround_color = TT::getmeta('backround_color');

if( !empty($title_padding_top) ){
    $title_attr .= 'padding-top:'. abs($title_padding_top) .'px;';
}
if( !empty($title_padding_bottom) ){
    $title_attr .= 'padding-bottom:'. abs($title_padding_bottom) .'px;';
}if( !empty($title_backround_color) ){
    $title_attr .= 'backround:'. abs($title_backround_color);
}

$parallax_section = 'default';
if( strpos($title_attr, 'parallax')!==false ){
    $parallax_section = 'parallax';
}
?>
<div class="wpc-banner style-7 wpc-overlay overlay-1" style="<?php echo esc_attr($title_attr); echo esc_attr($title_backround_color);?>" data-section-type="<?php echo esc_attr($parallax_section); ?>">> 
    <div class="container padd-only-sm">
        <div class="row">
            <div class="col-md-12">
                <section class="page-heading">
                    <h1 class="heading-title"><?php TPL::get_page_title(); ?></h1>
                    <div class="heading-breadcrumbs"><?php themeton_breadcrumb(); ?></div>
                </section>
            </div>
        </div>
    </div>
</div>
