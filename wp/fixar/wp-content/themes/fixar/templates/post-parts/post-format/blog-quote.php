<?php
	global $post;
	// get meta options/values
	$fixar_content = ( class_exists( 'RW_Meta_Box' ) ) ? rwmb_meta('post_quote_content') : '';
	$fixar_source = ( class_exists( 'RW_Meta_Box' ) ) ? rwmb_meta('post_quote_source') : '';
	$fixar_format  = get_post_format();
	$fixar_format = !in_array($fixar_format, array("quote", "gallery", "video")) ? "standared" : $fixar_format;
	$icon = array("standared" => "icon-picture", "quote" => "fa fa-pencil", "gallery" => "icon-camera", "video" => "fa fa-video-camera");
	$post_date = strtotime($post->post_date);

	$categories = wp_get_post_categories($post->ID,array('fields' => 'all'));
	$comments = wp_count_comments($post->ID);
?>


		
			<blockquote>
				<?php echo wp_kses_post($fixar_content); ?>
				<div class="blog-quote-source"><?php echo wp_kses_post($fixar_source)?></div>
			</blockquote>
		
