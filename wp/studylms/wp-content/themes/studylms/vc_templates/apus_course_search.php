<?php 

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$args = array(
    'type' => 'post',
    'child_of' => 0,
    'orderby' => 'name',
    'order' => 'ASC',
    'hide_empty' => true,
    'hierarchical' => 1,
    'taxonomy' => 'edr_course_category'
);
$categories = array( '' => esc_html__('All Categories', 'studylms') );
$terms = get_categories( $args );
if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
	foreach ( $terms as $term ) {
 		$categories[$term->term_id] =  $term->name;  
	}
}
$instructors = studylms_educator_get_lecturers();
?>
<div class="widget-search-form <?php echo esc_attr($el_class); ?> <?php echo esc_attr($layout_type); ?>">
	<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
		<?php if ($layout_type == 'layout1') { ?>
			<div class="layout1 clearfix">
				<div class="left-search">
					<div class="row">
						<div class="col-sm-4">
							<!-- categories -->
							<div class="inner-select">
								<select name="_category">
					               	<?php foreach ($categories as $key => $value) { ?>
				                        <option value="<?php echo trim($key); ?>"><?php echo trim($value); ?></option>
				                    <?php } ?>
				                </select>
			                </div>
						</div>
						<div class="col-sm-4">
							<!-- lecturer -->
							<div class="inner-select">
								<select name="_lecturer">
									<option value=""><?php esc_html_e( 'All Instructors', 'studylms' ); ?></option>
					               	<?php foreach ($instructors as $key => $value) { ?>
				                        <option value="<?php echo trim($value->ID); ?>"><?php echo get_the_author_meta('display_name', $value->ID ); ?></option>
				                    <?php } ?>
				                </select>
							</div>
						</div>
						<div class="col-sm-4">
							<!-- keyword -->
							<input class="input_search" name="s" value="" placeholder="<?php esc_html_e('Enter Keyword', 'studylms'); ?>"/>
						</div>
					</div>
				</div>
				<div class="text-center submit">
					<button type="submit" class="btn btn-theme"><?php esc_html_e( 'Search', 'studylms'); ?></button>
				</div>
			</div>
		<?php } else { ?>
			<div class="input-group">
				<!-- keyword -->
				<input class="input_search form-control" name="s" value="" placeholder="<?php esc_html_e('What do you want to learn today?', 'studylms'); ?>"/>
				<span class="input-group-btn">
					<button type="submit" class="btn btn-theme"><i class="fa fa-search" aria-hidden="true"></i></button>
				</span>
			</div>

		<?php } ?>
		<input type="hidden" name="post_type" value="<?php echo defined('EDR_PT_COURSE') ? EDR_PT_COURSE : ''; ?>" class="post_type" />
	</form>
</div>