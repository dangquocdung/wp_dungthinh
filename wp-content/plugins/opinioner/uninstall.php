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

/** 
 * Runs on Uninstall of Opinioner plugin. 
 **/

/** Check that we should be doing this. */
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    header( 'Status: 403 Forbidden' );
    header( 'HTTP/1.1 403 Forbidden' );
    exit;
}

/** Delete Options. */
$settings = array(
    'mdp_opinioner_settings',
    'mdp_opinioner_assignments_settings'
);

foreach ( $settings as $key ) {
    
    if ( is_multisite() ) { // For Multisite.
        if ( get_site_option( $key ) ) {
            delete_site_option( $key );
        }
    } else { 
        if ( get_option( $key ) ) {
            delete_option( $key );
        }    
    }

}
