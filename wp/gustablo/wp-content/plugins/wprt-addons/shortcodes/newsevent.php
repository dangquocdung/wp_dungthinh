<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
	'image_crop' => 'rectangle',
	'content_background' => '#f7f7f7',
	'items'		=> '3',
	'cat_slug' => '',
	'heading_font_family' => 'Default',
	'heading_font_weight' => 'Default',
	'heading_color' => '',
	'heading_font_size' => '',
	'heading_line_height' => '',
	'desc_font_family' => 'Default',
	'desc_font_weight' => 'Default',
	'desc_color' => '',
	'desc_font_size' => '',
	'desc_line_height' => '',
	'button_font_family' => 'Default',
	'button_font_weight' => 'Default',
	'button_font_size' => '',
	'button_line_height' => '',
	'button_style' => 'accent',
	'button_text' => 'READ MORE',
	'heading_top_margin' => '',
	'heading_bottom_margin' => '',
	'desc_top_margin' => '',
	'desc_bottom_margin' => '',
), $atts ) );
$content = wpb_js_remove_wpautop($content, true);

$items = intval( $items );

$heading_line_height = intval( $heading_line_height );
$desc_line_height = intval( $desc_line_height );
$button_line_height = intval( $button_line_height );

$heading_font_size = intval( $heading_font_size );
$desc_font_size = intval( $desc_font_size );
$button_font_size = intval( $button_font_size );

$heading_top_margin = intval( $heading_top_margin );
$heading_bottom_margin = intval( $heading_bottom_margin );
$desc_top_margin = intval( $desc_top_margin );
$desc_bottom_margin = intval( $desc_bottom_margin );

$item_css = $content_css = $heading_css = $desc_css = $button_css = $arrow1_css = $arrow2_css = '';

if ( empty( $items ) ) return;

if ( $content_background ) {
	$item_css .= 'background-color:'. $content_background .';';
	$arrow1_css .= 'border-bottom-color:'. $content_background .';';
	$arrow2_css .= 'border-top-color:'. $content_background .';';
}

if ( $heading_font_weight != 'Default' ) $heading_css .= 'font-weight:'. $heading_font_weight .';';
if ( $heading_color ) $heading_css .= 'color:'. $heading_color .';';
if ( $heading_font_size ) $heading_css .= 'font-size:'. $heading_font_size .'px;';
if ( $heading_line_height ) $heading_css .= 'line-height:'. $heading_line_height .'px;';
if ( $heading_top_margin ) $heading_css .= 'margin-top:'. $heading_top_margin .'px;';
if ( $heading_bottom_margin ) $heading_css .= 'margin-bottom:'. $heading_bottom_margin .'px;';
if ( $heading_font_family != 'Default' ) {
	wprt_enqueue_google_font( $heading_font_family );
	$heading_css .= 'font-family:'. $heading_font_family .';';
}

if ( $desc_font_weight != 'Default' ) $desc_css .= 'font-weight:'. $desc_font_weight .';';
if ( $desc_color ) $desc_css .= 'color:'. $desc_color .';';
if ( $desc_font_size ) $desc_css .= 'font-size:'. $desc_font_size .'px;';
if ( $desc_line_height ) $desc_css .= 'line-height:'. $desc_line_height .'px;';
if ( $desc_top_margin ) $desc_css .= 'margin-top:'. $desc_top_margin .'px;';
if ( $desc_bottom_margin ) $desc_css .= 'margin-bottom:'. $desc_bottom_margin .'px;';
if ( $desc_font_family != 'Default' ) {
	wprt_enqueue_google_font( $desc_font_family );
	$desc_css .= 'font-family:'. $desc_font_family .';';
}

if ( $button_font_weight != 'Default' ) $button_css .= 'font-weight:'. $button_font_weight .';';
if ( $button_font_size ) $button_css .= 'font-size:'. $button_font_size .'px;';
if ( $button_line_height ) $button_css .= 'line-height:'. $button_line_height .'px;';
if ( $button_font_family != 'Default' ) {
	wprt_enqueue_google_font( $button_font_family );
	$button_css .= 'font-family:'. $button_font_family .';';
}

$button_cls = 'small';
if ( $button_style == 'accent' ) $button_cls .= ' wprt-button accent';
if ( $button_style == 'dark' ) $button_cls .= ' wprt-button dark';
if ( $button_style == 'light' ) $button_cls .= ' wprt-button light';
if ( $button_style == 'very-light' ) $button_cls .= ' wprt-button very-light';
if ( $button_style == 'white' ) $button_cls .= ' wprt-button white';
if ( $button_style == 'outline' ) $button_cls .= ' wprt-button outline ol-accent solid';
if ( $button_style == 'outline_dark' ) $button_cls .= ' wprt-button outline dark solid';
if ( $button_style == 'outline_light' ) $button_cls .= ' wprt-button outline light solid';
if ( $button_style == 'outline_very-light' ) $button_cls .= ' wprt-button outline very-light solid';
if ( $button_style == 'outline_white' ) $button_cls .= '  wprt-button outline white solid';

$query_args = array(
    'post_type' => 'post',
    'posts_per_page' => $items
);

if ( ! empty( $cat_slug ) )
	$query_args['category_name'] = $cat_slug;

$query = new WP_Query( $query_args );
if ( ! $query->have_posts() ) { return; }
ob_start(); ?>

<div class="wprt-news-event">
<?php if ( $query->have_posts() ) : ?>
	<?php wp_enqueue_script( 'wprt-cubeportfolio' ); ?>
	<div id="events" class="cbp">
	    <?php while ( $query->have_posts() ) : $query->the_post(); ?>
	    	<?php

		    	$img_size = 'wprt-rectangle';
				if ( $image_crop == 'square' ) $img_size = 'wprt-square';
				if ( $image_crop == 'rectangle2' ) $img_size = 'wprt-rectangle2';
				if ( $image_crop == 'postgrid' ) $img_size = 'wprt-post-grid';
			?>
		    <?php if ( $query->current_post == 0 || $query->current_post == 2 || $query->current_post == 3 || $query->current_post == 5 || $query->current_post == 6 || $query->current_post == 8 || $query->current_post == 9 || $query->current_post == 11 ) :
		   	?>
				<div class="cbp-item">
			    	<div class="event-item">
			    		<div class="inner" style="<?php echo esc_attr( $item_css ); ?>">
			    			<div class="thumb-wrap">
				    			<?php
				    			if ( has_post_thumbnail() )
									echo get_the_post_thumbnail( get_the_ID(), $img_size );
				    			?>
			    			</div>

			                <div class="text-wrap">
			                	<div class="arrow-above" style="<?php echo esc_attr( $arrow1_css ); ?>"></div>
								<?php
									echo '<h3 class="title" style="'. esc_attr( $heading_css ) .'"><a href="'. esc_url( get_the_permalink() ) .'">'. get_the_title() .'</a></h3>';

									echo '<div class="meta"><span class="post-date">'. get_the_date() .'</span></div>';

									echo '<p class="excerpt" style="'. esc_attr( $desc_css ) .'">'. wp_trim_words( get_the_content(), '16', '&hellip;' ) .'</p>';

									echo '<div class="post-btn"><a href="'. esc_url( get_permalink() ) .'" class="'. esc_attr( $button_cls ) .'" style="'. esc_attr( $button_css ) .'">'. esc_html( $button_text ) .'</a></div>';
								?>
			                </div><!-- /.text-wrap -->
			            </div>
			    	</div><!-- /.event-item -->
			    </div><!-- /.cbp-item -->
			<?php endif ?>
		    <?php if ( $query->current_post == 1 || $query->current_post == 4 || $query->current_post == 7 || $query->current_post == 10 ): ?>
		    	<div class="cbp-item">
			    	<div class="event-item">
			    		<div class="inner" style="<?php echo esc_attr( $item_css ); ?>">
			                <div class="text-wrap">
			                	<div class="arrow-below" style="<?php echo esc_attr( $arrow2_css ); ?>"></div>
								<?php
									echo '<h3 class="title" style="'. esc_attr( $heading_css ) .'"><a href="'. esc_url( get_the_permalink() ) .'">'. get_the_title() .'</a></h3>';

									echo '<div class="meta"><span class="post-date">'. get_the_date() .'</span></div>';

									echo '<p class="excerpt" style="'. esc_attr( $desc_css ) .'">'. wp_trim_words( get_the_content(), '16', '&hellip;' ) .'</p>';

									echo '<div class="post-btn"><a href="'. esc_url( get_permalink() ) .'" class="'. esc_attr( $button_cls ) .'" style="'. esc_attr( $button_css ) .'">'. esc_html( $button_text ) .'</a></div>';
								?>
			                </div><!-- /.text-wrap -->

			    			<div class="thumb-wrap">
				    			<?php
				    			if ( has_post_thumbnail() )
									echo get_the_post_thumbnail( get_the_ID(), $img_size );
				    			?>
			    			</div>
		    			</div>
			    	</div><!-- /.event-item -->
			    </div><!-- /.cbp-item -->
		    <?php endif ?>

		<?php endwhile; ?>
	</div><!-- /#events -->
<?php endif; ?>
<?php wp_reset_postdata(); ?>
</div><!-- /.wprt-news-event -->
<?php
$return = ob_get_clean();
echo $return;