<!-- Sidebar
================================================== -->
<?php 
global $onetheme_sidebar;
$sidebar_id = 'sidebar';
?>
<div class="col-sm-12 col-md-4 marg-sm-t80">
	<aside class="wpc-sidebar">
	    <?php
	    if( isset($sidebar) && !empty($sidebar) )
	        $sidebar_id = $sidebar_id ."-". $sidebar;

	    if ( is_active_sidebar( $sidebar_id ) ) :
	        dynamic_sidebar($sidebar_id);
	    else: 
	        echo "<div class='widget'><h5>".esc_html__('Please add your widgets.', 'onetheme')."</h5></div>";
	    endif;
	    ?>
	</aside>
</div>
