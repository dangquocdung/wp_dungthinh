<?php
/**
 * Coronar
 * COVID19 Coronavirus Visual Dashboard
 * Exclusively on https://1.envato.market/coronar
 *
 * @encoding        UTF-8
 * @version         2.0.0
 * @copyright       (C) 2018 - 2020 Merkulove ( https://merkulov.design/ ). All rights reserved.
 * @license         Envato License https://1.envato.market/KYbje
 * @contributors    Nemirovskiy Vitaliy (nemirovskiyvitaliy@gmail.com), Alexander Khmelnitskiy (info@alexander.khmelnitskiy.ua), Dmitry Merkulov (dmitry@merkulov.design)
 * @support         help@merkulov.design
 * @license         Envato License https://1.envato.market/KYbje
 **/

namespace Merkulove\Coronar;

use Merkulove\Coronar\Unity\Plugin;
use Merkulove\Coronar\Unity\Settings;
use Merkulove\Coronar\Unity\TabGeneral;

/** Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

/**
 * SINGLETON: Settings class used to modify default plugin settings.
 *
 * @since 1.0.0
 * @author Alexandr Khmelnytsky (info@alexander.khmelnitskiy.ua)
 **/
final class Config {

	/**
	 * The one true Settings.
	 *
     * @since 1.0.0
     * @access private
	 * @var Config
	 **/
	private static $instance;

    /**
     * Prepare plugin settings by modifying the default one.
     *
     * @since 1.0.0
     * @access public
     *
     * @return void
     **/
    public function prepare_settings() {

        /** Get default plugin settings. */
        $tabs = Plugin::get_tabs();

        /** Change General tab title. */
        $tabs['general']['title'] = esc_html__( 'Coronar Settings', 'coronar' );

	    /** Disable Assignments tab. */
	    $tabs['assignments']['enabled'] = false;

	    /** Create General tab. */
	    $tabs = $this->create_tab_general( $tabs );

	    /** Create Style tab. */
	    $tabs = $this->create_tab_style( $tabs );
	    $tabs = $this->refresh_settings( $tabs );
	    $tabs = $this->create_tab_style( $tabs );

	    /** Create Map tab. */
	    $tabs = $this->create_tab_map( $tabs );

        /** Set updated tabs. */
        Plugin::set_tabs( $tabs );

        /** Refresh settings. */
        Settings::get_instance()->get_options();

    }

	private function refresh_settings( $tabs ) {

		/** Set updated tabs. */
		Plugin::set_tabs( $tabs );

		/** Refresh settings. */
		Settings::get_instance()->get_options();

		/** Get default plugin settings. */
		return Plugin::get_tabs();

	}

	/**
	 * Create General tab.
	 *
	 * @param array $tabs - List of tabs with all settings and fields.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return array - List of tabs with all settings and fields.
	 **/
	private function create_tab_general( $tabs ) {

		/** Get plugin Options. */
		$options = Settings::get_instance()->options;

		# Cache Lifetime
		$key = 'cache_time';
		$tabs['general']['fields'][$key] = [
			'type'              => 'slider',
			'label'             => esc_html__( 'Cache Lifetime:', 'coronar' ),
			'show_label'        => true,
			'description'       => esc_html__( 'Refresh data every:', 'coronar' ) . ' <strong>' . esc_html( ( ! empty( $options[$key] ) ) ? $options[$key] : '60' ) . '</strong>' . esc_html__( ' minutes. The higher the value, the less the load on the hosting and the lower the relevance of the data.', 'coronar' ),
			'show_description'  => true,
			'min'               => 30,
			'max'               => 300,
			'step'              => 15,
			'default'           => 60,
			'discrete'          => true,
		];

		# Clear Cache button
		$tabs['general']['fields']['clear_cache'] = [
			'type'              => 'button',
			'label'             => 'Clear Cache',
			'show_label'        => false,
			'placeholder'       => esc_html__( 'Clear Cache', 'coronar' ),
			'description'       => esc_html__( 'Press to reset cache and download fresh data.', 'coronar' ),
			'show_description'  => true,
			'default'           => '',
			'icon'              => 'close',
			'attr'              => [
				'class'     => 'mdc-button--outlined mdp-reset', // Filled button
			]
		];

		# Show Search
        $tabs['general']['fields']['show_search'] = [
            'type'              => 'switcher',
            'label'             => esc_html__( 'Show Search:', 'coronar' ),
            'show_label'        => true,
            'placeholder'       => esc_html__( 'Table Search', 'coronar' ),
            'description'       => esc_html__( 'Show Search input in table views', 'coronar' ),
            'show_description'  => true,
            'default'           => 'on',
        ];

		# Responsive Tables
		$tabs['general']['fields']['responsive_table'] = [
			'type'              => 'switcher',
			'label'             => esc_html__( 'Responsive Tables:', 'coronar' ),
			'show_label'        => true,
			'placeholder'       => esc_html__( 'Responsive Table', 'coronar' ),
			'description'       => esc_html__( 'Enable responsive behavior in table views', 'coronar' ),
			'show_description'  => true,
			'default'           => 'on',
		];

		# Label for Flag
        $tabs['general']['fields']['label_flag'] = [
            'type'              => 'text',
            'label'             => esc_html__( 'Label for Flag:', 'coronar' ),
            'show_label'        => true,
            'placeholder'       => esc_html__( 'Label', 'coronar' ),
            'description'       => esc_html__( 'Enter the text to replace the default label', 'coronar' ),
            'show_description'  => true,
            'default'           => 'Flag',
            'attr'              => [
                'maxlength' => '4500'
            ]
        ];

		# Label for Country
		$tabs['general']['fields']['label_country'] = [
			'type'              => 'text',
			'label'             => esc_html__( 'Label for Country:', 'coronar' ),
			'show_label'        => true,
			'placeholder'       => esc_html__( 'Label', 'coronar' ),
			'description'       => esc_html__( 'Enter the text to replace the default label', 'coronar' ),
			'show_description'  => true,
			'default'           => 'Country',
			'attr'              => [
				'maxlength' => '4500'
			]
		];

		# Label for Province
		$tabs['general']['fields']['label_province'] = [
			'type'              => 'text',
			'label'             => esc_html__( 'Label for Province:', 'coronar' ),
			'show_label'        => true,
			'placeholder'       => esc_html__( 'Label', 'coronar' ),
			'description'       => esc_html__( 'Enter the text to replace the default label', 'coronar' ),
			'show_description'  => true,
			'default'           => 'Province',
			'attr'              => [
				'maxlength' => '4500'
			]
		];

		# Label for Total Confirmed
		$tabs['general']['fields']['label_confirmed_total'] = [
			'type'              => 'text',
			'label'             => esc_html__( 'Label for Total Confirmed:', 'coronar' ),
			'show_label'        => true,
			'placeholder'       => esc_html__( 'Label', 'coronar' ),
			'description'       => esc_html__( 'Enter the text to replace the default label', 'coronar' ),
			'show_description'  => true,
			'default'           => 'Total Confirmed',
			'attr'              => [
				'maxlength' => '4500'
			]
		];

		# Label for New Confirmed
		$tabs['general']['fields']['label_confirmed_new'] = [
			'type'              => 'text',
			'label'             => esc_html__( 'Label for New Confirmed:', 'coronar' ),
			'show_label'        => true,
			'placeholder'       => esc_html__( 'Label', 'coronar' ),
			'description'       => esc_html__( 'Enter the text to replace the default label', 'coronar' ),
			'show_description'  => true,
			'default'           => 'New Confirmed',
			'attr'              => [
				'maxlength' => '4500'
			]
		];

		# Total Deaths
		$tabs['general']['fields']['label_deaths_total'] = [
			'type'              => 'text',
			'label'             => esc_html__( 'Label for Total Deaths:', 'coronar' ),
			'show_label'        => true,
			'placeholder'       => esc_html__( 'Label', 'coronar' ),
			'description'       => esc_html__( 'Enter the text to replace the default label', 'coronar' ),
			'show_description'  => true,
			'default'           => 'Total Deaths',
			'attr'              => [
				'maxlength' => '4500'
			]
		];

		# New Deaths
		$tabs['general']['fields']['label_deaths_new'] = [
			'type'              => 'text',
			'label'             => esc_html__( 'Label for New Deaths:', 'coronar' ),
			'show_label'        => true,
			'placeholder'       => esc_html__( 'Label', 'coronar' ),
			'description'       => esc_html__( 'Enter the text to replace the default label', 'coronar' ),
			'show_description'  => true,
			'default'           => 'New Deaths',
			'attr'              => [
				'maxlength' => '4500'
			]
		];

		# Total Recovered
		$tabs['general']['fields']['label_recovered_total'] = [
			'type'              => 'text',
			'label'             => esc_html__( 'Label for Total Recovered:', 'coronar' ),
			'show_label'        => true,
			'placeholder'       => esc_html__( 'Label', 'coronar' ),
			'description'       => esc_html__( 'Enter the text to replace the default label', 'coronar' ),
			'show_description'  => true,
			'default'           => 'Total Recovered',
			'attr'              => [
				'maxlength' => '4500'
			]
		];

		# New Recovered
		$tabs['general']['fields']['label_recovered_new'] = [
			'type'              => 'text',
			'label'             => esc_html__( 'Label for New Recovered:', 'coronar' ),
			'show_label'        => true,
			'placeholder'       => esc_html__( 'Label', 'coronar' ),
			'description'       => esc_html__( 'Enter the text to replace the default label', 'coronar' ),
			'show_description'  => true,
			'default'           => 'New Recovered',
			'attr'              => [
				'maxlength' => '4500'
			]
		];

		# Chart Confirmed
		$tabs['general']['fields']['label_chart_confirmed'] = [
			'type'              => 'text',
			'label'             => esc_html__( 'Label for Chart Confirmed:', 'coronar' ),
			'show_label'        => true,
			'placeholder'       => esc_html__( 'Label', 'coronar' ),
			'description'       => esc_html__( 'Enter the text to replace the default label', 'coronar' ),
			'show_description'  => true,
			'default'           => 'Chart Confirmed',
			'attr'              => [
				'maxlength' => '4500'
			]
		];

		# Chart Deaths
		$tabs['general']['fields']['label_chart_deaths'] = [
			'type'              => 'text',
			'label'             => esc_html__( 'Label for Chart Deaths:', 'coronar' ),
			'show_label'        => true,
			'placeholder'       => esc_html__( 'Label', 'coronar' ),
			'description'       => esc_html__( 'Enter the text to replace the default label', 'coronar' ),
			'show_description'  => true,
			'default'           => 'Chart Deaths',
			'attr'              => [
				'maxlength' => '4500'
			]
		];

		# Chart Recovered
		$tabs['general']['fields']['label_chart_recovered'] = [
			'type'              => 'text',
			'label'             => esc_html__( 'Label for Chart Recovered:', 'coronar' ),
			'show_label'        => true,
			'placeholder'       => esc_html__( 'Label', 'coronar' ),
			'description'       => esc_html__( 'Enter the text to replace the default label', 'coronar' ),
			'show_description'  => true,
			'default'           => 'Chart Recovered',
			'attr'              => [
				'maxlength' => '4500'
			]
		];

		return $tabs;

	}

	/**
	 * Create Style tab.
	 *
	 * @param array $tabs - List of tabs with all settings and fields.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return array - List of tabs with all settings and fields.
	 **/
	private function create_tab_style( $tabs ) {

		/** Get plugin Options. */
		$options = Settings::get_instance()->options;

		/** Add Design tab after General. */
		$offset = 1; // Position for new tab.
		$tabs = array_slice( $tabs, 0, $offset, true ) +
		        ['style' => [
			        'enabled'       => true,
			        'class'         => TabGeneral::class,
			        'label'         => esc_html__( 'Style', 'coronar' ),
			        'title'         => esc_html__( 'Style Settings', 'coronar' ),
			        'show_title'    => true,
			        'icon'          => 'brush',
			        'fields'        => []
		        ] ] +
		        array_slice( $tabs, $offset, NULL, true );

        # Confirmed Color
        $tabs['style']['fields']['confirmed_color'] = [
            'type'              => 'colorpicker',
            'label'             => esc_html__( 'Confirmed Color', 'coronar' ),
            'show_label'        => true,
            'placeholder'       => esc_html__( 'Confirmed color', 'coronar' ),
            'description'       => esc_html__( 'Select Confirmed Color', 'coronar' ),
            'show_description'  => true,
            'default'           => '#ffa000',
            'attr'              => [
                'readonly'      => 'readonly',
            ]
        ];

		# Deaths Color
		$tabs['style']['fields']['deaths_color'] = [
			'type'              => 'colorpicker',
			'label'             => esc_html__( 'Deaths Color', 'coronar' ),
			'show_label'        => true,
			'placeholder'       => esc_html__( 'Deaths color', 'coronar' ),
			'description'       => esc_html__( 'Select Deaths Color', 'coronar' ),
			'show_description'  => true,
			'default'           => '#ff3d00',
			'attr'              => [
				'readonly'      => 'readonly',
			]
		];

		# Recovered Color
		$tabs['style']['fields']['recovered_color'] = [
			'type'              => 'colorpicker',
			'label'             => esc_html__( 'Recovered Color', 'coronar' ),
			'show_label'        => true,
			'placeholder'       => esc_html__( 'Recovered color', 'coronar' ),
			'description'       => esc_html__( 'Select Recovered Color', 'coronar' ),
			'show_description'  => true,
			'default'           => '#2e7d32',
			'attr'              => [
				'readonly'      => 'readonly',
			]
		];

		# Background Color
		$tabs['style']['fields']['bg_color'] = [
			'type'              => 'colorpicker',
			'label'             => esc_html__( 'Background Color', 'coronar' ),
			'show_label'        => true,
			'placeholder'       => esc_html__( 'Background color', 'coronar' ),
			'description'       => esc_html__( 'Select Background Color', 'coronar' ),
			'show_description'  => true,
			'default'           => '#ffffff',
			'attr'              => [
				'readonly'      => 'readonly',
			]
		];

		# Shadow
		$tabs['style']['fields']['shadow'] = [
			'type'              => 'switcher',
			'label'             => esc_html__( 'Shadow:', 'coronar' ),
			'show_label'        => true,
			'placeholder'       => esc_html__( 'Row/Card Shadow', 'coronar' ),
			'description'       => esc_html__( 'Outer shadow for one country in the row or card', 'coronar' ),
			'show_description'  => true,
			'default'           => 'on',
		];

		# Margin
		$key = 'margin';
		$tabs['style']['fields'][$key] = [
			'type'              => 'slider',
			'label'             => esc_html__( 'Margin:', 'coronar' ),
			'show_label'        => true,
			'description'       => esc_html__( 'Margin:', 'coronar' ) . ' <strong>' . esc_html( ( ! empty( $options[$key] ) ) ? $options[$key] : '20' ) . '</strong>' . esc_html__( ' px.', 'coronar' ),
			'show_description'  => true,
			'min'               => 0,
			'max'               => 100,
			'step'              => 1,
			'default'           => 20,
			'discrete'          => true,
		];

		# Padding
		$key = 'padding';
		$tabs['style']['fields'][$key] = [
			'type'              => 'slider',
			'label'             => esc_html__( 'Padding:', 'coronar' ),
			'show_label'        => true,
			'description'       => esc_html__( 'Padding:', 'coronar' ) . ' <strong>' . esc_html( ( ! empty( $options[$key] ) ) ? $options[$key] : '20' ) . '</strong>' . esc_html__( ' px.', 'coronar' ),
			'show_description'  => true,
			'min'               => 0,
			'max'               => 100,
			'step'              => 1,
			'default'           => 20,
			'discrete'          => true,
		];

		# Border Radius
		$key = 'border_radius';
		$tabs['style']['fields'][$key] = [
			'type'              => 'slider',
			'label'             => esc_html__( 'Border Radius:', 'coronar' ),
			'show_label'        => true,
			'description'       => esc_html__( 'Border Radius:', 'coronar' ) . ' <strong>' . esc_html( ( ! empty( $options[$key] ) ) ? $options[$key] : '15' ) . '</strong>' . esc_html__( ' px.', 'coronar' ),
			'show_description'  => true,
			'min'               => 0,
			'max'               => 100,
			'step'              => 1,
			'default'           => 15,
			'discrete'          => true,
		];

		# Text Color
		$tabs['style']['fields']['accent_color'] = [
			'type'              => 'colorpicker',
			'label'             => esc_html__( 'Text Color', 'coronar' ),
			'show_label'        => true,
			'placeholder'       => esc_html__( 'Text color', 'coronar' ),
			'description'       => esc_html__( 'Select Text Color', 'coronar' ),
			'show_description'  => true,
			'default'           => '#0274e6',
			'attr'              => [
				'readonly'      => 'readonly',
			]
		];

        # Font Size
        $tabs['style']['fields']['font_size'] = [
            'type'              => 'select',
            'label'             => esc_html__( 'Font Size', 'coronar' ),
            'show_label'        => true,
            'placeholder'       => esc_html__( 'Font Size', 'coronar' ),
            'description'       => esc_html__( 'Absolute font size, based on default font size (which is medium).', 'coronar' ),
            'show_description'  => true,
            'default'           => 'medium',
            'options'           => [
	            'xx-small'  => esc_html__( 'XX-small', 'coronar' ),
	            'x-small'   => esc_html__( 'S-small', 'coronar' ),
	            'small'     => esc_html__( 'Small', 'coronar' ),
	            'medium'    => esc_html__( 'Medium', 'coronar' ),
	            'large'     => esc_html__( 'Large', 'coronar' ),
	            'x-large'   => esc_html__( 'X-large', 'coronar' ),
	            'xx-large'  => esc_html__( 'XX-large', 'coronar' ),
	            'xxx-large' => esc_html__( 'XXX-large', 'coronar' ),
            ]
        ];

		# Margin
		$key = 'flag_size';
		$tabs['style']['fields'][$key] = [
			'type'              => 'slider',
			'label'             => esc_html__( 'Flag Size:', 'coronar' ),
			'show_label'        => true,
			'description'       => esc_html__( 'Flag Size:', 'coronar' ) . ' <strong>' . esc_html( ( ! empty( $options[$key] ) ) ? $options[$key] : '20' ) . '</strong>' . esc_html__( ' px.', 'coronar' ),
			'show_description'  => true,
			'min'               => 0,
			'max'               => 256,
			'step'              => 1,
			'default'           => 20,
			'discrete'          => true,
		];

		return $tabs;

	}

	/**
	 * Create Style tab.
	 *
	 * @param array $tabs - List of tabs with all settings and fields.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return array - List of tabs with all settings and fields.
	 **/
	private function create_tab_map( $tabs ) {

		/** Add Design tab after General. */
		$offset = 2; // Position for new tab.
		$tabs = array_slice( $tabs, 0, $offset, true ) +
		        ['map' => [
			        'enabled'       => true,
			        'class'         => TabGeneral::class,
			        'label'         => esc_html__( 'Map', 'coronar' ),
			        'title'         => esc_html__( 'Map Settings', 'coronar' ),
			        'show_title'    => true,
			        'icon'          => 'map',
			        'fields'        => []
		        ] ] +
		        array_slice( $tabs, $offset, NULL, true );

		# API Key
		$tabs['map']['fields']['api_key'] = [
			'type'              => 'text',
			'label'             => esc_html__( 'API Key:', 'coronar' ),
			'show_label'        => true,
			'placeholder'       => esc_html__( 'API Key', 'coronar' ),
			'description'       => esc_html__( 'Enter Google Map API Key. ', 'coronar' ) .
			                       '<a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">' .
			                       esc_html__( 'Get an API Key.', 'coronar' ) .
			                       '</a>',
			'show_description'  => true,
			'default'           => '',
			'attr'              => [
				'maxlength' => '4500'
			]
		];

		# Land Color
		$tabs['map']['fields']['land_color'] = [
			'type'              => 'colorpicker',
			'label'             => esc_html__( 'Land Color:', 'coronar' ),
			'show_label'        => true,
			'placeholder'       => esc_html__( 'Land Color', 'coronar' ),
			'description'       => esc_html__( 'Select color for countries without data.', 'coronar' ),
			'show_description'  => true,
			'default'           => '#ffffff',
			'attr'              => [
				'readonly'      => 'readonly',
			]
		];

		# Water Color
		$tabs['map']['fields']['water_color'] = [
			'type'              => 'colorpicker',
			'label'             => esc_html__( 'Water Color:', 'coronar' ),
			'show_label'        => true,
			'placeholder'       => esc_html__( 'Water Color', 'coronar' ),
			'description'       => esc_html__( 'Select color for water.', 'coronar' ),
			'show_description'  => true,
			'default'           => '#ffffff',
			'attr'              => [
				'readonly'      => 'readonly',
			]
		];

		return $tabs;

	}

	/**
	 * Main Settings Instance.
	 * Insures that only one instance of Settings exists in memory at any one time.
	 *
	 * @static
     * @since 1.0.0
     * @access public
     *
	 * @return Config
	 **/
	public static function get_instance() {

		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof self ) ) {

			self::$instance = new self;

		}

		return self::$instance;

	}

}
