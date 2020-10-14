<?php
add_filter( 'g5core_theme_font_default', 'crown_font_default' );
function crown_font_default() {
	return array(
		array(
			'family'   => 'Poppins',
			'kind'     => 'webfonts#webfont',
			'variants' => array(
				'200italic',
				'300',
				'300italic',
				'300',
				'400italic',
				'400',
				'600italic',
				'600',
				'700italic',
				'700',
				'800italic',
				'800',
				'900italic',
				'900',
			),
		),
		array(
			'family'   => 'Arimo',
			'kind'     => 'webfonts#webfont',
			'variants' => array(
				'400italic',
				'400',
				'700',
				'700italic',
			),
		)
	);
}

