<?php
/*
Plugin Name: Ultimate Image Gallery
Plugin URI: http://codecanyon.net/user/FWDesign/portfolio
Description: This is the Wordpress plugin with a CMS menu for the installation and configuration of the Ultimate Image Gallery.
Author: FWD
Version: 1.0
Author URI: http://webdesign-flash.ro/
*/

include_once "php/FWDUIG.php";
include_once "php/FWDUIGData.php";

function fwduig_check_if_admin()
{
	$roles = wp_get_current_user()->roles;
	$role = "administrator";
	 
	return in_array($role, $roles);
}

function fwduig_admin_init()
{
	if (fwduig_check_if_admin())
	{
		$role = get_role("administrator");
		$role->add_cap(FWDUIG::CAPABILITY);
	}
}

function fwduig_init_plugin()
{	
	$cov = new FWDUIG();	$cov->init();
}

add_action("init", "fwduig_init_plugin");
add_action("admin_init", "fwduig_admin_init");
add_filter("plugin_action_links_" . plugin_basename(__FILE__), array("FWDUIG", "set_action_links"));

?>