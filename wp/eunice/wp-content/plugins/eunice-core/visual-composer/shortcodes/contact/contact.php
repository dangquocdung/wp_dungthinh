<?php
/* ==========================================================
    Contact
=========================================================== */
if ( !function_exists('ence_contact_function')) {
  function ence_contact_function( $atts, $content = true ) {
    extract(shortcode_atts(array(
      'id'            => '',
      'form_title'    => '',
      'description'   => '',
      'contact_adrs'  => '',
    ), $atts)); 
    	ob_start();
  ?>
  <div class="container container-width-990  contact-container">
    <div class="entry-content-warp">
  	<div class="entry-content-contact">
      <div class="text-center contact-page-heading">
        <h2><?php echo $form_title; ?></h2>
        <p><?php echo $description; ?></p>
      </div>
      <div class="contact-page-info row">
        <div class="text-left col-sm-4 contact-info">
          <?php 
         	$contact_adrs = vc_param_group_parse_atts( $atts['contact_adrs'] );
          foreach ($contact_adrs as $adresss) : ?>
            <div class="contact-single-info">
                <h4><?php echo $adresss['adrs_titl']; ?></h4>
                <address class="contact-address">
                  <?php echo nl2br($adresss['adrs_contact']); ?>
                </address>
            </div>
	        <?php endforeach; ?>
        </div>
        <!--contact form start\-->
        <div class="col-sm-8 contact-form">
          <?php echo do_shortcode( '[contact-form-7 id="'. $id .'"]' ); ?>
        </div><!--/contact form end-->
      </div>
      </div>
    </div>
  </div>
  <?php
    return ob_get_clean();
  }
}
add_shortcode( 'ence_contact', 'ence_contact_function' );
