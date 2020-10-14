<?php 
//color scheme
function cordon_color_scheme() {
		 if( function_exists( 'ot_get_option' )) {
			$general =  ot_get_option( 'color_general' );
			$color_general = "
			.post.sticky .content-btn:hover,.blog-slider .slide-nav:hover,.widgettitle::before,.tagcloud a:hover,#searchform #searchsubmit,.post-detail::after,.content-btn,
			.form-submit #submit,.slide-btn,.line-subtext::before,.port-hov i,.work-content .slide-nav,
			.box-relative .sub-title::before,.portfolio-gallery a i,.wpcf7-submit,.pagination > .active > a, .pagination > .active > span, #wp-calendar caption,
			.pagination > .active > a:hover, .pagination > .active > span:hover, .pagination > .active > a:focus, .pagination > .active > span:focus,.top-title > span,.teams-btn,
			#wp-calendar td a:hover,.team-social a,.port-hover i,blockquote::before,.hero-btn,.abtw-soc a:hover,.sk-cube-grid .sk-cube,
			.home-slider .owl-page.active,.progress-bar-cordon,.slider-btn,.port-filter a::after,.port-filter a.active,.banner-btn::after,.dbox-relative,
			.to-top:hover,.to-top::after,.blog-gallery a i,.spinner > div,#testimonial .fa,.bordering-widget,.post-detail > li i,.port-filter a::after,.port-filter a::before,
			.to-top::after,.to-top::before,.color-bg ,.wpcf7-submit, .dark-page .wpcf7-submit
			{background-color:$general;}
	
			.content-btn:hover,a:hover,.form-submit #submit:hover,.work-content .slide-nav:hover,.wpcf7-submit:hover,.content-title span,.slider-title span,.table-content h3 > span,.box-small-icon > i,
			.blog-slider .slide-nav:hover,.blog-slider .slide-nav,.team-social a:hover,.slide-btn:hover,.hero-btn:hover,.port-filter a,.team-list-two .team-sicon li a,.blog-post-list a:hover h4,
			.abtw-soc a,.personal-color,.slide-nav:hover,.tagcloud a:hover,.slider-btn:hover,.banner-btn,.team-soc a:hover,.content-box-title i,.box-with-icon .fa,.portfolio-type-two .dbox-relative p,
			.hero-title span,.tagcloud a
			{color:$general;}
			
			.p-table a ,.content-btn,.blog-slider .slide-nav:hover,.work-content .slide-nav:hover,.slider-btn,.port-filter a:hover,.tagcloud a:hover
			{color:#fff;}
			.wpcf7-submit:hover, .dark-page .wpcf7-submit:hover{background:transparent;}
	
			.blog-slider .slide-nav,.content-btn,.form-submit #submit,.form-submit #submit:hover,.blog-slider .slide-nav:hover,.cell-right-border,.cell-left-border,.wpcf7-submit, 
			.dark-page .wpcf7-submit,
			.work-content .slide-nav,.wpcf7-submit:hover,.wpcf7-submit,.pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover,.tagcloud a,.tagcloud a:hover,
			 .pagination > .active > span:hover, .pagination > .active > a:focus, .pagination > .active > span:focus,.port-filter .active,.port-filter a:hover,.port-filter a,.teams-btn,
			 .hero-btn,.abtw-soc a,.abtw-soc a:hover,.widget-about-us h3::before,.content-title::before,.to-top:hover,.content-btn:hover
			{border-color:$general;}
			";   
			if ( function_exists( 'ot_get_option' ) && ot_get_option( 'color_general' )) {           
			wp_add_inline_style( 'cordon-theme-style', $color_general );
			}
			
			$hovers =  ot_get_option( 'custom_hovers' );
			$custom_hovers = "a:hover{color:$hovers;}
			";   
			if ( function_exists( 'ot_get_option' ) && ot_get_option( 'custom_hovers' )) {           
			wp_add_inline_style( 'cordon-theme-style', $custom_hovers );
			}
			
			$color =  ot_get_option( 'color_scheme' );
			$custom_css = "
			a{color:$color;}
			";   
			if ( function_exists( 'ot_get_option' ) && ot_get_option( 'color_scheme' )) {           
			wp_add_inline_style( 'cordon-theme-style', $custom_css );
			}
			
			$hovers =  ot_get_option( 'custom_hovers' );
			$custom_hovers = "a:hover{color:$hovers;}
			";   
			if ( function_exists( 'ot_get_option' ) && ot_get_option( 'custom_hovers' )) {           
			wp_add_inline_style( 'cordon-theme-style', $custom_hovers );
			}
			
			$heading =  ot_get_option( 'heading_color' );
			$heading_color = "
			h1, h2, h3, h4, h5, h6{color:$heading;} 
			";   
			if ( function_exists( 'ot_get_option' ) && ot_get_option( 'heading_color' )) {           
			wp_add_inline_style( 'cordon-theme-style', $heading_color );
			}
			
			$general =  ot_get_option( 'general_color' );
			$general_color = "
			body{color:$general;}
			";   
			if ( function_exists( 'ot_get_option' ) && ot_get_option( 'general_color' )) {           
			wp_add_inline_style( 'cordon-theme-style', $general_color );
			}
			
			$footer =  ot_get_option( 'footer_color' );
			$footer_color = "
			.footer{background-color:$footer;}
			";   
			if ( function_exists( 'ot_get_option' ) && ot_get_option( 'footer_color' )) {           
			wp_add_inline_style( 'cordon-theme-style', $footer_color );
			}
	 
	
			$menu =  ot_get_option( 'stick_menu' );
			$color_menu = "
			.is-sticky .for-sticky{background-color: $menu;}
			";   
			if ( function_exists( 'ot_get_option' ) && ot_get_option( 'stick_menu' )) {           
			wp_add_inline_style( 'cordon-theme-style', $color_menu );
			}
		 }
		 
}

		