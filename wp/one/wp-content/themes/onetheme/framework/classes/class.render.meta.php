<?php

/* set external sliders
=======================================*/
global $onetheme_sliders;
$onetheme_sliders = array("none" => 'No slider');
$onetheme_sliders = array_merge($onetheme_sliders, TT::get_sliders('layerslider'));
$onetheme_sliders = array_merge($onetheme_sliders, TT::get_sliders('revslider'));
$onetheme_sliders = array_merge($onetheme_sliders, TT::get_sliders('masterslider'));

require_once get_template_directory()."/framework/classes/class.render.meta.fields.php";

class TTRenderMeta{
    public $items;

    function __construct(){
        $this->items = $this->items();
        add_action('admin_enqueue_scripts', array($this, 'print_admin_scripts'));
        add_action('add_meta_boxes', array($this, 'add_custom_meta'), 1);
        add_action('edit_post', array($this, 'save_post'), 99);
    }

    // admin enqueue scripts
    public function print_admin_scripts(){
        global $post_type;
        if ($post_type == '' || $post_type == NULL) {
            return;
        }
        wp_enqueue_style('render-meta', esc_url(get_template_directory_uri() . '/framework/admin-assets/render.meta.css') );
        wp_enqueue_script('render-meta', esc_url(get_template_directory_uri() . '/framework/admin-assets/render.meta.js'), false, false, true);
    }

    // meta items
    public function items(){
        return array();
    }

    // register meta items
    public function add_custom_meta(){
        foreach ($this->items as $key => $value) {
            $position = 'advanced';
            $priority = 'core';
            if ($value['post_type'] == 'post') {
                $position = 'normal';
                $priority = 'high';
            }
            add_meta_box(
                'pmeta_' . $key, $value['label'], array($this, 'render_meta_section'), $value['post_type'], $position, $priority, $value['items']
            );
        }
    }

    // rendering meta sections
    public function render_meta_section($post, $metabox){
        global $post;
        foreach ($metabox['args'] as $value) {
            
            if ($value['type'] == 'start_group') {
                $style = '';
                if(isset($value['visible']) && $value['visible'] == false){
                    $style = 'style="display:none;"';
                }
                print '<div id="'.esc_attr($value['name']).'" class="'.esc_attr($value['name']).'" '.$style.'>';
            }
            elseif ($value['type'] == 'end_group') {
                echo '</div><!-- #'.esc_attr($value['name']).' -->';
            }
            else {
                echo "<div id='option_wrapper_" . esc_attr($value['name']) . "' class='page_option_fieldset'>";

                echo '<div class="meta-option-field">';
                    if( isset($value['label']) && $value['label'] != '' && !in_array($value['type'], array('checkbox1', 'colorpicker1', 'number1')) ){
                        echo "<div><label for='" . esc_attr($value['name']) . "'>" . esc_html($value['label']) . "</label>";
                            if(isset($value['desc']) && !empty($value['desc'])) {
                                echo '<div class="field_description" style="max-width:90%">'.esc_html($value['desc']).'</div>';
                            }
                        echo "</div>";
                    }
                    echo "<div>";
                    print "<div class='page_option_field'>".TTRenderMetaFields::getField($value)."</div>";
                    echo "</div>";
                echo '</div>';
                echo "<div style='clear:both;'></div></div>";
            }
        }
    }


    // save meta fields when saving post
    public function save_post($post_id){
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return $post_id;

        if (isset($_GET['post_type']) && 'page' == $_GET['post_type']) {
            if (!current_user_can('edit_page', $post_id))
                return $post_id;
        }
        else {
            if (!current_user_can('edit_post', $post_id))
                return $post_id;
        }

        $field_name = array();
        foreach ($this->items as $key => $value) {
            foreach ($value['items'] as $item) {
                $field_name[] = $item['name'];
            }
        }

        foreach ($field_name as $field) {
            if (isset($_POST[$field])) {
                $data_field = '_' . $field;
                $data_value = $_POST[$field];

                if (count(get_post_meta($post_id, $data_field)) == 0) {
                    add_post_meta($post_id, $data_field, trim($data_value), true);
                } elseif ($data_value != get_post_meta($post_id, $data_field, true)) {
                    update_post_meta($post_id, $data_field, trim($data_value));
                } elseif ($data_value == "") {
                    delete_post_meta($post_id, $data_field, trim(get_post_meta($post_id, $data_field, true)));
                }
            }
        }
    }
}