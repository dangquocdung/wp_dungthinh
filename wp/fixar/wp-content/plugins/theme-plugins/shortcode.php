<?php
function tmpl_share_buttons($atts, $content=NULL){

    extract(shortcode_atts(array(
        'class' => '',
        'title' => esc_html__('Share this post','tmpl'),
        'post_type'=>'',
    ), $atts));

    global $post;
    if(!isset($post->ID)){
        $post = get_queried_object();
    }

    if (!isset($post->ID)){
        return;
    }

    $permalink = get_permalink($post->ID);
    $image =  wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'rettic-preview-thumb' );

    $post_title = rawurlencode(get_the_title($post->ID));

    if( $post_type == '' ){
        $out='
            <div class="footer-meta btn-social">
					<div class="blog-footer-title">'.esc_html($title).'</div>
					<a class="tmpl-social-pinterest"  href="http://pinterest.com/pin/create/button/?url='.$permalink.'&amp;media='.$image[0].'&amp;description='.$post_title.'" target="_blank"><i class="fa fa-pinterest"></i></a>
					<a class="tmpl-social-twitter"  href="https://twitter.com/share?url='.$permalink.'&text='.$post_title.'" title="'.__('Twitter', 'rettic').'" target="_blank"><i class="fa fa-twitter"></i></a>
					<a class="tmpl-social-facebook"  href="http://www.facebook.com/sharer.php?u='.$permalink.'&amp;images='.$image[0].'" title="'.__('Facebook', 'rettic').'" target="_blank"><i class="fa fa-facebook"></i></a>
					<a  class="tmpl-social-google latest" href="http://plus.google.com/share?url='.$permalink.'&title='.$post_title.'" title="'.__('Google +', 'rettic').'" target="_blank"><i class="fa fa-google"></i></a>
			</div>
			';
    } elseif($post_type == 'product') {
        $out='
			<h4 class="font-additional font-weight-bold text-uppercase">'.esc_attr($title).'</h4>
			<ul class="social-list">
				  <li><a  href="http://www.facebook.com/sharer.php?u='.$permalink.'&amp;images='.$image[0].'" title="'.__('Facebook', 'rettic').'" target="_blank"><span class="social_facebook" aria-hidden="true"></span></a></li>
                  <li><a  href="https://twitter.com/share?url='.$permalink.'&text='.$post_title.'" title="'.__('Twitter', 'rettic').'" target="_blank"><span class="social_twitter" aria-hidden="true"></span></a></li>
                  <li><a  href="http://plus.google.com/share?url='.$permalink.'&title='.$post_title.'" title="'.__('Google +', 'rettic').'" target="_blank"><span class="social_googleplus" aria-hidden="true"></span></a></li>
                  <li><a  href="http://pinterest.com/pin/create/button/?url='.$permalink.'&amp;media='.$image[0].'&amp;description='.$post_title.'"  target="_blank"><span class="social_pinterest" aria-hidden="true"></span></a></li>
			</ul>
			';
    } elseif($post_type == 'portfolio') {
        $out='
            
            <div class="pix-social-share">
                <ul>
                    <li><a href="http://www.facebook.com/sharer.php?u='.$permalink.'&amp;images='.$image[0].'" title="'.__('Facebook', 'rettic').'" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="https://twitter.com/share?url='.$permalink.'&text='.$post_title.'" title="'.__('Twitter', 'rettic').'" target="_blank"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="http://plus.google.com/share?url='.$permalink.'&title='.$post_title.'" title="'.__('Google +', 'rettic').'" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="http://pinterest.com/pin/create/button/?url='.$permalink.'&amp;media='.$image[0].'&amp;description='.$post_title.'" title="" target="_blank"><i class="fa fa-pinterest"></i></a></li>
                </ul>
            </div>
			';
    }

    return $out;
}

add_shortcode('share', 'tmpl_share_buttons');