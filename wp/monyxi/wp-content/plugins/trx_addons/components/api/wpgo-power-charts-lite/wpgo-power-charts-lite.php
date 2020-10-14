<?php
/**
 * Plugin support: M Chart
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.38
 */

if (!defined('TRX_ADDONS_CHART_CPT_CHART'))			define('TRX_ADDONS_CHART_CPT_CHART', 			'wpgo_power_charts');

// Check if plugin installed and activated
if ( !function_exists( 'trx_addons_exists_wpgo_power_charts_lite' ) ) {
	function trx_addons_exists_wpgo_power_charts_lite() {
        return class_exists('WPGO_Power_Charts');
	}
}

// One-click import support
//------------------------------------------------------------------------

// Check plugin in the required plugins
if ( !function_exists( 'trx_addons_wpgo_power_charts_lite_importer_required_plugins' ) ) {
	if (is_admin()) add_filter( 'trx_addons_filter_importer_required_plugins',	'trx_addons_wpgo_power_charts_lite_importer_required_plugins', 10, 2 );
	function trx_addons_wpgo_power_charts_lite_importer_required_plugins($not_installed='', $list='') {
		if (strpos($list, 'wpgo-power-charts-lite')!==false && !trx_addons_exists_wpgo_power_charts_lite() )
			$not_installed .= '<br>' . esc_html__('Power Charts Lite', 'trx_addons');
		return $not_installed;
	}
}

// Set plugin's specific importer options
//if ( !function_exists( 'trx_addons_wpgo_power_charts_lite_importer_set_options' ) ) {
//	if (is_admin()) add_filter( 'trx_addons_filter_importer_options',	'trx_addons_wpgo_power_charts_lite_importer_set_options' );
//	function trx_addons_wpgo_power_charts_lite_importer_set_options($options=array()) {
//		if ( trx_addons_exists_wpgo_power_charts_lite() && in_array('wpgo-power-charts-lite', $options['required_plugins']) ) {
//			$options['additional_options'][] = '_wpgo_%';				// Add slugs to export options for this plugin
//		}
//		return $options;
//	}
//}

// Add checkbox to the one-click importer
if ( !function_exists( 'trx_addons_wpgo_power_charts_lite_importer_show_params' ) ) {
	if (is_admin()) add_action( 'trx_addons_action_importer_params',	'trx_addons_wpgo_power_charts_lite_importer_show_params', 10, 1 );
	function trx_addons_wpgo_power_charts_lite_importer_show_params($importer) {
		if ( trx_addons_exists_wpgo_power_charts_lite() && in_array('wpgo-power-charts-lite', $importer->options['required_plugins']) ) {
			$importer->show_importer_params(array(
				'slug' => 'wpgo-power-charts-lite',
				'title' => esc_html__('ImportPower Charts Lite', 'trx_addons'),
				'part' => 0
			));
		}
	}
}

// Check if the row will be imported
if ( !function_exists( 'trx_addons_wpgo_power_charts_lite_importer_check_row' ) ) {
	if (is_admin()) add_filter('trx_addons_filter_importer_import_row', 'trx_addons_wpgo_power_charts_lite_importer_check_row', 9, 4);
	function trx_addons_wpgo_power_charts_lite_importer_check_row($flag, $table, $row, $list) {
		if ($flag || strpos($list, 'wpgo-power-charts-lite')===false) return $flag;
		if ( trx_addons_exists_wpgo_power_charts_lite() ) {
			if ($table == 'posts')
				$flag = in_array($row['post_type'], array(TRX_ADDONS_CHART_CPT_CHART));
		}
		return $flag;
	}
}

// Display import progress
if ( !function_exists( 'trx_addons_wpgo_power_charts_lite_importer_import_fields' ) ) {
	if (is_admin()) add_action( 'trx_addons_action_importer_import_fields',	'trx_addons_wpgo_power_charts_lite_importer_import_fields', 10, 1 );
	function trx_addons_wpgo_power_charts_lite_importer_import_fields($importer) {
		if ( trx_addons_exists_wpgo_power_charts_lite() && in_array('wpgo-power-charts-lite', $importer->options['required_plugins']) ) {
			$importer->show_importer_fields(array(
				'slug'=>'wpgo-power-charts-lite',
				'title' => esc_html__('Power Charts Lite', 'trx_addons')
				)
			);
		}
	}
}

?>