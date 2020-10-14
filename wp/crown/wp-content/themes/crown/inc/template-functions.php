<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Header template
 */
function crown_template_header() {
	crown_get_template('header');
}
add_action('crown_before_page_wrapper_content', 'crown_template_header', 10);

/**
 * Footer template
 */
function crown_template_footer() {
	crown_get_template('footer');
}
add_action('crown_after_page_wrapper_content', 'crown_template_footer', 10);

/**
 * Content Wrapper Start
 */
function crown_template_wrapper_start() {
	crown_get_template('global/wrapper-start');
}
add_action('crown_main_wrapper_content_start', 'crown_template_wrapper_start', 10);

/**
 * Content Wrapper End
 */
function crown_template_wrapper_end() {
	crown_get_template('global/wrapper-end');
}
add_action('crown_main_wrapper_content_end', 'crown_template_wrapper_end', 10);

/**
 * Archive content layout
 */
function crown_template_archive_content() {
	crown_get_template('archive/layout');
}
add_action('crown_archive_content', 'crown_template_archive_content', 10);

/**
 * Single content layout
 */
function crown_template_single_content() {
	crown_get_template('single/layout');
}
add_action('crown_single_content', 'crown_template_single_content', 10);

/**
 * Single content layout
 */
function crown_template_page_content() {
	crown_get_template('page/layout');
}
add_action('crown_page_content', 'crown_template_page_content', 10);

/**
 * Search content layout
 */
function crown_template_search_content() {
	crown_get_template('search/layout');
}
add_action('crown_search_content', 'crown_template_search_content', 10);

/**
 * 404 content layout
 */
function crown_template_404_content() {
	crown_get_template('404/layout');
}
add_action('crown_404_content', 'crown_template_404_content', 10);

function crown_template_page_title() {
	crown_get_template( 'page-title' );
}
add_action('crown_before_main_content', 'crown_template_page_title', 10);
