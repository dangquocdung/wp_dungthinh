/*
Author     :  AA-Team - http://themeforest.net/user/AA-Team
*/
// Initialization and events code for the app
AArpr_admin = (function ($) {
    "use strict";
    
	var DISABLED				= false; // disable this module!
	var DEBUG					= false;

    // public
    var debug_level 			= 1,
        maincontainer 			= null,
        loading 						= null,
        $action_status 			= null,
        notices_main 			= null,
        notices_opt 				= {},
        lang                    		= null;

	var plugin_main				= null,
		plugin_alias				= '';

	// init function, autoload
	(function init() {
		// load the triggers
		$(document).ready(function(){
			maincontainer 		= $(".AArpr_iw");
			loading 					= $(".AArpr_iw-loader");
			$action_status 		= maincontainer.find(".AArpr-action-status.AArpr-message");
            notices_main 		= $("#AArpr-admin-mainnotices");
            
            // language messages
            lang = AArpr_lang;
            //console.log( lang ); 
            
            if ( $(".AArpr_plugin_iw").length ) {
            	plugin_main = $(".AArpr_plugin_iw");
            	plugin_alias = plugin_main.data('plugin_alias');
            }

			maintriggers();

			fix_content_width();
		});

		$(window).resize(function(){
			fix_content_width();
		});

		load_ajax();
	})();

	function ajax_loading( that )
	{
		var html = [];

		html.push('<div class="AArpr-loader">');
		html.push(	'<div class="AArpr-loader-square"></div>');
		html.push(	'<div class="AArpr-loader-square"></div>');
		html.push(	'<div class="AArpr-loader-square AArpr-loader-last"></div>');
		html.push(	'<div class="AArpr-loader-square AArpr-loader-clear"></div>');
		html.push(	'<div class="AArpr-loader-square"></div>');
		html.push(	'<div class="AArpr-loader-square AArpr-loader-last"></div>');
		html.push(	'<div class="AArpr-loader-square AArpr-loader-clear"></div>');
		html.push(	'<div class="AArpr-loader-square"></div>');
		html.push(	'<div class="AArpr-loader-square AArpr-loader-last"></div>');
		html.push(	'<span class="AArpr-loader-label">' + ( that.data('label') ) + '</span>');
		html.push('</div>');

		that.html( html.join("\n") );
	}

	function load_ajax()
	{
		$(".AArpr-ajax-action").each(function(){
			var that = $(this),
				action = that.data('action'),
				sub_action = that.data('sub_action'),
				params = that.data('params');

			ajax_loading( that );

			var data = {
	            'action'				: action,
				'sub_action'		: sub_action,
				'params'			: params
	       	};
	       	
			$.post(ajaxurl, data, function (response) {
				if( response.status == 'invalid' ){
					that.html("<div class='AArpr-message AArpr-error'>" + ( response.response ) + "</div>");
				}else{
					that.html( response.html );
				}
				
	        }, 'json');
		});
	}

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
    		form.find( ".AArpr-form-row:not(." + ( link_name ) + "), .AArpr-message:not(." + ( link_name ) + ")" ).hide();

    		var cc = 0;
    		form.find( ".AArpr-form-row." + link_name + ", .AArpr-message." + link_name ).each(function(){
    			var that = $(this);
    			
    			that.show();

    			if( cc % 2 == 0 ){
    				that.addClass("AArpr-even");
    			}

    			else if( cc % 1 == 0 ){
    				that.addClass("AArpr-odd");
    			}

    			cc++;
    		});

    		that.find(".on").removeClass("on");
    		link.addClass("on");
    	}

		$('.AArpr-list-table').find(".AArpr-settings-tabs").each(function(){
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
            statusBoxHtml   = theForm.find('div#AArpr-status-box');

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
				childs 		= row.find(">div .AArpr_iw-dashboard-in-box-content");

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
            'action'	: 'AArpr_register',
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
		same_height( maincontainer.find(".AArpr_iw-section-dashboard-row") );
        make_tabs();

		$('.AArpr-wp-color-picker').wpColorPicker();
		
        $('body').on('click', '.AArpr-saveOptions', function(e) {
            e.preventDefault();
            saveOptions( $(this) );
        });
        
        $('body').on('click', '.AArpr-show-all-options', function(e) {
            e.preventDefault();
            
            var that = $(this).parents('form').eq(0);
            
            that.find(".we-complex-options").removeClass('we-complex-options');
        });

        maincontainer.find('.AArpr_iw-register_plugin').on('click', '.AArpr_iw-dashboard-button', function(e) {
        	e.preventDefault();

        	register_plugin( $(this) );
        });


        maincontainer.on('click', '.AArpr_iw-require_register', function(e){
        	e.preventDefault();

        	$(".AArpr_iw-dashboard-input[name='AArpr_iw-validation-token']").focus();
        });
        
	}
	
	
	/******************************/
	/* list-table class interface */
    var box_list_table = (function() {
        
        var DISABLED				= false; // disable this module!
        var debug_level				= 1,
            module						= 'AArpr_box_list_table',
            main							= null,
            maincontainer			= null,
            mainform					= null,
            mainlogs					= null,
            alias							= null,
            loading						= null,
            confirm_delete			= true;

        // Test!
        function __() {};

        // get public vars
        function get_vars() {
            return $.extend( {}, {} );
        };

        // init function, autoload
        (function init() {
            // load the triggers
            $(document).ready(function() {
				alias					= plugin_alias;
                main          		= plugin_main;
                if ( !main ) {
                	return false;
                }

                maincontainer 	= main.find('.AArpr-list-table');
                mainform			= maincontainer.find('form.AArpr-list-table-form');
				mainlogs      		= main.find('.AArpr-list-table-logs');
				loading 				= main.find('.'+alias+'_iw-loader');

               	triggers();
            });
        })();

        // Triggers
        function triggers() {
            if ( DISABLED ) return false;

	        checkall_checkbox();
	        rows_mark_published();

            // publish/unpublish
            main
                .on( "click", '.AArpr-list-table form.AArpr-list-table-form #the-list tr .row-actions .publish a', do_action_publish );

			// delete
            main
                .on( "click", '.AArpr-list-table form.AArpr-list-table-form #the-list tr .row-actions .delete a', do_action_delete );

			// bulk actions - Apply
            main
                .on( "submit", '.AArpr-list-table form.AArpr-list-table-form', function( e ) {
                    e.preventDefault();
					return false;
                });
            main
                .on( "click", '.AArpr-list-table form.AArpr-list-table-form #doaction, .AArpr-list-table form.AArpr-list-table-form #doaction2', do_bulk_actions );
			/*
	        main
	        	.on('click', 'input#doaction', function(e) {
		            e.preventDefault();
		            
		            var that = $(this),
		                form = that.parents('form').eq(0),
		                _action = form.find('select#bulk-action-selector-top').val();
		 
		            // '_ajax_custom_list_nonce', 'ajaxid', 'order', 'orderby', '_wpnonce', '_wp_http_referer'
		            var field_reset = ['_ajax_custom_list_nonce', 'ajaxid', 'order', 'orderby', '_wp_http_referer'];
		            for (var i in field_reset) {
		                $( 'input[name="'+field_reset[i]+'"]' ).remove();
		            }
		            if ( 'delete' == _action ) {
		                $( 'input[name="paged"]' ).val(1);
		            }
		
		            form.submit();
	        	});
	        */
                
			// Pagination links, sortable link
			main
				.on('click', '.tablenav-pages a, .manage-column.sortable a, .manage-column.sorted a', function(e) {
					e.preventDefault();

					var $this			= $(this),
						  form			= $this.parents('form.AArpr-list-table-form:first'),
						  boxparent 	= form.parents('.AArpr-list-table:first');

					// use the URL to extract our needed variables
					var query = this.search.substring( 1 );

					var data = {
						paged			: get_query( query, { what : 'paged' } ) || '1',
						order			: get_query( query, { what : 'order' } ) || 'desc',
						orderby			: get_query( query, { what : 'orderby' } ) || 'id'
					};

					make_request( 'paged', data, boxparent );
				});
	
			// page number input
			main
				.on('keyup', 'input[name=paged]', function(e) {
					// If user hit enter, we don't want to submit the form
					if ( 13 == e.which )
						e.preventDefault();
		
					var $this			= $(this),
						  form			= $this.parents('form.AArpr-list-table-form:first'),
						  boxparent 	= form.parents('.AArpr-list-table:first');

					// This time we fetch the variables in inputs
					var data = {
						paged			: parseInt( boxparent.find('input[name=paged]').val() ) || '1',
						order			: boxparent.find('input[name=order]').val() || 'desc',
						orderby			: boxparent.find('input[name=orderby]').val() || 'id'
					};
		 
					make_request( 'paged', data, boxparent );
				});
				
			// posts per page
			main
				.on('change', '.AArpr-list-table form.AArpr-list-table-form select[name=AArpr-post-per-page]', function(e){
					e.preventDefault();

					var $this			= $(this),
						  form			= $this.parents('form.AArpr-list-table-form:first'),
						  boxparent 	= form.parents('.AArpr-list-table:first');

					var data = {
						items_per_page : $this.val(),
						paged				: 1,
						order				: boxparent.find('input[name=order]').val() || 'desc',
						orderby				: boxparent.find('input[name=orderby]').val() || 'id'
					};

					make_request( 'items_per_page', data, boxparent );
			});
			
			// filter by drop-downs
			main
				.on('change', '.AArpr-list-table form.AArpr-list-table-form select.AArpr-filter-general_field', function(e){
					e.preventDefault();

					var $this			= $(this),
						  form			= $this.parents('form.AArpr-list-table-form:first'),
						  boxparent 	= form.parents('.AArpr-list-table:first');

					var filter_name = $this.data('filter_field'),
						  filter_val  	= $this.val();

					var data = {
						filter_name    	: filter_name,
						filter_val     		: filter_val,
						paged				: 1,
						order				: boxparent.find('input[name=order]').val() || 'desc',
						orderby				: boxparent.find('input[name=orderby]').val() || 'id'
					};

					make_request( 'general_field', data, boxparent );
			});
			
			// filter by links
			main
				.on('click', '.AArpr-list-table form.AArpr-list-table-form ul.AArpr-filter-general_field a', function(e){
					e.preventDefault();

					var $this			= $(this),
						  form			= $this.parents('form.AArpr-list-table-form:first'),
						  boxparent 	= form.parents('.AArpr-list-table:first');

					var $parent_ul  = $this.parents('ul').first(),
						  filter_name = $parent_ul.data('filter_field'),
						  filter_val  	= $this.data('filter_val');

					var data = {
						filter_name    	: filter_name,
						filter_val     		: filter_val,
						paged				: 1,
						order				: boxparent.find('input[name=order]').val() || 'desc',
						orderby				: boxparent.find('input[name=orderby]').val() || 'id'
					};

					make_request( 'general_field', data, boxparent );
			});
			
			// search text in posts title
			main
				.on('click', '.AArpr-list-table form.AArpr-list-table-form .AArpr-list-table-search-box input[type="button"]', function(e){
					e.preventDefault();
					
					var $this			= $(this),
						  form			= $this.parents('form.AArpr-list-table-form:first'),
						  boxparent 	= form.parents('.AArpr-list-table:first');
						  
					var search_text = $this.parent().find('input[type="search"]');

					var data = {
						search_text		: search_text.val(),
						paged				: 1,
						order				: boxparent.find('input[name=order]').val() || 'desc',
						orderby				: boxparent.find('input[name=orderby]').val() || 'id'
					};

					// highlight search text
					if ( '' != $.trim(data['search_text']) ) {
						search_text.addClass('search-highlight');
					} else {
						search_text.removeClass('search-highlight');
					}

					make_request( 'search', data, boxparent );
			});

        };
        
        function do_bulk_actions(e) {
			e.preventDefault();
			console.log( 'AArpr_admin.bulk_actions' );

			var $this			= $(this),
				  form			= $this.parents('form.AArpr-list-table-form:first'),
				  boxparent 	= form.parents('.AArpr-list-table:first'),
				  n 				= $this.prop( 'id' ).substr( 2 ),
				  act				= $this.parent().find( 'select[name="' + n + '"]' ).val();
			
			if ( -1 == act ) {
				alert( lang.no_bulk_action );
				return false;
			}

			// /aa/assets/js/admin.js : use > -1 if you need this event in a specific plugin
			//if ( $.inArray(act, ['delete', 'publish', 'unpublish']) == -1 ) {
			//	return false;
			//}

			var qs = {};
			qs = $.extend(
				{
					paged			: 'delete' == act ? 1 : (parseInt( boxparent.find('input[name=paged]').val() ) || '1'),
					order			: boxparent.find('input[name=order]').val() || 'desc',
					orderby			: boxparent.find('input[name=orderby]').val() || 'id'
				},
				{
					id					: bulk_ids( form.find('#the-list tr') ).join(','),
					is_bulk			: 1
				}
			);
			//console.log( qs );
			if ( '' == qs.id ) {
				alert( lang.no_items_selected );
				return false;
			}

			if ( 'delete' == act ) {
				!confirm_delete ? make_request( act, qs, boxparent ) : ( confirm( lang.delete_confirm ) ? make_request( act, qs, boxparent ) : null );
			}
			else if ( $.inArray(act, ['publish', 'unpublish']) > -1 ) {
				make_request( act, qs, boxparent );
			}
		};

		function do_action_delete(e) {
			e.preventDefault();
			console.log( 'AArpr_admin.action_delete' );

			var $this			= $(this),
				  form			= $this.parents('form.AArpr-list-table-form:first'),
				  boxparent 	= form.parents('.AArpr-list-table:first'),
				  query			= this.search.substring( 1 ), //$this.prop('href'),
				  qs				= {};

			qs = $.extend(
				{
					paged			: 1, //parseInt( boxparent.find('input[name=paged]').val() ) || '1',
					order			: boxparent.find('input[name=order]').val() || 'desc',
					orderby			: boxparent.find('input[name=orderby]').val() || 'id'
				},
				get_query( query )
			);
			//console.log( qs );
			!confirm_delete ? make_request( 'delete', qs, boxparent ) :
				( confirm( lang.delete_confirm ) ? make_request( 'delete', qs, boxparent ) : null );
		};
		
		function do_action_publish(e) {
			e.preventDefault();
			console.log( 'AArpr_admin.action_publish' );

			var $this			= $(this),
				  form			= $this.parents('form.AArpr-list-table-form:first'),
				  boxparent 	= form.parents('.AArpr-list-table:first'),
				  query			= this.search.substring( 1 ), //$this.prop('href'),
				  qs				= {};

			qs = $.extend(
				{
					paged			: parseInt( boxparent.find('input[name=paged]').val() ) || '1',
					order			: boxparent.find('input[name=order]').val() || 'desc',
					orderby			: boxparent.find('input[name=orderby]').val() || 'id'
				},
				get_query( query )
			);
			//console.log( qs );
			make_request( qs['sub_action'], qs, boxparent );
		};

		function make_request( action, params, box )
		{
			loading.show();
			loading.find('span').html('');

			delete params['sub_action'];
			//console.log( box, params );

			$.ajax({
				url: ajaxurl,
				data: $.extend(
					{
						_ajax_custom_list_nonce	: box.find('#_ajax_custom_list_nonce').val(),
						action								: box.find("#ajaxid").val(),
						ajax_id								: box.find("#ajaxid").val(),
						sub_action						: action,
						params								: params,

						// mandatory, otherwise the wp pagination which uses $_REQUEST don't work
						paged								: params['paged'],
						order								: params['order'],
						orderby								: params['orderby']
					},
					{}
				),
				// Handle the successful result
				success: function( response ) {
	
					// WP_List_Table::ajax_response() returns json
					var response = $.parseJSON( response );

					// rebuild table based on response
					rebuild_table( response, box );

					// write log
					write_log( response, null, { 'from' : module } );

					// hide the loader
					loading.fadeOut(250);
				},
				error: function( response ) {
					// hide the loader
					//loading.fadeOut(250);
				}
			});
		};
		
		function rebuild_table( response, box ) {
			var box = box.find('form.AArpr-list-table-form:first');

			// add the requested rows
			if ( response.rows.length ) {
				box.find('.wp-list-table #the-list').html( response.rows );
			}
 
			// update column headers for sorting
			if ( response.column_headers.length ) {
				box.find('.wp-list-table > thead tr, .wp-list-table > tfoot tr').html( response.column_headers );
			}
			
			// update filters
			if ( response.print_filters.length ) {
				var pg = box.find('.tablenav.top .AArpr-list-table-wrapper');
				pg.after( response.print_filters );
				pg.remove();
			}
			if ( response.print_filters_bottom.length ) {
				var pg = box.find('.tablenav.bottom');
				pg.html( response.print_filters_bottom );
			}
						
			// update pagination for navigation
			if ( response.pagination.top.length ) {
				if ( box.find('.tablenav.top .tablenav-pages').length < 0 ) {
					var $div = $("<div>", {"class": "tablenav-pages"});
					box.find('.tablenav.top .AArpr-list-table-wrapper .AArpr-list-table-right-col').append( $div );
				}
				//box.find('.tablenav.top .tablenav-pages').html( $(response.pagination.top).html() );
				var pg = box.find('.tablenav.top .tablenav-pages');
				pg.after( response.pagination.top );
				pg.remove();
			}
						
			if ( response.pagination.bottom.length ) {
				if ( box.find('.tablenav.bottom .tablenav-pages').length < 0 ) {
					var $div = $("<div>", {"class": "tablenav-pages"});
					box.find('.tablenav.bottom .actions.bulkactions').after( $div );
				}
				//box.find('.tablenav.bottom .tablenav-pages').html( $(response.pagination.bottom).html() );
				var pg = box.find('.tablenav.bottom .tablenav-pages');
				pg.after( response.pagination.bottom );
				pg.remove();
			}
			
			// update items per page
			if ( response.box_items_per_page.length ) {
				var pg = box.find('.tablenav.top .AArpr-box-show-per-pages');
				pg.after( response.box_items_per_page );
				pg.remove();
				
				var pg = box.find('.tablenav.bottom .AArpr-box-show-per-pages');
				pg.after( response.box_items_per_page );
				pg.remove();
			}

			// init back our event handlers
			checkall_checkbox();
			rows_mark_published();
		}

        function get_query( query, pms ) {
	        var pms		= typeof pms == 'object' ? pms : {},
				  what		= misc.hasOwnProperty(pms, 'what') ? pms.what : '',
            	  exclude	= misc.hasOwnProperty(pms, 'exclude') ? pms.exclude : ['page'],

        	//query.substr( query.indexOf('admin.php?') ).replace('admin.php?', '')
        	query = -1 != query.indexOf('?') ? query.split('?')[1] : query;
			var vars = query.split('&');

			var ret = {};
			for (var k in vars) {
				var v = vars[k].split('=');

				if ( '' != what && what == v[0] ) {
					return v[1];
				}
				if ( $.isArray( exclude ) && $.inArray( v[0], exclude ) > -1 ) continue;
				ret[v[0]] = v[1];
			}

			if ( '' != what ) return false;
			return ret;
        };
        
        function bulk_ids( container ) {
			var list = container.find('input[type="checkbox"]:checked'),
				  ret = [];
			list.each(function(i) {
				ret.push( $(this).val() );
			});
			return ret; 
        };

		function rows_mark_published() {
			var rows = main.find('.AArpr-list-table form.AArpr-list-table-form #the-list tr');
			rows.each(function(i) {
				var $this 		= $(this),
					  actions 	= $this.find('.row-actions .publish a'),
					  is_published = actions.data('published');
 
				if ( '1' == is_published ) {
					$this.addClass('published');
				} else {
					$this.removeClass('published');
				}
			});
		}

	    //source: /wp-admin/js/common.js
		function checkall_checkbox() {
	        var checks, first, last, checked, sliced, lastClicked = false;
	
	        // check all checkboxes
	        main.find('tbody').children().children('.check-column').find(':checkbox').on( 'click', function(e) {
	            if ( 'undefined' == e.shiftKey ) { return true; }
	            if ( e.shiftKey ) {
	                if ( !lastClicked ) { return true; }
	                checks = $( lastClicked ).closest( 'form' ).find( ':checkbox' ).filter( ':visible:enabled' );
	                first = checks.index( lastClicked );
	                last = checks.index( this );
	                checked = $(this).prop('checked');
	                if ( 0 < first && 0 < last && first != last ) {
	                    sliced = ( last > first ) ? checks.slice( first, last ) : checks.slice( last, first );
	                    sliced.prop( 'checked', function() {
	                        if ( $(this).closest('tr').is(':visible') )
	                            return checked;
	    
	                        return false;
	                    });
	                }
	            }
	            lastClicked = this;
	    
	            // toggle "check all" checkboxes
	            var unchecked = $(this).closest('tbody').find(':checkbox').filter(':visible:enabled').not(':checked');
	            $(this).closest('table').children('thead, tfoot').find(':checkbox').prop('checked', function() {
	                return ( 0 === unchecked.length );
	            });
	    
	            return true;
	        });
	    
	        main.find('thead, tfoot').find('.check-column :checkbox').on( 'click.wp-toggle-checkboxes', function( event ) {
	            var $this = $(this),
	                $table = $this.closest( 'table' ),
	                controlChecked = $this.prop('checked'),
	                toggle = event.shiftKey || $this.data('wp-toggle');
	    
	            $table.children( 'tbody' ).filter(':visible')
	                .children().children('.check-column').find(':checkbox')
	                .prop('checked', function() {
	                    if ( $(this).is(':hidden,:disabled') ) {
	                        return false;
	                    }
	    
	                    if ( toggle ) {
	                        return ! $(this).prop( 'checked' );
	                    } else if ( controlChecked ) {
	                        return true;
	                    }
	    
	                    return false;
	                });
	    
	            $table.children('thead,  tfoot').filter(':visible')
	                .children().children('.check-column').find(':checkbox')
	                .prop('checked', function() {
	                    if ( toggle ) {
	                        return false;
	                    } else if ( controlChecked ) {
	                        return true;
	                    }
	    
	                    return false;
	                });
	        });
		};

        // set log messages
        function set_status_msg( status, msg, op, from ) {
            var pms = {
                container	: mainlogs, 
                msg			: msg,
                op				: op,
                from			: ( 'undefined' != typeof( from ) ? from : module ),
            };
            set_status_msg_generic( status, pms );
        };
        
		function write_log( response, logbox, pms ) {
        var pms			= typeof pms == 'object' ? pms : {},
            from				= misc.hasOwnProperty(pms, 'from') ? pms.from : '';

			mainlogs = logbox || mainlogs;
			//console.log( box, mainlogs, response );

			if ( misc.hasOwnProperty(response, 'status') && misc.hasOwnProperty(response, 'msg') ) {
				var msg_title = misc.hasOwnProperty(response, 'msg_title') ? response.msg_title : '';
				set_status_msg( response.status, response.msg, msg_title, from );
				mainlogs.show();
			}
			// DEBUG Query
			if ( debug_level ) {
				if ( misc.hasOwnProperty(response, 'status') && misc.hasOwnProperty(response, 'sql') ) {
					set_status_msg( response.status, response.sql, 'SQL', from ); // debug query
					mainlogs.show();
				}
			}
			return true;
		};

        // external usage
        return {
            // attributes
            'v'                     		: get_vars,
            
            // methods
            '__'                    		: __,
            //'loading'               		: loading
            'make_request'	  		: make_request,
            'rebuild_table'	  		: rebuild_table,
            'do_bulk_actions'		: do_bulk_actions,
            'do_action_delete'		: do_action_delete,
            'do_action_publish'	: do_action_publish,
            'bulk_ids'			  		: bulk_ids,
            'get_query'				: get_query,
            'write_log'					: write_log
        };

    })();
	/* end: list-table class interface */
	/******************************/


    // :: LOG MESSAGES
    function set_status_msg_generic( status, pms ) {
        var pms         = typeof pms == 'object' ? pms : {},
            msg         = misc.hasOwnProperty(pms, 'msg') ? pms.msg : '',
            op          = misc.hasOwnProperty(pms, 'op') ? pms.op : '',
            from        = misc.hasOwnProperty(pms, 'from') ? pms.from : '',
            container   = misc.hasOwnProperty(pms, 'container') ? pms.container : '';

        var _op         = ( '' != from ? from + ' :: ' : '' ) + op,
            wrap        = { li: '', i: '', span: '' };
 
        switch (status) {
            case 'invalid':
                wrap.li = 'error';
                wrap.i = 'minus-circle';
                wrap.span = 'error';
                break;
                
            case 'valid':
                wrap.li = 'success';
                wrap.i = 'check-circle';
                wrap.span = 'success';
                break;
                
            case 'info':
            default:
                wrap.li = 'notice';
                wrap.i = 'info';
                wrap.span = 'info';
                break;
        }
        //<span class="AArpr-insane-logs-frame">Yesterday 10:24 PM</span>
        var html = '' +
            '<li class="AArpr-log-' + wrap.li + '">' +
                '<i class="fa fa-' + wrap.i + '"></i>' +
                '<span class="AArpr-insane-logs-frame">' + misc.get_current_date() + '</span>' +
                '<span class="AArpr-insane-logs-frame">' + _op + '</span>' +
                '<br />' +
                '<span class="AArpr-insane-logs-msg"> ' + msg + '</span>' +
            '</li>',
            html_ = '' +
            '<span class="AArpr-message AArpr-' + wrap.span + '">' +
                '<span class="AArpr-insane-logs-frame">' + misc.get_current_date() + '</span>' +
                '<span class="AArpr-insane-logs-frame">' + _op + '</span>' +
                '<br />' +
                '<span class="AArpr-insane-logs-msg"> ' + msg + '</span>' +
            '</span>';

        container.find('ul.AArpr-insane-logs').prepend( html );
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


    // :: GET public vars 
	// get public vars
	function get_vars() {
		return $.extend( {}, {
			'debug_level'			: debug_level,
        	'lang'						: lang,
        	'loading'				: loading
		} );
	};

	// external usage
	return {
		// attributes
		'v'                     		: get_vars,
            
		// methods
		'triggers'										: maintriggers,
        'make_tabs'									: make_tabs,
        'ajax_loading'								: ajax_loading,
        'saveOptions'								: saveOptions,
        'set_status_msg_generic'				: set_status_msg_generic,
        box_list_table								: {
            'make_request'	  		: box_list_table.make_request,
            'rebuild_table'	  		: box_list_table.rebuild_table,
            'do_bulk_actions'		: box_list_table.do_bulk_actions,
            'do_action_delete'		: box_list_table.do_action_delete,
            'do_action_publish'	: box_list_table.do_action_publish,
            'bulk_ids'			  		: box_list_table.bulk_ids,
            'get_query'				: box_list_table.get_query,
            'write_log'					: box_list_table.write_log
        }
	}
})(jQuery);
