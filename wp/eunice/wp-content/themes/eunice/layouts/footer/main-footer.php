<?php
	// Main Text
	$eunice_need_copyright = cs_get_option('need_copyright');
	$need_social = cs_get_option('need_social');
?>

<footer class="footer">
<!-- Social links start /-->

	<?php
	if( $need_social == true) { ?>
		<div class="social-links">
			<ul class="list-inline">
			<?php $footer_menus = (array) cs_get_option('footer_socials');
			foreach ($footer_menus as $key => $menu) { ?>
				<li><a title="<?php echo esc_attr($menu['title']); ?>" href="<?php echo esc_url($menu['social_link']); ?>"><i class="<?php echo esc_attr($menu['social_icon']); ?>"></i></a></li>
			<?php	} ?>
			</ul>
		</div>
	<?php } ?>
	<!--/ Social links end-->

	<?php if (isset($eunice_need_copyright)) {	?>
	<!-- copyright Text start /-->
	<div class="copyright-text">
		<?php
		$eunice_copyright_text = cs_get_option('copyright_text');
		if ( !empty($eunice_copyright_text )) {
			echo esc_attr($eunice_copyright_text);
		} else {
			echo date('Y') . esc_html__(' &copy; Made By VictorThemes All Rights Reserved.', 'eunice');
		}
		?>
	</div><!--/ copyright Text end-->
	<?php } ?>

</footer>
<!-- Copyright Bar -->
