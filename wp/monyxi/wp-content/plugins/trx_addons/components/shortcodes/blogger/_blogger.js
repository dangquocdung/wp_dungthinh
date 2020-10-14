/**
 * Blogger scripts
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.1
 */

/* global jQuery:false */
/* global TRX_ADDONS_STORAGE:false */

// Init handlers
jQuery(document).on('action.ready_trx_addons', function() {

    "use strict";

    if (jQuery('.sc_blogger_filters').length > 0) {
        // AJAX loader for the pages
        // jQuery('.sc_bloggertabs_ajax').on( "click", '.sc_blogger_filters_titles a', function(e) {
        //     var panel = jQuery(this).parents('.sc_blogger');
        //     trx_addons_tab_content_loader(panel, jQuery(this).data('tab'), jQuery(this).data('taxonomy'));
        //     e.preventDefault();
        //     return false;
        // });




		var pagination_busy = false;
		// Load next page by AJAX
		jQuery('.sc_blogger_filters:not(.inited)')
			.addClass('inited')
			.on('click', 'a', function(e) {
				if (!pagination_busy) {
					pagination_busy = true;
					var link = jQuery(this),
						pagination_wrap = link.parents('.sc_blogger_filters'),
						sc = pagination_wrap.parent(),
						posts = sc.find('.sc_blogger_content');

					jQuery.post(TRX_ADDONS_STORAGE['ajax_url'], {
						action: 'trx_addons_item_pagination',
						nonce: TRX_ADDONS_STORAGE['ajax_nonce'],
						params: pagination_wrap.data('params'),
						page: jQuery(this).data('page'),
						filters_active: jQuery(this).data('tab')
					}).done(function(response) {
						var rez = {};
						if (response=='' || response==0) {
							rez = { error: TRX_ADDONS_STORAGE['msg_ajax_error'] };
						} else {
							try {
								rez = JSON.parse(response);
							} catch (e) {
								rez = { error: TRX_ADDONS_STORAGE['msg_ajax_error'] };
								console.log(response);
							}
						}
						if (rez.error === '') {
							// Add inline styles
							if (rez.css != '') {
								var	selector = 'trx_addons-inline-styles-inline-css',
									inline_css = jQuery('#'+selector);
								if (inline_css.length == 0)
									jQuery('body').append('<style id="'+selector+'" type="text/css">' + rez.css + '</style>');
								else
									inline_css.append(rez.css);
							}
							// Append posts
                            sc.fadeOut(function() {
                                sc.after(jQuery(rez.data).hide());
                                var sc_new = sc.next();
                                sc.remove();
                                sc_new.fadeIn();
                                jQuery(document).trigger('action.init_hidden_elements', [sc_new]);
                            });
						} else {
							alert(rez.error);
						}
						pagination_busy = false;
					});
				}
				e.preventDefault();
				return false;
			});


    }

    // Load tab's content
    function trx_addons_tab_content_loader(panel, tab, tax) {
		panel.find('.sc_item_pagination .nav-links  a[data-page="1"]').first()
            .attr('data-tab', tab)
            .attr('data-taxonomy', tax)
            .trigger('click');
    }

});
