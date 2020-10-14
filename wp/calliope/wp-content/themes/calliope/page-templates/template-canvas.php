<?php
/*
 * Template Name: Canvas
 * Description: A Page Template with a Page Builder design.
 */

get_header('canvas'); ?>

<?php
	$pmenu = array(
		'theme_location'  => 'primary',
		'menu'            => '',
		'container'       => '',
		'container_class' => '',
		'container_id'    => '',
		'menu_class'      => 'dot-nav-wrap links-to-floor1',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
		'walker'          => new wp_bootstrap_navwalker(),
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul data-breakpoint="800" id="%1$s" class="%2$s">%3$s</ul>',
		'depth'           => 0,
	);
	if ( has_nav_menu( 'primary' ) ) {
		wp_nav_menu( $pmenu );
	}
?>

<?php if (have_posts()){ ?>
		
		<?php while (have_posts()) : the_post()?>
			<div class="canvas" id="ascensorBuilding">
				<?php the_content(); ?>
			</div>
		<?php endwhile; ?>
	
	<?php }else {
		echo 'Page Canvas For Page Builder'; 
	}?>

<?php wp_footer(); ?>
<script type="text/javascript">
	$(function(){"use strict";

		var $id1  = $('#ascensorBuilding > div:eq( 0 ) > .wpb_rows').attr('id');
		var $id2  = $('#ascensorBuilding > div:eq( 1 ) > .wpb_rows').attr('id');
		var $id3  = $('#ascensorBuilding > div:eq( 2 ) > .wpb_rows').attr('id');
		var $id4  = $('#ascensorBuilding > div:eq( 3 ) > .wpb_rows').attr('id');
		var $id5  = $('#ascensorBuilding > div:eq( 4 ) > .wpb_rows').attr('id');
		var $id6  = $('#ascensorBuilding > div:eq( 5 ) > .wpb_rows').attr('id');
		var $id7  = $('#ascensorBuilding > div:eq( 6 ) > .wpb_rows').attr('id');
		var $id8  = $('#ascensorBuilding > div:eq( 7 ) > .wpb_rows').attr('id');
		var $id9  = $('#ascensorBuilding > div:eq( 8 ) > .wpb_rows').attr('id');
		var $id10 = $('#ascensorBuilding > div:eq( 9 ) > .wpb_rows').attr('id');

		var ascensor = $('#ascensorBuilding').ascensor({
			keyNavigation: true, 
			loop: true, 
			direction: [[0,0],[0,1],[1,0],[1,1],[2,0],[2,1],[3,0],[3,1],[4,0],[4,1]], 
			ascensorFloorName:[$id1, $id2, $id3, $id4, $id5, $id6, $id7, $id8, $id8, $id10]
		});
		var floorAdded = false;
		
		$(".links-to-floor li").click(function(event, index) {
			ascensor.trigger("scrollToStage", $(this).index());
		});
		
		$(".links-to-floor li:eq("+ ascensor.data("current-floor") +")").addClass("selected");

		ascensor.on("scrollStart", function(event, floor){
			$(".links-to-floor li").removeClass("selected");
			$(".links-to-floor li:eq("+floor.to+")").addClass("selected");
		});			
		$(".links-to-floor1 li").click(function(event, index) {
			ascensor.trigger("scrollToStage", $(this).index());
		});
		
		$(".links-to-floor1 li:eq("+ ascensor.data("current-floor") +")").addClass("selected");

		ascensor.on("scrollStart", function(event, floor){
			$(".links-to-floor1 li").removeClass("selected");
			$(".links-to-floor1 li:eq("+floor.to+")").addClass("selected");
		});
		
	});
</script>