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

jQuery(document).ready(function() {
    // Read Cookie.
    var mdp_Cookie = {};
    mdp_Cookie = JSON.parse(readCookie("opinioner_data"));

    // If this is first visit
    if(mdp_Cookie == null) {
        mdp_Cookie = {};
        mdp_Cookie['guid'] = getGUID(); // Mark User with GUID
        
        // Set Cookie
        createCookie("opinioner_data", JSON.stringify(mdp_Cookie));
    }
    
    // Get all votes on page
    var opinioner = jQuery(".opinioner-box");
    
    // For each Opinioner
    opinioner.each(function (i, v) {
        var f_new_vote = 1; // Is this first time vote for user?
        var f_counter_updated = 0; // After first vote, one time update counter.
        
        // ID of current vote
        var id = jQuery(this).attr("id").replace("opinioner-", "");

        // Initial value for tooltip
        var tooltip = jQuery('#opinioner-' + id + ' .vote-slider .value');
        var slider = jQuery('#opinioner-' + id + ' .vote-slider .range');
        tooltip.html(slider.val());
        
        // On slider draging - update and move tooltip
        jQuery('#opinioner-' + id + ' .vote-slider .range').on('input', function () {
            jQuery(this).next().html(this.value + " %");
            jQuery(this).next().css("margin-left", (-15 - Math.round(this.value * 0.2)) + "px"); // Tooltip correction
            jQuery(this).next().css("left", this.value + "%");
        });
        
        // On value changed.
        var vote_val = null;
        var old_vote_val = null;
        jQuery('#opinioner-' + id + ' .vote-slider .range').on('change', function () {
            
            // Store old vote value to decrement it on change vote.
            if(old_vote_val == null){
                old_vote_val = mdp_Cookie["value_" + id];
            }else{
                old_vote_val = vote_val;
            }
            vote_val = this.value;
            
            // Send AJAX
            var data = {
                'action': 'process_vote',
                'vote_id': id,
                'vote_val': vote_val,
                'guid': mdp_Cookie['guid'],
                'new_vote': f_new_vote
            };
            
            // AJAX call
            jQuery('#opinioner-' + id + ' .vote-slider .range').prop('disabled', true); // Disable slider
            jQuery.post(opinioner_ajax.url, data, function(data) {
                if(!data.status){
                    console.log("AJAX Error! See below:");
                    console.log(data);
                    
                    if(typeof data.message !== 'undefined'){
                        alert(data.message);
                    }
                }else{ // AJAX done
                    f_new_vote = 0;
                    
                    // After first vote, one time update counter.
                    if(! f_counter_updated){
                        jQuery('#opinioner-' + id + ' .mdp-counter p b').text(parseInt(jQuery('#opinioner-' + id + ' .mdp-counter p b').text()) + 1);
                        f_counter_updated = 1;
                    }
                
                    // Chart refresh with my vote
                    if(vote_val != null) {
                        window["opinioner_data_" + id]['series'][0][old_vote_val]--; // Value - 1 user voice 
                        window["opinioner_data_" + id]['series'][0][vote_val]++; // Value + 1 user voice 
                        showChart(id); // Refresh result chart.
                        showAterVoteMsg(); // Show After Vote Message.
                    }
                }
            }, 'json').fail(function(data) {
                console.log("AJAX Error! See below:");
                console.log(data);
            }).always(function (){
                jQuery('#opinioner-' + id + ' .vote-slider .range').prop('disabled', false); // Enable slider
            });
            
            // Set Cookie
            mdp_Cookie['value_' + id] = vote_val;
            createCookie("opinioner_data", JSON.stringify(mdp_Cookie));
            
        } );
        
        /**  Read Cookie. */
        mdp_Cookie = JSON.parse(readCookie("opinioner_data"));
        if(mdp_Cookie["value_" + id] != null){
            f_new_vote = 0; // Already voted in this poll.
            f_counter_updated = 1;
            
            // Set previous vote value
            jQuery('#opinioner-' + id + ' .vote-slider .range').val(mdp_Cookie["value_" + id]);
            tooltip.html(slider.val());
            tooltip.css("margin-left", (-15 - Math.round(slider.val() * 0.2)) + "px"); // Tooltip correction
            tooltip.css("left", slider.val() + "%");

            /** Show result chart. */
            showChart(id);
            showAterVoteMsg(); // Show After Vote Message.
        }else{

            // Check is voting open or closed
            var opinionerVotingStatus = jQuery('#opinioner-' + id + ' .vote-slider');

            if ( opinionerVotingStatus.length !== 0 ) {

                // Hide result chart
                jQuery('#opinioner-' + id + ' .ct-chart').hide();
                showBeforeVoteMsg(); // Show Before Vote Message.

            } else {

                // Show results chart
                showChart(id);
                showAterVoteMsg(); // Show After Vote Message.

            }

        }

        /**
        * Show After Vote Message.
        */
        function showAterVoteMsg() {

            // Hide Before Vote Message
            jQuery('#opinioner-' + id + ' .mdp-before-vote-msg').hide();

            // Remove Befor Vote Message
            setTimeout( function () {
                jQuery('#opinioner-' + id + ' .mdp-before-vote-msg').remove();
            }, 1000);
            
            // Show After Vote Message
            jQuery('#opinioner-' + id + ' .mdp-after-vote-msg').show();

            // Remove After Vote Message after showing
            setTimeout( function () {
                jQuery('#opinioner-' + id + ' .mdp-after-vote-msg').remove();
            }, 4000);

        }
        
        /**
        * Show Before Vote Message.
        */
        function showBeforeVoteMsg() {

            // Show Before Vote Message
            jQuery('#opinioner-' + id + ' .mdp-before-vote-msg').show();
            
            // Hide After Vote Message
            jQuery('#opinioner-' + id + ' .mdp-after-vote-msg').hide();

        }
        
    });
    
    /**
     * Pseudo GUID, user as unique user id
     * 
     * @returns {String}
     */
    function getGUID() {
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
            var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
            return v.toString(16);
        });
    }
    
    /**
    * Create сookie value
    * 
    * @param {type} name
    * @param {type} value
    * @param {type} days
    * @returns {undefined}
    */
    function createCookie(name, value, days) {
       var expires = "";
       if (days) {
           var date = new Date();
           date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
           expires = "; expires=" + date.toUTCString();
       }
       document.cookie = name + "=" + value + expires + "; path=/";
    }

    /**
    * Read value from Cookie
    * 
    * @param {type} name
    * @returns {unresolved}
    */
    function readCookie(name) {
       var nameEQ = name + "=";
       var ca = document.cookie.split(';');
       for (var i = 0; i < ca.length; i++) {
           var c = ca[i];
           while (c.charAt(0) == ' ')
               c = c.substring(1, c.length);
           if (c.indexOf(nameEQ) == 0)
               return c.substring(nameEQ.length, c.length);
       }
       return null;
    }

    /**
    * Erase Cookie Value
    * 
    * @param {type} name
    * @returns {undefined}
    */
    function eraseCookie(name) {
       createCookie(name, "", -1);
    }
    
});