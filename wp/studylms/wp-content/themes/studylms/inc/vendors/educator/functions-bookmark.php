<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
 
class Studylms_Educator_Bookmark {
    
    public static function init() {
        add_action( 'wp_ajax_studylms_add_bookmark', array(__CLASS__, 'add_bookmark') );
        add_action( 'wp_ajax_nopriv_studylms_add_bookmark', array(__CLASS__, 'add_bookmark') );
        add_action( 'wp_ajax_studylms_remove_bookmark', array(__CLASS__, 'remove_bookmark') );
        add_action( 'wp_ajax_nopriv_studylms_remove_bookmark', array(__CLASS__, 'remove_bookmark') );
    }

    public static function add_bookmark() {
        if ( isset($_GET['post_id']) && $_GET['post_id'] ) {
            self::save_bookmark($_GET['post_id']);
            $result['msg'] = esc_html__( 'View Your Bookmark', 'studylms' );
            $result['status'] = 'success';
        } else {
            $result['msg'] = esc_html__( 'Add Bookmark Error.', 'studylms' );
            $result['status'] = 'error';
        }
        echo json_encode($result);
        die();
    }

    public static function remove_bookmark() {
        if ( isset($_GET['post_id']) && $_GET['post_id'] ) {
            $user_id = get_current_user_id();
            $data = get_user_meta($user_id, '_edr_bookmark', true);
            if (is_array($data)) {
                foreach ($data as $key => $value) {
                    if ( $_GET['post_id'] == $value ) {
                        unset($data[$key]);
                    }
                }
            }
            update_user_meta( $user_id, '_edr_bookmark', $data );
            
            $result['msg'] = esc_html__( 'Remove a listing to bookmark successful', 'studylms' );
            $result['status'] = 1;
        } else {
            $result['msg'] = esc_html__( 'Remove a listing to bookmark error', 'studylms' );
            $result['status'] = 0;
        }
        echo json_encode($result);
        die();
    }

    public static function get_bookmark() {
        $user_id = get_current_user_id();
        $data = get_user_meta($user_id, '_edr_bookmark', true);
        return $data;
    }

    public static function save_bookmark($post_id) {
        $user_id = get_current_user_id();
        $data = get_user_meta($user_id, '_edr_bookmark', true);
        if ( !in_array($post_id, $data) ) {
            $data[] = $post_id;
            update_user_meta( $user_id, '_edr_bookmark', $data );
        }
    }

    public static function check_course_added($post_id) {
        $data = self::get_bookmark();
        if ( !is_array($data) || !in_array($post_id, $data) ) {
            return false;
        }
        return true;
    }

}

Studylms_Educator_Bookmark::init();
