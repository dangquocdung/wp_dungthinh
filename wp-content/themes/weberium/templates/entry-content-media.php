<?php
/**
 * Entry Content / Media
 *
 * @package weberium
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( is_single() && ! weberium_get_mod( 'blog_single_media', true ) )
	return;

$html = $thumb = '';

switch ( get_post_format() ) {
	case 'gallery':
		$icon = 'post-gallery';
		$size = 'weberium-post-standard';

		if ( is_page_template( 'templates/page-blog-grid.php' ) )
			$size = 'weberium-post-grid';

		$images = weberium_metabox( 'gallery_images', "type=image&size=$size" );

		if ( empty( $images ) )
			break;

		wp_enqueue_script( 'slick' );
		$html = '<div class="blog-gallery">';

		foreach ( $images as $image ) {
			$html .= sprintf(
				'<div><img src="%s" alt="%s"></div>',
				esc_url( $image['url'] ),
				esc_attr__('gallery', 'weberium')
			);
		}
		$html .= '</div>';
		break;
	case 'video':
		$icon = 'post-video';
		$video = weberium_metabox( 'video_url' );
		if ( ! $video )
			break;

		if ( filter_var( $video, FILTER_VALIDATE_URL ) ) {
			// If URL: show oEmbed HTML
			if ( $oembed = @wp_oembed_get( $video ) )
				$html .= $oembed;
		} else {
			// If embed code: just display
			$html .= $video;
		}
		break;
	default:
		$icon = 'post-standard"';
		$size = 'weberium-post-standard';

		if ( is_page_template( 'templates/page-blog-grid.php' ) || is_page_template( 'templates/page-blog-list.php' ) )
			$size = 'weberium-post-grid';

		$thumb = get_the_post_thumbnail( get_the_ID(), $size );
		if ( empty( $thumb ) )
			return;

		if ( is_single() ) {
			$html .= $thumb;
		} else {
			$html .= '<a href="' . esc_url( get_permalink() ) . '">';
			$html .= $thumb;
			$html .= '</a>';			
		}
}

if ( $html )
	printf( '<div class="post-media clearfix">%1$s</div>', $html );
