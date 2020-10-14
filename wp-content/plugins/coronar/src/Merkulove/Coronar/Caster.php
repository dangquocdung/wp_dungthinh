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

use Merkulove\Coronar\Unity\Helper;
use Merkulove\Coronar\Unity\Plugin;
use Merkulove\Coronar\Unity\Settings;

/** Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

/**
 * SINGLETON: Caster class contain main plugin logic.
 *
 * @since 1.0.0
 * @author Alexandr Khmelnytsky (info@alexander.khmelnitskiy.ua)
 **/
final class Caster {

	/**
	 * The one true Caster.
	 *
     * @since 1.0.0
     * @access private
	 * @var Caster
	 **/
	private static $instance;

    /**
     * Setup the plugin.
     *
     * @since 1.0.0
     * @access public
     *
     * @return void
     **/
    public function setup() {

        /** Define hooks that runs on both the front-end as well as the dashboard. */
        $this->both_hooks();

        /** Define public hooks. */
        $this->public_hooks();

        /** Define admin hooks. */
        $this->admin_hooks();

    }

    /**
     * Define hooks that runs on both the front-end as well as the dashboard.
     *
     * @since 1.0.0
     * @access private
     *
     * @return void
     **/
    private function both_hooks() {

	    /** Create /wp-content/uploads/coronar/ folder for cache files. */
	    wp_mkdir_p( trailingslashit( wp_upload_dir()['basedir'] ) . 'coronar' );

	    /** Adds all the necessary shortcodes. */
	    Shortcodes::get_instance();

    }

    /**
     * Register all of the hooks related to the public-facing functionality.
     *
     * @since 1.0.0
     * @access private
     *
     * @return void
     **/
    private function public_hooks() {

        /** Work only on frontend area. */
        if ( is_admin() ) { return; }

	    /** Load CSS for Frontend Area. */
	    add_action( 'wp_enqueue_scripts', [$this, 'styles'] ); // CSS.

	    /** Load JavaScript for Frontend Area. */
	    add_action( 'wp_enqueue_scripts', [$this, 'scripts'] ); // JS.

    }

    /**
     * Register all of the hooks related to the admin area functionality.
     *
     * @since 1.0.0
     * @access private
     *
     * @return void
     **/
    private function admin_hooks() {

        /** Work only in admin area. */
        if ( ! is_admin() ) { return; }

	    /** Clear Cache. */
	    if ( defined('DOING_AJAX') ) {
		    add_action( 'wp_ajax_clear_cache', [$this, 'clear_cache' ] );
	    }

    }

	/**
	 * Add CSS for the public-facing side of the site.
	 *
	 * @return void
	 * @since 1.0.0
	 **/
	public function styles() {

		/** Frontend CSS for shortcodes. */
		wp_register_style( 'dataTables', Plugin::get_url() . 'css/jquery.dataTables' . Plugin::get_suffix() . '.css', [], Plugin::get_version() );

		if ( 'on' === Settings::get_instance()->options['responsive_table'] ) {

			wp_register_style( 'dataTables-rowReorder', Plugin::get_url() . 'css/rowReorder.dataTables' . Plugin::get_suffix() . '.css', [], Plugin::get_version() );
			wp_register_style( 'dataTables-responsive', Plugin::get_url() . 'css/responsive.dataTables' . Plugin::get_suffix() . '.css', [], Plugin::get_version() );

		}
		
		wp_register_style( 'chartist', Plugin::get_url() . 'css/chartist' . Plugin::get_suffix() . '.css', [], Plugin::get_version() );
		wp_register_style( 'mdp-coronar', Plugin::get_url() . 'css/coronar' . Plugin::get_suffix() . '.css', [], Plugin::get_version() );

		$inline_css = $this->get_inline_css();

		/** Add custom CSS. */
		wp_add_inline_style( 'mdp-coronar', $inline_css . Settings::get_instance()->options['custom_css'] );

	}

	/**
	 * Add JavaScript for the public-facing side of the site.
	 *
	 * @return void
	 * @since 1.0.0
	 **/
	public function scripts() {

		/** Get plugin settings. */
		$options = Settings::get_instance()->options;

		/** Frontend JS for shortcodes. */
		wp_register_script( 'dataTables', Plugin::get_url() . 'js/jquery.dataTables' . Plugin::get_suffix() . '.js', ['jquery'], Plugin::get_version(), true );

		if ( 'on' === $options['responsive_table'] ) {

			wp_register_script( 'dataTables-rowReorder', Plugin::get_url() . 'js/dataTables.rowReorder' . Plugin::get_suffix() . '.js', ['jquery', 'dataTables'], Plugin::get_version(), true );
			wp_register_script( 'dataTables-responsive', Plugin::get_url() . 'js/dataTables.responsive' . Plugin::get_suffix() . '.js', ['jquery', 'dataTables'], Plugin::get_version(), true );

		}

		wp_register_script( 'chartist', Plugin::get_url() . 'js/chartist' . Plugin::get_suffix() . '.js', [], Plugin::get_version(), true );

		wp_register_script( 'geo-chart', 'https://www.gstatic.com/charts/loader.js', [], Plugin::get_version(), true );
		wp_register_script( 'mdp-map-chart', Plugin::get_url() . 'js/map-chart' . Plugin::get_suffix() . '.js', ['jquery', 'geo-chart'], Plugin::get_version(), true );

		/** Pass variables to JS. */
		wp_localize_script( 'mdp-map-chart', 'mdpCoronarMap', [
			'mapsApiKey' => $options['api_key']
		] );

		wp_register_script( 'mdp-coronar', Plugin::get_url() . 'js/coronar' . Plugin::get_suffix() . '.js', ['jquery', 'dataTables'], Plugin::get_version(), true );

		/** Pass variables to JS. */
		wp_localize_script( 'mdp-coronar', 'mdpCoronar', [
			'showSearch'        => ( 'on' !== $options['show_search'] ) ? 'false' : 'true',
			'responsiveTable'   => ( 'on' !== $options['responsive_table'] ) ? 'false' : 'true',
		] );

	}

	/**
	 * Return inline CSS for coronar.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 **/
	private function get_inline_css() {

		/** Get Plugin Settings. */
		$options = Settings::get_instance()->options;

		/** Prepare variables. */
		$accent_color = $options['accent_color'];
		$bg_color = $options['bg_color'];
		$shadow = 'none';
		if ( 'on' === $options['shadow'] ) {
			$shadow = '0 4px 1px -6px rgba(0,0,0,0.02), 0 1px 10px 0 rgba(0,0,0,0.11)';
		}
		$margin = $options['margin'];
		$padding = $options['padding'];

		$half_padding = $options['padding']/4;

		$border_radius = $options['border_radius'];
		$font_size = $options['font_size'];
		$flag_size = $options['flag_size'];

		$confirmed_color = $options['confirmed_color'];
		$deaths_color = $options['deaths_color'];
		$recovered_color = $options['recovered_color'];

		// language=CSS
		/** @noinspection CssUnusedSymbol */
		return "
			.mdp-coronar-table-box table {
				border-spacing: 0 {$margin}px;
				font-size: {$font_size};
			}
			
			.mdp-coronar-table-box table.dataTable td {
				padding: {$padding}px 0;
				background-color: {$bg_color};
			}
			
			.mdp-coronar-table-box tbody tr {
				border-radius: {$border_radius}px;
				box-shadow: {$shadow};
				background-color: {$bg_color};
			}
						
			.mdp-coronar-table-box tbody tr td:first-child {
				border-radius: {$border_radius}px 0 0 {$border_radius}px;				
				padding-left: {$padding}px;
			}
			
			.mdp-coronar-table-box tbody tr td:last-child {
				border-radius: 0 {$border_radius}px {$border_radius}px 0;
				padding-right: {$padding}px;
			}
			
			.mdp-coronar-table-box tbody tr.child td{
				border-radius: {$border_radius}px !important;
			}
			
			.mdp-coronar-table-box table.dataTable td.mdp-coronar-flag {
				padding: {$padding}px;
				min-width: {$flag_size}px;
				max-width: {$flag_size}px;
				width: {$flag_size}px;
			}
						
			.mdp-coronar-table-box table.dataTable th {
				padding: 0 {$padding}px 0 {$padding}px;
				background-color: {$bg_color};
				color: {$accent_color};
			}
			
			.mdp-coronar-table-box tbody td.mdp-coronar-flag img {
				width: {$flag_size}px;
            	height: {$flag_size}px;
            	min-width: {$flag_size}px;
            	min-height: {$flag_size}px;
			}
				
			.mdp-coronar-table-box table.dataTable td ul li span {
				color: {$accent_color};
			}
					
			.mdp-coronar-table-box .dataTables_filter input {
				border-radius: {$border_radius}px;
			}
						
			.mdp-coronar-table-box table.dataTable td.dataTables_empty {
				border-radius: {$border_radius}px;
			}
			
			.mdp-coronar-table-box table.dtr-inline tbody tr {
				background-color: {$bg_color};
			}
						
			.mdp-coronar-table-box table.dtr-inline tbody tr td.mdp-coronar-last-visible {
				border-radius: 0 {$border_radius}px {$border_radius}px 0;
			}			
			.mdp-coronar-table-box table.dtr-inline tbody td li {
				padding: {$half_padding}px 0;
			}
			
			.mdp-coronar-summary-date-box {
				font-size: {$font_size};
			}
			
			.mdp-coronar-summary-tbl .ct-golden-section {
				height: {$flag_size}px;
			}
			
			.mdp-coronar-summary-relative-date-box {
				font-size: {$font_size};
			}
			
			.mdp-coronar-country {
				color: {$accent_color};
			}
			
			.mdp-coronar-confirmed-total,
			.mdp-coronar-confirmed-new {
				color: {$confirmed_color};
			}
			
			.mdp-coronar-deaths-new,
			.mdp-coronar-deaths-total {
				color: {$deaths_color};
			}
			
			.mdp-coronar-recovered-new,
			.mdp-coronar-recovered-total {
				color: {$recovered_color};
			}
			
			.mdp-coronar-bottom {
				font-size: {$font_size};
			}

            .mdp-coronar-country-card {
            	margin: {$margin}px;
                background-color: {$bg_color};
				box-shadow: {$shadow}; 
				border-radius: {$border_radius}px;
				font-size: {$font_size};
            }
            
            .mdp-coronar-country-card .mdp-coronar-amount {
            	font-size: calc( {$flag_size}px * .75);
            	line-height: {$flag_size}px;
            	height: {$flag_size}px;
            }
            
            .mdp-coronar-country-card > div{
            	padding: {$padding}px 0 0 {$padding}px;           
            }
            
            .mdp-coronar-country-card span.mdp-coronar-card-label {
            	margin-top: calc( {$padding}px / 2 );
            	color: {$accent_color};
            }
            
            .mdp-coronar-country-card .mdp-coronar-flag-country span {
            	color: {$accent_color};
            }
            
            .mdp-coronar-country-card .mdp-coronar-stats > div {
            	padding: 0 {$padding}px {$padding}px 0;
            }
            
            .mdp-coronar-country-card .mdp-coronar-flag-country {
            	padding-bottom: {$padding}px;
            }
            
			.mdp-coronar-country-card .mdp-coronar-flag {
				min-width: {$flag_size}px;
				max-width: {$flag_size}px;
			}
				
            .mdp-coronar-country-card .mdp-coronar-flag img {
            	width: {$flag_size}px;
            	height: {$flag_size}px;
            	min-width: {$flag_size}px;
            	min-height: {$flag_size}px;
            }
            
            .mdp-coronar-summary-tbl .mdp-coronar-chart-confirmed .ct-point,
            .mdp-coronar-summary-tbl .mdp-coronar-chart-confirmed .ct-line,
            .mdp-coronar-cards-box .mdp-coronar-chart-confirmed .ct-point,
            .mdp-coronar-cards-box .mdp-coronar-chart-confirmed .ct-line {
            	stroke: {$confirmed_color};
            }
            
            .mdp-coronar-cards-box .mdp-coronar-chart-confirmed .ct-area {
            	fill: {$confirmed_color};
            }
            
            .mdp-coronar-summary-tbl .mdp-coronar-chart-deaths .ct-point,
            .mdp-coronar-summary-tbl .mdp-coronar-chart-deaths .ct-line,
            .mdp-coronar-cards-box .mdp-coronar-chart-deaths .ct-point,
            .mdp-coronar-cards-box .mdp-coronar-chart-deaths .ct-line {
            	stroke: {$deaths_color};
            }

			.mdp-coronar-cards-box .mdp-coronar-chart-deaths .ct-area {
            	fill: {$deaths_color};
            }
            
            .mdp-coronar-summary-tbl .mdp-coronar-chart-recovered .ct-point,
            .mdp-coronar-summary-tbl .mdp-coronar-chart-recovered .ct-line,
            .mdp-coronar-cards-box .mdp-coronar-chart-recovered .ct-point,
            .mdp-coronar-cards-box .mdp-coronar-chart-recovered .ct-line {
            	stroke: {$recovered_color};
            }
            
            .mdp-coronar-cards-box .mdp-coronar-chart-recovered .ct-area {
            	fill: {$recovered_color};
            }
            
            .google-visualization-tooltip {
            	border-radius: {$border_radius}px;
            	padding: {$padding}px;
            	color: {$accent_color};
            	background: {$bg_color};
            }
            
            /* RTL */
            .rtl .mdp-coronar-table-box tbody tr td:first-child {
				border-radius: 0 {$border_radius}px {$border_radius}px 0;			
			}			
			.rtl .mdp-coronar-table-box table.dtr-inline tbody tr td.mdp-coronar-last-visible {
				border-radius: {$border_radius}px 0 0 {$border_radius}px;
			}
			.rtl .mdp-coronar-table-box tbody tr td:last-child {
				border-radius: {$border_radius}px 0 0 {$border_radius}px;
			}
			.rtl table.dataTable.dtr-inline.collapsed > tbody > tr[role=\"row\"] > td:first-child:before {
				right: unset;
				left: 20px;
			}
             
        ";

	}

	/**
	 * Clear coronar cache.
	 *
	 * @return void
	 * @since 1.0.0
	 * @access public
	 **/
	public function clear_cache() {

		/** Check nonce for security. */
		check_ajax_referer( 'coronar', 'nonce' );

		/** Do we need to do a full reset? */
		if ( empty( $_POST['doClear'] ) ) {
			/** @noinspection ForgottenDebugOutputInspection */
			wp_die( 'Wrong parameter value.' ); // this is required to terminate immediately and return a proper response
		}

		/** Remove /wp-content/uploads/coronar/ folder. */
		$dir = trailingslashit( wp_upload_dir()['basedir'] ) . 'coronar';
		Helper::get_instance()->remove_directory( $dir );

		/** Return JSON result. */
		echo json_encode( true );

		/** This is required to terminate immediately and return a proper response. */
		/** @noinspection ForgottenDebugOutputInspection */
		wp_die();

	}

	/**
	 * Main Caster Instance.
	 * Insures that only one instance of Caster exists in memory at any one time.
	 *
	 * @static
     * @since 1.0.0
     * @access public
     *
	 * @return Caster
	 **/
	public static function get_instance() {

		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof self ) ) {

			self::$instance = new self;

		}

		return self::$instance;

	}

}
