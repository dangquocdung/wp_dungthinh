<?php
    $page_header = TT::getmeta('page_header');
    if( !empty($page_header) && $page_header!='default' ){
        global $onetheme_header_layout;
        $onetheme_header_layout = $page_header;
    }
    // get header
    get_header();

    if( TT::getmeta('title_show')!='0' ){
        get_template_part("tpl", "page-title");
    }
    $page_class = '';

    if( TT::getmeta('remove_padding')=='1' ){
        $page_class .= 'no-padding ';
    }
    $layout_class = 'col-sm-8 col-md-9';
    $page_layout = TT::getmeta('page_layout');
    if( $page_layout=='full' ){
        $layout_class = 'col-sm-12';
    }
    if( $page_layout=='left' ){
            $layout_class = 'col-sm-8 col-md-9 pull-right';
      }
    $panel_attr = '';
    $img = TT::get_meta_bg_value('background_image');
    if( !empty($img) ){
        $panel_attr = $img;
    }
    $panel_bg = TT::getmeta('panel_bg_color');
    if( !empty($panel_bg) ){
        $panel_attr .= "background-color:$panel_bg;";
    }
    $content_attr = '';
    $content_bg_color = TT::getmeta('content_bg_color');
    if( !empty($content_bg_color) ){
        $content_attr .= "background-color:$content_bg_color;";
    }
?>
<section class="work-section <?php echo esc_attr($page_class); ?>">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?php woocommerce_content(); ?>
            </div>
        </div>
        <!-- .row -->
    </div>
    <!-- .container -->
</section>

<?php
// get footer
get_footer();
?>