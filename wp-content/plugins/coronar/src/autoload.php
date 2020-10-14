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

/** Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
    header( 'Status: 403 Forbidden' );
    header( 'HTTP/1.1 403 Forbidden' );
    exit;
}

/**
 * Autoload class used to register custom __autoload() implementation for plugin.
 *
 * @since 1.0.0
 * @author Alexandr Khmelnytsky (info@alexander.khmelnitskiy.ua)
 **/
final class Autoload {

    /**
     * Plugin root Namespace.
     *
     * @since 1.0.0
     * @var string
     **/
    private static $namespace = 'Merkulove\\';

    /**
     * Shorthand for DIRECTORY_SEPARATOR.
     * Brevity is the Soul of Wit.
     *
     * @since 1.0.0
     * @var string
     **/
    private static $DS = DIRECTORY_SEPARATOR;

    /**
     * Custom autoloader for plugin.
     *
     * @param string $class - Called class name.
     *
     * @static
     * @since  1.0.0
     * @access public
     *
     * @return void
     **/
    public static function load( $class ) {

        /** Bail if the class is not in our namespace. */
        if ( 0 !== strpos( $class, self::$namespace ) ) { return; }

        /** Classes from Coronar. */
        $file_p = self::get_plugin_class_file( $class );

        /** If Class exists in Coronar - load it. */
        self::include_class( $file_p );

        /** Classes from Unity. */
        $file_u = self::get_unity_class_file( $class );

        /** Secondly we load classes from Unity. */
        self::include_class( $file_u );

    }

    /**
     * Build file path for classes from Unity directory.
     *
     * @param string $class - Called class name.
     *
     * @static
     * @since  1.0.0
     * @access private
     *
     * @return string - Path to class file.
     **/
    private static function get_unity_class_file( $class ) {

        /** Build the filename. */
        $file = realpath( __DIR__ );

        return $file . self::$DS . str_replace( ['Coronar\\', '\\'], ['', self::$DS], $class ) . '.php';

    }

    /**
     * Build file path for classes from Coronar directory.
     *
     * @param string $class - Called class name.
     *
     * @static
     * @since  1.0.0
     * @access private
     *
     * @return string - Path to class file.
     **/
    private static function get_plugin_class_file( $class ) {

        /** Build the filename. */
        $file = realpath( __DIR__ );

        return $file . self::$DS . str_replace( '\\', self::$DS, $class ) . '.php';

    }

    /**
     * Includes and evaluates the specified file only once.
     *
     * @param string $file - Path to class file.
     *
     * @static
     * @since  1.0.0
     * @access private
     *
     * @return string - Path to class file.
     **/
    private static function include_class( $file ) {

        /** If Class file exists - load it. */
        if ( file_exists( $file ) ) {

            /** @noinspection PhpIncludeInspection */
            include_once( $file );

        }

    }

}

/** Register plugin custom autoloader. */
spl_autoload_register( __NAMESPACE__ .'\Autoload::load' );

