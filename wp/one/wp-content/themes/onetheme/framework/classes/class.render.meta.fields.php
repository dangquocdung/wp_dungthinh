<?php

class TTRenderMetaFields{

    public static function getField($params){
        
        global $post;
        $name = $params['name'];
        $type = $params['type'];
        $meta_val = TT::getmeta($params['name'], $post->ID);

        $default = isset($params['default']) ? $params['default'] : '';
        $value = $meta_val != '' ? $meta_val : $default;
        if (isset($params['option']))
            $option = $params['option'];

        $gatts = 'id="' . $name . '" name="' . $name . '"';


        switch ($type) {
            case 'title':
                return '<span style="font-weight: bold;font-size:14px;background-color: #4cd864;display: inline-block;padding:7px;border-radius: 3px;color: #fff;">' . $params['title'] . '</span>';
                break;
            case 'colorpicker':
                return '<input type="text" ' . $gatts . ' value="' . $value . '" class="tt_wpcolorpicker" data-default-color="' . $default . '" />';
                break;
            case 'text':
                return '<input type="text" ' . $gatts . ' value="' . esc_html($value) . '" />';
                break;
            case 'number':
                return '<input type="number" ' . $gatts . ' step="1" min="0" value="' . (int)$value . '" class="small-text" />';
                break;
            case 'textarea':
                return '<textarea ' . $gatts . '>' . esc_html($value) . '</textarea>';
                break;
            case 'select':
                $html = '<select ' . $gatts . ' default-value="' . $value . '" class="tt_wpselectbox">';
                foreach ($option as $key => $val) {
                    $html .= '<option value="' . $key . '">' . $val . '</option>';
                }
                $html .= '</select>';
                return $html;
                break;
            case 'radio':
                $html = '';
                foreach ($option as $key => $val) {
                    $html .= '<input type="radio" group="tt_group_' . $name . '" ' . $gatts . ' class="tt_wpradiobox" ' . ($value == $key ? 'checked' : '') . '>';
                    $html .= $val . '<br>';
                }
                return $html;
                break;
            case 'icon':
                $html = '';
                foreach ($option as $key => $val) {
                    $html .= '<input type="radio" group="tt_group_' . $name . '" ' . $gatts . ' class="tt_wpradiobox" ' . ($val == $key ? 'checked' : '') . '>';
                    $html .= $val;
                    if ($key == 'custom')
                        $html .= '<input type="text" value""/>';
                    $html .= '<br>';
                }
                return $html;
                break;
            case 'thumbs':
                $html = '';
                $ndx = 0;
                foreach ($option as $key => $val) {
                    $ndx++;
                    $html .= '<input type="radio" group="tt_group_' . $name . '" name="' . $name . '" id="' . $name . $ndx . '" value="' . $key . '" class="tt_wpradiobox" ' . ($key == $value ? 'checked' : '') . '>';
                    $html .= '<label for="' . $name . $ndx . '"><img src="' . $val . '" class="'.($key == $value ? 'active' : '').'" /></label>';
                }
                return "<div class='page_option_field_thumbs'>$html</div>";
                break;
            case 'image':
                $html = '';
                $html .= '<div class="pmeta_item_browse">
                                <input type="text" ' . $gatts . ' value="' . esc_attr($value) . '" />
                                <a href="javascript:;" class="button pmeta_button_browse">'.esc_html__('Browse...', 'onetheme').'</a>
                                <div class="browse_preview">' . ($value != '' ? '<img src="' . $value . '" /><a href="javascript:;">'.esc_html__('Remove', 'onetheme').'</a>' : '') . '</div>
                        </div>';
                return $html;
                break;
            case 'font_icon':
                $html = '';
                $html .= '<div class="pmeta_item_font">
                                    <input type="text" ' . $gatts . ' value="' . $value . '" />
                                    <a href="javascript:;" class="button pmeta_button_font">'.esc_html__('Font Icon...', 'onetheme').'</a>
                            </div>';
                return $html;
                break;
            case 'checkbox':
                return '<span class="blox_switcher '.($value == '1' ? 'on' : '').'">
                            <span class="handle"></span>
                            <input type="hidden" ' . $gatts . ' value="' . ($value == '1' ? '1' : '0') . '" />
                        </span>';
                break;
            case 'customlink':
                return '<input type="text" ' . $gatts . ' value="' . esc_html($value) . '" /><input type="checkbox" value="1"/> ' . esc_html__('Open in a new tab?', 'onetheme');
                break;
            case 'video':
                $html = '<div class="pmeta_video">
                            <input type="text" ' . $gatts . ' value="' . esc_html($value) . '" />
                            <a href="javascript:;" class="button pmeta_button_browse">'.esc_html__('Browse...', 'onetheme').'</a>
                        </div>';
                return $html;
                break;
            case 'gallery':
                $imgs = '';
                $arr = explode(',', trim($value));
                foreach ($arr as $uri) {
                    if( $uri!='' ){
                        $imgs .= '<span style="background-image: url('.wp_get_attachment_url($uri).');"></span>';
                    }
                }
                $html = '<div class="pmeta_gallery">
                            <a href="javascript:;" class="button pmeta_button_browse">'.esc_html__('Insert/Update Gallery...', 'onetheme').'</a>
                            <a href="javascript:;" class="pmeta_remove" title="'.esc_attr__('Remove Gallery', 'onetheme').'">(x)</a>
                            <input type="hidden" ' . $gatts . ' value="'.trim($value).'" class="gallery_images" />
                            <div class="gallery_images_preview">'.$imgs.'</div>
                        </div>';
                return $html;
                break;
            case 'background':
                $values = TTRenderMetaFields::get_bg_values($value);
                $html = '';
                $html .= '<div class="pmeta_item_background">
                                <input type="text" id="'.$name.'_image" name="'.$name.'_image" value="' . esc_html($values['url']) . '" class="bg_image_url" />
                                <input type="hidden" ' . $gatts . ' value="'.$value.'" class="bg_hidden_value" />
                                <a href="javascript:;" class="button pmeta_button_browse">'.esc_html__('Browse...', 'onetheme').'</a>
                                <div class="browse_preview" style="'.($values['url']=='' ? 'display:none;' : '').'">
                                    <div class="preview_sample" style="background-image:url('.esc_html($values['url']).');"></div>
                                    <a href="javascript:;">'.esc_html__('Remove', 'onetheme').'</a>
                                </div>
                                <div class="background-controlls" style="'.($values['url']=='' ? 'display:none;' : '').'">
                                    <select id="'.$name.'_repeat" name="'.$name.'_repeat" default-value="'.$values['repeat'].'" class="tt_wpselectbox bg_image_repeat">
                                        <option value="repeat">'.esc_html__('Repeat', 'onetheme').'</option>
                                        <option value="repeat-x">'.esc_html__('Repeat-X', 'onetheme').'</option>
                                        <option value="repeat-y">'.esc_html__('Repeat-Y', 'onetheme').'</option>
                                        <option value="no-repeat">'.esc_html__('No Repeat', 'onetheme').'</option>
                                        <option value="cover">'.esc_html__('Cover', 'onetheme').'</option>
                                    </select>
                                    <select id="'.$name.'_position" name="'.$name.'_position" default-value="'.$values['position'].'" class="tt_wpselectbox bg_image_position">
                                        <option value="top left">'.esc_html__('Top &amp; Left', 'onetheme').'</option>
                                        <option value="top center">'.esc_html__('Top &amp; Center', 'onetheme').'</option>
                                        <option value="top right">'.esc_html__('Top &amp; Right', 'onetheme').'</option>
                                        <option value="center left">'.esc_html__('Center &amp; Left', 'onetheme').'</option>
                                        <option value="center center">'.esc_html__('Center &amp; Center', 'onetheme').'</option>
                                        <option value="center right">'.esc_html__('Center &amp; Right', 'onetheme').'</option>
                                        <option value="bottom left">'.esc_html__('Bottom &amp; Left', 'onetheme').'</option>
                                        <option value="bottom center">'.esc_html__('Bottom &amp; Center', 'onetheme').'</option>
                                        <option value="bottom right">'.esc_html__('Bottom &amp; Right', 'onetheme').'</option>
                                    </select>
                                    <select id="'.$name.'_attach" name="'.$name.'_attach" default-value="'.$values['attach'].'" class="tt_wpselectbox bg_image_attach">
                                        <option value="scroll">'.esc_html__('Scroll', 'onetheme').'</option>
                                        <option value="fixed">'.esc_html__('Fixed', 'onetheme').'</option>
                                        <option value="parallax">'.esc_html__('Parallax', 'onetheme').'</option>
                                    </select>
                                </div>
                          </div>';
                return $html;
                break;
            default:
                return "Option doesn't prepared!";
                break;
        }

    }

    public static function get_bg_values($value){
        $exp = explode('$', $value);
        if( count($exp) > 3 ){
            return array(
                    'url'=>$exp[0],
                    'repeat'=>$exp[1],
                    'position'=>$exp[2],
                    'attach'=>$exp[3]
                );
        }
        return array(
                    'url'=>'',
                    'repeat'=>'',
                    'position'=>'',
                    'attach'=>''
                );
    }

}