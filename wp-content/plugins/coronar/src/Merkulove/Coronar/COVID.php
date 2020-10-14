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
use Merkulove\Coronar\Unity\Settings;

/** Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

/**
 * SINGLETON: Class used to implement work with covid19api.com.
 *
 * @since 1.0.0
 * @author Alexandr Khmelnytsky (info@alexander.khmelnitskiy.ua)
 **/
final class COVID {

	/**
	 * The one true COVID.
	 *
	 * @var COVID
	 * @since 1.0.0
	 **/
	private static $instance;

	/**
	 * Sets up a new COVID instance.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	private function __construct() { }

	/**
	 * Get Summary from https://api-sports.io/documentation/covid-19
	 *
	 * @since 1.0.8
	 * @access public
	 **/
	public function get_sports_summary() {

		/** Read Summary data from local JSON. */
		$summary = $this->read_sports_summary();

		/** Return false on error. */
		if ( ! $summary ) { return false; }

		$summary = json_decode( $summary, true );

		/** Remove strange countries. */
		foreach ( $summary as $key => $country ) {

			if ( in_array( $country['country'], ['--', '-Africa-', '-Asia-', '-Europe-', '-North-America-', '-Oceania-', '-South-America-', 'All', 'World'] ) ) {

				unset( $summary[$key] );

			}

		}

		$summary = json_decode( json_encode( $summary ), FALSE );

		return $summary;

	}

	/**
	 * Get Summary of new and total cases per country.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public function get_summary() {

		/** Read Summary data from local JSON. */
		$summary = $this->read_summary();

		/** Return false on error. */
		if ( ! $summary ) { return false; }

		/** Fix "Korea, South" to Korea (South). */
		$summary = $this->fix_korea_south( $summary );

		$summary = json_decode( $summary, false );

		/** Double check. */
		if ( ! is_object( $summary ) ) {
			$summary = json_decode( $summary, false );
		}

		return $summary;

	}

	/**
	 * Return Provinces of USA.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array|false
	 **/
	public function get_usa_provinces() {

		$countries = $this->read_countries();

		/** Search USA slug. */
		foreach ( $countries as $country ) {

			if ( 'United States of America' === $country->Country ) {

				$usa_provinces = $country->Provinces;

				/** Remove "US" */
				if ( ( $key = array_search( 'United States of America', $usa_provinces, true ) ) !== false ) {
					unset( $usa_provinces[$key] );
				}

				/** Remove "Recovered" */
				if ( ( $key = array_search( 'Recovered', $usa_provinces, true ) ) !== false ) {
					unset( $usa_provinces[$key] );
				}

				return $usa_provinces;

			}

		}

		return false;

	}

	public function get_USA_cases_by_province() {

		/** Can we read data from the cache or do we need to update the data? */
		$cache_option_name = 'mdp_coronar_weedmark_usa_cache';
		$update_cache = get_transient( $cache_option_name );

		/** Download data from remote host. */
		if ( false === $update_cache ) {

			/** Download and cache data from https://covid19-api.weedmark.systems/api/v1/stats?country=US */
			$this->download_weedmark_usa_cases();

			/** Refresh cache time. */
			$this->refresh_cache_time( $cache_option_name );

		}

		/** Path to cases local JSON. */
		$cases_file = trailingslashit( wp_upload_dir()['basedir'] ) . 'coronar' . DIRECTORY_SEPARATOR . 'weedmark_usa_cases.json';

		/** Download if file not found. */
		if ( ! file_exists( $cases_file ) ) {

			/** Download and cache data from https://covid19-api.weedmark.systems/api/v1/stats?country=US */
			$this->download_weedmark_usa_cases();

			/** Refresh cache time. */
			$this->refresh_cache_time( $cache_option_name );

		}

		/** Read cases data. */
		$cases = file_get_contents( $cases_file );

		$cases = json_decode( $cases, false );

		return $cases;

	}

	/**
	 * Return data for all provinces of country.
	 *
	 * @param $country_slug
	 * @param $status
	 *
	 * @since  1.0.4
	 * @access public
	 *
	 * @return object
	 **/
	public function get_live_country_status( $country_slug, $status ) {

		/** Can we read data from the cache or do we need to update the data? */
		$cache_option_name = 'mdp_coronar_' . $country_slug . '_' . $status . '_cache';
		$update_cache = get_transient( $cache_option_name );

		/** Download data from remote host. */
		if ( false === $update_cache ) {

			/** Download and cache data from https://api.covid19api.com/live/country/{country}/status/{status} */
			$this->download_live_cases( $country_slug, $status );

			/** Refresh cache time. */
			$this->refresh_cache_time( $cache_option_name );

		}

		/** Path to cases local JSON. */
		$cases_file = trailingslashit( wp_upload_dir()['basedir'] ) . 'coronar' . DIRECTORY_SEPARATOR . $status . '_' . $country_slug . '_live.json';

		/** Download if file not found. */
		if ( ! file_exists( $cases_file ) ) {

			/** Download and cache data from https://api.covid19api.com/live/country/{country}/status/{status} */
			$this->download_live_cases( $country_slug, $status );

			/** Refresh cache time. */
			$this->refresh_cache_time( $cache_option_name );

		}

		/** Read cases data. */
		$cases = file_get_contents( $cases_file );

		$cases = json_decode( $cases, true );

		return $cases;

	}

	/**
	 * Get Confirmed cases By Country From First Recorded Case.
	 *
	 * @param string $country_slug - Country slug.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array|false
	 **/
	public function get_confirmed( $country_slug ) {

		$confirmed = $this->read_cases( $country_slug, 'confirmed' );

		/** Return false on error. */
		if ( ! $confirmed ) { return false; }

		return json_decode( $confirmed, false );

	}

	/**
	 * Get Deaths cases By Country From First Recorded Case.
	 *
	 * @param string $country_slug - Country slug.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array|false
	 **/
	public function get_deaths( $country_slug ) {

		$deaths = $this->read_cases( $country_slug, 'deaths' );

		/** Return false on error. */
		if ( ! $deaths ) { return false; }

		return json_decode( $deaths, false );

	}

	/**
	 * Get Recovered cases By Country From First Recorded Case.
	 *
	 * @param string $country_slug - Country slug.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array|false
	 **/
	public function get_recovered( $country_slug ) {

		$recovered = $this->read_cases( $country_slug, 'recovered' );

		/** Return false on error. */
		if ( ! $recovered ) { return false; }

		return json_decode( $recovered, false );

	}

	/**
	 * Read Cases By Country From First Recorded Case data from local JSON.
	 *
	 * @param string $country_slug
	 * @param string $case
	 *
	 * @since  1.0.0
	 * @access public
	 * @return mixed
	 **/
	private function read_cases( $country_slug, $case ) {

		/** Can we read data from the cache or do we need to update the data? */
		$cache_option_name = 'mdp_coronar_' . $case . '_' . $country_slug . '_cache';
		$update_cache = get_transient( $cache_option_name );

		/** Download data from remote host. */
		if ( false === $update_cache ) {

			/** Download and cache data from https://api.covid19api.com/total/dayone/country/{country}/status/{status} */
			$this->download_cases( $country_slug, $case );

			/** Refresh cache time. */
			$this->refresh_cache_time( $cache_option_name );

		}

		/** Path to Countries local JSON. */
		$countries_file = trailingslashit( wp_upload_dir()['basedir'] ) . 'coronar' . DIRECTORY_SEPARATOR . $case . '_' . $country_slug . '.json';

		/** Download if file not found. */
		if ( ! file_exists( $countries_file ) ) {

			/** Download and cache data from https://api.covid19api.com/total/dayone/country/{country}/status/{status} */
			$this->download_cases( $country_slug, $case );

			/** Refresh cache time. */
			$this->refresh_cache_time( $cache_option_name );

		}

		/** Read cases data. */
		return file_get_contents( $countries_file );

	}

	/**
	 * Get country slug.
	 *
	 * @param $country_name
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 **/
	public function get_country_slug( $country_name ) {

		$countries = $this->read_countries();

		/** Search country slug. */
		foreach ( $countries as $country ) {

			if ( $country->Country === $country_name ) {

				return $country->Slug;

			}

		}

		/** Nothing found. */
		return '';

	}

	/**
	 * Read Countries data from local JSON.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public function read_countries() {

		/** Can we read data from the cache or do we need to update the data? */
		$cache_option_name = 'mdp_coronar_countries_cache';
		$update_cache = get_transient( $cache_option_name );

		/** Download data from remote host. */
		if ( false === $update_cache ) {

			/** Download and cache Countries data from https://api.covid19api.com/countries */
			$this->download_countries();

			/** Refresh cache time. */
			$this->refresh_cache_time( $cache_option_name );

		}

		/** Path to Countries local JSON. */
		$countries_file = trailingslashit( wp_upload_dir()['basedir'] ) . 'coronar' . DIRECTORY_SEPARATOR . 'countries.json';

		/** Download if file not found. */
		if ( ! file_exists( $countries_file ) ) {

			/** Download and cache Countries data from https://api.covid19api.com/countries */
			$this->download_countries();

			/** Refresh cache time. */
			$this->refresh_cache_time( $cache_option_name );

		}

		/** Read the countries data. */
		$countries = file_get_contents( $countries_file );
		$countries = json_decode( $countries, false );

		/** Clear data. */
		foreach ( $countries as $key => $country ) {

			$country->Country = trim( $country->Country );

			if ( empty( $country->Country ) ) {
				unset( $countries[$key] );
			}

			if ( 'Others' === $country->Country ) {
				unset( $countries[$key] );
			}

		}

		return $countries;

	}

	/**
	 * Refresh cache time.
	 *
	 * @param string $option_name
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 **/
	private function refresh_cache_time( $option_name ) {

		/** Refresh cache time. */
		set_transient( $option_name, '1', ( Settings::get_instance()->options['cache_time'] * 60 ) );

	}

	/**
	 * Fix "Korea, South" to Korea (South).
	 *
	 * @param string $summary
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return string
	 **/
	private function fix_korea_south( $summary ) {

		return str_replace( 'Korea, South', 'Korea (South)', $summary );

	}

	/**
	 * Read Summary data from local JSON.
	 *
	 * @since 1.0.8
	 * @access public
	 **/
	private function read_sports_summary() {

		/** Can we read data from the cache or do we need to update the data? */
		$cache_option_name = 'mdp_coronar_sports_summary_cache';
		$update_cache = get_transient( $cache_option_name );

		/** Download data from remote host. */
		if ( false === $update_cache ) {

			/** Download and cache Summary data from https://covid-193.p.rapidapi.com/statistics. */
			$this->download_sports_summary();

			/** Refresh cache time. */
			$this->refresh_cache_time( $cache_option_name );

		}

		/** Path to Summary local JSON. */
		$summary_file = trailingslashit( wp_upload_dir()['basedir'] ) . 'coronar' . DIRECTORY_SEPARATOR . 'sports_summary.json';

		/** Return Error if file not found. */
		if ( ! file_exists( $summary_file ) ) {

			/** Download and cache Summary data from https://covid-193.p.rapidapi.com/statistics. */
			$this->download_sports_summary();

			/** Refresh cache time. */
			$this->refresh_cache_time( $cache_option_name );

		}

		/** Read the summary data. */
		return file_get_contents( $summary_file );

	}

	/**
	 * Read Summary data from local JSON.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	private function read_summary() {

		/** Can we read data from the cache or do we need to update the data? */
		$cache_option_name = 'mdp_coronar_summary_cache';
		$update_cache = get_transient( $cache_option_name );

		/** Download data from remote host. */
		if ( false === $update_cache ) {

			/** Download and cache Summary data from https://api.covid19api.com/summary. */
			$this->download_summary( $cache_option_name );

		}

		/** Path to Summary local JSON. */
		$summary_file = trailingslashit( wp_upload_dir()['basedir'] ) . 'coronar' . DIRECTORY_SEPARATOR . 'summary.json';

		/** Return Error if file not found. */
		if ( ! file_exists( $summary_file ) ) {

			/** Download and cache Summary data from https://api.covid19api.com/summary. */
			$this->download_summary( $cache_option_name );

		}

		/** Read Summary data from local JSON. */
		$summary = file_get_contents( $summary_file );
		$summary = json_decode( $summary, false );

		if ( ! empty( $summary->success ) && false === $summary->success ) {

			/** Download and cache Summary data from https://api.covid19api.com/summary. */
			$this->download_summary( $cache_option_name );

		}

		/** Read the summary data. */
		return file_get_contents( $summary_file );

	}

	/**
	 * Download and cache data from https://covid19-api.weedmark.systems/api/v1/stats?country=US
	 *
	 * @since  1.0.8
	 * @access public
	 * @return bool
	 **/
	private function download_weedmark_usa_cases() {

		/** Returns all cases by province for USA. */
		$cases = Helper::get_instance()->get_remote( 'https://covid19-api.weedmark.systems/api/v1/stats?country=US' );

		/** Error. */
		if ( ! $cases ) { return false; }

		/** Path to Countries local JSON. */
		$cases_file = trailingslashit( wp_upload_dir()['basedir'] ) . 'coronar' . DIRECTORY_SEPARATOR . 'weedmark_usa_cases.json';

		/** Instantiate the WordPress filesystem. */
		Helper::init_filesystem();

		/** Combine data by Province. */
		$cases = json_decode( $cases, false );
		$new_cases = [];
		foreach ( $cases->data->covid19Stats as $item ) {

			if ( 'Recovered' === $item->province ) { continue; }

			if ( array_key_exists( $item->province, $new_cases ) ) {

				$new_cases[$item->province]['confirmed']  += (int) $item->confirmed;
				$new_cases[$item->province]['deaths']     += (int) $item->deaths;
				$new_cases[$item->province]['recovered']  += (int) $item->recovered;

			} else {

				$new_cases[$item->province] = [
					'confirmed' => (int) $item->confirmed,
					'deaths'    => (int) $item->deaths,
					'recovered' => (int) $item->recovered,
				];

			}

		}

		/** Write to file. */
		return Helper::get_instance()->write_file( $cases_file, json_encode( $new_cases ) );

	}

	/**
	 * Download and cache data from https://api.covid19api.com/live/country/{country}/status/{status}
	 *
	 * @param $country_slug
	 * @param $status
	 *
	 * @since  1.0.0
	 * @access public
	 * @return bool
	 **/
	private function download_live_cases( $country_slug, $status ) {

		/** Returns all cases by case type for a country from the first recorded case with the latest record being the live count. */
		$cases = Helper::get_instance()->get_remote( 'https://api.covid19api.com/live/country/' . $country_slug . '/status/' . $status );

		/** Error. */
		if ( ! $cases ) { return false; }

		/** Path to Countries local JSON. */
		$cases_file = trailingslashit( wp_upload_dir()['basedir'] ) . 'coronar' . DIRECTORY_SEPARATOR . $status . '_' . $country_slug . '_live.json';

		/** Instantiate the WordPress filesystem. */
		Helper::init_filesystem();

		/** Write to file. */
		return Helper::get_instance()->write_file( $cases_file, $cases );

	}

	/**
	 * Download and cache data from https://api.covid19api.com/total/dayone/country/{country}/status/{status}
	 *
	 * @param $country_slug
	 * @param $case
	 *
	 * @since  1.0.0
	 * @access public
	 * @return bool
	 **/
	private function download_cases( $country_slug, $case ) {

		/** Returns all countries and associated provinces. The country_slug variable is used for country specific data. */
		$cases = Helper::get_instance()->get_remote( 'https://api.covid19api.com/total/dayone/country/' . $country_slug . '/status/' . $case );

		/** Error. */
		if ( ! $cases ) { return false; }

		/** Path to Countries local JSON. */
		$cases_file = trailingslashit( wp_upload_dir()['basedir'] ) . 'coronar' . DIRECTORY_SEPARATOR . $case . '_' . $country_slug . '.json';

		/** Instantiate the WordPress filesystem. */
		Helper::init_filesystem();

		/** Write to file. */
		return Helper::get_instance()->write_file( $cases_file, $cases );

	}

	/**
	 * Download and cache Countries data from https://api.covid19api.com/countries.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	private function download_countries() {

		/** Returns all countries and associated provinces. The country_slug variable is used for country specific data. */
		$countries = Helper::get_instance()->get_remote( 'https://api.covid19api.com/countries' );

		/** Error. */
		if ( ! $countries ) { return false; }

		/** Path to Countries local JSON. */
		$countries_file = trailingslashit( wp_upload_dir()['basedir'] ) . 'coronar' . DIRECTORY_SEPARATOR . 'countries.json';

		/** Instantiate the WordPress filesystem. */
		Helper::init_filesystem();

		/** Write to file. */
		return Helper::get_instance()->write_file( $countries_file, $countries );

	}

	/**
	 * Download and cache Summary data from https://covid-193.p.rapidapi.com/statistics.
	 *
	 * @since 1.0.8
	 * @access public
	 **/
	private function download_sports_summary() {

		$curl = curl_init();

		/** @noinspection SpellCheckingInspection */
		curl_setopt_array( $curl, [
			CURLOPT_URL             => "https://covid-193.p.rapidapi.com/statistics",
			CURLOPT_RETURNTRANSFER  => true,
			CURLOPT_FOLLOWLOCATION  => true,
			CURLOPT_ENCODING        => "",
			CURLOPT_MAXREDIRS       => 10,
			CURLOPT_TIMEOUT         => 30,
			CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST   => "GET",
			CURLOPT_HTTPHEADER      => [
				"x-rapidapi-host: covid-193.p.rapidapi.com",
				"x-rapidapi-key: d525390eebmsh0a9ed8677d94754p1e51c9jsned4e9c107efd"
			],
		] );

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ( $err ) {

			esc_html_e( 'cURL Error #: ', 'coronar' );
			esc_html_e( $err );

			return false;

		}

		$response = json_decode( $response, false );

		/** Path to Summary local JSON. */
		$summary_file = trailingslashit( wp_upload_dir()['basedir'] ) . 'coronar' . DIRECTORY_SEPARATOR . 'sports_summary.json';

		/** Instantiate the WordPress filesystem. */
		Helper::init_filesystem();

		/** Write to file. */
		return Helper::get_instance()->write_file( $summary_file, json_encode( $response->response ) );

	}

	/**
	 * Download and cache Summary data from https://api.covid19api.com/summary.
	 *
	 * @param $cache_option_name
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return bool
	 **/
	private function download_summary( $cache_option_name ) {

		/** A summary of new and total cases per country. */
		$summary = Helper::get_instance()->get_remote( 'https://api.covid19api.com/summary' );

		/** Error. */
		if ( ! $summary ) { return false; }

		/** Path to Summary local JSON. */
		$summary_file = trailingslashit( wp_upload_dir()['basedir'] ) . 'coronar' . DIRECTORY_SEPARATOR . 'summary.json';

		/** Instantiate the WordPress filesystem. */
		Helper::init_filesystem();

		/** Refresh cache time. */
		$this->refresh_cache_time( $cache_option_name );

		/** Write to file. */
		return Helper::get_instance()->write_file( $summary_file, $summary );

	}

	/**
	 * Main COVID Instance.
	 *
	 * Insures that only one instance of COVID exists in memory at any one time.
	 *
	 * @static
	 * @since 1.0.0
	 *
	 * @return COVID
	 **/
	public static function get_instance() {

		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof self ) ) {

			self::$instance = new self;

		}

		return self::$instance;

	}

} // End Class COVID.
