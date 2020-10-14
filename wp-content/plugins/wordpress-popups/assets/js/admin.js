/*
Author     :  AA-Team - http://themeforest.net/user/AA-Team
*/
// Initialization and events code for the app
SMPNEW_admin = (function ($) {
    "use strict";

	var DISABLED				= false; // disable this module!
	var DEBUG					= false;

    // public
    var debug_level 			= 0,
        maincontainer 			= null,
        loading 						= null,
        $action_status 			= null,
        notices_main 			= null,
        notices_opt 				= {},
        lang                    		= null;


	// init function, autoload
	(function init() {
		// load the triggers
		$(document).ready(function(){
    		if ( DISABLED ) {
    			console.log( 'SMPNEW admin script is DISABLED!' );
    			return false;
    		}
			if (DEBUG) console.log( 'SMPNEW admin script is loaded!' );

			maincontainer 		= $(".SMPNEW_iw");
			loading 					= $(".SMPNEW_iw-loader");
			$action_status 		= maincontainer.find(".SMPNEW-action-status.SMPNEW-message");
            notices_main 		= $("#SMPNEW-admin-mainnotices");

            // language messages
            lang = maincontainer.find('#SMPNEW-mainlang-translation');
            if ( lang.length ) {
            	lang = lang.html();
            	//lang = JSON.stringify(lang);
            	lang = typeof lang != 'undefined'
                	? JSON && JSON.parse(lang) || $.parseJSON(lang) : lang;            	
            }

			maintriggers();

			fix_content_width();
		});

		$(window).resize(function(){
			fix_content_width();
		});
	})();

	function fix_content_width()
	{
		maincontainer.css({
			'height': ( $("#wpwrap").height() - 70 )
		});
	}

    function make_tabs()
    {
    	function show_tab_elements( link, form, that )
    	{
    		var link_name = link.find("a").attr("href").replace("#", "");
 
    		// hide all elements
    		form.find( ".SMPNEW-form-row:not(." + ( link_name ) + ")" ).hide();

    		var cc = 0;
    		form.find( ".SMPNEW-form-row." + link_name  ).each(function() {
    			var that = $(this);

    			if( that.find('div.SMPNEW-form-item > div').hasClass('hide') ) {
    				that.hide();
    			} else {
    				that.show();
    			}

    			if( cc % 2 == 0 ){
    				that.addClass("SMPNEW-even");
    			}

    			if( cc % 1 == 0 ){
    				that.addClass("SMPNEW-odd");
    			}

    			cc++;
    		});

    		that.find(".on").removeClass("on");
    		link.addClass("on");
    	}

		maincontainer.find(".SMPNEW-settings-tabs").each(function(){
			var that = $(this),
				form = that.parents("form").eq(0),
				link = that.find("li").eq(0);

			show_tab_elements( link, form, that );

			that.on('click', 'li a', function(e){
				e.preventDefault();
				var link = $(this).parent("li");
				
				show_tab_elements( link, form, that );
			});
       });
    }

    function saveOptions($btn)
    {
        var theForm         = $btn.parents('form').eq(0),
            value           = $btn.val(),
            statusBoxHtml   = theForm.find('div#SMPNEW-status-box');

		// box amazon categories
		if ( 'yes' == theForm.find('select#SMPNEW-amazon-change-selection').val() ) {
			var amz_selected = SMPNEW_relate_utils.box_amazon_categories.get_box_selection();
			//var $hiddenInput = $('<input/>', {type: 'hidden', name: 'SMPNEW_Main_Settings[amz_country_default]', value: amz_selected.country});
			//$hiddenInput.appendTo( theForm );
			theForm.find('input[name="SMPNEW_Main_Settings[amz_country_default]"]').val( amz_selected.country );
			
			//var $hiddenInput2 = $('<input/>', {type: 'hidden', name: 'SMPNEW_Main_Settings[amz_categories_default]', value: amz_selected.amazoncategories});
			//$hiddenInput2.appendTo( theForm );
			theForm.find('input[name="SMPNEW_Main_Settings[amz_categories_default]"]').val( amz_selected.amazoncategories );
		}
   
        // replace the save button value with loading message
        $btn.val('saving setings ...').removeClass('green').addClass('gray');

        theForm.submit();
        
        // replace the save button value with default message
        $btn.val( value ).removeClass('gray').addClass('green');
    }

	function same_height( $elms )
	{
		$elms.each(function(){
			var row 		= $(this),
				maxHeight 	= 0,
				childs 		= row.find(">div .SMPNEW_iw-dashboard-in-box-content").filter(function(i) {
					return ! $(this).hasClass('not-fixed-height');
				});

			childs.each(function(){
				var that = $(this),
					height = that.height();

				if( maxHeight <= height ){
					maxHeight = height;
				}
			});
			childs.height( maxHeight );
		});
	}

	function register_plugin( that )
	{
		var form = that.parents('form').eq(0);

		loading.show();
		var data = {
            'action'	: 'SMPNEW_register',
			'params'	: form.serialize()
       	};
       	
		$.post(ajaxurl, data, function (response) {
			
			if( response.status == 'valid' ){
				location.reload();
			}

			loading.hide();
			
        }, 'json');
	}

	function maintriggers()
	{
		same_height( maincontainer.find(".SMPNEW_iw-section-dashboard-row") );
        make_tabs();

		$('.SMPNEW-wp-color-picker').wpColorPicker();
		
        $('body').on('click', '.SMPNEW-saveOptions', function(e) {
            e.preventDefault();
            saveOptions( $(this) );
        });
        
        $('body').on('click', '.SMPNEW-show-all-options', function(e) {
            e.preventDefault();
            
            var that = $(this).parents('form').eq(0);
            
            that.find(".we-complex-options").removeClass('we-complex-options');
        });

        maincontainer.find('.SMPNEW_iw-register_plugin').on('click', '.SMPNEW_iw-dashboard-button', function(e) {
        	e.preventDefault();

        	register_plugin( $(this) );
        });


        maincontainer.on('click', '.SMPNEW_iw-require_register', function(e){
        	e.preventDefault();

        	$(".SMPNEW_iw-dashboard-input[name='SMPNEW_iw-validation-token']").focus();
        });

		// Amazon Requests box
		$("body").on("click", ".SMPNEW-demo-keys #SMPNEW-list-rows a", function(e){
			e.preventDefault();
			$(this).parent().find('table').toggle("slow");
		});
		
		font_preview();
	}


	// :: demo keys
	function verify_products_demo_keys() {
		if (DEBUG) console.log( 'You can no longer find related products using our demo keys.' );
		window.location.reload();
	}


    // :: LOG MESSAGES
    function set_status_msg_generic( status, pms ) {
		return AArpr_admin.set_status_msg_generic( status, pms );
    };


	// :: FONT PREVIEW
	function font_preview() {
		function change_font( preview_elm ) {
			var that = preview_elm,
				pair_element = that.parents('.SMPNEW-form-item:first').find('select'),
				pair_value = pair_element.val(),
				google_font_url = "http://fonts.googleapis.com/css?family=" + pair_value;
			
			// step 1, load into DOM the spreadsheet
			$("head").append("<link href='" + ( google_font_url ) + "' rel='stylesheet' type='text/css'>");
			
			// step 2, print the font name into preview with inline font-family
			that.html( "<span style='font-family: " + ( pair_value ) + "'>Grumpy wizards make toxic brew for the evil Queen and Jack.</span>" );
		};
		
		$(".SMPNEW-font-preview").each(function(){
			var that = $(this),
				pair_element = that.parents('.SMPNEW-form-item:first').find('select');

			change_font( that );

			pair_element.change(function(e) {
				var preview = $(this).parents('.SMPNEW-form-item:first').find('.SMPNEW-font-preview');
				change_font( preview );
			});
		});
	};


    // :: MISC
    var misc = {

        hasOwnProperty: function(obj, prop) {
            var proto = obj.__proto__ || obj.constructor.prototype;
            return (prop in obj) &&
            (!(prop in proto) || proto[prop] !== obj[prop]);
        },

        get_current_date: function() {
            var UTCstring = (new Date()).toUTCString();
            return UTCstring;
        },

        is_chrome: function() {
            return window.chrome;
            //return navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
        }

    }

	// external usage
	return {
		'triggers'										: maintriggers,
        'make_tabs'									: make_tabs,
        'set_status_msg_generic'				: set_status_msg_generic,
        'verify_products_demo_keys'		: verify_products_demo_keys
	}
})(jQuery);
