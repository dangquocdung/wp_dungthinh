<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
	'items'			=> '8',
	'cat_slug'	=> '',
	'gap'			=> 'gap20',
), $atts ) );

$items = intval( $items );

if ( empty( $items ) ) $item = -1;

if ( get_query_var('paged') ) {
   $paged = get_query_var('paged');
} elseif ( get_query_var('page') ) {
   $paged = get_query_var('page');
} else {
   $paged = 1;
}

$query_args = array(
    'post_type' => 'food',
    'posts_per_page' => $items,
    'paged'     => $paged
);

if ( ! empty( $cat_slug ) ) {
	$query_args['tax_query'] = array(
		array(
			'taxonomy' => 'food_category',
			'field'    => 'slug',
			'terms'    => $cat_slug
		),
	);
}

$query = new WP_Query( $query_args );
if ( ! $query->have_posts() ) { echo "Food item not found!"; return; }
ob_start(); ?>

<div class="wprt-food-menu <?php echo esc_attr( $gap ); ?>">

	<?php if ( $query->have_posts() ) : ?>

		<div class="foods">
		    <?php while ( $query->have_posts() ) : $query->the_post(); ?>
		    	<div class="food-inner">
				<div class="food-box clearfix">
					<?php
					if ( has_post_thumbnail() )
				    	$img_size = 'wprt-square3';

		        	if ( $price = wprt_metabox( 'price' ) )
	        			$price = '<span class="food-price">'. esc_html( wprt_metabox( 'price' ) ) .'</span>';

	        		if ( $title = get_the_title() )
                		$title = '<h5><span class="food-title">'. get_the_title() .'</span><span class="food-dots"></span>'. $price .'</h5>';

	        		if ( $desc = wprt_metabox( 'desc' ) )
	        			$desc = '<div class="food-desc">'. esc_html( wprt_metabox( 'desc' ) ) .'</div>';

                	echo '<div class="food-wrap clearfix"><div class="food-image">'. get_the_post_thumbnail( get_the_ID(), $img_size ) .'</div><div class="food-detail">'. $title . $desc .'</div></div>';
					?>
				</div><!-- /.food-box -->
				</div><!-- /.food-inner -->
			<?php endwhile; ?>
		</div><!-- /#foods -->
	<?php endif; ?>

	<?php wp_reset_postdata(); ?>

</div><!-- /.wprt-food-menu -->
<div class="clearfix"></div>
<?php
$return = ob_get_clean();
echo $return;