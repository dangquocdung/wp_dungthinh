<?php
/**
 * Projects setting for Customizer
 *
 * @package weberium
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Project Related General
$this->sections['weberium_projects_general'] = array(
	'title' => esc_html__( 'General', 'weberium' ),
	'panel' => 'weberium_projects',
	'settings' => array(
		array(
			'id' => 'project_related',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'weberium' ),
				'type' => 'checkbox',
				'active_callback' => 'weberium_cac_has_single_project',
			),
		),
		array(
			'id' => 'project_related_title',
			'default' => esc_html__( 'RELATED PROJECTS', 'weberium' ),
			'control' => array(
				'label' => esc_html__( 'Project Related Title', 'weberium' ),
				'type' => 'text',
				'active_callback' => 'weberium_cac_has_related_project',
			),
		),
		array(
			'id' => 'project_related_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Wrap Padding', 'weberium' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 100px 0px 100px 0px', 'weberium' ),
				'active_callback' => 'weberium_cac_has_related_project',
			),
			'inline_css' => array(
				'target' => '.project-related-wrap',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'project_related_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Wrap Background', 'weberium' ),
				'active_callback' => 'weberium_cac_has_related_project',
			),
			'inline_css' => array(
				'target' => '.project-related-wrap',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'project_related_query',
			'default' => 9,
			'control' => array(
				'label' => esc_html__( 'Number of items', 'weberium' ),
				'type' => 'number',
				'active_callback' => 'weberium_cac_has_related_project',
			),
		),
		array(
			'id' => 'project_related_column',
			'default' => '4',
			'control' => array(
				'label' => esc_html__( 'Columns', 'weberium' ),
				'type' => 'select',
				'choices' => array(
					'4' => '4',
					'3' => '3',
					'2' => '2',
				),
				'active_callback' => 'weberium_cac_has_related_project',
			),
		),
		array(
			'id' => 'project_related_item_spacing',
			'default' => 17,
			'control' => array(
				'label' => esc_html__( 'Spacing between items', 'weberium' ),
				'type' => 'number',
				'active_callback' => 'weberium_cac_has_related_project',
			),
		),
		array(
			'id' => 'project_related_img_crop',
			'default' => 'square',
			'control' => array(
				'label' => esc_html__( 'Image Size', 'weberium' ),
				'type' => 'select',
				'choices' => array(
					'square' => '600 x 600',
					'rectangle' => '600 x 500',
					'rectangle2' => '600 x 390',
				),
				'active_callback' => 'weberium_cac_has_related_project',
			),
		),

	),
);