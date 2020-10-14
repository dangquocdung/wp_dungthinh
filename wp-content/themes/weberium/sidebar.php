<?php
// Get layout position
$layout = weberium_layout_position();
if ( $layout == 'no-sidebar' )
	return;
?>

<div id="sidebar">
	<div id="inner-sidebar" class="inner-content-wrap">
		<?php
		$sidebar = 'sidebar-blog';

		if ( is_page() && weberium_metabox('page_sidebar') )
			$sidebar = weberium_metabox('page_sidebar');

		if ( weberium_is_woocommerce_page() )
			$sidebar = 'sidebar-shop';

		if ( is_active_sidebar( $sidebar ) )
			dynamic_sidebar( $sidebar );		
		?>
	</div><!-- /#inner-sidebar -->
</div><!-- /#sidebar -->
