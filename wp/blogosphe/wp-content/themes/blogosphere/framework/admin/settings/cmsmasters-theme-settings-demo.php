<?php 
/**
 * @package 	WordPress
 * @subpackage 	Blogosphere
 * @version		1.0.0
 * 
 * Admin Panel Theme Settings Import/Export
 * Created by CMSMasters
 * 
 */


function blogosphere_options_demo_tabs() {
	$tabs = array();
	
	
	$tabs['import'] = esc_attr__('Import', 'blogosphere');
	$tabs['export'] = esc_attr__('Export', 'blogosphere');
	
	
	return $tabs;
}


function blogosphere_options_demo_sections() {
	$tab = blogosphere_get_the_tab();
	
	
	switch ($tab) {
	case 'import':
		$sections = array();
		
		$sections['import_section'] = esc_html__('Theme Settings Import', 'blogosphere');
		
		
		break;
	case 'export':
		$sections = array();
		
		$sections['export_section'] = esc_html__('Theme Settings Export', 'blogosphere');
		
		
		break;
	default:
		$sections = array();
		
		
		break;
	}
	
	
	return $sections;
} 


function blogosphere_options_demo_fields($set_tab = false) {
	if ($set_tab) {
		$tab = $set_tab;
	} else {
		$tab = blogosphere_get_the_tab();
	}
	
	
	$options = array();
	
	
	switch ($tab) {
	case 'import':
		$options[] = array( 
			'section' => 'import_section', 
			'id' => 'blogosphere' . '_demo_import', 
			'title' => esc_html__('Theme Settings', 'blogosphere'), 
			'desc' => esc_html__("Enter your theme settings data here and click 'Import' button", 'blogosphere') . (CMSMASTERS_THEME_STYLE_COMPATIBILITY ? '<span class="descr_note">' . esc_html__("Please note that when importing theme settings, these settings will be applied to the appropriate Theme Style (with the same name).", 'blogosphere') . '<br />' . esc_html__("To see these settings applied, please enable appropriate", 'blogosphere') . ' <a href="' . esc_url(admin_url('admin.php?page=cmsmasters-settings&tab=theme_style')) . '">' . esc_html__("Theme Style", 'blogosphere') . '</a>.</span>' : ''), 
			'type' => 'textarea', 
			'std' => '', 
			'class' => '' 
		);
		
		
		break;
	case 'export':
		$options[] = array( 
			'section' => 'export_section', 
			'id' => 'blogosphere' . '_demo_export', 
			'title' => esc_html__('Theme Settings', 'blogosphere'), 
			'desc' => esc_html__("Click here to export your theme settings data to the file.", 'blogosphere') . (CMSMASTERS_THEME_STYLE_COMPATIBILITY ? '<span class="descr_note">' . esc_html__("Please note, that when exporting theme settings, you will export settings for the currently active Theme Style.", 'blogosphere') . '<br />' . esc_html__("Theme Style can be set", 'blogosphere') . ' <a href="' . esc_url(admin_url('admin.php?page=cmsmasters-settings&tab=theme_style')) . '">' . esc_html__("here", 'blogosphere') . '</a>.</span>' : ''), 
			'type' => 'button', 
			'std' => esc_html__('Export Theme Settings', 'blogosphere'), 
			'class' => 'cmsmasters-demo-export' 
		);
		
		
		break;
	}
	
	
	return $options;	
}

