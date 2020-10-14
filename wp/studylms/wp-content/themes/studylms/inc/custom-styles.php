<?php

if ( !function_exists ('studylms_custom_styles') ) {
	function studylms_custom_styles() {
		global $post;	
		
		ob_start();	
		?>
		
		<!-- ******************************************************************** -->
		<!-- * Theme Options Styles ********************************************* -->
		<!-- ******************************************************************** -->
			
		<style>

			/* check main color */ 
			<?php if ( studylms_get_config('main_color') != "" ) : ?>

				/* seting background main */
				.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
				.single-tribe_events .image-event .event-meta,
				.course-lesson-sidebar .forward,
				.widget-title-special .edr-buy-widget__link,
				.sidebar .widget .widget-title::after, .apus-sidebar .widget .widget-title::after,
				.edr-membership-wrapper::before,
				.vc_tta-container > h2::before,
				.widget.widget-text-heading::after,
				.widget-features-box.center-line .feature-box-inner:hover .ourservice-heading::before,
				.widget-features-box.center .fbox-icon .img-hover,
				.widget.under-line .widget-title::before, .widget.under-line .widgettitle::before, .widget.under-line .widget-heading::before,
				.widget-newletter.style2 .icon,
				.widget-event .widget-description::before,
				.widget-course-categories.style1 .category-wrapper a::before,
				.login-topbar,
				.post-grid::before,
				.counters .title::before,
				.bg-theme
				{
					background: <?php echo esc_html( studylms_get_config('main_color') ) ?>;
				}
				/* setting color*/
				.navbar-nav.megamenu .dropdown-menu > li > a.active, .navbar-nav.megamenu .dropdown-menu > li > a:hover, .navbar-nav.megamenu .dropdown-menu > li > a:active,
				.product-block.grid:hover .name a,
				.single-tribe_events .times > div span,
				#course-program .edr-lessons .lesson-icon i,
				.apus-breadscrumb .breadcrumb > .active,
				.widget-features-box.center-line .feature-box-inner:hover .ourservice-heading,
				.apus-teacher-inner.style1 .job,
				.widget-testimonials.style2 .testimonials-body .name-client,
				.rating-print-wrapper .review-stars,
				.rating-print-wrapper .review-stars + .review-stars,
				a:hover,a:active
				{
					color: <?php echo esc_html( studylms_get_config('main_color') ) ?>;
				}
				.text-theme
				{
					color: <?php echo esc_html( studylms_get_config('main_color') ) ?> !important;
				}
				/* setting border color*/
				.widget-brands .item-wrapper a:hover,
				.border-theme{
					border-color: <?php echo esc_html( studylms_get_config('main_color') ) ?>;
				}
				.navbar-nav.megamenu .dropdown-menu,
				.post-grid-v2::after{
					border-top-color: <?php echo esc_html( studylms_get_config('main_color') ) ?>;
				}
				.post-grid-v2:hover::after{
					box-shadow:0 -2px 0 0 <?php echo esc_html( studylms_get_config('main_color') ) ?> inset;
				}
			<?php endif; ?>

			/* check second color */ 
			<?php if ( studylms_get_config('second_color') != "" ) : ?>

				/* seting background main */
				.edr-course .edr-course__price,
				#back-to-top,
				.bg-theme-second,.btn-theme-second
				{
					background: <?php echo esc_html( studylms_get_config('second_color') ) ?>;
				}
				/* setting color*/
				.edr-course-list-simple .edr-course__price,
				.text-second,.second-color
				{
					color: <?php echo esc_html( studylms_get_config('second_color') ) ?> !important;
				}
				/* setting border color*/
				.btn-theme-second
				{
					border-color: <?php echo esc_html( studylms_get_config('second_color') ) ?>;
				}

			<?php endif; ?>
			
			/* button background */ 
			<?php if ( studylms_get_config('button_color') != "" ) : ?>

				/* seting background main */
				.archive-shop div.product .information .cart .btn, .archive-shop div.product .information .cart .button,
				.edr-form .edr-button,
				.login-topbar,
				.btn-theme,
				.bg-theme
				{
					background: <?php echo esc_html( studylms_get_config('button_color') ) ?>;
				}
				/* setting border color*/
				.archive-shop div.product .information .cart .btn, .archive-shop div.product .information .cart .button,
				.btn-theme
				{
					border-color: <?php echo esc_html( studylms_get_config('button_color') ) ?>;
				}

			<?php endif; ?>
			/* button background hover */ 
			<?php if ( studylms_get_config('button_hover_color') != "" ) : ?>

				/* seting background main */
				.archive-shop div.product .information .cart .btn:active, .archive-shop div.product .information .cart .button:active, .archive-shop div.product .information .cart .btn:hover, .archive-shop div.product .information .cart .button:hover,
				.product-block.grid:hover .btn, .product-block.grid:hover .button,
				.edr-form .edr-button:hover,.edr-form .edr-button:active,
				.bg-theme,.btn-theme:hover,.btn-theme:active
				{
					background: <?php echo esc_html( studylms_get_config('button_hover_color') ) ?> !important;
				}
				/* setting border color*/
				.archive-shop div.product .information .cart .btn:active, .archive-shop div.product .information .cart .button:active, .archive-shop div.product .information .cart .btn:hover, .archive-shop div.product .information .cart .button:hover,
				.product-block.grid:hover .btn, .product-block.grid:hover .button,
				.edr-form .edr-button:hover,.edr-form .edr-button:active,
				.btn-theme:hover,.btn-theme:active
				{
					border-color: <?php echo esc_html( studylms_get_config('button_hover_color') ) ?> !important;
				}

			<?php endif; ?>

			/* Typo */
			<?php
				$main_font = studylms_get_config('main_font');
				if ( !empty($main_font) ) :
			?>
				/* seting background main */
				body, p
				{
					<?php if ( isset($main_font['font-family']) && $main_font['font-family'] ) { ?>
						font-family: <?php echo esc_html( $main_font['font-family'] ) ?>;
					<?php } ?>
					<?php if ( isset($main_font['font-weight']) && $main_font['font-weight'] ) { ?>
						font-weight: <?php echo esc_html( $main_font['font-weight'] ) ?>;
					<?php } ?>
					<?php if ( isset($main_font['font-style']) && $main_font['font-style'] ) { ?>
						font-style: <?php echo esc_html( $main_font['font-style'] ) ?>;
					<?php } ?>
					<?php if ( isset($main_font['font-size']) && $main_font['font-size'] ) { ?>
						font-size: <?php echo esc_html( $main_font['font-size'] ) ?>;
					<?php } ?>
					<?php if ( isset($main_font['line-height']) && $main_font['line-height'] ) { ?>
						line-height: <?php echo esc_html( $main_font['line-height'] ) ?>;
					<?php } ?>
					<?php if ( isset($main_font['color']) && $main_font['color'] ) { ?>
						color: <?php echo esc_html( $main_font['color'] ) ?>;
					<?php } ?>
				}
				
			<?php endif; ?>

			<?php
				$second_font = studylms_get_config('second_font');
				if ( !empty($second_font) ) :
			?>
				/* seting background main */
				.widget .widget-title, .widget .widgettitle, .widget .widget-heading
				{
					<?php if ( isset($second_font['font-family']) && $second_font['font-family'] ) { ?>
						font-family: <?php echo esc_html( $second_font['font-family'] ) ?>;
					<?php } ?>
					<?php if ( isset($second_font['font-weight']) && $second_font['font-weight'] ) { ?>
						font-weight: <?php echo esc_html( $second_font['font-weight'] ) ?>;
					<?php } ?>
					<?php if ( isset($second_font['font-style']) && $second_font['font-style'] ) { ?>
						font-style: <?php echo esc_html( $second_font['font-style'] ) ?>;
					<?php } ?>
					<?php if ( isset($second_font['font-size']) && $second_font['font-size'] ) { ?>
						font-size: <?php echo esc_html( $second_font['font-size'] ) ?>;
					<?php } ?>
					<?php if ( isset($second_font['line-height']) && $second_font['line-height'] ) { ?>
						line-height: <?php echo esc_html( $second_font['line-height'] ) ?>;
					<?php } ?>
					<?php if ( isset($second_font['color']) && $second_font['color'] ) { ?>
						color: <?php echo esc_html( $second_font['color'] ) ?>;
					<?php } ?>
				}
				
			<?php endif; ?>

			/* H1 */
			<?php
				$h1_font = studylms_get_config('h1_font');
				if ( !empty($h1_font) ) :
			?>
				/* seting background main */
				h1
				{
					<?php if ( isset($h1_font['font-family']) && $h1_font['font-family'] ) { ?>
						font-family: <?php echo esc_html( $h1_font['font-family'] ) ?>;
					<?php } ?>
					<?php if ( isset($h1_font['font-weight']) && $h1_font['font-weight'] ) { ?>
						font-weight: <?php echo esc_html( $h1_font['font-weight'] ) ?>;
					<?php } ?>
					<?php if ( isset($h1_font['font-style']) && $h1_font['font-style'] ) { ?>
						font-style: <?php echo esc_html( $h1_font['font-style'] ) ?>;
					<?php } ?>
					<?php if ( isset($h1_font['font-size']) && $h1_font['font-size'] ) { ?>
						font-size: <?php echo esc_html( $h1_font['font-size'] ) ?>;
					<?php } ?>
					<?php if ( isset($h1_font['line-height']) && $h1_font['line-height'] ) { ?>
						line-height: <?php echo esc_html( $h1_font['line-height'] ) ?>;
					<?php } ?>
					<?php if ( isset($h1_font['color']) && $h1_font['color'] ) { ?>
						color: <?php echo esc_html( $h1_font['color'] ) ?>;
					<?php } ?>
				}
			<?php endif; ?>

			/* H2 */
			<?php
				$h2_font = studylms_get_config('h2_font');
				if ( !empty($h2_font) ) :
			?>
				/* seting background main */
				h2
				{
					<?php if ( isset($h2_font['font-family']) && $h2_font['font-family'] ) { ?>
						font-family: <?php echo esc_html( $h2_font['font-family'] ) ?>;
					<?php } ?>
					<?php if ( isset($h2_font['font-weight']) && $h2_font['font-weight'] ) { ?>
						font-weight: <?php echo esc_html( $h2_font['font-weight'] ) ?>;
					<?php } ?>
					<?php if ( isset($h2_font['font-style']) && $h2_font['font-style'] ) { ?>
						font-style: <?php echo esc_html( $h2_font['font-style'] ) ?>;
					<?php } ?>
					<?php if ( isset($h2_font['font-size']) && $h2_font['font-size'] ) { ?>
						font-size: <?php echo esc_html( $h2_font['font-size'] ) ?>;
					<?php } ?>
					<?php if ( isset($h2_font['line-height']) && $h2_font['line-height'] ) { ?>
						line-height: <?php echo esc_html( $h2_font['line-height'] ) ?>;
					<?php } ?>
					<?php if ( isset($h2_font['color']) && $h2_font['color'] ) { ?>
						color: <?php echo esc_html( $h2_font['color'] ) ?>;
					<?php } ?>
				}
			<?php endif; ?>

			/* H3 */
			<?php
				$h3_font = studylms_get_config('h3_font');
				if ( !empty($h3_font) ) :
			?>
				/* seting background main */
				h3, 
                .widgettitle, .widget-title'
				{
					<?php if ( isset($h3_font['font-family']) && $h3_font['font-family'] ) { ?>
						font-family: <?php echo esc_html( $h3_font['font-family'] ) ?>;
					<?php } ?>
					<?php if ( isset($h3_font['font-weight']) && $h3_font['font-weight'] ) { ?>
						font-weight: <?php echo esc_html( $h3_font['font-weight'] ) ?>;
					<?php } ?>
					<?php if ( isset($h3_font['font-style']) && $h3_font['font-style'] ) { ?>
						font-style: <?php echo esc_html( $h3_font['font-style'] ) ?>;
					<?php } ?>
					<?php if ( isset($h3_font['font-size']) && $h3_font['font-size'] ) { ?>
						font-size: <?php echo esc_html( $h3_font['font-size'] ) ?>;
					<?php } ?>
					<?php if ( isset($h3_font['line-height']) && $h3_font['line-height'] ) { ?>
						line-height: <?php echo esc_html( $h3_font['line-height'] ) ?>;
					<?php } ?>
					<?php if ( isset($h3_font['color']) && $h3_font['color'] ) { ?>
						color: <?php echo esc_html( $h3_font['color'] ) ?>;
					<?php } ?>
				}
			<?php endif; ?>

			/* H4 */
			<?php
				$h4_font = studylms_get_config('h4_font');
				if ( !empty($h4_font) ) :
			?>
				/* seting background main */
				h4
				{
					<?php if ( isset($h4_font['font-family']) && $h4_font['font-family'] ) { ?>
						font-family: <?php echo esc_html( $h4_font['font-family'] ) ?>;
					<?php } ?>
					<?php if ( isset($h4_font['font-weight']) && $h4_font['font-weight'] ) { ?>
						font-weight: <?php echo esc_html( $h4_font['font-weight'] ) ?>;
					<?php } ?>
					<?php if ( isset($h4_font['font-style']) && $h4_font['font-style'] ) { ?>
						font-style: <?php echo esc_html( $h4_font['font-style'] ) ?>;
					<?php } ?>
					<?php if ( isset($h4_font['font-size']) && $h4_font['font-size'] ) { ?>
						font-size: <?php echo esc_html( $h4_font['font-size'] ) ?>;
					<?php } ?>
					<?php if ( isset($h4_font['line-height']) && $h4_font['line-height'] ) { ?>
						line-height: <?php echo esc_html( $h4_font['line-height'] ) ?>;
					<?php } ?>
					<?php if ( isset($h4_font['color']) && $h4_font['color'] ) { ?>
						color: <?php echo esc_html( $h4_font['color'] ) ?>;
					<?php } ?>
				}
			<?php endif; ?>

			/* H5 */
			<?php
				$h5_font = studylms_get_config('h5_font');
				if ( !empty($h5_font) ) :
			?>
				/* seting background main */
				h5
				{
					<?php if ( isset($h5_font['font-family']) && $h5_font['font-family'] ) { ?>
						font-family: <?php echo esc_html( $h5_font['font-family'] ) ?>;
					<?php } ?>
					<?php if ( isset($h5_font['font-weight']) && $h5_font['font-weight'] ) { ?>
						font-weight: <?php echo esc_html( $h5_font['font-weight'] ) ?>;
					<?php } ?>
					<?php if ( isset($h5_font['font-style']) && $h5_font['font-style'] ) { ?>
						font-style: <?php echo esc_html( $h5_font['font-style'] ) ?>;
					<?php } ?>
					<?php if ( isset($h5_font['font-size']) && $h5_font['font-size'] ) { ?>
						font-size: <?php echo esc_html( $h5_font['font-size'] ) ?>;
					<?php } ?>
					<?php if ( isset($h5_font['line-height']) && $h5_font['line-height'] ) { ?>
						line-height: <?php echo esc_html( $h5_font['line-height'] ) ?>;
					<?php } ?>
					<?php if ( isset($h5_font['color']) && $h5_font['color'] ) { ?>
						color: <?php echo esc_html( $h5_font['color'] ) ?>;
					<?php } ?>
				}
			<?php endif; ?>

			/* H6 */
			<?php
				$h6_font = studylms_get_config('h6_font');
				if ( !empty($h6_font) ) :
			?>
				/* seting background main */
				h6
				{
					<?php if ( isset($h6_font['font-family']) && $h6_font['font-family'] ) { ?>
						font-family: <?php echo esc_html( $h6_font['font-family'] ) ?>;
					<?php } ?>
					<?php if ( isset($h6_font['font-weight']) && $h6_font['font-weight'] ) { ?>
						font-weight: <?php echo esc_html( $h6_font['font-weight'] ) ?>;
					<?php } ?>
					<?php if ( isset($h6_font['font-style']) && $h6_font['font-style'] ) { ?>
						font-style: <?php echo esc_html( $h6_font['font-style'] ) ?>;
					<?php } ?>
					<?php if ( isset($h6_font['font-size']) && $h6_font['font-size'] ) { ?>
						font-size: <?php echo esc_html( $h6_font['font-size'] ) ?>;
					<?php } ?>
					<?php if ( isset($h6_font['line-height']) && $h6_font['line-height'] ) { ?>
						line-height: <?php echo esc_html( $h6_font['line-height'] ) ?>;
					<?php } ?>
					<?php if ( isset($h6_font['color']) && $h6_font['color'] ) { ?>
						color: <?php echo esc_html( $h6_font['color'] ) ?>;
					<?php } ?>
				}
			<?php endif; ?>

			/* Custom CSS */
			<?php if ( studylms_get_config('custom_css') != "" ) : ?>
				<?php echo trim(studylms_get_config('custom_css')); ?>
			<?php endif; ?>

		</style>

	<?php
		$content = ob_get_clean();
		$content = str_replace(array("\r\n", "\r"), "\n", $content);
		$lines = explode("\n", $content);
		$new_lines = array();
		foreach ($lines as $i => $line) {
			if (!empty($line)) {
				$new_lines[] = trim($line);
			}
		}
		
		echo implode($new_lines);
	}
}

?>
<?php add_action( 'wp_head', 'studylms_custom_styles', 99 ); ?>