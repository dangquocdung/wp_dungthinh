<?php
/**
 * WooCommerce setting for Customizer
 *
 * @package weberium
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// WooCommerce General
$this->sections['weberium_woocommerce_general'] = array(
	'title' => esc_html__( 'General', 'weberium' ),
	'panel' => 'weberium_woocommerce',
	'settings' => array(
		array(
			'id' => 'shop_featured_title',
			'default' => esc_html__( 'Shop', 'weberium' ),
			'control' => array(
				'label' => esc_html__( 'Shop Featured Title', 'weberium' ),
				'type' => 'text',
				'active_callback' => 'weberium_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_products_per_page',
			'default' => 9,
			'control' => array(
				'label' => esc_html__( 'Products Per Page', 'weberium' ),
				'type' => 'number',
				'active_callback' => 'weberium_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_item_products_desc',
			'default' => 20,
			'control' => array(
				'label' => esc_html__( 'Product Item: Desciption', 'weberium' ),
				'type' => 'number',
				'active_callback' => 'weberium_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_columns',
			'default' => '3',
			'control' => array(
				'label' => esc_html__( 'Shop Columns', 'weberium' ),
				'type' => 'select',
				'choices' => array(
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
				),
				'active_callback' => 'weberium_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_item_bottom_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Item Bottom Margin', 'weberium' ),
				'description' => esc_html__( 'Example: 30px.', 'weberium' ),
				'active_callback' => 'weberium_cac_has_woo',
			),
			'inline_css' => array(
				'target' => '.woocommerce-page .content-woocommerce .products li',
				'alter' => 'margin-bottom',
			),
		),
		array(
			'id' => 'shop_layout_position',
			'default' => 'no-sidebar',
			'control' => array(
				'label' => esc_html__( 'Shop Layout Position', 'weberium' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'weberium' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'weberium' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'weberium' ),
				),
				'desc' => esc_html__( 'Specify layout for main shop page.', 'weberium' )
			),
		),
		array(
			'id' => 'shop_single_layout_position',
			'default' => 'no-sidebar',
			'control' => array(
				'label' => esc_html__( 'Shop Single Layout Position', 'weberium' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'weberium' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'weberium' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'weberium' ),
				),
				'desc' => esc_html__( 'Specify layout on the shop single page.', 'weberium' ),
				'active_callback' => 'weberium_cac_has_woo',
			),
		),
	),
);