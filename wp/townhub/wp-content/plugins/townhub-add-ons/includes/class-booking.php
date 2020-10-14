<?php 
/* add_ons_php */

defined( 'ABSPATH' ) || exit; 

class Esb_Class_Booking{

    public static function init(){
        add_action( 'before_delete_post', array( __CLASS__, 'before_delete_post' ), 10, 1 ); 
        add_action( 'townhub_addons_lbooking_change_status_to_completed', array( __CLASS__, 'approve_booking' ), 10, 1 );
        add_action( 'townhub_addons_lbooking_change_status_completed_to_refunded', array( __CLASS__, 'refund_booking' ), 10, 1 );
    }

    public static function approve_booking($booking_id = 0){
        if(is_numeric($booking_id)&&(int)$booking_id > 0){
            $listing_id = get_post_meta( $booking_id, ESB_META_PREFIX.'listing_id', true );
            $booking_user_id = get_post_meta( $booking_id, ESB_META_PREFIX.'user_id', true );
                // not for manual approved
                update_post_meta( $booking_id, ESB_META_PREFIX.'lb_status',  'completed'  );
            // if ( !update_post_meta( $booking_id, ESB_META_PREFIX.'lb_status',  'completed'  ) ) {
            //     if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Update booking status to completed failure" . PHP_EOL, 3, ESB_LOG_FILE);
            // }else{
            if( !empty($booking_user_id) ){
                Esb_Class_Dashboard::add_notification($booking_user_id, array(
                    'type' => 'booking_approved',
                    'entity_id'     => $listing_id
                ));
            }
                
            // update author earning
            $listing_author_id = get_post_field( 'post_author', $listing_id );
            if($listing_author_id){
                $inserted_earning = Esb_Class_Earning::insert($booking_id, $listing_author_id, $listing_id);
                
            }

            // update cth_booking status: 0 - insert - 1 - active
            self::update_cth_booking_status($booking_id, 1);

            do_action( 'townhub_addons_booking_approved', $booking_id );
        // }
        }        

    }

    public static function refund_booking($booking_id = 0){
        if(is_numeric($booking_id)&&(int)$booking_id > 0){
            $listing_id = get_post_meta( $booking_id, ESB_META_PREFIX.'listing_id', true );
            $booking_user_id = get_post_meta( $booking_id, ESB_META_PREFIX.'user_id', true );
                // not for manual approved
                // update_post_meta( $booking_id, ESB_META_PREFIX.'lb_status',  'completed'  );
            // if ( !update_post_meta( $booking_id, ESB_META_PREFIX.'lb_status',  'completed'  ) ) {
            //     if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Update booking status to completed failure" . PHP_EOL, 3, ESB_LOG_FILE);
            // }else{
            // if( !empty($booking_user_id) ){
            //     Esb_Class_Dashboard::add_notification($booking_user_id, array(
            //         'type' => 'booking_refunded',
            //         'entity_id'     => $listing_id
            //     ));
            // }
                
            // update author earning
            $listing_author_id = get_post_field( 'post_author', $listing_id );
            if($listing_author_id){
                $inserted_earning = Esb_Class_Earning::insert_refund($booking_id, $listing_author_id, $listing_id);
                
            }

            // update cth_booking status: 0 - insert - 1 - active
            // self::update_cth_booking_status($booking_id, 1);

            do_action( 'townhub_addons_booking_edit_refunded', $booking_id );
        // }
        }     
    }

    // public static function paypal_completed_check($payment_data = array(), $booking_id = 0){
    //     // check for amount
    //     // $bk_price = get_post_meta( $booking_id, ESB_META_PREFIX.'price_total', true );
    //     if($payment_data['pm_amount'] == get_post_meta( $booking_id, ESB_META_PREFIX.'price_total', true )) self::approve_booking($booking_id);

    // }

    private static function update_cth_booking_status($booking_id = 0, $status = 0){
        global $wpdb;
        $booking_table = $wpdb->prefix . 'cth_booking';
        $wpdb->update( $booking_table, array( 'status' => $status ), array( 'booking_id' => $booking_id ), array( '%d' ), array( '%d' ) );
    }

    // before delete booking and room post
    public static function before_delete_post($postid = 0){
        global $wpdb;
        $post_type = get_post_type($postid);
        if($post_type === 'lbooking' || $post_type === 'lrooms'){
            $booking_table = $wpdb->prefix . 'cth_booking';
            $wpdb->query( 
                $wpdb->prepare( 
                    "
                    DELETE FROM $booking_table
                    WHERE booking_id = %d OR room_id = %d
                    ",
                    $postid,
                    $postid
                )
            );
        }
    }


}
Esb_Class_Booking::init();