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

"use strict";

/** Run jQuery scripts */
( function ( $ ) {

    "use strict";

    /** Document Ready. */
    $( document ).ready( function () {

        let mdpCoronar = window.mdpCoronar;

        /** Clear Cache button. */
        let $clearCacheBtn = $('#mdp_coronar_general_settings-clear_cache');

        /** Click on Clear Cache button. */
        $clearCacheBtn.on('click', function (e) {

            /** Disable button and show process. */
            $clearCacheBtn.attr('disabled', true).addClass('mdp-spin').find('.material-icons').text('refresh');

            /** Prepare data for AJAX request. */
            let data = {
                action: 'clear_cache',
                nonce: mdpCoronar.nonce,
                doClear: 1
            };

            /** Make POST AJAX request. */
            $.post( mdpCoronar.ajaxURL, data, function (response) {

                /** Show Error message if returned false. */
                if ( response ) {
                    window.alert('Cache Cleared');
                } else {
                    console.error('Looks like an error has occurred. Please try again later.');
                }

            }, 'json').fail(function (response) {

                /** Show Error message if returned some data. */
                console.log(response);
                console.error('Looks like an error has occurred. Please try again later.');

            }).always(function () {

                /** Enable button again. */
                $clearCacheBtn.attr('disabled', false).removeClass('mdp-spin').find('.material-icons').text('close');

            });

        });

    } );

} ( jQuery ) );