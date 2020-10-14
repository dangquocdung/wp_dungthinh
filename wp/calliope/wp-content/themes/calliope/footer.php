<?php
/**
 * The template for displaying the footer
 */
 global $theme_option; 
?>

	<?php if($theme_option['footer_text']) { ?>
	<div class="footer">
		<div class="container">
			<div class="twelve columns">
				<div class="footer-bottom"> 
					<p><?php echo htmlspecialchars_decode($theme_option['footer_text']); ?></p>
					<a href="<?php echo esc_url(home_url()); ?>"><img src="<?php echo esc_url($theme_option['logo_footer']['url']); ?>" alt=""/></a>
				</div>
			</div>	
		</div>	
	</div>
	<?php } ?>
<?php wp_footer(); ?>
</body>
</html>