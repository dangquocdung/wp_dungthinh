<?php
/* ==============================================
  Try to remove default template
=============================================== */
add_filter( 'vc_load_default_templates', 'eunice_template_modify_array' );
function eunice_template_modify_array($data) {
    return array(); // This will remove all default templates
}

/* ==============================================
  Create Custom Template in Visual Composer
=============================================== */

/* Example Page Template */
if( ! function_exists( 'eunice_vc_example_page_template' ) ) {

  add_filter( 'vc_load_default_templates', 'eunice_vc_example_page_template' );
  function eunice_vc_example_page_template($data) {
    $template               = array();
    $template['name']       = esc_html__( 'Example Page Template', 'eunice-core' );
    $template['content']    = <<<CONTENT
[vc_row][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
  }

}