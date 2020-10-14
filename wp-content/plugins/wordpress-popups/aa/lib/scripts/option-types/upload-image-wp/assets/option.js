AArpr_Option_Type_Upload_Image_WP = (function ($) {
    "use strict";
    
    // public
    var debug_level = 0,
        maincontainer = null;
        
    var upload_popup_parent = null;
    
	// init function, autoload
	(function init() {
		// load the triggers
		$(document).ready(function(){

            $('body').on('click', '.upload_image_button_wp, .change_image_button_wp', function(e) {
                e.preventDefault();

                upload_popup_parent = $(this);
                var win = $(window);
                
                send_to_editor();
            
                tb_show('Select image', 'media-upload.php?type=image&amp;height=' + ( parseInt(win.height() / 1.2) ) + '&amp;width=610&amp;post_id=0&amp;from=aaframework&amp;TB_iframe=true');
            });
            
            $('body').on('click', '.remove_image_button_wp', function(e) {
                e.preventDefault();
                
                removeWpUploadImage( $(this) );
            });

		});
	})();
	
    function send_to_editor()
    {
        if( window.send_to_editor != undefined ) {
            // store old send to editor function
            window.restore_send_to_editor = window.send_to_editor;  
        }

        window.send_to_editor = function(html){
            //var thumb_id = $('img', html).attr('class').split('wp-image-');
            var thumb_img   = $('<div/>').html( html ).contents(),
                thumb_id    = thumb_img.attr('class').split('wp-image-');
            thumb_id = parseInt(thumb_id[1]);
            
            var upload_box = upload_popup_parent.parents('.AArpr-upload-image-wp-box').eq(0),
                previewsize = upload_box.find('.upload_image_button_wp').data('previewsize');
            
            $.post(ajaxurl, {
                'action'        : 'AArpr_WPMediaUploadImage',
                'att_id'        : thumb_id,
                'previewsize'   : previewsize
            }, function(response) {

                if (response.status == 'valid') {
                    
                    var upload_box = upload_popup_parent.parents('.AArpr-upload-image-wp-box').eq(0),
                        previewsize = upload_box.find('.upload_image_button_wp').data('previewsize');

                    upload_box.find('input').val( thumb_id );
                    
                    var the_preview_box = upload_box.find('a.upload_image_preview'),
                        the_img         = the_preview_box.find('img');

                    if ( !the_preview_box.length ) {
                        upload_box.find('.AArpr-prev-buttons').before(
                            '<a style="display: block" class="upload_image_preview" target="_blank" href=""></a>'
                        );
                        the_preview_box = upload_box.find('a.upload_image_preview');
                    }
                    if ( !the_img.length ) {
                        the_preview_box.html(
                            '<img style="display: inline-block" src="">'
                        );
                        the_img = the_preview_box.find('img');
                    }
 
                    the_img.attr('src', response.thumb );
                    the_preview_box.attr('href', response.full );
                    
                    the_img.show();
                    the_preview_box.show();

                    upload_box.find('.AArpr-prev-buttons').show();
                    upload_box.find(".upload_image_button_wp").hide();
                
                }

            }, 'json');
            
            tb_remove();
            
            if( window.restore_send_to_editor != undefined ) {
                // store old send to editor function
                window.restore_send_to_editor = window.send_to_editor;  
            }
        }
    }
    
    function removeWpUploadImage( $this )
    {
        var upload_box = $this.parents(".AArpr-upload-image-wp-box").eq(0);
        upload_box.find('input').val('');

        var the_preview_box = upload_box.find('.upload_image_preview'),
            the_img = the_preview_box.find('img');
            
        the_img.attr('src', '');
        the_img.hide();
        the_preview_box.hide();
        upload_box.find('.AArpr-prev-buttons').hide();
        upload_box.find(".upload_image_button_wp").fadeIn('fast');
    }

})(jQuery);