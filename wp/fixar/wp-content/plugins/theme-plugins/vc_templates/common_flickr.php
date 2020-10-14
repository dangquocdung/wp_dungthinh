<?php
$out = '';

extract(shortcode_atts(array(
	'title'=>'',
	'id'=>'',
	'number'=>'',
	'css_animation' => '',
), $atts));

$out = $css_animation != '' && $css_animation != 'none' ? '<div class="animated" data-animation="' . esc_attr($css_animation) . '">' : '<div>';
$out .= '
	<div class="fot-box">
		<h2 class="widgettitle">'.wp_kses_post($title).'</h2>
			<!-- Flickr-->
			<script type="text/javascript">

jQuery(document).ready(function($) {

    var flickr_id = "'.esc_js($id).'";

    var flcr_feed

    flcr_feed = jQuery("#flickr-feed");
    if (flcr_feed.length) {
        jQuery("#flickr-feed").jflickrfeed({
            limit: '.esc_js($number).',
            qstrings: {
                id: flickr_id
            },
            itemTemplate: \'<li><a href="{{image_b}}" rel="prettyPhoto[flickr]"><img src="{{image_s}}" alt="{{title}}" /><span><i class="icomoon-search"></i></span></a></li>\',
            itemCallback: function() {
                jQuery("a[rel=\'prettyPhoto[flickr]\']").prettyPhoto({
                    changepicturecallback: function() {
                        jQuery(\'.pp_pic_holder\').show();
                    }
                });
            }
        });
    }
 });

</script>
		<div class="fot-contact">
			<div class="media-body">
				<ul id="flickr-feed" class="flickr-feed">
				</ul>
			</div>
		</div>
	</div>
</div>
'; 

echo $out;