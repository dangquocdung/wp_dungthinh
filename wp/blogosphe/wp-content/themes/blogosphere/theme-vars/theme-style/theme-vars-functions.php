<?php
/**
 * @package 	WordPress
 * @subpackage 	Blogosphere
 * @version 	1.0.1
 * 
 * Theme Vars Functions
 * Created by CMSMasters
 * 
 */


/* Register CSS Styles */
function blogosphere_vars_register_css_styles() {
	wp_enqueue_style('blogosphere-theme-vars-style', get_template_directory_uri() . '/theme-vars/theme-style' . CMSMASTERS_THEME_STYLE . '/css/vars-style.css', array('blogosphere-retina'), '1.0.0', 'screen, print');
}

add_action('wp_enqueue_scripts', 'blogosphere_vars_register_css_styles');

