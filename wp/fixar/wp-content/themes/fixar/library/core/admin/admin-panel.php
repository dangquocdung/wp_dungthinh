<?php

	require_once(get_template_directory() . '/library/core/admin/admin-panel/class.customizer.fonts.php');
	require_once(get_template_directory() . '/library/core/admin/admin-panel/general.php');
	require_once(get_template_directory() . '/library/core/admin/admin-panel/page-loader.php' );
	require_once(get_template_directory() . '/library/core/admin/admin-panel/style.php' );
	require_once(get_template_directory() . '/library/core/admin/admin-panel/header.php');
	require_once(get_template_directory() . '/library/core/admin/admin-panel/page-tab.php');
	require_once(get_template_directory() . '/library/core/admin/admin-panel/responsive.php');
	require_once(get_template_directory() . '/library/core/admin/admin-panel/search.php');
	require_once(get_template_directory() . '/library/core/admin/admin-panel/footer.php');
	require_once(get_template_directory() . '/library/core/admin/admin-panel/shop.php');
	require_once(get_template_directory() . '/library/core/admin/admin-panel/portfolio.php');
	require_once(get_template_directory() . '/library/core/admin/admin-panel/services.php');
	require_once(get_template_directory() . '/library/core/admin/admin-panel/blog.php');
	require_once(get_template_directory() . '/library/core/admin/admin-panel/social.php');
	require_once(get_template_directory() . '/library/core/admin/admin-panel/sanitizer.php' );
 
	
	function fixar_customize_register( $wp_customize ) {

		$wp_customize->remove_section('header_image');
		$wp_customize->remove_section('background_image');
		$wp_customize->remove_section('colors');

		/** GENERAL SETTINGS **/
		fixar_customize_general_tab($wp_customize,'fixar');
		
		
		/** PAGE LOADER SETTINGS **/
		fixar_customize_page_loader_tab($wp_customize,'fixar');


		/** STYLE SECTION **/

		fixar_customize_style_tab($wp_customize, 'fixar');
		
		
		/** HEADER SECTION **/

		fixar_customize_header_tab($wp_customize,'fixar');


		/** RESPONSIVE SECTION **/

		fixar_customize_responsive_tab($wp_customize,'fixar');


		/** SEARCH SECTION **/

		fixar_customize_search_tab($wp_customize,'fixar');


		/** PAGE TITLE AND BREADCRUMBS SECTION **/

		fixar_customize_page_t_a_b_tab($wp_customize,'fixar');


		/** FOOTER SECTION **/

		fixar_customize_footer_tab($wp_customize,'fixar');


		/** SHOP SECTION **/

		fixar_customize_shop_tab($wp_customize,'fixar');


		/** PORTFOLIO SECTION **/

		fixar_customize_portfolio_tab($wp_customize, 'fixar');


		/** SERVICES SECTION **/

		fixar_customize_services_tab($wp_customize, 'fixar');


		/** BLOG SECTION **/

		fixar_customize_blog_tab($wp_customize,'fixar');

		/** SOCIAL SECTION **/

		fixar_customize_social_tab($wp_customize,'fixar');

		/** Remove unused sections */

		$removedSections = apply_filters('fixar_admin_customize_removed_sections', array('header_image','background_image'));
		foreach ($removedSections as $_sectionName){
			$wp_customize->remove_section($_sectionName);
		}

    }
    
    
	add_action( 'customize_register', 'fixar_customize_register' );

?>