<?php
/** 
 * Opinioner plugin allows you to ask questions to readers of articles and evaluates the answers.
 * Exclusively on Envato Market: https://1.envato.market/opinioner
 * 
 * @encoding     UTF-8
 * @version      1.0.0
 * @copyright    Copyright (C) 2019 Merkulove ( https://merkulov.design/ ). All rights reserved.
 * @license      Envato Standard License https://1.envato.market/KYbje
 * @author       Alexandr Khmelnytsky (info@alexander.khmelnitskiy.ua)
 * @support      dmitry@merkulov.design
 **/

/** Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
    header( 'Status: 403 Forbidden' );
    header( 'HTTP/1.1 403 Forbidden' );
    exit;
}

if ( ! class_exists( 'MDPHelper' ) ) :
    
    /**
     * SINGLETON: Class used to implement base plugin features.
     *
     * @since 1.0.0
     * @author Alexandr Khmelnytsky (info@alexander.khmelnitskiy.ua)
     */
    final class MDPHelper {

        /**
         * The one true MDPHelper.
         * 
	 * @var MDPHelper
	 * @since 1.0.0
	 **/
	private static $instance;
        
        /**
         * Sets up a new MDPHelper instance.
         *
         * @since 1.0.0
         * @access public
         **/
        private function __construct() {
            
            /** Add plugin links. */
            add_filter( 'plugin_action_links_' . Opinioner::$basename, [$this, 'add_links'] );
            
            /** Add plugin meta. */
            add_filter( 'plugin_row_meta', [$this, 'add_row_meta'], 10, 2 );
            
            /** Load JS and CSS for Backend Area. */
            $this->enqueue_backend();
            
        }
        
        /**
         * Load JS and CSS for Backend Area.
         *
         * @since 1.0.0
         * @access public
         **/
        function enqueue_backend() {
            
            /** Add admin styles. */
            add_action( 'admin_enqueue_scripts', [$this, 'add_admin_styles'] );
            
            /** Add admin javascript. */
            add_action( 'admin_enqueue_scripts', [$this, 'add_admin_scripts'] );
            
        }
        
        /**
         * Add CSS for admin area.
         *
         * @since   1.0.0
         * @return void
         **/
        public function add_admin_styles( $hook ) {
            
            $screen = get_current_screen();
            
            /** Add styles only on WP Plugins page. */
            if ( $screen->base == 'plugins' ) {
                wp_enqueue_style( 'mdp-opinioner-plugins', Opinioner::$url . 'css/plugins' . Opinioner::$suffix . '.css', [], Opinioner::VERSION );   
            }
            
        }
        
        /**
         * Add JS for admin area.
         *
         * @since   1.0.0
         * @return void
         **/
        public function add_admin_scripts( $hook ) {
            
            $screen = get_current_screen();
            
            /** Add scripts only on WP Plugins page. */
            if ( $screen->base == 'plugins' ) {   
                wp_enqueue_script( 'mdp-opinioner-plugins', Opinioner::$url . 'js/plugins' . Opinioner::$suffix . '.js', ['jquery'], Opinioner::VERSION, true );
            }
        }
        
        /**
         * Add "merkulov.design" and  "Envato Profile" links on plugin page.
         *
         * @since 1.0.0
         * @access public
         *
         * @param array $links Current links: Deactivate | Edit
         **/
        public function add_links($links) {

            array_unshift( $links, '<a title="' . esc_html__( 'Settings', 'opinioner' ) . '" href="'. admin_url( 'edit.php?post_type=opinioner&page=mdp_opinioner_settings' ) .'">' . esc_html__( 'Settings', 'opinioner' ) . '</a>' );
            array_push( $links, '<a title="' . esc_html__( 'Documentation', 'opinioner' ) . '" href="https://docs.merkulov.design/tag/opinioner/" target="_blank">' . esc_html__( 'Documentation', 'opinioner' ) . '</a>' );
            array_push( $links, '<a href="https://1.envato.market/cc-merkulove" target="_blank" class="cc-merkulove"><img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPHN2ZyB2aWV3Qm94PSIwIDAgMTE3Ljk5IDY3LjUxIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8ZGVmcz4KPHN0eWxlPi5jbHMtMSwuY2xzLTJ7ZmlsbDojMDA5ZWQ1O30uY2xzLTIsLmNscy0ze2ZpbGwtcnVsZTpldmVub2RkO30uY2xzLTN7ZmlsbDojMDA5ZWUyO308L3N0eWxlPgo8L2RlZnM+CjxjaXJjbGUgY2xhc3M9ImNscy0xIiBjeD0iMTUiIGN5PSI1Mi41MSIgcj0iMTUiLz4KPHBhdGggY2xhc3M9ImNscy0yIiBkPSJNMzAsMmgwQTE1LDE1LDAsMCwxLDUwLjQ4LDcuNUw3Miw0NC43NGExNSwxNSwwLDEsMS0yNiwxNUwyNC41LDIyLjVBMTUsMTUsMCwwLDEsMzAsMloiLz4KPHBhdGggY2xhc3M9ImNscy0zIiBkPSJNNzQsMmgwQTE1LDE1LDAsMCwxLDk0LjQ4LDcuNUwxMTYsNDQuNzRhMTUsMTUsMCwxLDEtMjYsMTVMNjguNSwyMi41QTE1LDE1LDAsMCwxLDc0LDJaIi8+Cjwvc3ZnPgo=" alt="' . esc_html__( 'Plugins', 'speaker' ) . '">' . esc_html__( 'Plugins', 'speaker' ) . '</a>');

            return $links;
        }
                
        /**
         * Add "Rate us" link on plugin page.
         *
         * @since 1.0.0
         * @access public
         *
         * @param array $links Current links: Deactivate | Edit
         **/
        public function add_row_meta( $links, $file ) {
            
            if ( Opinioner::$basename !== $file ) {
                return $links;
            }

            $links[] = esc_html__( 'Rate this plugin:', 'opinioner' )
                . "<span class='mdp-opinioner-rating-stars'>"
                . "     <a href='https://1.envato.market/cc-downloads' target='_blank'>"
                . "         <span class='dashicons dashicons-star-filled'></span>"
                . "     </a>"
                . "     <a href='https://1.envato.market/cc-downloads' target='_blank'>"
                . "         <span class='dashicons dashicons-star-filled'></span>"
                . "     </a>"
                . "     <a href='https://1.envato.market/cc-downloads' target='_blank'>"
                . "         <span class='dashicons dashicons-star-filled'></span>"
                . "     </a>"
                . "     <a href='https://1.envato.market/cc-downloads' target='_blank'>"
                . "         <span class='dashicons dashicons-star-filled'></span>"
                . "     </a>"
                . "     <a href='https://1.envato.market/cc-downloads' target='_blank'>"
                . "         <span class='dashicons dashicons-star-filled'></span>"
                . "     </a>"
                . "<span>";

            return $links;
        }
        
        /**
         * Main MDPHelper Instance.
         *
         * Insures that only one instance of MDPHelper exists in memory at any one time.
         *
         * @static
         * @return MDPHelper
         * @since 1.0.0
         **/
        public static function get_instance() {
            
            if ( ! isset( self::$instance ) && ! ( self::$instance instanceof MDPHelper ) ) {
                self::$instance = new MDPHelper();
            }

            return self::$instance;
            
        }
        
        /**
	 * Throw error on object clone.
	 *
	 * The whole idea of the singleton design pattern is that there is a single
	 * object therefore, we don't want the object to be cloned.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @return void
	 **/
	public function __clone() {
            
            /** Cloning instances of the class is forbidden. */
            _doing_it_wrong( __FUNCTION__, esc_html__( 'The whole idea of the singleton design pattern is that there is a single object therefore, we don\'t want the object to be cloned.', 'opinioner' ), Opinioner::VERSION );
            
	}

        /**
	 * Disable unserializing of the class.
         * 
         * The whole idea of the singleton design pattern is that there is a single
	 * object therefore, we don't want the object to be unserialized.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @return void
	 **/
	public function __wakeup() {
            
            /** Unserializing instances of the class is forbidden. */
            _doing_it_wrong( __FUNCTION__, esc_html__( 'The whole idea of the singleton design pattern is that there is a single object therefore, we don\'t want the object to be unserialized.', 'opinioner' ), Opinioner::VERSION );
            
	}
        
    
    } // End Class MDPHelper.

endif; // End if class_exists check.