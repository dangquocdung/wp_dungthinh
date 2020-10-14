<?php 

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$bcol = 12/$columns;
if ($columns == 5) {
	$bcol = 'cus-5';
}
$users = studylms_educator_get_lecturers($number);
if ( !empty($users) ) {
	?>
	<div class="widget widget-lecturer <?php echo esc_attr($el_class); ?>">
		<div class="row">
			<?php
			foreach ($users as $user) {
				set_query_var( 'lecturer', $user );
				?>
				<div class="col-sm-<?php echo esc_attr($bcol); ?> col-xs-12">
					<?php get_template_part( 'educator/lecturer/lecturer-item-style1' ); ?>
				</div>
				<?php
			}
			?>
		</div>
	</div>
	<?php
}