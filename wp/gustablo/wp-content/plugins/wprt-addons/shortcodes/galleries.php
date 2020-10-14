<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
	'showcase' => 'style-1',
	'image_crop' => 'square2',
	'items'			=> '8',
	'gap'			=> '0',
	'cat_slug'	=> '',
	'auto_scroll' => 'false',
	'column'		=> '3c',
	'column2'		=> '2c',
	'column3'		=> '1c',
	'show_bullets' => '',
	'show_arrows' => '',
	'bullet_show' => 'bullet-square',
	'bullet_between' => '50',
    'arrow_offset' => 'center',
    'arrow_offset_v' => '0',
), $atts ) );

$items = intval( $items );
$gap = intval( $gap );
$column = intval( $column );
$column2 = intval( $column2 );
$column3 = intval( $column3 );

if ( empty( $items ) ) $item = -1;

$cls = 'arrow-center '. $bullet_show .' ';
$cls .= 'offset'. $arrow_offset .' offset-v'. $arrow_offset_v;
if ( $show_bullets ) $cls .= ' has-bullets'; 
if ( $show_arrows ) $cls .= ' has-arrows';

if ( $bullet_between == '45' ) $cls .= ' bullet45';
if ( $bullet_between == '40' ) $cls .= ' bullet40';
if ( $bullet_between == '35' ) $cls .= ' bullet35';
if ( $bullet_between == '30' ) $cls .= ' bullet30';
if ( $bullet_between == '25' ) $cls .= ' bullet25';
if ( $bullet_between == '20' ) $cls .= ' bullet20';
if ( $bullet_between == '15' ) $cls .= ' bullet15';
if ( $bullet_between == '10' ) $cls .= ' bullet10';

$query_args = array(
    'post_type' => 'gallery',
    'posts_per_page' => $items
);

if ( ! empty( $cat_slug ) ) {
	$query_args['tax_query'] = array(
		array(
			'taxonomy' => 'gallery_category',
			'field'    => 'slug',
			'terms'    => $cat_slug
		),
	);
}

$query = new WP_Query( $query_args );
if ( ! $query->have_posts() ) { echo "Gallery item not found!"; return; }
ob_start(); ?>

<div class="wprt-gallery <?php echo esc_attr( $cls ); ?>" data-auto="<?php echo esc_attr( $auto_scroll ); ?>" data-column="<?php echo esc_attr( $column ); ?>" data-column2="<?php echo esc_attr( $column2 ); ?>" data-column3="<?php echo esc_attr( $column3 ); ?>" data-gap="<?php echo esc_html( $gap ); ?>">

<?php if ( $query->have_posts() ) : ?>
	<?php wp_enqueue_script( 'wprt-owlcarousel' ); wp_enqueue_script( 'wprt-magnificpopup' ); ?>

	<div class="owl-carousel owl-theme">
	    <?php while ( $query->have_posts() ) : $query->the_post(); global $post; ?>
			<div class="gallery-box <?php echo esc_attr( $showcase ); ?>">
				<div class="inner">
					<?php
						if ( has_post_thumbnail() ) {
					    	$img_size = 'wprt-rectangle3';
							if ( $image_crop == 'full' ) $img_size = 'full';
							if ( $image_crop == 'square' ) $img_size = 'wprt-square';
							if ( $image_crop == 'square2' ) $img_size = 'wprt-square2';
							if ( $image_crop == 'rectangle' ) $img_size = 'wprt-rectangle';
							if ( $image_crop == 'rectangle2' ) $img_size = 'wprt-rectangle2';
							if ( $image_crop == 'auto2' ) $img_size = 'wprt-small-auto';
                    	}

                    	$icon_html = sprintf('<div class="icon">
                    		<a class="link" href="%1$s" title="%2$s"><i class="gustablo-link"></i></a>
                    		<a class="zoom-popup" href="%3$s" data-title="%2$s"><i class="gustablo-magnifier3"></i></a>
                    		</div>',
                    		esc_url( get_the_permalink() ),
                    		esc_attr( get_the_title() ),
                    		wprt_get_image( array( 'size' => 'full', 'format' => 'src' ) )
                    	);

                    	$heading_html = sprintf('<h2><a href="%1$s" title="%2$s">%3$s</a></h2>', esc_url( get_the_permalink() ), esc_attr( get_the_title() ), get_the_title() );

		                echo '<div class="gallery-wrap"><div class="gallery-image">'. get_the_post_thumbnail( get_the_ID(), $img_size ) . $icon_html .'</div><div class="gallery-text">'. $heading_html .'</div></div>';
					?>
                </div>
			</div><!-- /.gallery-box -->
		<?php endwhile; ?>
	</div><!-- /.owl-carousel -->

<?php endif; ?>
<?php wp_reset_postdata(); ?>

</div><!-- /.wprt-gallery -->
<?php
$return = ob_get_clean();
echo $return;