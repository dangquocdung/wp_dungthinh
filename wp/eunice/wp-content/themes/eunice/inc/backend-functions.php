<?php
/*
 * All Back-End Helper Functions for Eunice Theme
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */

/* Validate px entered in field */
if( ! function_exists( 'eunice_check_px' ) ) {
  function eunice_check_px( $num ) {
    return ( is_numeric( $num ) ) ? $num . 'px' : $num;
  }
}

/* Escape Strings */
if( ! function_exists( 'eunice_vt_esc_string' ) ) {
  function eunice_vt_esc_string( $num ) {
    return preg_replace('/\D/', '', $num);
  }
}

/* Escape Numbers */
if( ! function_exists( 'eunice_vt_esc_number' ) ) {
  function eunice_vt_esc_number( $num ) {
    return preg_replace('/[^a-zA-Z]/', '', $num);
  }
}

/* Compress CSS */
if ( ! function_exists( 'eunice_compress_css_lines' ) ) {
  function eunice_compress_css_lines( $css ) {
    $css  = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
    $css  = str_replace( ': ', ':', $css );
    $css  = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $css );
    return $css;
  }
}

/* Inline Style */
global $all_inline_styles;
$all_inline_styles = array();
if( ! function_exists( 'add_inline_style' ) ) {
  function add_inline_style( $style ) {
    global $all_inline_styles;
    array_push( $all_inline_styles, $style );
  }
}

/* Support WordPress uploader to following file extensions */
if( ! function_exists( 'eunice_vt_upload_mimes' ) ) {
  function eunice_vt_upload_mimes( $mimes ) {

    $mimes['ttf']   = 'font/ttf';
    $mimes['eot']   = 'font/eot';
    $mimes['svg']   = 'font/svg';
    $mimes['woff']  = 'font/woff';
    $mimes['otf']   = 'font/otf';

    return $mimes;

  }
  add_filter( 'upload_mimes', 'eunice_vt_upload_mimes' );
}

/* Custom WordPress admin login logo */
if( ! function_exists( 'eunice_theme_login_logo' ) ) {
  function eunice_theme_login_logo() {
    $login_logo = cs_get_option('brand_logo_wp');
    if($login_logo) {
      $login_logo_url = wp_get_attachment_url($login_logo);
    } else {
      $login_logo_url = EUNICE_IMAGES . '/logo.png';
    }
    if($login_logo) {
    echo "
      <style>
  	    body.login #login h1 a {
  	    background: url('$login_logo_url') no-repeat scroll center bottom transparent;
  	    height: 100px;
  	    width: 100%;
  	    margin-bottom:0px;
  	    }
      </style>";
    }
  }
  add_action('login_head', 'eunice_theme_login_logo');
}

/* WordPress admin login logo link */
if( ! function_exists( 'eunice_login_url' ) ) {
  function eunice_login_url() {
    return site_url();
  }
  add_filter( 'login_headerurl', 'eunice_login_url', 10, 4 );
}

/* WordPress admin login logo link */
if( ! function_exists( 'eunice_login_title' ) ) {
  function eunice_login_title() {
    return get_bloginfo('name');
  }
  add_filter('login_headertext', 'eunice_login_title');
}

/**
 * TinyMCE Editor
 */

// Enable font size & font family selects in the editor
if ( ! function_exists( 'eunice_tinymce_btns_font' ) ) {
  function eunice_tinymce_btns_font( $buttons ) {
    array_unshift( $buttons, 'fontselect' ); // Add Font Select
    array_unshift( $buttons, 'fontsizeselect' ); // Add Font Size Select
    return $buttons;
  }
  add_filter( 'mce_buttons_2', 'eunice_tinymce_btns_font' );
}

// Customize mce editor font sizes
if ( ! function_exists( 'eunice_tinymce_sizes' ) ) {
  function eunice_tinymce_sizes( $initArray ){
    $initArray['fontsize_formats'] = "9px 10px 12px 13px 14px 16px 18px 21px 24px 28px 32px 36px";
    return $initArray;
  }
  add_filter( 'tiny_mce_before_init', 'eunice_tinymce_sizes' );
}

// Customize mce editor font family
if ( ! function_exists( 'eunice_tinmymce_family' ) ) {
  function eunice_tinmymce_family( $initArray ) {
      $initArray['font_formats'] = 'Amiri=Amiri,serif;Montserrat=Montserrat,sans-serif;Andale Mono=andale mono,times;Arial=arial,helvetica,sans-serif;Arial Black=arial black,avant garde;Book Antiqua=book antiqua,palatino;Comic Sans MS=comic sans ms,sans-serif;Courier New=courier new,courier;Georgia=georgia,palatino;Helvetica=helvetica;Impact=impact,chicago;Symbol=symbol;Tahoma=tahoma,arial,helvetica,sans-serif;Terminal=terminal,monaco;Times New Roman=times new roman,times;Trebuchet MS=trebuchet ms,geneva;Verdana=verdana,geneva;Webdings=webdings;Wingdings=wingdings,zapf dingbats';
            return $initArray;
  }
  add_filter( 'tiny_mce_before_init', 'eunice_tinmymce_family' );
}

/* HEX to RGB */
if( ! function_exists( 'eunice_vt_hex2rgb' ) ) {
  function eunice_vt_hex2rgb( $hexcolor, $opacity = 1 ) {

    if( preg_match( '/^#[a-fA-F0-9]{6}|#[a-fA-F0-9]{3}$/i', $hexcolor ) ) {

      $hex    = str_replace( '#', '', $hexcolor );

      if( strlen( $hex ) == 3 ) {
        $r    = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
        $g    = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
        $b    = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
      } else {
        $r    = hexdec( substr( $hex, 0, 2 ) );
        $g    = hexdec( substr( $hex, 2, 2 ) );
        $b    = hexdec( substr( $hex, 4, 2 ) );
      }

      return ( isset( $opacity ) && $opacity != 1 ) ? 'rgba('. $r .', '. $g .', '. $b .', '. $opacity .')' : ' ' . $hexcolor;

    } else {

      return $hexcolor;

    }

  }
}

/* Yoast Plugin Metabox Low */
if( ! function_exists( 'eunice_vt_yoast_metabox' ) ) {
  function eunice_vt_yoast_metabox() {
    return 'low';
  }
  add_filter( 'wpseo_metabox_prio', 'eunice_vt_yoast_metabox' );
}

if( ! function_exists( 'eunice_is_post_type' ) ) {
  function eunice_is_post_type($type){
    global $wp_query;
    if($type == get_post_type($wp_query->post->ID)) return true;
    return false;
  }
}

/**
 * If WooCommerce Plugin Activated
 */
if ( ! function_exists( 'eunice_is_woocommerce_activated' ) ) {
  function eunice_is_woocommerce_activated() {
    if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
  }
}

/**
 * If is WooCommerce Shop
 */
if ( ! function_exists( 'eunice_is_woocommerce_shop' ) ) {
  function eunice_is_woocommerce_shop() {
    if ( eunice_is_woocommerce_activated() && is_shop() ) { return true; } else { return false; }
  }
}

/**
 * If is WPML is active
 */
if ( ! function_exists( 'eunice_is_wpml_activated' ) ) {
  function eunice_is_wpml_activated() {
    if ( class_exists( 'SitePress' ) ) { return true; } else { return false; }
  }
}

/**
 * Remove Rev Slider Metabox
 */
if ( is_admin() ) {

  if( ! function_exists( 'eunice_remove_rev_slider_meta_boxes' ) ) {
    function eunice_remove_rev_slider_meta_boxes() {
      remove_meta_box( 'mymetabox_revslider_0', 'page', 'normal' );
      remove_meta_box( 'mymetabox_revslider_0', 'post', 'normal' );
      remove_meta_box( 'mymetabox_revslider_0', 'team', 'normal' );
      remove_meta_box( 'mymetabox_revslider_0', 'testimonial', 'normal' );
      remove_meta_box( 'mymetabox_revslider_0', 'gallery', 'normal' );
    }
    add_action( 'do_meta_boxes', 'eunice_remove_rev_slider_meta_boxes' );
  }

}

/**
 * Plugin class
 **/
if ( ! class_exists( 'Eunice_Gallery_Category_Meta' ) ) {

class Eunice_Gallery_Category_Meta {

  public function __construct() {
    //
  }

 /*
  * Initialize the class and start calling our hooks and filters
  * @since 1.0.0
 */
 public function init() {
   add_action( 'gallery_category_add_form_fields', array ( $this, 'eunice_add_gallery_category_image' ), 10, 2 );
   add_action( 'created_gallery_category', array ( $this, 'eunice_save_gallery_category_image' ), 10, 2 );
   add_action( 'gallery_category_edit_form_fields', array ( $this, 'eunice_update_gallery_category_image' ), 10, 2 );
   add_action( 'edited_gallery_category', array ( $this, 'eunice_updated_gallery_category_image' ), 10, 2 );
   add_action( 'admin_enqueue_scripts', array( $this, 'load_media' ) );
   add_action( 'admin_footer', array ( $this, 'eunice_add_script' ) );
   add_filter( "manage_edit-gallery_category_columns", array( $this, 'eunice_custom_column_header'), 10);
   add_action( "manage_gallery_category_custom_column", array( $this, 'eunice_custom_column_content'), 10, 3);
 }

public function load_media() {
 wp_enqueue_media();
}

 /*
  * Add a form field in the new gallery_category page
  * @since 1.0.0
 */
 public function eunice_add_gallery_category_image ( $taxonomy ) { ?>
   <div class="form-field term-group">
     <label for="gallery_category-image-id"><?php _e('Image', 'eunice'); ?></label>
     <input type="hidden" id="gallery_category-image-id" name="gallery_category-image-id" class="custom_media_url" value="">
     <div id="gallery_category-image-wrapper"></div>
     <p>
       <input type="button" class="button button-secondary eunice_tax_media_button" id="eunice_tax_media_button" name="eunice_tax_media_button" value="<?php _e( 'Add Image', 'eunice' ); ?>" />
       <input type="button" class="button button-secondary eunice_tax_media_remove" id="eunice_tax_media_remove" name="eunice_tax_media_remove" value="<?php _e( 'Remove Image', 'eunice' ); ?>" />
    </p>
   </div>
 <?php
 }

 /*
  * Save the form field
  * @since 1.0.0
 */
 public function eunice_save_gallery_category_image ( $term_id, $tt_id ) {
   if( isset( $_POST['gallery_category-image-id'] ) && '' !== $_POST['gallery_category-image-id'] ){
     $image = $_POST['gallery_category-image-id'];
     add_term_meta( $term_id, 'gallery_category-image-id', $image, true );
   }
 }

 /*
  * Edit the form field
  * @since 1.0.0
 */
 public function eunice_update_gallery_category_image ( $term, $taxonomy ) { ?>
   <tr class="form-field term-group-wrap">
     <th scope="row">
       <label for="gallery_category-image-id"><?php _e( 'Image', 'eunice' ); ?></label>
     </th>
     <td>
       <?php $image_id = get_term_meta ( $term -> term_id, 'gallery_category-image-id', true ); ?>
       <input type="hidden" id="gallery_category-image-id" name="gallery_category-image-id" value="<?php echo $image_id; ?>">
       <div id="gallery_category-image-wrapper">
         <?php if ( $image_id ) { ?>
           <?php echo wp_get_attachment_image ( $image_id, 'thumbnail' ); ?>
         <?php } ?>
       </div>
       <p>
         <input type="button" class="button button-secondary eunice_tax_media_button" id="eunice_tax_media_button" name="eunice_tax_media_button" value="<?php _e( 'Add Image', 'eunice' ); ?>" />
         <input type="button" class="button button-secondary eunice_tax_media_remove" id="eunice_tax_media_remove" name="eunice_tax_media_remove" value="<?php _e( 'Remove Image', 'eunice' ); ?>" />
       </p>
     </td>
   </tr>
 <?php
 }

/*
 * Update the form field value
 * @since 1.0.0
 */
 public function eunice_updated_gallery_category_image ( $term_id, $tt_id ) {
   if( isset( $_POST['gallery_category-image-id'] ) && '' !== $_POST['gallery_category-image-id'] ){
     $image = $_POST['gallery_category-image-id'];
     update_term_meta ( $term_id, 'gallery_category-image-id', $image );
   } else {
     update_term_meta ( $term_id, 'gallery_category-image-id', '' );
   }
 }

 // category image shoing on the column
  public function eunice_custom_column_header( $columns ){
    $columns = array();
    $columns['name'] = esc_html__('Name', 'eunice');
    $columns['image_header'] = esc_html__('Image', 'eunice');
    $columns['slug'] = esc_html__('Slug', 'eunice');
    $columns['description'] = esc_html__('Description', 'eunice');
    $columns['posts'] = esc_html__('Posts', 'eunice');
    return $columns;
  }

  public function eunice_custom_column_content( $value, $column_name, $tax_id ){
    if ($column_name === 'image_header') {
      $image_id = get_term_meta ( $tax_id, 'gallery_category-image-id', true );
      echo wp_get_attachment_image( $image_id, array( 70, 70 ), true );
    }
  }

  /*
   * Add script
   * @since 1.0.0
   */
 public function eunice_add_script() { ?>
   <script>
     jQuery(document).ready( function($) {
       function eunice_media_upload(button_class) {
         var _custom_media = true,
         _orig_send_attachment = wp.media.editor.send.attachment;
         $('body').on('click', button_class, function(e) {
           var button_id = '#'+$(this).attr('id');
           var send_attachment_bkp = wp.media.editor.send.attachment;
           var button = $(button_id);
           _custom_media = true;
           wp.media.editor.send.attachment = function(props, attachment){
             if ( _custom_media ) {
               $('#gallery_category-image-id').val(attachment.id);
               $('#gallery_category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
               $('#gallery_category-image-wrapper .custom_media_image').attr('src',attachment.url).css('display','block');
             } else {
               return _orig_send_attachment.apply( button_id, [props, attachment] );
             }
            }
         wp.media.editor.open(button);
         return false;
       });
     }
     eunice_media_upload('.eunice_tax_media_button.button');
     $('body').on('click','.eunice_tax_media_remove',function(){
       $('#gallery_category-image-id').val('');
       $('#gallery_category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
     });
     // Thanks: http://stackoverflow.com/questions/15281995/wordpress-create-gallery_category-ajax-response
     $(document).ajaxComplete(function(event, xhr, settings) {
       var queryStringArr = settings.data.split('&');
       if( $.inArray('action=add-tag', queryStringArr) !== -1 ){
         var xml = xhr.responseXML;
         $response = $(xml).find('term_id').text();
         if($response!=""){
           // Clear the thumb image
           $('#gallery_category-image-wrapper').html('');
         }
       }
     });
   });
 </script>
 <?php }

  }

  $gallery_category_meta = new Eunice_Gallery_Category_Meta();
  $gallery_category_meta -> init();

}

//Add custom metabox in media upload
function eunice_gallery_attachment_field_credit( $form_fields, $post ) {
	$form_fields['image-media-link'] = array(
		'label' => esc_html__('Image Link', 'eunice'),
		'input' => 'text',
		'value' => get_post_meta( $post->ID, '_image_media_link', true ),
		'helps' =>  esc_html__('Add Image Link', 'eunice'),
	);

  $form_fields['video-media-url'] = array(
    'label' =>  esc_html__('Video Link', 'eunice'),
    'input' => 'text',
    'value' => get_post_meta( $post->ID, '_video_media_url', true ),
    'helps' =>  esc_html__('Add video URL', 'eunice'),
  );

	$form_fields['external-link'] = array(
		'label' =>  esc_html__('External Link', 'eunice'),
		'input' => 'text',
		'value' => get_post_meta( $post->ID, '_external_link', true ),
		'helps' =>  esc_html__('Add External URL', 'eunice'),
	);

	return $form_fields;
}

add_filter( 'attachment_fields_to_edit', 'eunice_gallery_attachment_field_credit', 10, 3 );

function eunice_gallery_attachment_field_credit_save( $post, $attachment ) {
	if( isset( $attachment['image-media-link'] ) )
		update_post_meta( $post['ID'], '_image_media_link', $attachment['image-media-link'] );

  if( isset( $attachment['video-media-url'] ) )
  update_post_meta( $post['ID'], '_video_media_url', esc_url( $attachment['video-media-url'] ) );
	if( isset( $attachment['external-link'] ) )
  update_post_meta( $post['ID'], '_external_link', esc_url( $attachment['external-link'] ) );

	return $post;
}

add_filter( 'attachment_fields_to_save', 'eunice_gallery_attachment_field_credit_save', 10, 3 );
