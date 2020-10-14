<?php 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$img = wp_get_attachment_image_src($image,'full');
?>
<div class="banner-widget <?php echo esc_attr($el_class); ?>">
	<div class="banner-item">
		<?php if( isset($title) && $title && isset($url) && $url ) : ?>
			<h3 class="title" > <a href="<?php echo esc_attr($url); ?>"><?php echo trim($title); ?></a></h3>
		<?php endif; ?>	
		<?php if ( !empty($img) && isset($img[0]) ): ?>
	    	<img src="<?php echo esc_url_raw($img[0]); ?>" alt="">
	    <?php endif; ?>
	</div>
</div>