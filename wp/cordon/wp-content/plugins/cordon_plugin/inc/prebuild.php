<?php
// Registers the new post type 


function cordon_prebuilt_layouts($layouts) {
	$plugin_url = plugin_dir_url( __FILE__ );
	$layouts[ 'one-page-slider' ] = array_merge(
		array(
			'name' => __('Onepage Slider', 'cordon_plg'), 
			'description' => __('Prebuilt layout for homepage with one-page slider style. 
			You can change the color scheme light/dark in theme options.
			Make sure to choose One Page Builder template so you can use one-page style menus later.', 'cordon_plg'),
			'screenshot' => $plugin_url . 'template/onepage-slider.jpg', 
		),
		json_decode( file_get_contents( plugin_dir_path( __FILE__ ) . 'template/onepage-slider.json' ), true )
	);
	
	$layouts[ 'one-page-video' ] = array_merge(
		array(
			'name' => __('Onepage Video', 'cordon_plg'), 
			'description' => __('Prebuilt layout for homepage with one-page video style. 
			You can change the color scheme light/dark in theme options.
			Make sure to choose One Page Builder template so you can use one-page style menus later.', 'cordon_plg'),
			'screenshot' => $plugin_url . 'template/onepage-video.jpg', 
		),
		json_decode( file_get_contents( plugin_dir_path( __FILE__ ) . 'template/onepage-video.json' ), true )
	);
	$layouts[ 'one-page-youtube' ] = array_merge(
		array(
			'name' => __('Onepage Youtube', 'cordon_plg'), 
			'description' => __('Prebuilt layout for homepage with one-page youtube style. 
			You can change the color scheme light/dark in theme options.
			Make sure to choose One Page Builder template so you can use one-page style menus later.', 'cordon_plg'),
			'screenshot' => $plugin_url . 'template/onepage-youtube.jpg', 
		),
		json_decode( file_get_contents( plugin_dir_path( __FILE__ ) . 'template/onepage-youtube.json' ), true )
	);
	$layouts[ 'home-agency-1' ] = array_merge(
		array(
			'name' => __('Home Agency 1', 'cordon_plg'), 
			'description' => __('Prebuilt layout for homepage agency style one.
			You can change the color scheme light/dark in theme options.
			Make sure to choose Page Builder template to prevent layout error.', 'cordon_plg'),
			'screenshot' => $plugin_url . 'template/home-agency1.jpg', 
		),
		json_decode( file_get_contents( plugin_dir_path( __FILE__ ) . 'template/home-agency1.json' ), true )
	);
	$layouts[ 'home-agency-2' ] = array_merge(
		array(
			'name' => __('Home Agency 2', 'cordon_plg'), 
			'description' => __('Prebuilt layout for homepage agency style two.
			You can change the color scheme light/dark in theme options.
			Make sure to choose Page Builder template to prevent layout error.', 'cordon_plg'),
			'screenshot' => $plugin_url . 'template/home-agency2.jpg', 
		),
		json_decode( file_get_contents( plugin_dir_path( __FILE__ ) . 'template/home-agency2.json' ), true )
	);
	$layouts[ 'home-personal-1' ] = array_merge(
		array(
			'name' => __('Home Personal 1', 'cordon_plg'), 
			'description' => __('Prebuilt layout for homepage personal style one.
			You can change the color scheme light/dark in theme options.
			Make sure to choose Page Builder template to prevent layout error.', 'cordon_plg'),
			'screenshot' => $plugin_url . 'template/home-personal1.jpg', 
		),
		json_decode( file_get_contents( plugin_dir_path( __FILE__ ) . 'template/home-personal1.json' ), true )
	);
	$layouts[ 'home-personal-2' ] = array_merge(
		array(
			'name' => __('Home Personal 2', 'cordon_plg'), 
			'description' => __('Prebuilt layout for homepage personal style two.
			You can change the color scheme light/dark in theme options.
			Make sure to choose Page Builder template to prevent layout error.', 'cordon_plg'),
			'screenshot' => $plugin_url . 'template/home-personal2.jpg', 
		),
		json_decode( file_get_contents( plugin_dir_path( __FILE__ ) . 'template/home-personal2.json' ), true )
	);
	$layouts[ 'work-agency-1' ] = array_merge(
		array(
			'name' => __('Works Agency 1', 'cordon_plg'), 
			'description' => __('Prebuilt layout for works page agency style one.
			You can change the color scheme light/dark in theme options.
			Make sure to choose Page Builder template to prevent layout error.', 'cordon_plg'),
			'screenshot' => $plugin_url . 'template/work-agency1.jpg', 
		),
		json_decode( file_get_contents( plugin_dir_path( __FILE__ ) . 'template/work-agency1.json' ), true )
	);
	$layouts[ 'work-agency-2' ] = array_merge(
		array(
			'name' => __('Works Agency 2', 'cordon_plg'), 
			'description' => __('Prebuilt layout for works page agency style two.
			You can change the color scheme light/dark in theme options.
			Make sure to choose Page Builder template to prevent layout error.', 'cordon_plg'),
			'screenshot' => $plugin_url . 'template/work-agency2.jpg', 
		),
		json_decode( file_get_contents( plugin_dir_path( __FILE__ ) . 'template/work-agency2.json' ), true )
	);
	$layouts[ 'about-agency-1' ] = array_merge(
		array(
			'name' => __('About Agency 1', 'cordon_plg'), 
			'description' => __('Prebuilt layout for about page agency style one.
			You can change the color scheme light/dark in theme options.
			Make sure to choose Page Builder template to prevent layout error.', 'cordon_plg'),
			'screenshot' => $plugin_url . 'template/about-agency1.jpg', 
		),
		json_decode( file_get_contents( plugin_dir_path( __FILE__ ) . 'template/about-agency1.json' ), true )
	);
	$layouts[ 'about-agency-2' ] = array_merge(
		array(
			'name' => __('About Agency 2', 'cordon_plg'), 
			'description' => __('Prebuilt layout for about page agency style two.
			You can change the color scheme light/dark in theme options.
			Make sure to choose Page Builder template to prevent layout error.', 'cordon_plg'),
			'screenshot' => $plugin_url . 'template/about-agency2.jpg', 
		),
		json_decode( file_get_contents( plugin_dir_path( __FILE__ ) . 'template/about-agency2.json' ), true )
	);
	$layouts[ 'about-personal' ] = array_merge(
		array(
			'name' => __('About Personal', 'cordon_plg'), 
			'description' => __('Prebuilt layout for about page personal style.
			You can change the color scheme light/dark in theme options.
			Make sure to choose Page Builder template to prevent layout error.', 'cordon_plg'),
			'screenshot' => $plugin_url . 'template/about-personal.jpg', 
		),
		json_decode( file_get_contents( plugin_dir_path( __FILE__ ) . 'template/about-personal.json' ), true )
	);
	$layouts[ 'contact-agency1' ] = array_merge(
		array(
			'name' => __('Contact Agency 1', 'cordon_plg'), 
			'description' => __('Prebuilt layout for contact page agency style one.
			You can change the color scheme light/dark in theme options.
			Make sure to choose Page Builder template to prevent layout error.', 'cordon_plg'),
			'screenshot' => $plugin_url . 'template/contact-agency1.jpg', 
		),
		json_decode( file_get_contents( plugin_dir_path( __FILE__ ) . 'template/contact-agency1.json' ), true )
	);
	$layouts[ 'contact-agency2' ] = array_merge(
		array(
			'name' => __('Contact Agency 2', 'cordon_plg'), 
			'description' => __('Prebuilt layout for contact page agency style two.
			You can change the color scheme light/dark in theme options.
			Make sure to choose Page Builder template to prevent layout error.', 'cordon_plg'),
			'screenshot' => $plugin_url . 'template/contact-agency2.jpg', 
		),
		json_decode( file_get_contents( plugin_dir_path( __FILE__ ) . 'template/contact-agency2.json' ), true )
	);
	$layouts[ 'contact-personal' ] = array_merge(
		array(
			'name' => __('Contact Personal', 'cordon_plg'), 
			'description' => __('Prebuilt layout for contact page personal style.
			You can change the color scheme light/dark in theme options.
			Make sure to choose Page Builder template to prevent layout error.', 'cordon_plg'),
			'screenshot' => $plugin_url . 'template/contact-personal.jpg', 
		),
		json_decode( file_get_contents( plugin_dir_path( __FILE__ ) . 'template/contact-personal.json' ), true )
	);


	return $layouts;
}
add_filter('siteorigin_panels_prebuilt_layouts','cordon_prebuilt_layouts');


