<?php
/**
 * Plugin Name: Opinioner
 * Plugin URI: https://1.envato.market/opinioner
 * Description: Most effective way to protect your online content from being copy.
 * Author: Merkulove
 * Version: 1.0.0
 * Author URI: https://1.envato.market/cc-merkulove
 **/

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

if ( ! class_exists( 'Opinioner' ) ) :
    
    /**
     * SINGLETON: Core class used to implement a Opinioner plugin.
     *
     * This is used to define internationalization, admin-specific hooks, and
     * public-facing site hooks.
     *
     * @since 1.0.0
     */
    final class Opinioner {
    
        /** Plugin version.
         *
         * @var Constant
         * @since 1.0.0
         **/
        const VERSION = '1.0.0';
        
        /**
         * Opinioner Plugin settings.
         * 
	 * @var array()
	 * @since 1.0.0
	 **/
        public $options = [];
        
        /**
         * Helpers objects.
         * 
	 * @var array()
	 * @since 1.0.0
	 **/
        public $helpers = [];
        
        /**
         * Use minified libraries if SCRIPT_DEBUG is turned off.
         * 
	 * @since 1.0.0
	 **/
        public static $suffix = '';
        
        /**
         * URL (with trailing slash) to plugin folder.
         * 
	 * @var string
	 * @since 1.0.0
	 **/
        public static $url = '';
        
        /**
         * PATH to plugin folder.
         * 
	 * @var string
	 * @since 1.0.0
	 **/
        public static $path = '';
        
        /**
         * Plugin base name.
         * 
	 * @var string
	 * @since 1.0.0
	 **/
        public static $basename = '';
        
        /**
         * Opinioner Post Type name.
         * 
	 * @var string
	 * @since 1.0.0
	 **/
        const POST_TYPE = 'opinioner';
        
        /**
         * The one true Opinioner.
         * 
	 * @var Opinioner
	 * @since 1.0.0
	 **/
	private static $instance;
        
        /**
         * Sets up a new plugin instance.
         *
         * @since 1.0.0
         * @access public
         **/
        private function __construct() {

            /** Initialize main variables. */
            $this->init();
            
            /** Add plugin settings page. */
            $this->add_settings_page();

            /** Load JS and CSS for Backend Area. */
            $this->enqueue_backend();
            
            /** Load JS and CSS for Fronend Area. */
            //$this->enqueue_fronend();
            
            /** Loads plugin helpers. */
            $this->load_helpers();

        }
        
        /**
         * Register Opinioner post type.
         *
         * @since 1.0.0
         * @access public
         **/
        public function register_post_type() {
            
            register_post_type( self::POST_TYPE, [
                'public' => TRUE,
                'labels' => [
                    'name' => __( 'Opinions', 'opinioner' ),
                    'singular_name' => __( 'Opinion', 'opinioner'),
                    'add_new' => __('Add New Opinion', 'opinioner'),
                    'add_new_item' => __('Add New Opinion', 'opinioner'),
                    'edit_item' => __('Edit Opinion', 'opinioner'),
                    'new_item' => __('New Opinion', 'opinioner'),
                    'view_item' => __('View Opinion', 'opinioner'),
                    'view_items' => __('View Opinions', 'opinioner'),
                    'search_items' => __('Search Opinions', 'opinioner'),
                    'not_found' => __('No Opinions found', 'opinioner'),
                    'not_found_in_trash' => __('No Opinions found in Trash', 'opinioner'),
                    'all_items' => __('All Opinions', 'opinioner'),
                    'archives' => __('Opinion Archives', 'opinioner'),
                    'attributes' => __('Opinion Attributes', 'opinioner'),
                    'insert_into_item' => __('Insert into Opinion', 'opinioner'),
                    'uploaded_to_this_item' => __('Uploaded to this Opinion', 'opinioner'),
                    'featured_image' => __('Opinion Image', 'opinioner'),
                    'set_featured_image' => __('Set Opinion image', 'opinioner'),
                    'remove_featured_image' => __('Remove Opinion image', 'opinioner'),
                    'use_featured_image' => __('Use as Opinion image', 'opinioner'),
                    'menu_name' => __('Opinioner', 'opinioner')
                ],
                'menu_icon' => $this->get_svg_icon(),
                'exclude_from_search' => TRUE,
                'publicly_queryable' => FALSE,
                'menu_position' => FALSE,
                'show_in_rest' => TRUE,
                'rest_base' => 'opinioner',
                'supports' => ['title', 'excerpt', 'thumbnail']
            ] );
        }
        
        /**
         * Return base64 encoded SVG icon.
         *
         * @since 1.0.0
         * @access public
         **/
        public function get_svg_icon() {
            
            $svg = file_get_contents( self::$path . 'images/icon.svg' );

            return 'data:image/svg+xml;base64,' . base64_encode( $svg );
        }

        /**
         * Load JS and CSS for Backend Area.
         *
         * @since 1.0.0
         * @access public
         **/
        function enqueue_backend() {
            
            /** Add admin styles. */
            add_action( 'admin_enqueue_scripts', [$this, 'load_admin_styles'] );
            
            /** Add admin javascript. */
            add_action( 'admin_enqueue_scripts', [$this, 'load_admin_scripts'] );
            
        }
        
        /**
         * Load JS and CSS for Fronend Area.
         *
         * @since 1.0.0
         * @access public
         **/
        function enqueue_fronend() {
            
            /** Add plugin script. */
            add_action( 'wp_enqueue_scripts', [$this, 'load_scripts'] );
            
        }

        /**
         * Initialize main variables.
         *
         * @since 1.0.0
         * @access public
         **/
        public function init() {
            
            /** Gets the plugin URL (with trailing slash). */
            self::$url = plugin_dir_url( __FILE__ );
            
            /** Gets the plugin PATH. */
            self::$path = plugin_dir_path( __FILE__ );
            
            /** Use minified libraries if SCRIPT_DEBUG is turned off. */
            self::$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
            
            /** Set plugin basename. */
            self::$basename = plugin_basename( __FILE__ );
            
            /** Load translation. */
            add_action( 'plugins_loaded', [$this, 'load_textdomain'] );
            
            /** Get plugin settings. */
            $this->get_options();
            
            /** Registers Opinioner post type. */
            add_action( 'init', [$this, 'register_post_type'] );
            
            /** Add REST API support to Opinioner post type. */
            add_action( 'init', [$this, 'add_rest_support'], 25 );
            
            /**
             * Since WP 4.7, filter has been removed from WP-API. I have no idea why.
             * Add the necessary filter to each post type.
             **/
            add_action( 'rest_api_init', [$this, 'rest_api_filter_add_filters'] );
            
            /** Create editor button for shortcode. */
            add_action( 'init', [$this, 'add_button'] );
            
            /** Add Shortcode column to votes list. */
            add_filter( 'manage_' . self::POST_TYPE . '_posts_columns', [$this, 'add_head_shortcode_column'], 10 );
            add_action( 'manage_' . self::POST_TYPE . '_posts_custom_column', [$this, 'add_content_shortcode_column'], 10, 2 );
            
            /** Fire meta box setup on the post editor screen. */
            add_action( 'load-post.php', [$this, 'meta_boxes_setup'] );
            add_action( 'load-post-new.php', [$this, 'meta_boxes_setup'] );
            
            /** Remove unnecessary metaboxes. */
            add_action( 'edit_form_after_title', [$this, 'remove_unnecessary_metaboxes'], 100 );
            
            /** Create [opinioner id="ID"] shorcode. */
            add_shortcode( 'opinioner', [$this, 'opinioner_shortcode'] );
            
            /** Add plugin css and js if post has shortcode. */
            add_action( 'the_posts', [$this, 'enqueue_shortcode_styles'] );
            
            /** Creating opinioner table. */
            add_action( 'init', [$this, 'register_opinioner_table'], 1 );
            add_action( 'switch_blog', [$this, 'register_opinioner_table'] );
            register_activation_hook(__FILE__, [$this, 'create_opinioner_table'] );
            
            /** Add action to AJAX process vote. */
            add_action( 'wp_ajax_process_vote', [$this, 'process_vote'] );
            add_action( 'wp_ajax_nopriv_process_vote', [$this, 'process_vote'] );
            
            /** Clear votes on remove vote post. */
            add_action( 'before_delete_post', [$this, 'before_delete_vote_post'] );
            
            /** Print Open Graph tags */
            add_action( 'wp_head', [$this, 'open_graph_print'] );

            /** Handle Open Graph canonical URL */
            add_filter( 'get_canonical_url', [$this, 'open_graph_canonical_url'], 50, 1 );
            
        }
        
        /**
         * Add Open Graph tags to head.
         *
         * @since 1.0.0
         * @access public
         **/
        public function open_graph_print() {
            
            $vote = $this->get_vote( isset($_GET['voteid'] ) ? (int) $_GET['voteid'] : 0 );
            if ( ! $vote ) { return; }

            $thumbnail_url = get_the_post_thumbnail_url( $vote );
            $title = trim( $vote->post_title );
            $description = trim( $vote->post_excerpt );

            if ( $title ) { ?><meta property="og:title" content="<?php esc_attr_e( $title ); ?>" /><?php }
            
            if ( $description ) { ?><meta property="og:description" content="<?php esc_attr_e( $description ); ?>" /><?php }
            
            if ( $thumbnail_url ) { ?><meta property="og:image" content="<?php esc_attr_e( $thumbnail_url ); ?>" /><?php }
            
        }
        
        /**
         * Handle Open Graph canonical URL.
         *
         * @since 1.0.0
         * @access public
         **/
        public function open_graph_canonical_url($canonical_url) {
            
            $vote = $this->get_vote( isset( $_GET['voteid'] ) ? (int) $_GET['voteid'] : 0 );
            
            if ( ! $vote ) {
                return $canonical_url;
            }
            
            return add_query_arg( 'voteid', $vote->ID, $canonical_url );
        }

        /**
         * Clear votes after remove vote post.
         *
         * @since 1.0.0
         * @access public
         **/
        public function before_delete_vote_post($post_id) {
            global $wpdb;

            /** Work only with opinioner post type. */
            if ( get_post_type( $post_id ) != self::POST_TYPE ) { 
                return;
            }

            $res = $wpdb->delete( $wpdb->opinioner, ['vote_id' => $post_id] );

            return $res;
        }

        /**
         * AJAX Add vote.
         * Users can vote 10 times from 1 IP in 24 hours.
         *
         * @since 1.0.0
         * @access public
         **/
        public function process_vote() {
            
            $is_new_vote = boolval( $_POST['new_vote'] );
            $vote_id = intval( $_POST['vote_id'] );
            $vote_val = intval( $_POST['vote_val'] );
            $user_ip = sanitize_text_field( $this->get_ip() );
            $guid = sanitize_text_field( $_POST['guid'] );
            $created = gmdate( 'Y-m-d H:i:s' );
            $modified = gmdate( 'Y-m-d H:i:s' );

            /** New Vote. */
            if ( $is_new_vote ) {
                
                /** Check limits to vote from this IP. */
                if ( $this->check_votes_limits( $vote_id, $user_ip ) ) {
                    
                    /** Insert vote in table. */
                    $this->insert_vote( $vote_id, $vote_val, $user_ip, $guid, $created, $modified );
                    
                } else {
                    
                    /** Exceeded the limit of votes from one IP. */
                    echo json_encode( ['status' => 0, 'message' => esc_html_e( 'Exceeded the limit of votes from one IP.', 'opinioner' ) ] );
                    wp_die(); // Required to terminate immediately and return a proper response.
                }
                
            /** User alredy voted. */
            } else {
                /** Check limits to vote from this IP. */
                if ( $this->check_votes_limits( $vote_id, $user_ip ) ) {
                    
                    /** Update previous vote. */
                    $this->update_vote( $vote_id, $vote_val, $user_ip, $guid, $modified );
                } else {
                    
                    /** Exceeded the limit of votes from one IP. */
                    echo json_encode( ['status' => 0, 'message' => esc_html_e( 'Exceeded the limit of votes from one IP.', 'opinioner' ) ] );
                    wp_die(); // Required to terminate immediately and return a proper response.
                }
            }

            // All OK
            echo json_encode( ['status' => 1, 'is_new_vote' => $is_new_vote] );
            
            wp_die(); // Required to terminate immediately and return a proper response.
        }
        
        /**
         * Update existing vote value.
         *
         * @param $vote_id
         * @param $vote_val
         * @param $user_ip
         * @param $guid
         * @param $modified
         * @return false|int
         **/
        public function update_vote( $vote_id, $vote_val, $user_ip, $guid, $modified ) {
            global $wpdb;

            $res = $wpdb->update(
                $wpdb->opinioner, ['value' => $vote_val, 'ip' => $user_ip, 'modified' => $modified], ['vote_id' => $vote_id, 'guid' => $guid], ['%d', '%s', '%s'], ['%d', '%s']
            );

            return $res;
        }

        /**
         * Insert new vote value.
         *
         * @param $vote_id
         * @param $vote_val
         * @param $user_ip
         * @param $guid
         * @param $created
         * @param $modified
         * @return int
         **/
        public function insert_vote( $vote_id, $vote_val, $user_ip, $guid, $created, $modified ) {
            global $wpdb;

            $wpdb->insert(
                $wpdb->opinioner, ['vote_id' => $vote_id, 'value' => $vote_val, 'ip' => $user_ip, 'guid' => $guid, 'created' => $created, 'modified' => $modified], ['%d', '%d', '%s', '%s', '%s', '%s']
            );

            return $wpdb->insert_id;
        }

        /**
         * Users can vote 10 times from 1 IP in 24 hours.
         *
         * @param $vote_id
         * @param string $ip
         * @return bool
         **/
        public function check_votes_limits( $vote_id, $ip ) {
            global $wpdb;

            $res = $wpdb->get_results(
                $wpdb->prepare("
                    SELECT * FROM $wpdb->opinioner
                    WHERE ($wpdb->opinioner.modified > DATE_SUB(NOW(), INTERVAL 24 HOUR)) AND vote_id = %d AND ip = %s", 
                    [$vote_id, $ip]
                )
            );

            if ( count( $res ) > 9 ) {
                return false;
            }

            return true;
        }

        /**
         * Get user IP.
         *
         * @since 1.0.0
         * @access public
         **/
        public function get_ip() {
            
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR']; //to check ip passed from proxy
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }

            /** Add some validation. */
            if ( ! filter_var( $ip, FILTER_VALIDATE_IP ) ) {
                $ip = "UNKNOWN";
            }

            return $ip;
        }

        /**
         * Creating a opinioner table.
         * id | vote_id (Post ID) | ip | value | created | modified
         *
         * @since 1.0.0
         * @access public
         **/
        public function create_opinioner_table() {
            global $wpdb;
            global $charset_collate;

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

            /** Call this manually as we may have missed the init hook. */
            $this->register_opinioner_table();

            $sql_create_table = "
                CREATE TABLE {$wpdb->opinioner} (				
                    id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                    vote_id BIGINT(20) UNSIGNED NOT NULL DEFAULT '0',
                    value INT(3) UNSIGNED NOT NULL DEFAULT '0',
                    ip varchar(64) CHARACTER SET utf8 NOT NULL DEFAULT '',
                    guid varchar(64) CHARACTER SET utf8 NOT NULL DEFAULT '',
                    created DATETIME DEFAULT NULL,
                    modified DATETIME DEFAULT NULL,
                    PRIMARY KEY (id)
                ) $charset_collate; ";

            dbDelta( $sql_create_table );
        }

        /**
         * Store our table name in $wpdb with correct prefix.
         *
         * @since 1.0.0
         * @access public
         **/
        public function register_opinioner_table() {
            global $wpdb;

            $wpdb->opinioner = "{$wpdb->prefix}opinioner";
        }

        /**
         * Remove all unnecessary meta boxes.
         *
         * @since 1.0.0
         * @access public
         **/
        public function remove_unnecessary_metaboxes($post) {
            global $wp_meta_boxes;

            /** Only for Votes. */
            if ( $post->post_type != self::POST_TYPE ) { return; }

            /** Does the post have metaboxes? */
            if ( ! isset( $wp_meta_boxes[self::POST_TYPE] ) ) { return; } 

            /** All metaboxes will be removed except this. */
            $filter_metaboxes = array(
                'submitdiv',
                'postimagediv',
                'postexcerpt',
                'mdp-values-meta-box',
                'mdp-chart-meta-box',
                'mdp-actions-meta-box',
                'mdp-status-meta-box'
            );

            foreach ( (array) $wp_meta_boxes['opinioner'] as $context_key => $context_item ) {
                foreach ( $context_item as $priority_key => $priority_item ) {
                    foreach ( $priority_item as $metabox_key => $metabox_item ) {
                        if ( ! in_array( $metabox_key, $filter_metaboxes ) ) {
                            unset( $wp_meta_boxes['opinioner'][$context_key][$priority_key][$metabox_key]); // Remove meta boxes.
                        }
                    }
                }
            }
        }

        /**
         * Core logic of [opinioner id="VOTE_ID"] shortcode.
         *
         * @return string
         * @since 1.0.0
         * @access public
         **/
        public function opinioner_shortcode( $atts, $content = null, $tag ) {
            global $post;

            $atts = shortcode_atts( array( 'id' => NULL ), $atts );

            $vote = $this->get_vote($atts['id']);
            if ( ! $vote ) { return ''; }

            $left_value = get_post_meta( $vote->ID, 'left_value', true );
            $right_value = get_post_meta( $vote->ID, 'right_value', true );

            $vote_status = get_post_meta( $vote->ID, 'vote_status', true );
            $votes_count = $this->count_votes( $vote->ID );

            $before_vote_msg_description = $this->options['before_vote_msg_description'];
            $after_vote_msg_description = $this->options['after_vote_msg_description'];

            $share_url = add_query_arg( 'voteid', $vote->ID, get_permalink( $post->ID ) );

            ob_start();
            ?>
            <div id="opinioner-<?php echo esc_attr( $vote->ID ); ?>" class="opinioner-box">
                <div class="mdp-container">
                    
                    <?php if ( has_post_thumbnail( $vote->ID ) ): ?>
                        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $vote->ID ), 'full' ); ?>
                        <div class="mdp-vote-bg" style="background-image: url('<?php echo $image[0]; ?>')"></div>
                    <?php endif; ?>
                    
                    <header>
                        <h3><?php echo wp_kses_post( $vote->post_title ); ?></h3>
                    </header>

                    <?php if ( strlen( trim( $vote->post_excerpt ) ) > 0 ): ?>
                        <div class="mdp-post-excerpt">
                            <p><?php echo wp_kses_post( $vote->post_excerpt ); ?></p>
                        </div>
                    <?php endif; ?>

                    <div class="mdp-votes">

                        <div class="opinioner-chart">
                            <div class="ct-chart ct-golden-section"></div>
                        </div>
                        <script type='text/javascript'>
                            <?php $this->opinioner_data_e( $vote->ID ); ?>
                        </script>

                        <?php if ( wp_kses_post( $vote_status ) === "open" ) : ?>

                            <div class="mdp-before-vote-msg">
                                <?php if ( $before_vote_msg_description ) : ?>
                                    <div class="mdp-description">
                                        <?php echo wp_kses_post( $before_vote_msg_description ); ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="mdp-after-vote-msg" style="display: none;">
                                <?php if ( $after_vote_msg_description ) : ?>
                                    <div class="mdp-description">
                                        <?php echo wp_kses_post( $after_vote_msg_description ); ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                        <?php endif; ?>

                    </div>

                    <div class="mdp-slider">

                        <?php if ( wp_kses_post( $vote_status ) === "open" ) : ?>
                            <div class="vote-slider">
                                <input class="range" type="range" value="50" min="0" max="100">
                                <p class="value">0</p>
                            </div>
                        <?php endif; ?>

                        <div class="left_value"><p><?php echo wp_kses_post( $left_value ); ?></p></div>
                        <div class="right_value"><p><?php echo wp_kses_post( $right_value ); ?></p></div>

                    </div>

                    <div class="mdp-footer">
                        <div class="mdp-social">
                            <?php foreach ( $this->options['social_share_buttons'] as $value ) : ?>

                                <?php if ($value == "fb") : ?>
                                    <span class="facebook"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( $share_url ); ?>" target="_blank"><?php esc_html_e( 'Facebook', 'opinioner' ); ?></a></span>
                                <?php endif; ?>

                                <?php if ($value == "tw") : ?>
                                    <span class="twitter"><a href="https://twitter.com/intent/tweet?source=webclient&amp;original_referer=<?php echo urlencode( $share_url ); ?>&amp;text=<?php echo urlencode( get_the_title( $vote ) ); ?>&amp;url=<?php echo urlencode( get_permalink( $post ) ); ?>" target="_blank"><?php esc_html_e( 'Twitter', 'opinioner' ); ?></a></span>
                                <?php endif; ?>

                                <?php if ($value == "vk") : ?>
                                    <span class="vkontakte"><a href="https://vk.com/share.php?url=<?php echo urlencode( $share_url ); ?>&amp;title=<?php echo urlencode( get_the_title( $vote ) ); ?>" target="_blank"><?php esc_html_e( 'VKontakte', 'opinioner' ); ?></a></span>
                                <?php endif; ?>

                            <?php endforeach; ?>
                        </div>
                        <div class="mdp-counter"><p><b><?php echo wp_kses_post( $votes_count ); ?></b> <?php echo _n( 'Vote', 'Votes', $votes_count, 'opinioner'); ?></p></div>
                    </div>
                </div>
            </div>

            <?php
            return ob_get_clean();
        }

        /**
         * Return count of votes for vote.
         * @param $vote_id
         * @return int
         **/
        public function count_votes( $vote_id ) {
            global $wpdb;

            $res = $wpdb->get_results(
                $wpdb->prepare(
                    "SELECT COUNT(id) AS cnt FROM $wpdb->opinioner WHERE $wpdb->opinioner.vote_id = %d", [$vote_id]
                )
            );

            return (int) $res[0]->cnt;
        }

        /**
         * Get Vote post
         *
         * @param int $id
         * @return null|WP_Post
         **/
        public function get_vote( $id ) {
            
            if ( ! $id ) { return null; }

            $vote = get_post( $id );
            if ( ! $vote || $vote->post_type !== self::POST_TYPE ) { return null; }

            return $vote;
        }

        /**
         * Add plugin css and js if post has shortcode.
         *
         * @param array $posts
         * @return array
         * @since 1.0.0
         * @access public
         **/
        public function enqueue_shortcode_styles( $posts ) {
            
            if ( empty($posts) ) { return $posts; }

            /** False because we have to search through the posts first. */
            $found = false;

            /** Search through each post. */
            foreach ($posts as $post) {
                
                /** Check the post content for the short code. */
                if ( has_shortcode( $post->post_content, 'opinioner' ) ) {
                    $found = true; // We have found a post with the short code.
                    break; // Stop the search.
                }
            }

            if ( $found ) {
                
                wp_enqueue_style( 'mdp-opinioner-common', self::$url . 'css/opinioner' . self::$suffix . '.css', [], self::VERSION );
                wp_enqueue_script( 'mdp-opinioner-common', self::$url . 'js/common' . self::$suffix . '.js', ['jquery'], self::VERSION );
                
                wp_enqueue_script( 'mdp-opinioner-script', self::$url . 'js/script' . self::$suffix . '.js', ['mdp-opinioner-common'], '', true );
                /** In JavaScript, object properties are accessed as opinioner_ajax.url */
                wp_localize_script( 'mdp-opinioner-script', 'opinioner_ajax', ['url' => admin_url( 'admin-ajax.php' ) ] );
                
                wp_enqueue_style( 'mdp-opinioner-chartist', self::$url . 'css/chartist' . self::$suffix . '.css');
                /** Add inline CSS */
                $css = ".opinioner-box .mdp-footer .mdp-counter p {color:" . $this->options['key_color'] . ";}";
                $css .= ".opinioner-chart .ct-grid:first-of-type {stroke:" . $this->options['key_color'] . ";}";
                $css .= ".opinioner-chart .ct-series-a .ct-line {stroke:" . $this->options['key_color'] . ";}";
                $css .= ".opinioner-chart .ct-series-a .ct-area {fill:" . $this->options['key_color'] . ";}";
                $css .= ".opinioner-box .range::-webkit-slider-thumb {background: " . $this->options['key_color'] . ";}";
                $css .= ".opinioner-box .range::-moz-range-thumb {background: " . $this->options['key_color'] . ";}";
                wp_add_inline_style( 'mdp-opinioner-chartist', $css );
                
                wp_enqueue_script( 'mdp-opinioner-chartist', self::$url . 'js/chartist' . self::$suffix . '.js', [], '', true );
            }

            return $posts;
        }

        /**
         * Meta box setup function.
         *
         * @since 1.0.0
         * @access public
         **/
        public function meta_boxes_setup() {
            
            /** Add meta boxes on the 'add_meta_boxes' hook. */
            add_action( 'add_meta_boxes', [$this, 'add_meta_boxes'] );

            /** Save Left and Right values on the 'save_post' hook. */
            add_action( 'save_post', [$this, 'save_vote_meta'], 1, 2 );
        }
        
        /**
         * Save Left and Right values.
         *
         * @since 1.0.0
         * @access public
         **/
        public function save_vote_meta( $post_id, $post ) {

            /** Verify the nonce before proceeding. */
            if ( ! isset( $_POST['metabox_fields_nonce'] ) || ! wp_verify_nonce( $_POST['metabox_fields_nonce'], basename( __FILE__ ) ) ) {
                return $post_id;
            }

            /** Get the post type object. */
            $post_type = get_post_type_object( $post->post_type );

            /** Check if the current user has permission to edit the post. */
            if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
                return $post_id;
            }

            /** Get Left value and sanitize it for use. */
            $left_value = ( isset( $_POST['left_value']) ? sanitize_text_field( $_POST['left_value'] ) : '' );

            /** Update meta value. */
            $this->update_meta_val( $left_value, 'left_value', $post_id );

            /** Get Right value and sanitize it for use. */
            $right_value = ( isset( $_POST['right_value'] ) ? sanitize_text_field( $_POST['right_value'] ) : '' );

            /** Update meta value. */
            $this->update_meta_val( $right_value, 'right_value', $post_id );

            /** Get Status and sanitize it for use. */
            $vote_status = ( isset( $_POST['vote_status'] ) ? sanitize_text_field( $_POST['vote_status'] ) : 'opened' );

            /** Update meta value. */
            $this->update_meta_val( $vote_status, 'vote_status', $post_id );

        }

        /**
         * Add, update or remove meta value.
         *
         * @since 1.0.0
         * @access public
         **/
        public function update_meta_val( $new_value, $meta_key, $post_id ) {
            
            /** Get the meta value of the custom field key. */
            $meta_value = get_post_meta( $post_id, $meta_key, true );

            /* If a new meta value was added and there was no previous value, add it. */
            if ( $new_value && '' == $meta_value ) {
                add_post_meta( $post_id, $meta_key, $new_value, true );
            }
            /* If the new meta value does not match the old value, update it. */ 
            elseif ( $new_value && $new_value != $meta_value ) {
                update_post_meta( $post_id, $meta_key, $new_value );
            }
            /* If there is no new meta value but an old value exists, delete it. */ 
            elseif ( '' == $new_value && $meta_value ) {
                delete_post_meta( $post_id, $meta_key, $meta_value );
            }
        }

        /**
         * Create Left and Right values meta boxes to be displayed on vote editor screen.
         *
         * @since 1.0.0
         * @access public
         **/
        public function add_meta_boxes() {
            
            $screen = get_current_screen();

            /** Left and Right values metabox */
            add_meta_box( 'mdp-values-meta-box', esc_html__( 'Values', 'opinioner'), [$this, 'values_meta_box'], self::POST_TYPE, 'normal', 'default' );

            if ( 'add' != $screen->action ) {
                add_meta_box( 'mdp-chart-meta-box', esc_html__( 'Chart', 'opinioner'), [$this, 'chart_meta_box'], self::POST_TYPE, 'normal', 'default' );
            }

            add_meta_box( 'mdp-status-meta-box', esc_html__( 'Voting status', 'opinioner'), [$this, 'status_meta_box'], self::POST_TYPE, 'side', 'default' );
            add_meta_box( 'mdp-actions-meta-box', esc_html__('Actions', 'opinioner'), [$this, 'actions_meta_box'], self::POST_TYPE, 'side', 'default' );
        }
        
        /**
         * Display actions meta box.
         *
         * @param WP_Post $vote
         **/
        public function actions_meta_box( $vote ) {
            
            $this->opinioner_template(); 
            ?>
            <div id="opinioner-preview" style="display: none;"></div>
            <input type="button" id="opinioner-preview-button" value="<?php esc_html_e( 'Opinion preview', 'opinioner' ); ?>" class="button" />
            <?php
        }
        
        /**
         * Vote form template.
         *
         * @return string
         * @since 1.0.0
         * @access public
         **/
        public function opinioner_template() {

            ?>
            <script type="text/html" id="tmpl-opinioner">
                <div id="opinioner-sample" class="opinioner-box">
                    <div class="mdp-container">
                        <header>
                            <div><h3>{{ data.title }}</h3></div>
                        </header>
                        <# if (data.description) { #>
                        <div class="mdp-post-excerpt">{{ data.description }}</div>
                        <# } #>
                        <div class="mdp-slider">
                            <div class="opinioner-chart">
                                <div class="ct-chart ct-golden-section"></div>
                            </div>
                            <div class="vote-slider">
                                <input class="range" type="range" value="50" min="0" max="100">
                                <span class="value">0</span>
                            </div>
                            <div class="left_value"><p>{{ data.left_value }}</p></div>
                            <div class="right_value"><p>{{ data.right_value }}</p></div>
                        </div>

                        <div class="mdp-footer">
                            <div class="mdp-social">
                                <?php foreach ( $this->options['social_share_buttons'] as $value ) { ?>
                                    <?php if($value === 'fb') { ?>
                                        <span class="facebook"><a href="#"><?php esc_html_e( 'Facebook', 'opinioner'); ?></a></span>
                                    <?php } ?>
                                    <?php if( $value === 'tw' ) { ?>
                                        <span class="twitter"><a href="#"><?php esc_html_e( 'Twitter', 'opinioner'); ?></a></span>
                                    <?php } ?>
                                    <?php if( $value === 'vk' ) { ?>
                                        <span class="vkontakte"><a href="#"><?php esc_html_e( 'VKontakte', 'opinioner'); ?></a></span>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                            <div class="mdp-counter"><p><b>{{ data.votes_count }}</b>
                            <# if (data.votes_count === 1) { #>
                                <?php esc_html_e( 'Vote', 'opinioner'); ?>
                            <# } else { #>
                                <?php esc_html_e( 'Votes', 'opinioner'); ?>
                            <# } #>
                            </p></div>
                        </div>
                    </div>
                </div>
            </script>
            <?php
        }

        /**
         * Display chart meta box.
         *
         * @since 1.0.0
         * @access public
         * @param WP_Post $vote
         **/
        public function chart_meta_box( $vote ) {
            ?>
            <div class="opinioner-chart" data-id="<?php echo esc_attr( $vote->ID ); ?>" data-debug="true" id="opinioner-<?php echo esc_attr( $vote->ID ); ?>">
                <div class="ct-chart ct-golden-section"></div>
            </div>
            <div id="opinioner-chart-values" class="mdp-chart-box-values"></div>
            <script type="text/html" id="tmpl-opinioner-chart-values">
                <p class="mdp-left-value-fld">{{ data.left_value }}</p>
                <p class="mdp-right-value-fld">{{ data.right_value }}</p>
            </script>
            <script type='text/javascript'>
                <?php $this->opinioner_data_e( $vote->ID ); ?>
            </script>
            <?php
        }
        
        /**
         * Return chart data set for javascript.
         *
         * @since 1.0.0
         * @access public
         **/
        private function opinioner_data_e( $vote_id ) {
            
            $arr = $this->get_votes_data( $vote_id );
            $result = array( 'series' => [$arr], 'smooth' => $this->options['smooth'] );
            
            echo 'var opinioner_data_' . $vote_id . ' = ' . json_encode( $result ) . ';';
        }
        
        /**
         * Get votes data for the chart.
         *
         * @param $vote_id
         * @return array
         **/
        static public function get_votes_data( $vote_id ) {
            global $wpdb;

            $res = $wpdb->get_results( 
                $wpdb->prepare("
                    SELECT $wpdb->opinioner.value, COUNT($wpdb->opinioner.value) AS cnt
                    FROM $wpdb->opinioner
                    WHERE $wpdb->opinioner.vote_id = %d
                    GROUP BY $wpdb->opinioner.value", array( $vote_id ) )
            );

            // Init data array
            $arr = array_fill(0, 100, 0);

            // Fill votes
            foreach ($res as $row) {
                $arr[$row->value] = (int) $row->cnt;
            }

            return $arr;
        }

        /**
         * Display Left and Right values meta box.
         *
         * @since 1.0.0
         * @access public
         * @param WP_Post $vote
         **/
        public function values_meta_box($vote) {

            /** Nonce field to validate form request came from current site. */
            wp_nonce_field( basename(__FILE__), 'metabox_fields_nonce' );

            /** Get the left and right values if it's already been entered. */
            $left_value = get_post_meta( $vote->ID, 'left_value', true );
            $right_value = get_post_meta( $vote->ID, 'right_value', true );
            ?>
            <div class="mdp-left-right-box">
                <p class="mdp-left-value-fld">
                    <label for="left-value-field"><?php esc_html_e( 'Left value:', 'opinioner' ); ?></label>
                    <input type="text" id="left-value-field" name="left_value" value="<?php echo esc_attr( $left_value ); ?>" class="widefat">
                </p>

                <p class="mdp-right-value-fld">
                    <label for="right-value-field"><?php esc_html_e( 'Right value:', 'opinioner' ); ?></label>
                    <input type="text" id="right-value-field" name="right_value" value="<?php echo esc_attr( $right_value) ; ?>" class="widefat">
                </p>
            </div>
            <?php
        }

        /**
         * Display close/open status meta box.
         *
         * @since 1.0.0
         * @access public
         * @param WP_Post $vote
         **/
        public function status_meta_box($vote) {

            /** Nonce field to validate form request came from current site. */
            wp_nonce_field( basename(__FILE__), 'metabox_fields_nonce' );

            $vote_status = get_post_meta( $vote->ID, 'vote_status', true );

            ?>
            <select name='vote_status'>
                <option value="open" <?php if ( $vote_status == 'opened' ) echo 'selected="selected"'; ?> ><?php echo esc_html__( 'Voting is open', 'opinioner' ) ?></option>
                <option value="closed" <?php if ( $vote_status == 'closed' ) echo 'selected="selected"'; ?> ><?php echo esc_html__( 'Voting closed', 'opinioner' ) ?></option>
            </select>
            <?php
        }

        /**
         * Add HEAD for custom column with vote shorcode.
         *
         * @param array $columns
         * @return array
         * @since 1.0.0
         * @access public
         **/
        public function add_head_shortcode_column( $columns ) {
            
            /** Add new column key to the existing columns. */
            $columns['vote_shorcode'] = esc_html__( 'Shorcode', 'opinioner' );

            /** Define a new order. */
            $newOrder = array( 'cb', 'title', 'vote_shorcode', 'date' );

            /** Order columns like set in $newOrder. */
            $new = array();
            foreach ( $newOrder as $colname ) {
                $new[$colname] = $columns[$colname];
            }

            /** Return a new column array to WordPress. */
            return $new;
        }

        /**
         * Add CONTENT for custom column with vote shorcode.
         *
         * @since 1.0.0
         * @access public
         **/
        public function add_content_shortcode_column( $column_name, $post_ID ) {
            
            if ( $column_name == 'vote_shorcode' ) {
                echo '<code>[opinioner id="' . $post_ID . '"]</code>';
            }
            
        }

        /**
         * Create editor button for shorcode.
         *
         * @since 1.0.0
         * @access public
         **/
        public function add_button() {
            
            if ( is_admin() && current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
                
                add_filter( 'mce_external_plugins', [$this, 'add_TinyMCE_plugin'] );
                add_filter( 'mce_buttons', [$this, 'register_button'] );
                add_filter( 'mce_css', [$this, 'plugin_mce_css'] );

                /** File is empty, but we use it to pass rest_url to JS. */
                wp_enqueue_script( 'mdp-opinioner-button', self::$url . 'js/button' . self::$suffix . '.js', ['jquery'], self::VERSION, true );

                $data = array(
                    'rest_url' => get_rest_url()
                );
                
                wp_localize_script( 'mdp-opinioner-button', 'opinioner_data', $data );
            }
        }
        
        /**
         * Add stylesheet to the TinyMCE.
         *
         * @since 1.0.0
         * @access public
         **/
        public function plugin_mce_css( $mce_css ) {
            
            wp_enqueue_style( 'opinioner-editor', self::$url . 'css/editor' . self::$suffix . '.css' );

            return $mce_css;
        }

        /**
         * Adds shortcode to the array of buttons.
         *
         * @since 1.0.0
         * @access public
         **/
        public function register_button( $buttons ) {
            
            /** Remove button form setting page. */
            $screen = get_current_screen();
            if ( $screen->base == 'opinioner_page_mdp_opinioner_settings' ) { return $buttons; }
            
            /** Register button with their id. */
            array_push( $buttons, 'opinioner' );

            return $buttons;
        }

        /**
         * Register TinyMCE Plugin.
         *
         * @since 1.0.0
         * @access public
         **/
        function add_TinyMCE_plugin( $plugin_array ) {
            
            $plugin_array['opinioner_plugin'] = self::$url . 'js/opinioner' . self::$suffix . '.js';

            return $plugin_array;
        }

        /**
         * Add REST API support to Opinioner post type.
         *
         * @since 1.0.0
         * @access public
         **/
        public function add_rest_support() {
            global $wp_post_types;

            $post_type_name = self::POST_TYPE;
            if ( isset( $wp_post_types[$post_type_name] ) ) {
                $wp_post_types[$post_type_name]->show_in_rest = true;
            }
        }
        
        /**
         * Since WP 4.7, filter has been removed from WP-API. I have no idea why.
         * Add the necessary filter to each post type.
         *
         * @see https://github.com/WP-API/rest-filter
         * @since 1.0.0
         * @access public
         **/
        public function rest_api_filter_add_filters() {
            foreach ( get_post_types( ['show_in_rest' => true], 'objects' ) as $post_type ) {
                add_filter( 'rest_' . $post_type->name . '_query', [$this, 'rest_api_filter_add_filter_param'], 10, 2 );
            }
        }

        /**
         * Add the filter parameter.
         *
         * @param  array           $args    The query arguments.
         * @param  WP_REST_Request $request Full details about the request.
         * @return array $args.
         *
         * @since 1.0.0
         * @access public
         **/
        public function rest_api_filter_add_filter_param($args, $request) {
            global $wp;
            
            /** Bail out if no filter parameter is set. */
            if ( empty( $request['filter'] ) || !is_array( $request['filter'] ) ) {
                return $args;
            }

            $filter = $request['filter'];

            if ( isset( $filter['posts_per_page'] ) && ( (int) $filter['posts_per_page'] >= 1 && (int) $filter['posts_per_page'] <= 100 ) ) {
                $args['posts_per_page'] = $filter['posts_per_page'];
            }

            $vars = apply_filters( 'query_vars', $wp->public_query_vars );

            foreach ( $vars as $var ) {
                if ( isset( $filter[$var] ) ) {
                    $args[$var] = $filter[$var];
                }
            }
            
            return $args;
        }

        /**
         * Add plugin settings page.
         *
         * @since 1.0.0
         * @access public
         **/
        public function add_settings_page() {
            
            add_action( 'admin_menu', [$this, 'add_admin_menu'] );
            add_action( 'admin_init', [$this, 'settings_init'] );
            
        }

        /**
         * Loads plugin helpers, it is something like mini plugins.
         *
         * @since 1.0.0
         * @access public
         **/
        public function load_helpers() {
            
            /** Add Plugin Helper Class. */
            require_once ( wp_normalize_path( self::$path . '/classes/MDPHelper.class.php' ) );
            /** Run MDPHelper class. */
            $this->helpers['MDPHelper'] = MDPHelper::get_instance();
            
        }
        
        /**
         * Register the JavaScript for the public-facing side of the site.
         *
         * @since   1.0.0
         * @return void
         **/
        public function load_scripts() {
               
            wp_enqueue_script( 'mdp-opinioner', self::$url . 'js/opinioner' . self::$suffix . '.js', [], self::VERSION, true );
            wp_localize_script( 'mdp-opinioner', 'mdp_opinioner', 
                /** We use md_ prefix to avoid conflicts in JS. */
                [ 
                    'md_select_all'     => $this->options['select_all'], // Disable Select All.
                ]
            );
            
        }

        /**
         * Add admin menu for plugin settings.
         *
         * @since 1.0.0
         * @access public
         **/
        public function add_admin_menu() {
            add_submenu_page(                
                'edit.php?post_type=' . self::POST_TYPE,
                esc_html__( 'Opinioner Settings', 'opinioner' ),
                esc_html__( 'Settings', 'opinioner' ),
                'manage_options',
                'mdp_opinioner_settings',
                [$this, 'options_page']
            );
        }

        /**
         * Plugin Settings Page.
         *
         * @since 1.0.0
         * @access public
         **/
        public function options_page() {
            
            /** User rights check. */
            if ( ! current_user_can('manage_options' ) ) { return; }?>

            <div class="wrap">
                <h1><?php echo get_admin_page_title() ?></h1>
                <p><?php esc_html_e( 'Opinioner plugin allows you to ask questions to readers of articles and evaluates the answers.', 'opinioner' ); ?></p>
                
                <?php 
                
                /** Render Tabs Body. */
                ?>
                <form action='options.php' method='post'>
                    <?php
                    settings_fields( 'OpinionerOptionsGroup' );
                    do_settings_sections( 'OpinionerOptionsGroup' );
                    submit_button(); 
                    ?>
                </form>
                    
            </div>
            
            <?php
        }

        /**
         * Generate Settings Page.
         *
         * @since 1.0.0
         * @access public
         **/
        public function settings_init() {
            
            /** General Tab. */
            register_setting( 'OpinionerOptionsGroup', 'mdp_opinioner_settings' );
            add_settings_section( 'mdp_opinioner_settings_page_general_section', '', NULL, 'OpinionerOptionsGroup' );
            
            /** KeyColor. */
            add_settings_field( 'key_color', esc_html__( 'Color', 'opinioner'), [$this, 'render_key_color'], 'OpinionerOptionsGroup', 'mdp_opinioner_settings_page_general_section');

            /** Before Vote Message. */
            add_settings_field( 'before_vote_msg', esc_html__( 'Message before vote', 'opinioner'), [$this, 'render_before_vote_msg'], 'OpinionerOptionsGroup', 'mdp_opinioner_settings_page_general_section');

            /** After Vote Message. */
            add_settings_field( 'after_vote_msg', esc_html__( 'Message after vote', 'opinioner'), [$this, 'render_after_vote_msg'], 'OpinionerOptionsGroup', 'mdp_opinioner_settings_page_general_section');

            /** Social Buttons. */
            add_settings_field( 'social_share_buttons', esc_html__( 'Social share buttons', 'opinioner'), [$this, 'render_social_share_buttons'], 'OpinionerOptionsGroup', 'mdp_opinioner_settings_page_general_section');

            /** Path Smoothness. */
            add_settings_field( 'smooth', esc_html__( 'Smoothness', 'opinioner'), [$this, 'render_smooth'], 'OpinionerOptionsGroup', 'mdp_opinioner_settings_page_general_section');

        }
        
        /**
         * Render After Vote Message field.
         *
         * @since 1.0.0
         * @access public
         **/
        public function render_after_vote_msg() {
            ?>
            <div>
                <?php wp_editor( $this->options['after_vote_msg_description'], 'mdpopinioneraftervotemsgdescription', array( 'textarea_rows' => 7, 'textarea_name' => 'mdp_opinioner_settings[after_vote_msg_description]') ); ?>
            </div>
            <p class="description"><?php esc_html_e( 'You can add custom message after voting.', 'opinioner' ); ?></p>
            <?php
        }

        /**
         * Render Before Vote Message field.
         *
         * @since 1.0.0
         * @access public
         **/
        public function render_before_vote_msg() {
            ?>
            <div>
                <?php wp_editor( $this->options['before_vote_msg_description'], 'mdpopinionerbeforevotemsgdescription', array( 'textarea_rows' => 7, 'textarea_name' => 'mdp_opinioner_settings[before_vote_msg_description]') ); ?>
            </div>
            <p class="description"><?php esc_html_e( 'You can add custom message before voting.', 'opinioner' ); ?></p>
            <?php
        }

        /**
         * Render Social Share Buttons field.
         *
         * @since 1.0.0
         * @access public
         **/
        public function render_social_share_buttons() {
            ?>
            <p class="description"><?php esc_html_e( 'Choose a social networks to share the voting.', 'opinioner' ); ?></p>
            <label>
                <input type='checkbox' name='mdp_opinioner_settings[social_share_buttons][]' value="fb" <?php echo in_array( 'fb', $this->options['social_share_buttons'] ) ? 'checked' : ''; ?>>
                <span><?php esc_html_e( 'Facebook', 'opinioner' ); ?></span>
            </label>
            <br />
            <label>
                <input type='checkbox' name='mdp_opinioner_settings[social_share_buttons][]' value="tw" <?php echo in_array( 'tw', $this->options['social_share_buttons'] ) ? 'checked' : ''; ?>>
                <span><?php esc_html_e( 'Twitter', 'opinioner' ); ?></span>
            </label>
            <br />
            <label>
                <input type='checkbox' name='mdp_opinioner_settings[social_share_buttons][]' value="vk" <?php echo in_array( 'vk', $this->options['social_share_buttons'] ) ? 'checked' : ''; ?>>
                <span><?php esc_html_e( 'VK', 'opinioner' ); ?></span>
            </label>
            <?php
        }

        /**
         * Render Key Color field.
         *
         * @since 1.0.0
         * @access public
         **/
        public function render_key_color() {

            ?><input name="mdp_opinioner_settings[key_color]" class="color-picker" data-alpha="true" type="text" value="<?php echo esc_attr( $this->options['key_color'] ); ?>" />
            <p class="description"><?php esc_html_e( 'Select a key color to modify the design', 'opinioner' ); ?></p>
            <?php
        }

        /**
         * Render Smooth field.
         *
         * @since 1.0.0
         * @access public
         **/
        public function render_smooth() {

            ?><input name="mdp_opinioner_settings[smooth]" type='number' min="0" max="100" step="1" value='<?php echo esc_attr( $this->options['smooth'] ); ?>'>
            <p class="description"><?php esc_html_e( 'Graph smoothing factor', 'opinioner' ); ?></p>

            <?php
        }
        
        /**
         * Get plugin settings with default values.
         *
         * @return array
         **/
        public function get_options() {
            
            /** Options. */
            $options = get_option( 'mdp_opinioner_settings' );
            
            /** Default values. */
            $defaults = 
            [
                'key_color' => 'rgba(0,154,73,1)', // KeyColor.
                'social_share_buttons' => [], // Social Buttons.
                'before_vote_msg_description' => "<h4 style='text-align: center'>" . esc_html__( 'Vote!', 'opinioner' ) . "</h4><p style='text-align: center'>" . esc_html__( 'Drag the slider and make your voice heard.', 'opinioner' ) . "</p>", // Before Vote Message description.
                'after_vote_msg_description' => "<h4 style='text-align: center'>" . esc_html__( 'Thanks for voting!', 'opinioner' ) . "</h4><p style='text-align: center'>" . esc_html__( 'Get your friends to vote, share this page.', 'opinioner' ) . "</p>", // After Vote Message description.
                'smooth' => 24 //Path smoothness
            ];
            
            $results = wp_parse_args( $options, $defaults );
            
            $this->options = $results;
        }

        /**
         * Loads the Opinioner translated strings.
         *
         * @since 1.0.0
         * @access public
         **/
        public function load_textdomain() {
            
            load_plugin_textdomain( 'opinioner', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
            
        }        
        
        /**
         * Add CSS for admin area.
         *
         * @since   1.0.0
         * @return void
         **/
        public function load_admin_styles( $hook ) {
            
            /** Add styles only on setting page */
            $screen = get_current_screen();            
            
            if ( $screen->base == "opinioner_page_mdp_opinioner_settings" ) {
                
                wp_enqueue_style( 'wp-color-picker' ); // Color Picker.
                
            } elseif ( $screen->post_type == self::POST_TYPE ) {

                wp_enqueue_style( 'mdp-opinioner-common', self::$url . 'css/opinioner' . self::$suffix . '.css', [], self::VERSION );
                wp_enqueue_style( 'mdp-opinioner-chartist', self::$url . 'css/chartist' . self::$suffix . '.css' );

                /** Add inline CSS. */
                $css = ".opinioner-box .mdp-footer .mdp-counter p {color:" . $this->options['key_color'] . ";}";
                $css .= ".opinioner-chart .ct-series-a .ct-line {stroke:" . $this->options['key_color'] . ";}";
                $css .= ".opinioner-chart .ct-series-a .ct-area {fill:" . $this->options['key_color'] . ";}";
                $css .= ".opinioner-box .range::-webkit-slider-thumb:hover {background: " . $this->options['key_color'] . ";}";
                $css .= ".opinioner-box .range:active::-webkit-slider-thumb {background: " . $this->options['key_color'] . ";}";
                $css .= ".opinioner-box .range::-moz-range-thumb:hover {background: " . $this->options['key_color'] . ";}";
                $css .= ".opinioner-box .range:active::-moz-range-thumb {background: " . $this->options['key_color'] . ";}";
                wp_add_inline_style( 'mdp-opinioner-chartist', $css );
                
                wp_enqueue_style( 'mdp-opinioner-admin', self::$url . 'css/admin' . self::$suffix . '.css', [], self::VERSION );
            }
            
        }
        
        /**
         * Add JS for admin area.
         *
         * @since   1.0.0
         * @return void
         **/
        public function load_admin_scripts( $hook ) {
            
            /** Add styles only on setting page */
            $screen = get_current_screen();
            
            /** Opinioner settings page. */
            if ( $screen->base == "opinioner_page_mdp_opinioner_settings" ) {
                
                wp_enqueue_script( 'wp-color-picker' );
                wp_enqueue_script( 'wp-color-picker-alpha', self::$url . 'js/wp-color-picker-alpha.min.js', ['wp-color-picker'], self::VERSION, true );
            
            /** Opinioner Post Type page. */
            } elseif ( $screen->post_type == self::POST_TYPE && $screen->base != 'edit' ) {
                
                add_thickbox();
                
                wp_enqueue_script( 'mdp-opinioner-common', self::$url . 'js/common' . self::$suffix . '.js', ['jquery'], self::VERSION );
                wp_enqueue_script( 'mdp-opinioner-admin', self::$url . 'js/admin' . self::$suffix . '.js', ['jquery', 'wp-util'], self::VERSION );
                wp_localize_script( 'mdp-opinioner-admin', 'opinioner_dict', ['preview' => esc_html__( 'Preview', 'opinioner' )] );
                wp_enqueue_script( 'mdp-opinioner-chartist', self::$url . 'js/chartist' . self::$suffix . '.js', [], '', true );
                
            }
        }
        
        /**
         * Main Opinioner Instance.
         *
         * Insures that only one instance of Opinioner exists in memory at any one time.
         *
         * @static
         * @return Opinioner
         * @since 1.0.0
         **/
        public static function get_instance() {
            if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Opinioner ) ) {
                self::$instance = new Opinioner;
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
            _doing_it_wrong( __FUNCTION__, esc_html__( 'The whole idea of the singleton design pattern is that there is a single object therefore, we don\'t want the object to be cloned.', 'opinioner' ), self::VERSION );
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
            _doing_it_wrong( __FUNCTION__, esc_html__( 'The whole idea of the singleton design pattern is that there is a single object therefore, we don\'t want the object to be unserialized.', 'opinioner' ), self::VERSION );
	}

    } // End Class Opinioner.
endif; // End if class_exists check.

/** Run Opinioner class. */
$Opinioner = Opinioner::get_instance();