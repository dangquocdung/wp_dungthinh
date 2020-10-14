<?php 
//Custom Heading
if(function_exists('vc_map')){

   vc_map( array(
   "name"      => esc_html__("OT Heading", 'architect'),
   "base"      => "heading",
   "class"     => "",
   "icon" => "icon-st",
   "category"  => 'Architect',
   "params"    => array(
      array(
         "type"      => "textarea",
         "holder"    => "div",
         "class"     => "",
         "heading"   => esc_html__("Text", 'architect'),
         "param_name"=> "text",
         "value"     => "",
         "description" => esc_html__("Add Text", 'architect')
      ),
      array(
        "type" => "dropdown",
        "heading" => esc_html__('Element Tag', 'architect'),
        "param_name" => "tag",
        "value" => array(
                     esc_html__('Select Tag', 'architect') => '',
                     esc_html__('h1', 'architect') => 'h1',
                     esc_html__('h2', 'architect') => 'h2',
                     esc_html__('h3', 'architect') => 'h3',  
                     esc_html__('h4', 'architect') => 'h4',
                     esc_html__('h5', 'architect') => 'h5',
                     esc_html__('h6', 'architect') => 'h6',  
                     esc_html__('p', 'architect')  => 'p',
                     esc_html__('div', 'architect') => 'div',
                    ),
        "description" => esc_html__("Section Element Tag", 'architect'),      
      ),
      array(
        "type" => "dropdown",
        "heading" => esc_html__('Text Align', 'architect'),
        "param_name" => "align",
        "value" => array( 
                     esc_html__('Select Align', 'architect') => '',  
                     esc_html__('left', 'architect') => 'left',
                     esc_html__('right', 'architect') => 'right',  
                     esc_html__('center', 'architect') => 'center',
                     esc_html__('justify', 'architect') => 'justify',   
                    ),
        "description" => esc_html__("Section Overlay", 'architect'),      
      ),
      array(
        "type" => "dropdown",
        "heading" => esc_html__('Font Weight', 'architect'),
        "param_name" => "weight",
        "value" => array( 
                     esc_html__('Select font weight', 'architect') => '',  
                     esc_html__('100', 'architect') => '100',
                     esc_html__('200', 'architect') => '200',  
                     esc_html__('300', 'architect') => '300',
                     esc_html__('400', 'architect') => '400',   
                     esc_html__('500', 'architect') => '500',
                     esc_html__('600', 'architect') => '600',  
                     esc_html__('700', 'architect') => '700',
                     esc_html__('800', 'architect') => '800',
                     esc_html__('900', 'architect') => '900',
                    ),
        "description" => esc_html__("Section Overlay", 'architect'),      
      ),
      array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => esc_html__("Font Size", 'architect'),
         "param_name"=> "size",
         "value"     => "",
         "description" => esc_html__("Font Size", 'architect')
      ),
      array(
         "type"      => "colorpicker",
         "holder"    => "div",
         "class"     => "",
         "heading"   => esc_html__("Color", 'architect'),
         "param_name"=> "color",
         "value"     => "",
         "description" => esc_html__("Color", 'architect')
      ),
      array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => esc_html__("Margin Top", 'architect'),
         "param_name"=> "top",
         "value"     => "",
         "description" => esc_html__("Add margin top of heading", 'architect')
      ),
      array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => esc_html__("Margin Bottom", 'architect'),
         "param_name"=> "bot",
         "value"     => "",
         "description" => esc_html__("Add margin bottom of heading", 'architect')
      ),
      array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => esc_html__("Class Extra", 'architect'),
         "param_name"=> "class",
         "value"     => "",
         "description" => esc_html__("Class extra for style", 'architect')
      ),
    )));

}

// Buttons
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Button ", 'architect'),
   "base" => "button",
   "class" => "",
   "category" => 'Architect',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Button Text", 'architect'),
         "param_name" => "btntext",
         "value" => "",
         "description" => esc_html__("", 'architect')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Button Link", 'architect'),
         "param_name" => "btnlink",
         "value" => '',
         "description" => esc_html__("", 'architect')
      ),
      array(
         "type" => "checkbox",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Show icon", 'architect'),
         "param_name" => "sicon",
         "value" => '',
         "description" => esc_html__("", 'architect')
      ),
      array(
         "type" => "iconpicker",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Icon", 'architect'),
         "param_name" => "icon",
         "value" => '',
         'dependency' => array(
                'element' => 'sicon',
                'not_empty' => true,
         ),
         "description" => esc_html__("", 'architect')
      ),
      array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Positon Icon", 'architect'),
         "param_name" => "iconpos",
         "value" => array( 
                     esc_html__('Default', 'architect') => 'default', 
                     esc_html__('Right', 'architect') => 'right',
                     esc_html__('left', 'architect') => 'left',
                    ),
         'dependency' => array(
                'element' => 'sicon',
                'not_empty' => true,
         ),
         "description" => esc_html__("", 'architect')
      ),
      array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Button Color", 'architect'),
         "param_name" => "color",
         "value" => array( 
                     esc_html__('Color default', 'architect') => 'default', 
                     esc_html__('Green', 'architect') => 'green',
                     esc_html__('Teal', 'architect') => 'teal',
                     esc_html__('Blue', 'architect') => 'blue',
                     esc_html__('Maroon', 'architect') => 'maroon',
                     esc_html__('Brown', 'architect') => 'brown',
                     esc_html__('Dark', 'architect') => 'dark',
                     esc_html__('Light', 'architect') => 'light',
                     esc_html__('Border Dark', 'architect') => 'dark2',
                     esc_html__('Transparent', 'architect') => 'transparent',
                    ),
         "description" => esc_html__("", 'architect')
      ),
      array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Button Size", 'architect'),
         "param_name" => "size",
         "value" => array( 
                     esc_html__('Regular size', 'architect') => 'default', 
                     esc_html__('Large', 'architect') => 'large',
                     esc_html__('Small', 'architect') => 'small',
                     esc_html__('Long', 'architect') => 'long',
                    ),
         "description" => esc_html__("", 'architect')
      ),
      array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Button Position", 'architect'),
         "param_name" => "position",
         "value" => array( 
                     esc_html__('Left', 'architect') => 'left', 
                     esc_html__('Center', 'architect') => 'center',
                     esc_html__('Right', 'architect') => 'right',
                    ),
         "description" => esc_html__("", 'architect')
      ),
      array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Radius", 'architect'),
         "param_name" => "radius",
         "value" => array( 
                     esc_html__('default', 'architect') => 'default', 
                     esc_html__('radius 50', 'architect') => 'radius50',
                     esc_html__('Rounded', 'architect') => 'rounded',
                    ),
         "description" => esc_html__("", 'architect')
      ),
    )
    ));
}

// Divider (use)
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Divider", 'architect'),
   "base" => "divider",
   "class" => "",
   "category" => 'Architect',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "colorpicker",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("background", 'architect'),
         "param_name" => "bg_color",
         "value" => "",
         "description" => esc_html__("select color", 'architect')
      ),
    )
    ));
}

// Miscellaneous Box
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Miscellaneous Box", 'architect'),
   "base" => "mulbox",
   "class" => "",
   "category" => 'Architect',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Style", 'architect'),
         "param_name" => "style",
         "value" => array(
                     esc_html__('Link Out in Image', 'architect') => 'style1', 
                     esc_html__('Have Button link', 'architect') => 'style2',                 
         ),
         "description" => esc_html__("", 'architect')
      ),
      array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Align", 'architect'),
         "param_name" => "align",
         'dependency'  => array( 'element' => 'style', 'value' => array( 'style1' ) ),
         "value" => array(
                     esc_html__('Select', 'architect') => 'none', 
                     esc_html__('left', 'architect') => 'left', 
                     esc_html__('right', 'architect') => 'right', 
                     esc_html__('full', 'architect') => 'full',                    
         ),
         "description" => esc_html__("", 'architect')
      ),
      array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Align", 'architect'),
         "param_name" => "aligns2",
         'dependency'  => array( 'element' => 'style', 'value' => array( 'style2' ) ),
         "value" => array(
                     esc_html__('Select', 'architect') => 'none', 
                     esc_html__('left', 'architect') => 'left', 
                     esc_html__('right', 'architect') => 'right',                 
         ),
         "description" => esc_html__("", 'architect')
      ),
      array(
         "type" => "attach_image",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Upload Image", 'architect'),
         "param_name" => "image",
         "value" => "",
         "description" => esc_html__("Upload image of box", 'architect')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Link Image", 'architect'),
         "param_name" => "linkimg",
         "value" => "",
         'dependency'  => array( 'element' => 'style', 'value' => array( 'style1' ) ),
         "description" => esc_html__("Add link for image. if you want this", 'architect')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("title", 'architect'),
         "param_name" => "title",
         "value" => "",
         "description" => esc_html__("Enter the title", 'architect')
      ),
      array(
         "type" => "textarea_html",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Content", 'architect'),
         "param_name" => "content",
         "value" => "",
         "description" => esc_html__("Enter the content", 'architect')
      ),
      array(
         "type" => "vc_link",
         "heading" => esc_html__("Button link", 'architect'),
         "param_name" => "linkbox",
         'dependency'  => array( 'element' => 'style', 'value' => array( 'style2' ) ),
         "description" => esc_html__("Add link", 'architect')
      ),
    )
    ));
}

// Icon Box
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Icon Box", 'architect'),
   "base" => "iconb",
   "class" => "",
   "category" => 'Architect',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "iconpicker",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Icon", 'architect'),
         "param_name" => "icon",
         "value" => "",
         "description" => esc_html__("select icon", 'architect')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("title", 'architect'),
         "param_name" => "title",
         "value" => "",
         "description" => esc_html__("Enter the title", 'architect')
      ),
      array(
         "type" => "textarea_html",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Content", 'architect'),
         "param_name" => "content",
         "value" => "",
         "description" => esc_html__("Enter the content", 'architect')
      ),
    )
    ));
}

// Question Box
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Question Box", 'architect'),
   "base" => "quesb",
   "class" => "",
   "category" => 'Architect',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("title", 'architect'),
         "param_name" => "title",
         "value" => "",
         "description" => esc_html__("Enter the title", 'architect')
      ),
      array(
         "type" => "vc_link",
         "heading" => esc_html__("Button link", 'architect'),
         "param_name" => "linkbox",
         "description" => esc_html__("Add link", 'architect')
      ),
    )
    ));
}

// Gallery Box
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Gallery Box", 'architect'),
   "base" => "galler",
   "class" => "",
   "category" => 'Architect',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Style", 'architect'),
         "param_name" => "style",
         "value" => array(
                     esc_html__('slide', 'architect') => 'style1', 
                     esc_html__('List', 'architect') => 'style2',                  
         ),
         "description" => esc_html__("", 'architect')
      ),
      array(
         "type" => "attach_images",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Image", 'architect'),
         "param_name" => "gallery",
         "value" => "",
         "description" => esc_html__("Upload image", 'architect')
      ),
    )
    ));
}

// Feature Box
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Feature Box", 'architect'),
   "base" => "feature",
   "class" => "",
   "category" => 'Architect',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Title Style", 'architect'),
         "param_name" => "style2",
         "value" => array(
                     esc_html__('title top', 'architect') => 'style1', 
                     esc_html__('title bot', 'architect') => 'style2',                  
         ),
         "description" => esc_html__("", 'architect')
      ),
      array(
         "type" => "attach_image",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Upload Image", 'architect'),
         "param_name" => "image",
         "value" => "",
         "description" => esc_html__("Upload image of box", 'architect')
      ),
      array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Image type", 'architect'),
         "param_name" => "style",
         "value" => array(
                     esc_html__('style1', 'architect') => 'style1', 
                     esc_html__('style2', 'architect') => 'style2', 
                     esc_html__('style3', 'architect') => 'style3',   
                     esc_html__('style4', 'architect') => 'style4',                   
         ),
         "description" => esc_html__("", 'architect')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("title", 'architect'),
         "param_name" => "title",
         "value" => "",
         "description" => esc_html__("Enter the title", 'architect')
      ),
      array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Title Type", 'architect'),
         "param_name" => "type",
         'dependency'  => array( 'element' => 'style2', 'value' => array( 'style2' ) ),
         "value" => array(
                     esc_html__('Select', 'architect') => 'none', 
                     esc_html__('White', 'architect') => 'white',   
                     esc_html__('Black', 'architect') => 'black', 
         ),
         "description" => esc_html__("", 'architect')
      ),
    )
    ));
}

// Promotion Box
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Promotion Box", 'architect'),
   "base" => "promotion",
   "class" => "",
   "category" => 'Architect',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Style", 'architect'),
         "param_name" => "style",
         "value" => array(
                     esc_html__('Background Image', 'architect') => 'style1', 
                     esc_html__('background Dark', 'architect') => 'style2',     
                     esc_html__('Background transparent', 'architect') => 'style3',                    
         ),
         "description" => esc_html__("", 'architect')
      ),
      array(
         "type" => "attach_image",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Upload Image", 'architect'),
         "param_name" => "image",
         'dependency'  => array( 'element' => 'style', 'value' => array( 'style1','style3' ) ),
         "value" => "",
         "description" => esc_html__("Upload image of box", 'architect')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Icon", 'architect'),
         "param_name" => "icon",
         "value" => "",
         'dependency'  => array( 'element' => 'style', 'value' => array( 'style2' ) ),
         "description" => esc_html__("Add code icon. Ex: lnr-leaf. Find: https://linearicons.com/free", 'architect')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("title", 'architect'),
         "param_name" => "title",
         "value" => "",
         "description" => esc_html__("Enter the title", 'architect')
      ),
      array(
         "type" => "textarea_html",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Content", 'architect'),
         "param_name" => "content",
         'dependency'  => array( 'element' => 'style', 'value' => array( 'style2','style1' ) ),
         "value" => "",
         "description" => esc_html__("Enter the content", 'architect')
      ),
      array(
         "type" => "colorpicker",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Background Color", 'architect'),
         "param_name" => "bg_color",
         "value" => "",
         'dependency'  => array( 'element' => 'style', 'value' => array( 'style2' ) ),
         "description" => esc_html__("Select color", 'architect')
      ),
      array(
         "type" => "vc_link",
         "heading" => esc_html__("Button link", 'architect'),
         "param_name" => "linkbox",
         'dependency'  => array( 'element' => 'style', 'value' => array( 'style1','style3' ) ),
         "description" => esc_html__("Add link", 'architect')
      ),
    )
    ));
}

// Latest blog (use)
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Latest Blog", 'architect'),
   "base" => "blog",
   "class" => "",
   "category" => 'Architect',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Style", 'architect'),
         "param_name" => "style",
         "value" => array(
                     esc_html__('2 column and have button', 'architect') => 'style1', 
                     esc_html__('3 column no button', 'architect') => 'style2',                    
         ),
         "description" => esc_html__("", 'architect')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Number Show", 'architect'),
         "param_name" => "number",
         "value" => "",
         "description" => esc_html__("Enter the number show", 'architect')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Excerpt Length", 'architect'),
         "param_name" => "excerpt",
         "value" => "",
         "description" => esc_html__("Number Excerpt Length", 'architect')
      ),
    )
    ));
}

// Latest blog Slide (use)
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Latest Blog Slide", 'architect'),
   "base" => "blogslide",
   "class" => "",
   "category" => 'Architect',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Number Show", 'architect'),
         "param_name" => "number",
         "value" => "",
         "description" => esc_html__("Enter the number show", 'architect')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Excerpt Length", 'architect'),
         "param_name" => "excerpt",
         "value" => "",
         "description" => esc_html__("Number Excerpt Length", 'architect')
      ),
    )
    ));
}

// Team New
if(function_exists('vc_map')){
   vc_map(array(
         "name"      => __("OT Team", 'architect'),
         "base"      => "ot_teamn",
         "class"     => "",
         "icon" => "icon-st",
         "category"  => 'Architect',
         "params"    => array(
            array(
               "type" => "dropdown",
               "holder" => "div",
               "class" => "",
               "heading" => __("Select Style.", 'architect'),
               "param_name" => "style",
               "value" => array(   
                           __('Select style', 'architect') => 'no',        
                           __('no description', 'architect') => 'style1',  
                           __('Show description', 'architect') => 'style2',  
                          ),
               "description" => __("Select style for show.", 'architect')
            ),  
            // params group
            array(
                'type' => 'param_group',
                'value' => '',
                'param_name' => 'body',
                // Note params is mapped inside param-group:
                'params' => array(
                    array(
                        'type' => 'attach_image',
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Image ',
                        'param_name' => 'photo',
                        "value" => "",
                        "description" => __("Upload image", 'architect')
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Name ',
                        'param_name' => 'name',
                        "value" => "",
                        "description" => __("Add name", 'architect')
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Job ',
                        'param_name' => 'job',
                        "value" => "",
                        "description" => __("Member's job", 'architect')
                    ),
                    array(
                        'type' => 'textarea',
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Enter your desc',
                        'param_name' => 'desc',
                        "value" => "",
                        "description" => __("Add Desc Content Text. Only use for style 2", 'architect')
                    ),
                    array(
                        'type' => 'iconpicker',
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Social icon 1 ',
                        'param_name' => 'icon1',
                        "value" => "",
                        "description" => __("select icon", 'architect')
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Link social 1',
                        'param_name' => 'link1',
                        "value" => "",
                        "description" => __("Add link", 'architect')
                    ),
                    array(
                        'type' => 'iconpicker',
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Social icon 2 ',
                        'param_name' => 'icon2',
                        "value" => "",
                        "description" => __("select icon", 'architect')
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Link social 2',
                        'param_name' => 'link2',
                        "value" => "",
                        "description" => __("Add link", 'architect')
                    ),
                    array(
                        'type' => 'iconpicker',
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Social icon 3 ',
                        'param_name' => 'icon3',
                        "value" => "",
                        "description" => __("select icon", 'architect')
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Link social 3',
                        'param_name' => 'link3',
                        "value" => "",
                        "description" => __("Add link", 'architect')
                    ),
                )                
            )
        )
    )
);
}

//Clients Logo (use)
if(function_exists('vc_map')){
   vc_map( array(
   "name"      => esc_html__("OT Client Logos", 'architect'),
   "base"      => "logos",
   "class"     => "",
   "icon" => "icon-st",
   "category" => 'Architect',
   "params"    => array(

      array(
         "type" => "attach_images",
         "holder" => "div",
         "class" => "",
         "heading" => "Logo Client",
         "param_name" => "gallery",
         "value" => "",
      ), 
    )));
}

// portfolio filter (use)
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Portfolio Filter", 'architect'),
   "base" => "portfoliofil",
   "class" => "",
   "category" => 'Architect',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Text show all", 'architect'),
         "param_name" => "all",
         "value" => "",
         "description" => esc_html__("Enter the text", 'architect')
      ),
      array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Hover Text Filter", 'architect'),
         "param_name" => "hover",
         "value" => array(
                     esc_html__('Select', 'architect') => 'none',
                     esc_html__('Cross text the filter', 'architect') => 'hover1', 
                     esc_html__('Background text the filter', 'architect') => 'hover2',                    
         ),
         "description" => esc_html__("", 'architect')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Number Show", 'architect'),
         "param_name" => "number",
         "value" => "",
         "description" => esc_html__("Enter the number show", 'architect')
      ),
      array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Style", 'architect'),
         "param_name" => "style",
         "value" => array(
                     esc_html__('Text filter dark', 'architect') => 'style1', 
                     esc_html__('Text filter light', 'architect') => 'style2',                    
         ),
         "description" => esc_html__("", 'architect')
      ),
    )
    ));
}

// portfolio filter Grid (use)
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Portfolio Filter Grid", 'architect'),
   "base" => "portfoliofil2",
   "class" => "",
   "category" => 'Architect',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Column", 'architect'),
         "param_name" => "style",
         "value" => array(
                     esc_html__('2 Columns', 'architect') => 'style1', 
                     esc_html__('3 Columns', 'architect') => 'style2',  
                     esc_html__('4 Columns', 'architect') => 'style3',                 
         ),
         "description" => esc_html__("", 'architect')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Text show all", 'architect'),
         "param_name" => "all",
         "value" => "",
         "description" => esc_html__("Enter the text", 'architect')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Number Show", 'architect'),
         "param_name" => "number",
         "value" => "",
         "description" => esc_html__("Enter the number show", 'architect')
      ),
    )
    ));
}

// portfolio filter Grid V2 (use)
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Portfolio Filter Grid V2", 'architect'),
   "base" => "portfoliofil2v2",
   "class" => "",
   "category" => 'Architect',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Column", 'architect'),
         "param_name" => "style",
         "value" => array(
                     esc_html__('2 Columns', 'architect') => 'style1', 
                     esc_html__('3 Columns', 'architect') => 'style2', 
                     esc_html__('4 Columns', 'architect') => 'style3',                  
         ),
         "description" => esc_html__("", 'architect')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Text show all", 'architect'),
         "param_name" => "all",
         "value" => "",
         "description" => esc_html__("Enter the text", 'architect')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Number Show", 'architect'),
         "param_name" => "number",
         "value" => "",
         "description" => esc_html__("Enter the number show", 'architect')
      ),
    )
    ));
}

// Counter (use)
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Counter", 'architect'),
   "base" => "counterup",
   "class" => "",
   "category" => 'Architect',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Style", 'architect'),
         "param_name" => "style",
         "value" => array(
                     esc_html__('Simple', 'architect') => 'style1', 
                     esc_html__('Have icon', 'architect') => 'style2',   
                     esc_html__('Have image', 'architect') => 'style3',                   
         ),
         "description" => esc_html__("", 'architect')
      ),
      array(
         "type" => "attach_image",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Image",'architect'),
         "param_name" => "image",
         'dependency'  => array( 'element' => 'style', 'value' => array( 'style3' ) ),
         "value" => "",
         "description" => esc_html__("Upload image", 'architect')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Icon",'architect'),
         "param_name" => "icon",
         'dependency'  => array( 'element' => 'style', 'value' => array( 'style2' ) ),
         "value" => "",
         "description" => esc_html__("Enter the code icon. Find https://linearicons.com/free", 'architect')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Number",'architect'),
         "param_name" => "number",
         "value" => "",
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Title",'architect'),
         "param_name" => "title",
         "value" => "",
         "description" => esc_html__("Enter the title", 'architect')
      ),
      array(
         "type" => "textarea_html",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Content",'architect'),
         "param_name" => "content",
         'dependency'  => array( 'element' => 'style', 'value' => array( 'style1' ) ),
         "value" => "",
         "description" => esc_html__("Enter the content", 'architect')
      ),
    )
    ));
}

// Process 
if(function_exists('vc_map')){
   vc_map(array(
         "name"      => __("OT Process", 'architect'),
         "base"      => "ot_group",
         "class"     => "",
         "icon" => "icon-st",
         "category"  => 'Architect',
         "params"    => array(
            array(
               "type" => "dropdown",
               "holder" => "div",
               "class" => "",
               "heading" => __("Select Style.", 'architect'),
               "param_name" => "style",
               "value" => array(   
                           __('Select style', 'architect') => 'no', 
                           __('List', 'architect') => 'style2',         
                           __('Slide', 'architect') => 'style1',
                          ),
               "description" => __("Select style for show.", 'architect')
            ),  
            // params group
            array(
                'type' => 'param_group',
                'value' => '',
                'param_name' => 'titles',
                // Note params is mapped inside param-group:
                'params' => array(
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Order(multiple field)',
                        'param_name' => 'order',
                        "value" => "",
                        "description" => __("Add Your Title Text", 'architect')
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Enter your title (multiple field)',
                        'param_name' => 'title',
                        "value" => "",
                        "description" => __("Add Your Title Text", 'architect')
                    ),
                    array(
                        'type' => 'textarea',
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Enter your desc (multiple field)',
                        'param_name' => 'desc',
                        "value" => "",
                        "description" => __("Add Desc Content Text", 'architect')
                    )
                )                
            )
        )
    )
);
}

// Testimonial New
if(function_exists('vc_map')){
   vc_map(array(
         "name"      => __("OT Testimonial", 'architect'),
         "base"      => "ot_testimonialnew",
         "class"     => "",
         "icon" => "icon-st",
         "category"  => 'Architect',
         "params"    => array(
            array(
               "type" => "dropdown",
               "holder" => "div",
               "class" => "",
               "heading" => __("Select Style.", 'architect'),
               "param_name" => "style",
               "value" => array(   
                           __('Select style', 'architect') => 'no',   
                           __('Slider', 'architect') => 'style2',         
                           __('List', 'architect') => 'style1',
                          ),
               "description" => __("Select style for show.", 'architect')
            ),  
            // params group
            array(
                'type' => 'param_group',
                'value' => '',
                'param_name' => 'body',
                // Note params is mapped inside param-group:
                'params' => array(
                    array(
                        'type' => 'attach_image',
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Image (multiple field)',
                        'param_name' => 'image',
                        "value" => "",
                        "description" => __("Upload image", 'architect')
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Name (multiple field)',
                        'param_name' => 'name',
                        "value" => "",
                        "description" => __("Add name", 'architect')
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Job (multiple field)',
                        'param_name' => 'job',
                        "value" => "",
                        "description" => __("Add Job", 'architect')
                    ),
                    array(
                        'type' => 'textarea',
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Enter your desc (multiple field)',
                        'param_name' => 'desc',
                        "value" => "",
                        "description" => __("Add Desc Content Text", 'architect')
                    ),
                )                
            )
        )
    )
);
}

// Testimonial 2 New 
if(function_exists('vc_map')){
   vc_map(array(
         "name"      => __("OT Testimonial 2", 'architect'),
         "base"      => "ot_testimonialnew2",
         "class"     => "",
         "icon" => "icon-st",
         "category"  => 'Architect',
         "params"    => array(
              array(
                  'type' => 'attach_image',
                  "holder" => "div",
                  "class" => "",
                  'heading' => 'Prev',
                  'param_name' => 'imgnv1',
                  "value" => "",
                  "description" => __("Upload image", 'architect')
              ),
              array(
                  'type' => 'attach_image',
                  "holder" => "div",
                  "class" => "",
                  'heading' => 'Next',
                  'param_name' => 'imgnv2',
                  "value" => "",
                  "description" => __("Upload image", 'architect')
              ),
            // params group
            array(
                'type' => 'param_group',
                'value' => '',
                'param_name' => 'body',
                // Note params is mapped inside param-group:
                'params' => array(
                    array(
                        'type' => 'attach_image',
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Image (multiple field)',
                        'param_name' => 'image',
                        "value" => "",
                        "description" => __("Upload image", 'architect')
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Name (multiple field)',
                        'param_name' => 'name',
                        "value" => "",
                        "description" => __("Add name", 'architect')
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Job (multiple field)',
                        'param_name' => 'job',
                        "value" => "",
                        "description" => __("Add Job", 'architect')
                    ),
                    array(
                        'type' => 'textarea',
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Enter your desc (multiple field)',
                        'param_name' => 'desc',
                        "value" => "",
                        "description" => __("Add Desc Content Text", 'architect')
                    ),
                    array(
                        'type' => 'attach_image',
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Logo (multiple field)',
                        'param_name' => 'logo',
                        "value" => "",
                        "description" => __("Upload logo", 'architect')
                    ),
                )                
            )
        )
    )
);
}

// Contact Info (use)
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Contact Info", 'architect'),
   "base" => "ctinfo",
   "class" => "",
   "category" => 'Architect',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Icon", 'architect'),
         "param_name" => "icon",
         "value" => "",
         "description" => esc_html__("Enter the code icon. Ex: lnr-smartphone. Find: https://linearicons.com/free", 'architect')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Info",'architect'),
         "param_name" => "title",
         "value" => "",
         "description" => esc_html__("Enter the info", 'architect')
      ),
    )
    ));
}

// Project Info (use)
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Project Info", 'architect'),
   "base" => "pjinfo",
   "class" => "",
   "category" => 'Architect',
   "icon" => "icon-st",
   "params" => array(
      
            array(
                'type' => 'param_group',
                'value' => '',
                'param_name' => 'titles',
                // Note params is mapped inside param-group:
                'params' => array(
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Title',
                        'param_name' => 'title',
                        "value" => "",
                        "description" => __("Enter the title", 'architect')
                    ),
                    array(
                        'type' => 'textarea',
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Description',
                        'param_name' => 'desc',
                        "value" => "",
                        "description" => __("Enter the content", 'architect')
                    ),
                )                
            )
    )
    ));
}

// Share (use)
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Share", 'architect'),
   "base" => "share",
   "class" => "",
   "category" => 'Architect',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Info",'architect'),
         "param_name" => "title",
         "value" => "",
         "description" => esc_html__("Enter the info", 'architect')
      ),
      array(
         "type" => "checkbox",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("facebook", 'architect'),
         "param_name" => "faceb",
         "value" => "",
         "description" => esc_html__("Select yes or no. Default: No.", 'architect')
      ),
      array(
         "type" => "checkbox",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Share Twitter", 'architect'),
         "param_name" => "twitter",
         "value" => "",
         "description" => esc_html__("Select yes or no. Default: No.", 'architect')
      ),
      array(
         "type" => "checkbox",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Share google plus", 'architect'),
         "param_name" => "google",
         "value" => "",
         "description" => esc_html__("Select yes or no. Default: No.", 'architect')
      ),
      array(
         "type" => "checkbox",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Share linkedin", 'architect'),
         "param_name" => "linkedin",
         "value" => "",
         "description" => esc_html__("Select yes or no. Default: No.", 'architect')
      ),
      array(
         "type" => "checkbox",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Share pinterest", 'architect'),
         "param_name" => "pinterest",
         "value" => "",
         "description" => esc_html__("Select yes or no. Default: No.", 'architect')
      ),
    )
    ));
}

// Social (use)
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Socaial", 'architect'),
   "base" => "social",
   "class" => "",
   "category" => 'Architect',
   "icon" => "icon-st",
   "params" => array(
            array(
                'type' => 'param_group',
                'value' => '',
                'param_name' => 'titles',
                // Note params is mapped inside param-group:
                'params' => array(
                    array(
                        'type' => 'iconpicker',
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Icon',
                        'param_name' => 'icon',
                        "value" => "",
                        "description" => __("Select social icon", 'architect')
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Link',
                        'param_name' => 'link',
                        "value" => "",
                        "description" => __("Add social link", 'architect')
                    ),
                )                
            )
    )
    ));
}

// Service (use)
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Service", 'architect'),
   "base" => "service",
   "class" => "",
   "category" => 'Architect',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Style", 'architect'),
         "param_name" => "style",
         "value" => array(
                     esc_html__('Images in the box', 'architect') => 'style1', 
                     esc_html__('No box', 'architect') => 'style2', 
                     esc_html__('Start post with show image in the right', 'architect') => 'style3', 
                     esc_html__('Start post with show image in the left', 'architect') => 'style4',                   
         ),
         "description" => esc_html__("", 'architect')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Number Service",'architect'),
         "param_name" => "number",
         "value" => "",
      ),
      array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Column", 'architect'),
         "param_name" => "column",
         'dependency'  => array( 'element' => 'style', 'value' => array( 'style2','style1' ) ),
         "value" => array(
                     esc_html__('2 Column', 'architect') => '2', 
                     esc_html__('3 Column', 'architect') => '3',  
                     esc_html__('4 Column', 'architect') => '4',                   
         ),
         "description" => esc_html__("", 'architect')
      ),
      array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Column", 'architect'),
         "param_name" => "column2",
         'dependency'  => array( 'element' => 'style', 'value' => array( 'style3','style4' ) ),
         "value" => array(
                     esc_html__('1 Column', 'architect') => '1', 
                     esc_html__('2 Column', 'architect') => '2',                   
         ),
         "description" => esc_html__("", 'architect')
      ),
      array(
         "type" => "checkbox",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Button", 'architect'),
         "param_name" => "button",
         "value" => "",
         "description" => esc_html__("Show button go to single service page. Default: no", 'architect')
      ),
    )
    ));
}

//Google Map
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Google Map", 'architect'),
   "base" => "ggmap",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Architect',
   "params" => array(        
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Title", 'architect'),
         "param_name" => "title",
         "value" => '',
         "description" => esc_html__("Enter the title", 'architect')
      ),      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Info", 'architect'),
         "param_name" => "info",
         "value" => '',
         "description" => esc_html__("Enter the info", 'architect')
      ),   
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Latitude", 'architect'),
         "param_name" => "lat",
         "value" => -37.817,
         "description" => esc_html__("Please enter http://www.latlong.net/ google map", 'architect')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Longitude", 'architect'),
         "param_name" => "long",
         "value" => 144.962,
         "description" => esc_html__("Please enter http://www.latlong.net/ google map", 'architect')

      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Zoom Map", 'architect'),
         "param_name" => "zoom",
         "value" => '',
         "description" => esc_html__("Please enter Zoom Map, Ex: 15", 'architect')
      ),
      array(
         "type" => "attach_image",
         "holder" => "div",
         "class" => "",
         "heading" => "Icon Map marker",
         "param_name" => "icon",
         "value" => "",
         "description" => esc_html__("Icon Map marker, 47 x 68", 'architect')
      ),  
      array(
          "type" => "textarea_raw_html",
          "holder" => "div",
          "class" => "",
          "heading" => esc_html__('JavaScript Code', 'architect'),
          "param_name" => "gmap_custom_style",
          "value" => "",
          "description" => __('Enter your JavaScript code, find your custom style gmap here:<a href="https://snazzymaps.com/explore" target="_blank">view more</a>', 'architect'),               
        )  
    )));
}
//Google Map 2
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Google Map 2", 'architect'),
   "base" => "ggmap2",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Architect',
   "params" => array(  
            array(
                'type' => 'param_group',
                'value' => '',
                'param_name' => 'body',
                // Note params is mapped inside param-group:
                'params' => array(
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Latitude ',
                        'param_name' => 'lat',
                        "value" => "",
                        "description" => esc_html__("Please enter http://www.latlong.net/ google map", 'architect')
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Longitude ',
                        'param_name' => 'long',
                        "value" => "",
                        "description" => esc_html__("Please enter http://www.latlong.net/ google map", 'architect')
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Title tab ',
                        'param_name' => 'tit_tab',
                        "value" => "",
                        "description" => esc_html__("Add Title Tab", 'architect')
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Title ',
                        'param_name' => 'title',
                        "value" => "",
                        "description" => esc_html__("Enter the title", 'architect')
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Info  ',
                        'param_name' => 'info',
                        "value" => "",
                        "description" => esc_html__("Enter the Info", 'architect')
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Zoom ',
                        'param_name' => 'zoom',
                        "value" => "",
                        "description" => esc_html__("Enter the zoom", 'architect')
                    ),
                    array(
                        'type' => 'attach_image',
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Image ',
                        'param_name' => 'image',
                        "value" => "",
                        "description" => esc_html__("Upload image. Image map marker", 'architect')
                    ),
                )                
            ),
      array(
          "type" => "textarea_raw_html",
          "holder" => "div",
          "class" => "",
          "heading" => esc_html__('JavaScript Code', 'architect'),
          "param_name" => "gmap_custom_style",
          "value" => "",
          "description" => __('Enter your JavaScript code, find your custom style gmap here:<a href="https://snazzymaps.com/explore" target="_blank">view more</a>', 'architect'),   
            
        )    
    )));
}
?>