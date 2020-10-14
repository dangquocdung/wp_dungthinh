<?php
/**
 * WooCommerce setting for Customizer
 *
 * @package gustablo
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// WooCommerce General
$this->sections['wprt_woocommerce_general'] = array(
	'title' => esc_html__( 'General', 'gustablo' ),
	'panel' => 'wprt_woocommerce',
	'settings' => array(
		array(
			'id' => 'shop_featured_title',
			'default' => esc_html__( 'SHOP', 'gustablo' ),
			'control' => array(
				'label' => esc_html__( 'Shop Featured Title', 'gustablo' ),
				'type' => 'text',
				'active_callback' => 'wprt_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_products_per_page',
			'default' => 9,
			'control' => array(
				'label' => esc_html__( 'Products Per Page', 'gustablo' ),
				'type' => 'number',
				'active_callback' => 'wprt_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_item_bottom_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Item Bottom Margin', 'gustablo' ),
				'description' => esc_html__( 'Example: 30px.', 'gustablo' ),
				'active_callback' => 'wprt_cac_has_woo',
			),
			'inline_css' => array(
				'target' => '.woocommerce-page .content-woocommerce .products li',
				'alter' => 'margin-bottom',
			),
		),
	),
);

// WooCommerce Layout
$this->sections['wprt_woocommerce_layout'] = array(
	'title' => esc_html__( 'Layout', 'gustablo' ),
	'panel' => 'wprt_woocommerce',
	'settings' => array(
		array(
			'id' => 'shop_columns',
			'default' => '3',
			'control' => array(
				'label' => esc_html__( 'Shop Columns', 'gustablo' ),
				'type' => 'select',
				'choices' => array(
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
				),
				'active_callback' => 'wprt_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_layout_position',
			'default' => 'no-sidebar',
			'control' => array(
				'label' => esc_html__( 'Shop Layout Position', 'gustablo' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'gustablo' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'gustablo' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'gustablo' ),
				),
				'desc' => esc_html__( 'Specify layout for main shop page.', 'gustablo' ),
				'active_callback' => 'wprt_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_single_layout_position',
			'default' => 'no-sidebar',
			'control' => array(
				'label' => esc_html__( 'Shop Single Layout Position', 'gustablo' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'gustablo' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'gustablo' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'gustablo' ),
				),
				'desc' => esc_html__( 'Specify layout on the shop single page.', 'gustablo' ),
				'active_callback' => 'wprt_cac_has_woo',
			),
		),
	),
);