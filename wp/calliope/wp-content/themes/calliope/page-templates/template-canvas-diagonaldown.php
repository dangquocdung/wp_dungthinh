<?php
/*
 * Template Name: Canvas Diagonal Down
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

		var ascensor = $('#ascensorBuilding').ascensor({
			keyNavigation: true, 
			loop: true, 
			direction: [[0,0],[1,1],[2,2],[3,3],[4,4],[5,5],[6,6],[7,7]], 
			ascensorFloorName:["1", "2", "3", "4", "5", "6", "7", "8"]
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