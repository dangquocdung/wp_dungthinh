<?php
/**
 * Amazon module return as json_encode
 * http://www.aa-team.com
 * =======================
 *
 * @author		Andrei Dinca, AA-Team
 * @version		1.0
 */

$AArpr = function_exists('AArpr') ? AArpr() : null;
//$AArpr_pages = function_exists('AArpr') ? AArpr()->get_pages() : null;
$AArpr_Main_Helper = function_exists('AArpr') ? AArpr()->mainhelper : null;

echo json_encode(array(
	// create the box elements array
	'option_name' => 'AArpr_Main_Settings',

	'tabs' => array(
		'setup' => array(
			'label' 	=> 'Plugin Setup',
			'elements' 	=> 'test, test2, test3, test4',
		),
	),

	'elements' => array(

				/* Config */
                'test' => array(
                    'type' => 'select',
                    'std' => '',
                    'size' => 'small',
                    //'force_width' => '200',
                    'title' => 'Test option',
                    'desc' => 'test option desc.',
                    'options' => array(
                        'test1' => 'Test 1',
                    )
                ),
                'test2' => array(
                    'type' => 'select',
                    'std' => '',
                    'size' => 'small',
                    //'force_width' => '200',
                    'title' => 'Test2 option',
                    'desc' => 'test2 option desc.',
                    'options' => array(
                        'test1' => 'Test 1',
                        'test2' => 'Test 2',
                    )
                ),
                'test3' => array(
                    'type' => 'select',
                    'std' => '',
                    'size' => 'small',
                    //'force_width' => '200',
                    'title' => 'Test3 option',
                    'desc' => 'test3 option desc.',
                    'options' => array(
                        'test1' => 'Test 1',
                        'test2' => 'Test 2',
                        'test3' => 'Test 3',
                    )
                ),
                'test4' => array(
                    'type' => 'select',
                    'std' => '',
                    'size' => 'small',
                    //'force_width' => '200',
                    'title' => 'Test4 option',
                    'desc' => 'test4 option desc.',
                    'options' => array(
                        'test1' => 'Test 1',
                        'test2' => 'Test 2',
                        'test3' => 'Test 3',
                        'test4' => 'Test 4',
                    )
                ),

	), // end elements
));