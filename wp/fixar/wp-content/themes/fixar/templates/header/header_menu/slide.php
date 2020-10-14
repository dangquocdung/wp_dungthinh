<?php
	$post_ID = isset ($wp_query) ? $wp_query->get_queried_object_id() : (isset($post->ID) && $post->ID>0 ? $post->ID : '');
	if( class_exists( 'WooCommerce' ) && fixar_is_woo_page() && fixar_get_option('fixar_woo_header_global','1') ){
		$post_ID = get_option( 'woocommerce_shop_page_id' ) ? get_option( 'woocommerce_shop_page_id' ) : $post_ID;
	}

	$fixar_header = apply_filters('fixar_header_settings', $post_ID);
	$fixar_header_menu_animation = isset($post_ID) && $post_ID>0 && get_post_meta($post_ID, 'header_menu_animation', 1) != '' ? get_post_meta($post_ID, 'header_menu_animation', 1) : fixar_get_option('header_menu_animation','overlay');
	$slide_class_arr = array('left' => 'slidebar-1 left', 'right' => 'slidebar-2 right', 'top' => 'slidebar-3 top', 'bottom' => 'slidebar-4 bottom');
	$fixar_header_menu_add_style = in_array($fixar_header['header_menu_add_position'], array('top', 'bottom')) ? 'push' : $fixar_header_menu_animation;
?>
<!-- ========================== -->
<!-- SLIDE MENU  --> 
<!-- ========================== -->

<div data-off-canvas="<?php echo esc_attr($slide_class_arr[$fixar_header['header_menu_add_position']]) ?> <?php echo esc_attr($fixar_header_menu_animation) ?>" class="slidebar-menu">
	<?php
		if(fixar_get_option('header_menu_add','')) {
			wp_nav_menu(array(
				'menu'          => fixar_get_option('header_menu_add',''),
				'menu_class'    => 'nav navbar-nav',
				'walker' => new fixar_Walker_Menu(),
			));
		} else {
			echo '<div class="no-slide-add-menu">'.
                    esc_html__('Please, set Additional Menu', 'fixar').'
                    <a href="'.esc_url(admin_url(). 'customize.php').'"><img src="'.esc_url(get_template_directory_uri(). '/images/pix-addmenu.png').'"></a>
                </div>';
		}
	?>
</div>