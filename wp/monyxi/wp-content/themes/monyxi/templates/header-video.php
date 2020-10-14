<?php
/**
 * The template to display the background video in the header
 *
 * @package WordPress
 * @subpackage MONYXI
 * @since MONYXI 1.0.14
 */
$monyxi_header_video = monyxi_get_header_video();
$monyxi_embed_video = '';
if (!empty($monyxi_header_video) && !monyxi_is_from_uploads($monyxi_header_video)) {
	if (monyxi_is_youtube_url($monyxi_header_video) && preg_match('/[=\/]([^=\/]*)$/', $monyxi_header_video, $matches) && !empty($matches[1])) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr($matches[1]); ?>"></div><?php
	} else {
		global $wp_embed;
		if (false && is_object($wp_embed)) {
			$monyxi_embed_video = do_shortcode($wp_embed->run_shortcode( '[embed]' . trim($monyxi_header_video) . '[/embed]' ));
			$monyxi_embed_video = monyxi_make_video_autoplay($monyxi_embed_video);
		} else {
			$monyxi_header_video = str_replace('/watch?v=', '/embed/', $monyxi_header_video);
			$monyxi_header_video = monyxi_add_to_url($monyxi_header_video, array(
				'feature' => 'oembed',
				'controls' => 0,
				'autoplay' => 1,
				'showinfo' => 0,
				'modestbranding' => 1,
				'wmode' => 'transparent',
				'enablejsapi' => 1,
				'origin' => home_url(),
				'widgetid' => 1
			));
			$monyxi_embed_video = '<iframe src="' . esc_url($monyxi_header_video) . '" width="1170" height="658" allowfullscreen="0" frameborder="0"></iframe>';
		}
		?><div id="background_video"><?php monyxi_show_layout($monyxi_embed_video); ?></div><?php
	}
}
?>