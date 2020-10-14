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

( function ( $ ) {

    "use strict";

    $( document ).ready( function () {

        let mdpCoronar = window.mdpCoronar

        /** Logo click - smooth scroll. */
        $( '.mdc-drawer__header > a.mdp-plugin-title' ).on( 'click', function ( e ) {
            e.preventDefault();

            $( 'html, body' ).animate( {
                scrollTop: 0
            }, 500 );

        } );

        /** Subscribe form. */
        let $subscribeBtn = $('#mdp-subscribe');
        $subscribeBtn.on( 'click', function (e) {

            e.preventDefault();

            let $mail = $('#mdp-subscribe-mail');
            let $name = $('#mdp-subscribe-name');
            let plugin = 'coronar';
            let mailIndex = $mail.parent().data('mdc-index');

            if ( $mail.val().length > 0 && window.MerkulovMaterial[mailIndex].valid) {

                const noticeArea = document.querySelector( '.mdp-subscribe-form-message' );
                $name.prop("disabled", true);
                $mail.prop("disabled", true);
                $('#mdp-subscribe').prop("disabled", true);

                $.ajax({
                    type: "GET",
                    url: "https://merkulove.host/wp-content/plugins/mdp-purchase-validator/esputnik/subscribe.php",
                    crossDomain: true,
                    data: 'name=' + $name.val() + '&mail=' + $mail.val() + '&plugin=' + plugin,
                    success: function (data) {

                        if (true === data) {

                            noticeArea.style.display = 'block';
                            noticeArea.classList.add( 'mdp-subscribe-form-message-success' );
                            noticeArea.innerHTML = noticeArea.dataset.success;

                            setTimeout( function () { noticeArea.style.display = 'none' }, 7500 );

                        } else {

                            noticeArea.style.display = 'block';
                            noticeArea.classList.add( 'mdp-subscribe-form-message-error' );
                            noticeArea.innerHTML = noticeArea.dataset.error;

                            setTimeout( function () { noticeArea.style.display = 'none' }, 7500 );

                        }

                    },
                    error: function (err) {

                        noticeArea.style.display = 'block';
                        noticeArea.classList.add( 'mdp-subscribe-form-message-error' );
                        noticeArea.innerHTML = noticeArea.dataset.warn;

                        $('#mdp-subscribe-name').prop( "disabled", false );
                        $('#mdp-subscribe-mail').prop( "disabled", false );
                        $('#mdp-subscribe').prop( "disabled", false );

                        setTimeout( function () { noticeArea.style.display = 'none' }, 7500 );

                    }
                });

            } else {
                window.MerkulovMaterial[mailIndex].valid = false;
            }

        });

        /** Check for Updates. */
        let $checkUpdatesBtn = $( '#mdp-updates-btn' );
        $checkUpdatesBtn.on( 'click', function ( e ) {

            e.preventDefault();

            /** Disable button and show process. */
            $checkUpdatesBtn.attr( 'disabled', true ).addClass( 'mdp-spin' ).find( '.material-icons' ).text( 'refresh' );

            /** Prepare data for AJAX request. */
            let data = {
                action: 'check_updates',
                nonce: mdpCoronar.nonce,
                checkUpdates: true
            };

            /** Do AJAX request. */
            $.post( mdpCoronar.ajaxURL, data, function( response ) {

                if ( response ) {
                    console.info( 'Latest version information updated.' );
                    location.reload();
                } else {
                    console.warn( response );
                }

            }, 'json' ).fail( function( response ) {

                /** Show Error message if returned some data. */
                console.error( response );
                alert( 'Looks like an Error has occurred. Please try again later.' );

            } ).always( function() {

                /** Enable button again. */
                $checkUpdatesBtn.attr( 'disabled', false ).removeClass( 'mdp-spin' ).find( '.material-icons' ).text( 'autorenew' );

            } );

        } );

        /** Custom CSS */
        function custom_css_init() {

            let $custom_css_fld = $( '#mdp_custom_css_fld' );

            if ( ! $custom_css_fld.length ) { return; }

            let editorSettings = wp.codeEditor.defaultSettings ? _.clone( wp.codeEditor.defaultSettings ) : {};
            editorSettings.codemirror = _.extend(
                {},
                editorSettings.codemirror, {
                    indentUnit: 2,
                    tabSize: 2,
                    mode: 'css'
                }
            );

            let css_editor;
            css_editor = wp.codeEditor.initialize( 'mdp_custom_css_fld', editorSettings );

            css_editor.codemirror.on( 'change', function( cMirror ) {
                css_editor.codemirror.save(); // Save data from CodeEditor to textarea.
                $custom_css_fld.change();
            } );

        }
        custom_css_init();

        /** Initialise Chosen fields. */
        let $chosenSelect = $( '.mdp-chosen.chosen-select' );
        $chosenSelect.chosen( {
            width: '100%',
            search_contains: true,
            disable_search_threshold: 7,
            inherit_select_classes: true,
            no_results_text: 'Oops, nothing found',
            max_selected_options: 3
        } );

    } )

} ( jQuery ) );