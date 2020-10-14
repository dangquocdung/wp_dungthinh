<?php
/*
 * Template Name: Canvas Go Left
 * Description: A Page Template with a Page Builder design.
 */

get_header('canvas'); ?>

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
			direction: [[0,9],[0,8],[0,7],[0,6],[0,5],[0,4],[0,3],[0,2],[0,1],[0,0]],
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