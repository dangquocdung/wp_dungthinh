<?php
/**
 * Theme storage manipulations
 *
 * @package WordPress
 * @subpackage MONYXI
 * @since MONYXI 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Get theme variable
if (!function_exists('monyxi_storage_get')) {
	function monyxi_storage_get($var_name, $default='') {
		global $MONYXI_STORAGE;
		return isset($MONYXI_STORAGE[$var_name]) ? $MONYXI_STORAGE[$var_name] : $default;
	}
}

// Set theme variable
if (!function_exists('monyxi_storage_set')) {
	function monyxi_storage_set($var_name, $value) {
		global $MONYXI_STORAGE;
		$MONYXI_STORAGE[$var_name] = $value;
	}
}

// Check if theme variable is empty
if (!function_exists('monyxi_storage_empty')) {
	function monyxi_storage_empty($var_name, $key='', $key2='') {
		global $MONYXI_STORAGE;
		if (!empty($key) && !empty($key2))
			return empty($MONYXI_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return empty($MONYXI_STORAGE[$var_name][$key]);
		else
			return empty($MONYXI_STORAGE[$var_name]);
	}
}

// Check if theme variable is set
if (!function_exists('monyxi_storage_isset')) {
	function monyxi_storage_isset($var_name, $key='', $key2='') {
		global $MONYXI_STORAGE;
		if (!empty($key) && !empty($key2))
			return isset($MONYXI_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return isset($MONYXI_STORAGE[$var_name][$key]);
		else
			return isset($MONYXI_STORAGE[$var_name]);
	}
}

// Inc/Dec theme variable with specified value
if (!function_exists('monyxi_storage_inc')) {
	function monyxi_storage_inc($var_name, $value=1) {
		global $MONYXI_STORAGE;
		if (empty($MONYXI_STORAGE[$var_name])) $MONYXI_STORAGE[$var_name] = 0;
		$MONYXI_STORAGE[$var_name] += $value;
	}
}

// Concatenate theme variable with specified value
if (!function_exists('monyxi_storage_concat')) {
	function monyxi_storage_concat($var_name, $value) {
		global $MONYXI_STORAGE;
		if (empty($MONYXI_STORAGE[$var_name])) $MONYXI_STORAGE[$var_name] = '';
		$MONYXI_STORAGE[$var_name] .= $value;
	}
}

// Get array (one or two dim) element
if (!function_exists('monyxi_storage_get_array')) {
	function monyxi_storage_get_array($var_name, $key, $key2='', $default='') {
		global $MONYXI_STORAGE;
		if (empty($key2))
			return !empty($var_name) && !empty($key) && isset($MONYXI_STORAGE[$var_name][$key]) ? $MONYXI_STORAGE[$var_name][$key] : $default;
		else
			return !empty($var_name) && !empty($key) && isset($MONYXI_STORAGE[$var_name][$key][$key2]) ? $MONYXI_STORAGE[$var_name][$key][$key2] : $default;
	}
}

// Set array element
if (!function_exists('monyxi_storage_set_array')) {
	function monyxi_storage_set_array($var_name, $key, $value) {
		global $MONYXI_STORAGE;
		if (!isset($MONYXI_STORAGE[$var_name])) $MONYXI_STORAGE[$var_name] = array();
		if ($key==='')
			$MONYXI_STORAGE[$var_name][] = $value;
		else
			$MONYXI_STORAGE[$var_name][$key] = $value;
	}
}

// Set two-dim array element
if (!function_exists('monyxi_storage_set_array2')) {
	function monyxi_storage_set_array2($var_name, $key, $key2, $value) {
		global $MONYXI_STORAGE;
		if (!isset($MONYXI_STORAGE[$var_name])) $MONYXI_STORAGE[$var_name] = array();
		if (!isset($MONYXI_STORAGE[$var_name][$key])) $MONYXI_STORAGE[$var_name][$key] = array();
		if ($key2==='')
			$MONYXI_STORAGE[$var_name][$key][] = $value;
		else
			$MONYXI_STORAGE[$var_name][$key][$key2] = $value;
	}
}

// Merge array elements
if (!function_exists('monyxi_storage_merge_array')) {
	function monyxi_storage_merge_array($var_name, $key, $value) {
		global $MONYXI_STORAGE;
		if (!isset($MONYXI_STORAGE[$var_name])) $MONYXI_STORAGE[$var_name] = array();
		if ($key==='')
			$MONYXI_STORAGE[$var_name] = array_merge($MONYXI_STORAGE[$var_name], $value);
		else
			$MONYXI_STORAGE[$var_name][$key] = array_merge($MONYXI_STORAGE[$var_name][$key], $value);
	}
}

// Add array element after the key
if (!function_exists('monyxi_storage_set_array_after')) {
	function monyxi_storage_set_array_after($var_name, $after, $key, $value='') {
		global $MONYXI_STORAGE;
		if (!isset($MONYXI_STORAGE[$var_name])) $MONYXI_STORAGE[$var_name] = array();
		if (is_array($key))
			monyxi_array_insert_after($MONYXI_STORAGE[$var_name], $after, $key);
		else
			monyxi_array_insert_after($MONYXI_STORAGE[$var_name], $after, array($key=>$value));
	}
}

// Add array element before the key
if (!function_exists('monyxi_storage_set_array_before')) {
	function monyxi_storage_set_array_before($var_name, $before, $key, $value='') {
		global $MONYXI_STORAGE;
		if (!isset($MONYXI_STORAGE[$var_name])) $MONYXI_STORAGE[$var_name] = array();
		if (is_array($key))
			monyxi_array_insert_before($MONYXI_STORAGE[$var_name], $before, $key);
		else
			monyxi_array_insert_before($MONYXI_STORAGE[$var_name], $before, array($key=>$value));
	}
}

// Push element into array
if (!function_exists('monyxi_storage_push_array')) {
	function monyxi_storage_push_array($var_name, $key, $value) {
		global $MONYXI_STORAGE;
		if (!isset($MONYXI_STORAGE[$var_name])) $MONYXI_STORAGE[$var_name] = array();
		if ($key==='')
			array_push($MONYXI_STORAGE[$var_name], $value);
		else {
			if (!isset($MONYXI_STORAGE[$var_name][$key])) $MONYXI_STORAGE[$var_name][$key] = array();
			array_push($MONYXI_STORAGE[$var_name][$key], $value);
		}
	}
}

// Pop element from array
if (!function_exists('monyxi_storage_pop_array')) {
	function monyxi_storage_pop_array($var_name, $key='', $defa='') {
		global $MONYXI_STORAGE;
		$rez = $defa;
		if ($key==='') {
			if (isset($MONYXI_STORAGE[$var_name]) && is_array($MONYXI_STORAGE[$var_name]) && count($MONYXI_STORAGE[$var_name]) > 0) 
				$rez = array_pop($MONYXI_STORAGE[$var_name]);
		} else {
			if (isset($MONYXI_STORAGE[$var_name][$key]) && is_array($MONYXI_STORAGE[$var_name][$key]) && count($MONYXI_STORAGE[$var_name][$key]) > 0) 
				$rez = array_pop($MONYXI_STORAGE[$var_name][$key]);
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if (!function_exists('monyxi_storage_inc_array')) {
	function monyxi_storage_inc_array($var_name, $key, $value=1) {
		global $MONYXI_STORAGE;
		if (!isset($MONYXI_STORAGE[$var_name])) $MONYXI_STORAGE[$var_name] = array();
		if (empty($MONYXI_STORAGE[$var_name][$key])) $MONYXI_STORAGE[$var_name][$key] = 0;
		$MONYXI_STORAGE[$var_name][$key] += $value;
	}
}

// Concatenate array element with specified value
if (!function_exists('monyxi_storage_concat_array')) {
	function monyxi_storage_concat_array($var_name, $key, $value) {
		global $MONYXI_STORAGE;
		if (!isset($MONYXI_STORAGE[$var_name])) $MONYXI_STORAGE[$var_name] = array();
		if (empty($MONYXI_STORAGE[$var_name][$key])) $MONYXI_STORAGE[$var_name][$key] = '';
		$MONYXI_STORAGE[$var_name][$key] .= $value;
	}
}

// Call object's method
if (!function_exists('monyxi_storage_call_obj_method')) {
	function monyxi_storage_call_obj_method($var_name, $method, $param=null) {
		global $MONYXI_STORAGE;
		if ($param===null)
			return !empty($var_name) && !empty($method) && isset($MONYXI_STORAGE[$var_name]) ? $MONYXI_STORAGE[$var_name]->$method(): '';
		else
			return !empty($var_name) && !empty($method) && isset($MONYXI_STORAGE[$var_name]) ? $MONYXI_STORAGE[$var_name]->$method($param): '';
	}
}

// Get object's property
if (!function_exists('monyxi_storage_get_obj_property')) {
	function monyxi_storage_get_obj_property($var_name, $prop, $default='') {
		global $MONYXI_STORAGE;
		return !empty($var_name) && !empty($prop) && isset($MONYXI_STORAGE[$var_name]->$prop) ? $MONYXI_STORAGE[$var_name]->$prop : $default;
	}
}
?>