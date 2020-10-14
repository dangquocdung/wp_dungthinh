<?php
require_once('helpers-generic.php');

/************************************************************************
 * START REPOSITORY
 ************************************************************************/

if ( ! function_exists( 'AArpr_Assets' ) ) {
	function AArpr_Assets( $id, $aapms=array() ) {
		$AArpr = AArpr();

		$aapms = array_replace_recursive(array(
		), $aapms);
		
		if ( empty($id) ) return null;

		extract( $aapms );
		switch ( $id ) {
			case 'base':
				return $AArpr->load_assets_base();

			case 'frm':
				return $AArpr->load_assets_frm();

			case 'optypes':
				return $AArpr->load_assets_optypes( $options );
		}
		return true;
	}
}

if ( ! function_exists( 'AArpr_Repository' ) ) {
	function AArpr_Repository( $id, $aapms=array() ) {
		$AArpr = AArpr();
		$repository = $AArpr->repository;
		
		$aapms = array_replace_recursive(array(
			'call_init'				=> true,
		), $aapms);

		if ( ! isset($repository["$id"]) )
			return null;
		$repository = $repository["$id"];

		//:::::::::::::::::::::
		// :: depend on (another module)
		if ( isset($repository['depend']) ) {
			foreach ($repository['depend'] as $key => $val) {
				//??? TO DO
			}
		}
		
		//:::::::::::::::::::::
		// :: func
		/*
		$func = isset($repository['func']) ? $repository['func'] : null;
		if ( ! empty($func) ) {
			if ( ! isset($func[1]) || empty($func[1]) )
				return $func[0]();
	
			if ( isset($func[1]) && ! empty($func[1]) ) {
				extract( $aapms );
	
				switch ( $func[0] ) {
					case 'AArpr_aaAmazonWS':
						return $func[0]( $params, $settings );
	
					case 'AArpr_RenderTime':
						return $func[0]();
	
					case 'AArpr_Utils':
						return $func[0]( $plugin_alias );
	
					case 'AArpr_Settings':
						return $func[0]( $plugin_alias, $pms );
				}
			}
		}
		*/

		//:::::::::::::::::::::
		// :: module init & validation
		$mod = isset($repository['module_init']) ? $repository['module_init'] : null;

		if ( empty($mod) )
			return null;
		if ( ! isset($mod['path']) || empty($mod['path']) )
			return null;
		if ( ! isset($mod['file']) || empty($mod['file']) )
			return null;
		if ( ! isset($mod['class']) || empty($mod['class']) )
			return null;

		//:::::::::::::::::::::
		// :: load script
		if ( 2 == count($mod['path']) )
			$path = $AArpr->path( $mod['path'][0], $mod['path'][1] . $mod['file'] );
		else
			$path = $AArpr->path( $mod['path'][0], $mod['file'] );
		require_once( $path );
    
		// do we call the class constructor too?
		if ( isset($aapms['call_init']) && ! $aapms['call_init'] ) return true;

		//:::::::::::::::::::::
		// :: init script class
		$class = $mod['class'];
		if ( ! isset($class[1]) || empty($class[1]) )
			return new $class[0]();

		if ( isset($class[1]) && ! empty($class[1]) ) {
			extract( $aapms );

			switch ( $id ) {
				case 'AArpr_aaAmazonWS':
					return new $class[0]( $AccessKeyID, $SecretAccessKey, $country, $main_aff_id );

				case 'AArpr_RenderTime':
					return new $class[0]( $parent );

				case 'AArpr_Utils':
					return new $class[0]( $parent, $plugin_alias );

				case 'AArpr_Settings':
					return new $class[0]( $plugin_alias, $pms );
			}
		}
		return null;
	}
}

if ( ! function_exists( 'AArpr_aaAmazonWS' ) ) {
	function AArpr_aaAmazonWS( $the_plugin, $params=array(), $settings=array() ) {

		$params['AccessKeyID'] = isset($params['AccessKeyID']) ? $params['AccessKeyID'] : $settings['AccessKeyID'];
		$params['SecretAccessKey'] = isset($params['SecretAccessKey']) ? $params['SecretAccessKey'] : $settings['SecretAccessKey'];
		$params['country'] = isset($params['country']) ? $params['country'] : $settings['country'];
		$params['main_aff_id'] = isset($params['main_aff_id']) ? $params['main_aff_id'] : $settings['main_aff_id'];

		$aaAmazonWS = AArpr_Repository( 'AArpr_aaAmazonWS', array(
			'call_init'					=> true,

			'AccessKeyID'			=> $params['AccessKeyID'],
			'SecretAccessKey'		=> $params['SecretAccessKey'],
			'country'					=> $params['country'],
			'main_aff_id'				=> $params['main_aff_id']
		));
		$aaAmazonWS->set_the_plugin( $the_plugin, $settings );
		return $aaAmazonWS;
		// END HERE

		// load the amazon webservices client class
		require_once( AArpr()->path( 'DIR_LIB_SCRIPTS', 'amazon/aaAmazonWS.class.php' ) );

		// create new amazon instance
		$aaAmazonWS = new AArpr_aaAmazonWS(
			$params['AccessKeyID'],
			$params['SecretAccessKey'],
			$params['country'],
			$params['main_aff_id']
		);
		$aaAmazonWS->set_the_plugin( $the_plugin, $settings );
		return $aaAmazonWS;
	}
}

if ( ! function_exists( 'AArpr_RenderTime' ) ) {
	function AArpr_RenderTime() {

		return AArpr_Repository( 'AArpr_RenderTime', array(
			'call_init'				=> true,

			'parent' 				=> AArpr(),
		));
		// END HERE

		// load class
		require_once( AArpr()->path( 'DIR_LIB_SCRIPTS', 'runtime/runtime.php' ) );

		return AArpr_RenderTime::getInstance( AArpr() );
	}
}

if ( ! function_exists( 'AArpr_Utils' ) ) {
	function AArpr_Utils( $plugin_alias='' ) {

		return AArpr_Repository( 'AArpr_Utils', array(
			'call_init'				=> true,

			'parent' 				=> AArpr(),
			'plugin_alias' 			=> $plugin_alias
		));
		// END HERE

		// load class
		require_once( AArpr()->path( 'DIR_LIB_SCRIPTS', 'utils/utils.php' ) );

		return AArpr_Utils::getInstance( AArpr(), $plugin_alias );
		//How to call?
		//AArpr_Utils( $plugin_alias )->get_folder_files_recursive( AArpr()->path( 'OPTION_TYPES_DIR' ) );
	}
}

if ( ! function_exists( 'AArpr_List_Table_Ajax' ) ) {
	function AArpr_List_Table_Ajax( $pms=array() ) {

		$pms = array_replace_recursive(array(
			'the_plugin'			=> null,
			'params'				=> array(),
			'plugin_alias'			=> ''
		), $pms);
		extract( $pms );

		return AArpr_Repository( 'AArpr_List_Table_Ajax', array(
			'call_init'				=> true,

			'the_plugin'			=> $the_plugin,
			'params'				=> $params,
			'plugin_alias'			=> $plugin_alias
		));
		// END HERE
	}
}

if ( ! function_exists( 'AArpr_scssc' ) ) {
	function AArpr_scssc( $pms=array() ) {

		return AArpr_Repository( 'AArpr_scssc', array(
			'call_init'				=> true,
		));
		// END HERE
	}
}

if ( ! function_exists( 'AArpr_phpQuery' ) ) {
	function AArpr_phpQuery( $pms=array() ) {
		
		$pms = array_replace_recursive(array(
			'arg1'					=> null,
			'context'				=> null,
		), $pms);
		extract( $pms );

		return AArpr_Repository( 'AArpr_phpQuery', array(
			'call_init'				=> true,
			
			'arg1'					=> $arg1,
			'context'				=> $context,
		));
		// END HERE
	}
}
 
/************************************************************************
 * END REPOSITORY
 ************************************************************************/


/************************************************************************
 * START PLUGIN
 ************************************************************************/
 
if ( ! function_exists( 'AArpr_Get_IP' ) ) {
	function AArpr_Get_IP() 
	{
		//Just get the headers if we can or else use the SERVER global
		if ( function_exists( 'apache_request_headers' ) ) {
			$headers = apache_request_headers();
		} else {
			$headers = $_SERVER;
		}
		//Get the forwarded IP if it exists
		if ( array_key_exists( 'X-Forwarded-For', $headers ) && filter_var( $headers['X-Forwarded-For'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 ) ) {
			$the_ip = $headers['X-Forwarded-For'];
		} elseif ( array_key_exists( 'HTTP_X_FORWARDED_FOR', $headers ) && filter_var( $headers['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 )
		) {
			$the_ip = $headers['HTTP_X_FORWARDED_FOR'];
		} else {
			$the_ip = filter_var( $_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 );
		}
		return $the_ip;
	}
}

if ( ! function_exists( 'AArpr_time_elapsed_string' ) ) {
	function AArpr_time_elapsed_string($ptime)
	{
	    $etime = time() - $ptime;
	
	    if ($etime < 1)
	    {
	        return '0 seconds';
	    }
	
	    $a = array( 365 * 24 * 60 * 60  =>  'year',
	                 30 * 24 * 60 * 60  =>  'month',
	                      24 * 60 * 60  =>  'day',
	                           60 * 60  =>  'hour',
	                                60  =>  'minute',
	                                 1  =>  'second'
	                );
	    $a_plural = array( 'year'   => 'years',
	                       'month'  => 'months',
	                       'day'    => 'days',
	                       'hour'   => 'hours',
	                       'minute' => 'minutes',
	                       'second' => 'seconds'
	                );
	
	    foreach ($a as $secs => $str)
	    {
	        $d = $etime / $secs;
	        if ($d >= 1)
	        {
	            $r = round($d);
	            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
	        }
	    }
	}
}

if ( ! function_exists( 'AArpr_db_custom_insert' ) ) {
	function AArpr_db_custom_insert($table, $fields, $ignore=false, $wp_way=false) {
		global $wpdb;

		$last_id = false;
		if ( $wp_way && !$ignore ) {
			$r = $wpdb->insert( 
				$table, 
				$fields['values'], 
				$fields['format']
			);
			$last_id = $r ? $wpdb->insert_id : false;
		} else {

			$formatVals = implode(', ', array_map('AArpr_prepareForInList', $fields['format']));
			$theVals = array();
			foreach ( $fields['values'] as $k => $v ) {
				$theVals[] = $k;
			}

			$q = "INSERT " . ($ignore ? "IGNORE" : "") . " INTO $table (" . implode(', ', $theVals) . ") VALUES (" . $formatVals . ");";
			foreach ($fields['values'] as $kk => $vv) {
				$fields['values']["$kk"] = esc_sql($vv);
			}

			$q = vsprintf($q, $fields['values']);
			$r = $wpdb->query( $q );
			$last_id = $r ? $wpdb->insert_id : false;
		}
		return $last_id;
	}
}

if ( ! function_exists( 'AArpr_prepareForInList' ) ) {
	function AArpr_prepareForInList($v) {
		return "'".$v."'";
	}
}

if ( ! function_exists('AArpr_escape') ) {
	function AArpr_escape($text) {
		$text = (string) $text;
		if ('' === $text) return '';

		$result = @htmlspecialchars($text, ENT_COMPAT, 'UTF-8');
		if (empty($result)) {
			$result = @htmlspecialchars(utf8_encode($text), ENT_COMPAT, 'UTF-8');
		}
		return $result;
	}
}

if ( ! function_exists('AArpr_objectToArray') ) {
	/**
	 * Transforms the responseobject to an array
	 *
	 * @param object $object
	 *
	 * @return array An array representation of the given object
	 */
	function AArpr_objectToArray($object) {
		$out = array();
		foreach ($object as $key => $value)
		{
			switch (true)
			{
				case is_object($value):
					$out[$key] = $this->objectToArray($value);
				break;

				case is_array($value):
					$out[$key] = $this->objectToArray($value);
				break;

				default:
					$out[$key] = $value;
				break;
			}
		}

		return $out;
	}
}

if ( ! function_exists('array_replace_recursive') ) {
    function array_replace_recursive($base, $replacements)
    {
        foreach (array_slice(func_get_args(), 1) as $replacements) {
            $bref_stack = array(&$base);
            $head_stack = array($replacements);

            do {
                end($bref_stack);

                $bref = &$bref_stack[key($bref_stack)];
                $head = array_pop($head_stack);

                unset($bref_stack[key($bref_stack)]);

                foreach (array_keys($head) as $key) {
                    if (isset($key, $bref, $bref[$key], $head[$key]) && is_array($bref[$key]) && is_array($head[$key])) {
                        $bref_stack[] = &$bref[$key];
                        $head_stack[] = $head[$key];
                    } else {
                        $bref[$key] = $head[$key];
                    }
                }
            } while(count($head_stack));
        }

        return $base;
    }
}

if ( ! function_exists('array_column') ) {
    function array_column(array $input, $columnKey, $indexKey = null) {
        $array = array();
        foreach ($input as $value) {
            if ( !array_key_exists($columnKey, $value)) {
                trigger_error("Key \"$columnKey\" does not exist in array");
                return false;
            }
            if (is_null($indexKey)) {
                $array[] = $value[$columnKey];
            }
            else {
                if ( !array_key_exists($indexKey, $value)) {
                    trigger_error("Key \"$indexKey\" does not exist in array");
                    return false;
                }
                if ( ! is_scalar($value[$indexKey])) {
                    trigger_error("Key \"$indexKey\" does not contain scalar value");
                    return false;
                }
                $array[$value[$indexKey]] = $value[$columnKey];
            }
        }
        return $array;
    }
}

/************************************************************************
 * END PLUGIN
 ************************************************************************/
?>