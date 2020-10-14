<?php
/**
 * Amazon module return as json_encode
 * http://www.aa-team.com
 * =======================
 *
 * @author		Andrei Dinca, AA-Team
 * @version		1.0
 */

$SMPNEW = function_exists('SMPNEW') ? SMPNEW() : null;
//$SMPNEW_pages = function_exists('SMPNEW') ? SMPNEW()->get_pages() : null;
$SMPNEW_Tpl_Helper = function_exists('SMPNEW') ? SMPNEW()->tplhelper : null;

echo json_encode(array(
	// create the box elements array
	'option_name' => 'SMPNEW_Tpl_Settings',

	'tabs' => array(
		'setup' => array(
			'label' 	=> 'Templates',
			'elements' 	=> 'box_templates',
		),
	),

	'elements' => array(

                'box_templates' => array(
                    'type' => 'html',
                    'std' => '',
                    'size' => 'large',
                    'title' => 'Templates',
                    'html' => is_object($SMPNEW_Tpl_Helper) ? $SMPNEW_Tpl_Helper->_box_templates( 'setup' ) : ''
                ),
                
	), // end elements
));