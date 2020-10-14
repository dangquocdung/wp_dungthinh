<?php

// Add Custom Class Options to SiteOrigin Rows
function andior_choose_row_style($fields) {
    $row_styles = array(
            'default-row-style' => 'Default',
			'gray-bg' => 'Gray Background',
			'color-bg' => 'Theme Color Background',
            'dark-page' => 'Dark/Image Background',
        );

  $fields['row_styles'] = array(
  'name'        => __('Row Styles', 'siteorigin-panels'),
      'type'        => 'select',
      'options' => $row_styles,
      'group'       => 'attributes',
      'description' => __('Choose a style for this row. <br>If you want to use background image, always choose <b>Dark/Image Background</b>.<br/>
	  You don\'t need to to this, if you\'re using the <b>Banner Block, Testimonial Section Block, Hero Title Block and Blockquote Element</b>.<br/>
	  The <b>Theme Color Background</b> only works best if you use it on Banner Block. <br/>
	  You can choose your image background in <b>Design</b> tab below.  ', 'siteorigin-panels'),
      'priority'    => 1,
  );

  return $fields;
}

add_filter( 'siteorigin_panels_row_style_fields', 'andior_choose_row_style' );

function andior_row_add_class( $attributes, $args ) {
	 if( !empty( $args['row_styles'] ) ) {
		if( $args['row_styles'] != 'default-row-style' ) {
			array_push($attributes['class'], $args['row_styles'] );
		}
	 }
    return $attributes;
}

add_filter('siteorigin_panels_row_style_attributes', 'andior_row_add_class', 10, 2);

//adding image mask
function cordon_row_mask($fields) {
  $fields['parallax'] = array(
      'name'        => __('Image Mask', 'siteorigin-panels'),
      'type'        => 'checkbox',
      'group'       => 'design',
      'description' => __('If enabled, the background image will have image mask.', 'siteorigin-panels'),
      'priority'    => 8,
  );

  return $fields;
}

add_filter( 'siteorigin_panels_row_style_fields', 'cordon_row_mask' );

function cordon_row_add_mask_class( $attributes, $args ) {
    if( !empty( $args['parallax'] ) ) {
        array_push($attributes['class'], 'bg-with-mask');
    }

    return $attributes;
}

add_filter('siteorigin_panels_row_style_attributes', 'cordon_row_add_mask_class', 10, 2);


function add_custom_container_class($fields) {
  $fields['content'] = array(
      'name'        => __('Row with Padding Top & Bottom', 'siteorigin-panels'),
      'type'        => 'checkbox',
      'group'       => 'attributes',
      'description' => __('If enabled, the row will have padding top & bottom (based on theme style).', 'siteorigin-panels'),
      'priority'    => 2,
  );
  $fields['margin-top'] = array(
      'name'        => __('Row with Margin Top', 'siteorigin-panels'),
      'type'        => 'checkbox',
      'group'       => 'attributes',
      'description' => __('If enabled, the row will have margin top (based on theme style).', 'siteorigin-panels'),
      'priority'    => 3,
  );
  $fields['margin-bottom'] = array(
      'name'        => __('Row with Margin Bottom', 'siteorigin-panels'),
      'type'        => 'checkbox',
      'group'       => 'attributes',
      'description' => __('If enabled, the row will have margin bottom (based on theme style).', 'siteorigin-panels'),
      'priority'    => 3,
  );

  return $fields;
}

add_filter( 'siteorigin_panels_row_style_fields', 'add_custom_container_class' );

function container_row_style_attributes( $attributes, $args ) {

	if( !empty( $args['content'] ) ) {
        array_push($attributes['class'], 'content');
    }
	if( !empty( $args['margin-bottom'] ) ) {
        array_push($attributes['class'], 'margin-bottom');
    }
	if( !empty( $args['margin-top'] ) ) {
        array_push($attributes['class'], 'margin-top');
    }

    return $attributes;
}

add_filter('siteorigin_panels_row_style_attributes', 'container_row_style_attributes', 10, 2);