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

$SMPNEW_TplCustom_Settings = array(
	// create the box elements array
	'option_name'	=> 'SMPNEW_TplCustom_Settings',
	'buttons'		    => false,
	'tabs_status'		=> false,

	'tabs' => array(
		'setup' => array(
			'label' 	=> 'Templates',
			'elements' 	=> '',
		),
	),

	'elements' => array(

		// if we need to refresh the templates cache: 0 = no refresh necessary ; 1 = yes, it needs refreshing
	    'cache_force_refresh' => array(
	        'type'				=> 'input-type-hidden',
	        'std'				=> '',
	        '__templates'	=> array(
	        	'template1' 	=> 1,
	        	'template2' 	=> 1, 
	        	'template3' 	=> 1,
	        	'template4' 	=> 1,
	        	'template5' 	=> 1,
	        	'template6'	=> 1,
			),
	    ),
	    
		
		'help_required_fields' => array(
			'type' => 'message',
			'status' => 'info',
			'row_css_reset' => true,
			'html' => 'The following options are used to stylize the Related Product Box.',
	        '__templates'	=> array(
	        	'template1' 	=> '#FF0000',
	        	'template2' 	=> '#00FF00', 
	        	'template3' 	=> '#0000FF',
	        	'template4' 	=> '#FFFF00',
	        	'template5' 	=> '#808080',
	        	'template6'	=> '#EF89DD',
			),
		),
		
	       
	    'primary_color' => array(
	        'type'				=> 'input-type-color',
	        'std'				=> '',
	        //'label'				=> __('placeholder', $SMPNEW->localizationName),
	        'title'				=> __('Headline Background Color', $SMPNEW->localizationName),
	        'desc'				=> __('Headline Background Color', $SMPNEW->localizationName),
	        '__templates'	=> array(
	        	'template1' 	=> '#FF0000',
	        	'template2' 	=> '#00FF00', 
	        	'template3' 	=> '#0000FF',
	        	'template4' 	=> '#FFFF00',
	        	'template5' 	=> '#808080',
	        	'template6'	=> '#EF89DD',
			),
	    ),
 

	    'box_title' => array(
	        'type'				=> 'input-type-text',
	        'std'				=> '',
	        'label'				=> __('Related Box Title', $SMPNEW->localizationName),
	        'title'				=> __('Related Box Title', $SMPNEW->localizationName),
	        'desc'				=> __('Related Box Title', $SMPNEW->localizationName),
	        'size'				=> 'small',
	        //'force_width'		=> '50%',
	        //'force_height'		=> '50px',
	        '__templates'	=> array(
	        	'template1' 	=> esc_html__('Related Products'),
	        	'template2' 	=> esc_html__('Related Products'), 
	        	'template3' 	=> esc_html__('Related Products'),
	        	'template4' 	=> esc_html__('Related Products'),
	        	'template5' 	=> esc_html__('Related Products'),
	        	'template6'	=> esc_html__('Related Products'),
			),
	    ),
	    
		'box_title_font_family' => array(
	        'type'				=> 'select',
	        'std'				=> '',
	        'options' 			=> is_object($SMPNEW) ? $SMPNEW->getAllGfonts() : array(),
	        'label'				=> __('Related Box Title Font Familiy', $SMPNEW->localizationName),
	        'title'				=> __('Related Box Title Font Familiy', $SMPNEW->localizationName),
	        'desc'				=> __('<div class="SMPNEW-font-preview"></div>', $SMPNEW->localizationName),
	        'size'				=> 'small',
	        //'force_width'		=> '50%',
	        //'force_height'		=> '50px',
	        '__templates'	=> array(
	        	'template1' 	=> 'Playfair Display',
	        	'template2' 	=> 'Playfair Display', 
	        	'template3' 	=> 'Playfair Display',
	        	'template4' 	=> 'Playfair Display',
	        	'template5' 	=> 'Playfair Display',
	        	'template6'	=> 'Playfair Display',
			),
	    ),
	    
	    'box_title_color' => array(
	        'type'				=> 'input-type-color',
	        'std'				=> '',
	        //'label'				=> __('placeholder', $SMPNEW->localizationName),
	        'title'				=> __('Related Box Title Color', $SMPNEW->localizationName),
	        'desc'				=> __('Related Box Title Color', $SMPNEW->localizationName),
	        '__templates'	=> array(
	        	'template1' 	=> '#323232',
	        	'template2' 	=> '#323232', 
	        	'template3' 	=> '#323232',
	        	'template4' 	=> '#323232',
	        	'template5' 	=> '#323232',
	        	'template6'	=> '#323232',
			),
	    ),


		'help_required_fields1' => array(
			'type' => 'message',
			'status' => 'info',
			'row_css_reset' => true,
			'html' => 'The following options are used to stylize the product',
	        '__templates'	=> array(
	        	'template1' 	=> '#FF0000',
	        	'template2' 	=> '#00FF00', 
	        	'template3' 	=> '#0000FF',
	        	'template4' 	=> '#FFFF00',
	        	'template5' 	=> '#808080',
	        	'template6'	=> '#EF89DD',
			),
		),
		   
		'title_font_family' => array(
	        'type'				=> 'select',
	        'std'				=> '',
	        'options' 			=> is_object($SMPNEW) ? $SMPNEW->getAllGfonts() : array(),
	        'label'				=> __('Title Font Familiy', $SMPNEW->localizationName),
	        'title'				=> __('Title Font Familiy', $SMPNEW->localizationName),
	        'desc'				=> __('<div class="SMPNEW-font-preview"></div>', $SMPNEW->localizationName),
	        'size'				=> 'small',
	        //'force_width'		=> '50%',
	        //'force_height'		=> '50px',
	        '__templates'	=> array(
	        	'template1' 	=> 'Arimo',
	        	'template2' 	=> 'Arimo', 
	        	'template3' 	=> 'Arimo',
	        	'template4' 	=> 'Arimo',
	        	'template5' 	=> 'Arimo',
	        	'template6'	=> 'Arimo',
			),
	    ),
	    
	    'title_color' => array(
	        'type'				=> 'input-type-color',
	        'std'				=> '',
	        //'label'				=> __('placeholder', $SMPNEW->localizationName),
	        'title'				=> __('Title color', $SMPNEW->localizationName),
	        'desc'				=> __('Title color', $SMPNEW->localizationName),
	        '__templates'	=> array(
	        	'template1' 	=> '#323232',
	        	'template2' 	=> '#323232', 
	        	'template3' 	=> '#323232',
	        	'template4' 	=> '#323232',
	        	'template5' 	=> '#323232',
	        	'template6'	=> '#323232',
			),
	    ),



		'category_font_family' => array(
	        'type'				=> 'select',
	        'std'				=> '',
	        'options' 			=> is_object($SMPNEW) ? $SMPNEW->getAllGfonts() : array(),
	        'label'				=> __('Category Font Familiy', $SMPNEW->localizationName),
	        'title'				=> __('Category Font Familiy', $SMPNEW->localizationName),
	        'desc'				=> __('<div class="SMPNEW-font-preview"></div>', $SMPNEW->localizationName),
	        'size'				=> 'small',
	        //'force_width'		=> '50%',
	        //'force_height'		=> '50px',
	        '__templates'	=> array(
	        	'template1' 	=> 'Montserrat',
	        	'template2' 	=> 'Montserrat', 
	        	'template3' 	=> 'Montserrat',
	        	'template4' 	=> 'Montserrat',
	        	'template5' 	=> 'Montserrat',
	        	'template6'	=> 'Montserrat',
			),
	    ),
	    
	    'category_color' => array(
	        'type'				=> 'input-type-color',
	        'std'				=> '',
	        //'label'				=> __('placeholder', $SMPNEW->localizationName),
	        'title'				=> __('Category color', $SMPNEW->localizationName),
	        'desc'				=> __('Category color', $SMPNEW->localizationName),
	        '__templates'	=> array(
	        	'template1' 	=> '#f1713e',
	        	'template2' 	=> '#f1713e', 
	        	'template3' 	=> '#f1713e',
	        	'template4' 	=> '#f1713e',
	        	'template5' 	=> '#f1713e',
	        	'template6'	=> '#f1713e',
			),
	    ),



		'price_font_family' => array(
	        'type'				=> 'select',
	        'std'				=> '',
	        'options' 			=> is_object($SMPNEW) ? $SMPNEW->getAllGfonts() : array(),
	        'label'				=> __('Price Font Familiy', $SMPNEW->localizationName),
	        'title'				=> __('Price Font Familiy', $SMPNEW->localizationName),
	        'desc'				=> __('<div class="SMPNEW-font-preview"></div>', $SMPNEW->localizationName),
	        'size'				=> 'small',
	        //'force_width'		=> '50%',
	        //'force_height'		=> '50px',
	        '__templates'	=> array(
	        	'template1' 	=> 'Arimo',
	        	'template2' 	=> 'Arimo', 
	        	'template3' 	=> 'Arimo',
	        	'template4' 	=> 'Arimo',
	        	'template5' 	=> 'Arimo',
	        	'template6'	=> 'Arimo',
			),
	    ),
	    
	    'price_color' => array(
	        'type'				=> 'input-type-color',
	        'std'				=> '',
	        //'label'				=> __('placeholder', $SMPNEW->localizationName),
	        'title'				=> __('Price color', $SMPNEW->localizationName),
	        'desc'				=> __('Price color', $SMPNEW->localizationName),
	        '__templates'	=> array(
	        	'template1' 	=> '#323232',
	        	'template2' 	=> '#323232', 
	        	'template3' 	=> '#323232',
	        	'template4' 	=> '#323232',
	        	'template5' 	=> '#323232',
	        	'template6'	=> '#323232',
			),
	    ),
	    'checkout_text' => array(
	        'type'				=> 'input-type-text',
	        'std'				=> '',
	        'label'				=> __('Checkout', $SMPNEW->localizationName),
	        'title'				=> __('Checkout button text', $SMPNEW->localizationName),
	        'desc'				=> __('Checkout button text', $SMPNEW->localizationName),
	        'size'				=> 'small',
	        //'force_width'		=> '50%',
	        //'force_height'		=> '50px',
	        '__templates'	=> array(
	        	'template1' 	=> esc_html__('Checkout'),
	        	'template2' 	=> esc_html__('Checkout'), 
	        	'template3' 	=> esc_html__('Checkout'),
	        	'template4' 	=> esc_html__('Checkout'),
	        	'template5' 	=> esc_html__('Checkout'),
	        	'template6'	=> esc_html__('Checkout'),
			),
	    ),
	    
	    'checkout_button_background' => array(
	        'type'				=> 'input-type-color',
	        'std'				=> '',
	        //'label'				=> __('placeholder', $SMPNEW->localizationName),
	        'title'				=> __('Checkout Button background color', $SMPNEW->localizationName),
	        'desc'				=> __('Checkout Button background color', $SMPNEW->localizationName),
	        '__templates'	=> array(
	        	'template1' 	=> '#9dc74b',
	        	'template2' 	=> '#9dc74b', 
	        	'template3' 	=> '#9dc74b',
	        	'template4' 	=> '#9dc74b',
	        	'template5' 	=> '#9dc74b',
	        	'template6'	=> '#9dc74b',
			),
	    ),
	    
	    'checkout_button_background_hover' => array(
	        'type'				=> 'input-type-color',
	        'std'				=> '',
	        //'label'				=> __('placeholder', $SMPNEW->localizationName),
	        'title'				=> __('Checkout Button background color on Hover', $SMPNEW->localizationName),
	        'desc'				=> __('Checkout Button background color on Hover', $SMPNEW->localizationName),
	        '__templates'	=> array(
	        	'template1' 	=> '#cfcfcf',
	        	'template2' 	=> '#cfcfcf', 
	        	'template3' 	=> '#cfcfcf',
	        	'template4' 	=> '#cfcfcf',
	        	'template5' 	=> '#cfcfcf',
	        	'template6'	=> '#cfcfcf',
			),
	    ),
	    
		'checkout_button_font_family' => array(
	        'type'				=> 'select',
	        'std'				=> '',
	        'options' 			=> is_object($SMPNEW) ? $SMPNEW->getAllGfonts() : array(),
	        'label'				=> __('Checkout Button Font Familiy', $SMPNEW->localizationName),
	        'title'				=> __('Checkout Button Font Familiy', $SMPNEW->localizationName),
	        'desc'				=> __('<div class="SMPNEW-font-preview"></div>', $SMPNEW->localizationName),
	        'size'				=> 'small',
	        //'force_width'		=> '50%',
	        //'force_height'		=> '50px',
	        '__templates'	=> array(
	        	'template1' 	=> 'Montserrat',
	        	'template2' 	=> 'Montserrat', 
	        	'template3' 	=> 'Montserrat',
	        	'template4' 	=> 'Montserrat',
	        	'template5' 	=> 'Montserrat',
	        	'template6'	=> 'Montserrat',
			),
	    ),
	    
	    'checkout_button_color' => array(
	        'type'				=> 'input-type-color',
	        'std'				=> '',
	        //'label'				=> __('placeholder', $SMPNEW->localizationName),
	        'title'				=> __('Checkout Button Font color', $SMPNEW->localizationName),
	        'desc'				=> __('Checkout Button Font color', $SMPNEW->localizationName),
	        '__templates'	=> array(
	        	'template1' 	=> '#ffffff',
	        	'template2' 	=> '#ffffff', 
	        	'template3' 	=> '#ffffff',
	        	'template4' 	=> '#ffffff',
	        	'template5' 	=> '#ffffff',
	        	'template6'	=> '#ffffff',
			),
	    ),

	    'checkout_thumb_background' => array(
	        'type'				=> 'input-type-color',
	        'std'				=> '',
	        //'label'				=> __('placeholder', $SMPNEW->localizationName),
	        'title'				=> __('Cart circle background color', $SMPNEW->localizationName),
	        'desc'				=> __('This appears only on certains templates, not on all of them.', $SMPNEW->localizationName),
	        '__templates'	=> array(
	        	'template1' 	=> '#9dc74b',
	        	'template4' 	=> '#9dc74b',
	        	'template5' 	=> '#9dc74b',
	        	 
			),
	    ),
		
		
	    'carousel_buttons_color' => array(
	        'type'				=> 'input-type-color',
	        'std'				=> '',
	        //'label'				=> __('placeholder', $SMPNEW->localizationName),
	        'title'				=> __('Carousel arrows color', $SMPNEW->localizationName),
	        'desc'				=> __('Carousel arrows color', $SMPNEW->localizationName),
	        '__templates'	=> array(
	        	'template2' 	=> '#f1713e', 
			),
	    ),

	    'carousel_buttons_background' => array(
	        'type'				=> 'input-type-color',
	        'std'				=> '',
	        //'label'				=> __('placeholder', $SMPNEW->localizationName),
	        'title'				=> __('Carousel arrows background', $SMPNEW->localizationName),
	        'desc'				=> __('Carousel arrows background', $SMPNEW->localizationName),
	        '__templates'	=> array(
	        	'template2' 	=> '#f6f6f6', 
			),
	    ),
	    
	    'carousel_buttons_background_hover' => array(
	        'type'				=> 'input-type-color',
	        'std'				=> '',
	        //'label'				=> __('placeholder', $SMPNEW->localizationName),
	        'title'				=> __('Carousel arrows background hover', $SMPNEW->localizationName),
	        'desc'				=> __('Carousel arrows background on hover', $SMPNEW->localizationName),
	        '__templates'	=> array(
	        	'template2' 	=> '#9dc74b', 
			),
	    ),
	    //textarea
	    'custom_css' => array(
	        'type'				=> 'textarea',
	        'std'				=> '',
	        'label'				=> __('Custom CSS', $SMPNEW->localizationName),
	        'title'				=> __('Custom CSS', $SMPNEW->localizationName),
	        'desc'				=> __('Custom CSS for this template', $SMPNEW->localizationName),
	        'size'				=> 'large',
	        //'force_width'		=> '50%',
	        //'force_height'		=> '50px',
	        '__templates'	=> array(
	        	'template1' 	=> '',
	        	'template2' 	=> '', 
	        	'template3' 	=> '',
	        	'template4' 	=> '',
	        	'template5' 	=> '',
	        	'template6'	=> '',
			),
	    ),
	    
	), // end elements
);

if ( ! function_exists('SMPNEW_TplCustom_Settings_func') ) {
	function SMPNEW_TplCustom_Settings_func( $x ) {
		//$tabElements = array_map('trim', explode(',', $val));
		//$tabElements = preg_replace('/^/', $key.'-', $tabElements);

		// build all form elements per each template
		$newel = array();
		foreach ($x['elements'] as $key => $val) {
			$filtered = isset($val['__templates']) ? (array) $val['__templates'] : array();

			foreach ($filtered as $key2 => $val2) {
				$newkey = $key2 . '-' . $key;

				$val['std'] = $val2;
				$val['__template'] = $key2;
				$newel["$newkey"] = $val;
			}
		}
		$x['elements'] = $newel;

		// build tabs
		$x['tabs']['setup']['elements'] = implode(', ', array_keys($x['elements']));

		return $x;
	}
}

$SMPNEW_TplCustom_Settings = SMPNEW_TplCustom_Settings_func( $SMPNEW_TplCustom_Settings );
echo json_encode( $SMPNEW_TplCustom_Settings );