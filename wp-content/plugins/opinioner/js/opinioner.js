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

"use strict";

(function () {
    tinymce.create('tinymce.plugins.opinioner_plugin', {

        /** URL argument holds the absolute url of our plugin directory. */
        init: function ( editor, url ) {

            var html = `
                <div id="insert-opinioner">
                    <p class="">Your shortcode is: <code class="shortcode">[opinioner id=""]</code></p>
                    <p class="help">Select one of the existing votes.</p>
                    <div class="search-wrapper">
                        <label>
                            <span class="search-label">Search</span>
                            <input type="search" id="opinioner-search" class="opinioner-search-field" autocomplete="off">
                            <span class="spinner"></span>
                        </label>
                    </div>
                    <div id="opinioner-search-results" tabindex="0">
                        <ul></ul>
                    </div>
                </div>
            `;

            /** Add new button. */
            editor.addButton('opinioner', {
                title: 'Insert Opinioner Vote',
                image: url + '/../images/icon.svg',
                onclick: function () {
                    
                    /** Open window. */
                    editor.windowManager.open({
                        title: 'Insert Vote',
                        width: 500,
                        height: 400,
                        body: [
                            {type: 'container', html: html}
                        ],
                        buttons: [{
                                text: 'Insert Vote',
                                classes: 'btn primary',
                                id: 'insert-vote-btn',
                                onclick: function ( e ) {

                                    var selected = editor.selection.getContent();
                                    var shorcode = jQuery( '#insert-opinioner .shortcode' ).text();
                                    var content = '';

                                    if ( selected ) {
                                        /** If text is selected when button is clicked. */
                                        content = selected + shorcode;
                                    } else {
                                        content = shorcode;
                                    }

                                    editor.execCommand( 'mceInsertContent', 0, content );
                                    editor.windowManager.close();
                                }
                            }, {
                                text: 'Close',
                                id: 'close-vote-btn',
                                onclick: 'close'
                            }],
                        onOpen: function ( e ) {
                            
                            /** Get Votes. */
                            jQuery( '#opinioner-search-results' ).addClass( 'loader' ); // Show loader.
                            jQuery.ajax({
                                url: opinioner_data['rest_url'] + 'wp/v2/opinioner/?filter[posts_per_page]=42',
                                dataType: 'json'
                            } ).done( function ( data ) {
                                jQuery( '#opinioner-search-results ul' ).empty();
                                jQuery.each( data, function ( index, element ) {
                                    jQuery( '#opinioner-search-results ul' ).append(''
                                        + '<li>'
                                        + '<input class="item-vote" type="hidden" value="' + element['id'] + '">'
                                        + '<span class="item-title">' + element['title']['rendered'] + '</span>'
                                        + '<span class="item-info">' + ( new Date( element['date'] ).toLocaleDateString() ) + '</span>'
                                        + '</li>' );
                                } );
                            } )
                            .fail( function ( data ) {
                                console.log( 'error!' );
                                console.log( data );
                            } )
                            .always( function () {
                                jQuery( '#opinioner-search-results' ).removeClass( 'loader' ); // Hide loader.
                            } );

                            /** Filter votes. */
                            jQuery( '#opinioner-search' ).on( 'keyup paste', function () {
                                
                                var s = jQuery( this ).val().toLowerCase(); // For case-insensitive search.
                                if ( s.length > 1 ) { // If the query is longer than 2 letters we look for items.
                                    jQuery( '#opinioner-search-results ul li' ).each( function ( index ) {
                                        if ( ~jQuery( this ).find( '.item-title' ).text().toLowerCase().indexOf(s) ) {
                                            jQuery( this ).show();
                                        } else {
                                            jQuery( this ).hide();
                                        }
                                    } );
                                } else {
                                    jQuery( '#opinioner-search-results ul li' ).show();
                                }
                                
                            } );

                            /** Select vote item. */
                            jQuery( 'body' ).on( 'click', '#opinioner-search-results ul li', function () {
                                jQuery( '#opinioner-search-results ul li' ).removeClass( 'selected' );
                                jQuery( this ).addClass( 'selected' );
                                jQuery( '#insert-opinioner .shortcode' ).html( '[opinioner id="' + jQuery( this ).find( '.item-vote' ).val() + '"]' );
                            } );

                        }
                    } );

                }
            } );

        },

        createControl: function ( n, cm ) {
            return null;
        },

        getInfo: function () {
            return {
                longname: 'Opinioner',
                author: 'Merkulove',
                version: '1.0.0'
            };
        }
    });

    tinymce.PluginManager.add( 'opinioner_plugin', tinymce.plugins.opinioner_plugin );

} )();