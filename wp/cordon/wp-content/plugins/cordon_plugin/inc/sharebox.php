<?php
function sharebox() {
  ?>
							<div class="hidden share-remove">
                                <div class="share-box">
                                   <span class="share-text"><?php _e("Share this:", "andior_plg"); ?> </span>
                                   <a class="tw-share" href="http://twitter.com/home/?status=<?php the_title(); ?> - <?php the_permalink(); ?>" 
                                   title="<?php esc_html_e("Tweet this", "andior_plg"); ?>">
                                      <i class="fa fa-twitter"></i>
                                   </a>
                                   <a class="fb-share" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>" 
                                   title="<?php esc_html_e("Share on Facebook", "andior_plg"); ?>">
                                      <i class="fa fa-facebook"></i>
                                   </a>
                                   <a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php 
                                   global $post;
                                   $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); echo $url; ?>" 
                                   title="<?php esc_html_e("Pin This", "andior_plg"); ?>">
                                      <i class="fa fa-pinterest"></i>
                                   </a>
                                   <a class="go-share" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" 
                                   title="<?php esc_html_e("Share on Google+", "andior_plg"); ?>">
                                      <i class="fa fa-google-plus"></i>
                                  </a>
                               </div>
                           </div>

<script type="text/javascript">
	(function ($) {
	'use strict';
		$( ".sharebox" ).append( $( ".share-box" ) );
		
		$( ".share-remove" ).remove();
		
		$(window).on("load", function() {
			$('.sharebox a').on('click', function() {
				window.open(this.href,"","menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600");return false;
				});
		});
	})(jQuery);
</script>
    <?php 

}




function share_box_single() {
	if (is_singular( 'post' )) {
		add_action( 'wp_footer', 'sharebox',1 );
	}
} 
add_action( 'wp_enqueue_scripts', 'share_box_single' );		