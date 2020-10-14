<?php 


//Custom Heading
if(function_exists('vc_map')){

   vc_map( array(

   "name"      => __("OT Heading", 'calliope'),

   "base"      => "heading",

   "class"     => "",

   "icon" => "icon-st",

   "category"  => 'Content',

   "params"    => array(

      array(

         "type"      => "textarea",

         "holder"    => "div",

         "class"     => "",

         "heading"   => __("Text", 'calliope'),

         "param_name"=> "text",

         "value"     => "Heading",

         "description" => __("", 'calliope')

      ),
      array(

        "type" => "dropdown",

        "heading" => __('Element Tag', 'calliope'),

        "param_name" => "tag",

        "value" => array(   
                     __('Select Tag', 'calliope') => '',

                     __('h1', 'calliope') => 'h1',

                     __('h2', 'calliope') => 'h2',

                     __('h3', 'calliope') => 'h3',  

                     __('h4', 'calliope') => 'h4',

                     __('h5', 'calliope') => 'h5',

                     __('h6', 'calliope') => 'h6',  

                     __('p', 'calliope')  => 'p',

                     __('div', 'calliope') => 'div',
                    ),

        "description" => __("Section Element Tag", 'calliope'),      

      ),
      array(

        "type" => "dropdown",

        "heading" => __('Text Align', 'calliope'),

        "param_name" => "align",

        "value" => array(   

                     __('inherit', 'calliope') => 'inherit',

                     __('left', 'calliope') => 'left',

                     __('right', 'calliope') => 'right',  

                     __('center', 'calliope') => 'center',

                     __('justify', 'calliope') => 'justify',
                     
                    ),

        "description" => __("Section Overlay", 'calliope'),      

      ),
      array(

         "type"      => "textfield",

         "holder"    => "div",

         "class"     => "",

         "heading"   => __("Font Size", 'calliope'),

         "param_name"=> "size",

         "value"     => "",

         "description" => __("", 'calliope')

      ),
      array(

         "type"      => "colorpicker",

         "holder"    => "div",

         "class"     => "",

         "heading"   => __("Color", 'calliope'),

         "param_name"=> "color",

         "value"     => "",

         "description" => __("", 'calliope')

      ),
      array(

         "type"      => "textfield",

         "holder"    => "div",

         "class"     => "",

         "heading"   => __("Margin Bottom", 'calliope'),

         "param_name"=> "bot",

         "value"     => "",

         "description" => __("", 'calliope')

      ),
      array(

         "type"      => "textfield",

         "holder"    => "div",

         "class"     => "",

         "heading"   => __("Class Extra", 'calliope'),

         "param_name"=> "class",

         "value"     => "",

         "description" => __("", 'calliope')

      ),
    )));

}

//Button Effect
if(function_exists('vc_map')){
   
   vc_map( array(
   "name" => __("OT Button Effect", 'calliope'),
   "base" => "btneffect",
   "class" => "",
   "category" => 'Content',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => "Label Button",
         "param_name" => "btn",
         "value" => "",
         "description" => __("Add link video .mp4", 'calliope')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => "Label Hover",
         "param_name" => "hover",
         "value" => "",
         "description" => __("Add link video .webm", 'calliope')
      ), 
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Link Button", 'calliope'),
         "param_name" => "link",
         "value" => "",
         "description" => __("", 'calliope')
      ),
      array(
         "type" => "checkbox",
         "holder" => "div",
         "class" => "",
         "heading" => __("Open New Window?", 'calliope'),
         "param_name" => "target",
         "value" => "",
         "description" => __("Default: False", 'calliope')
      ),
    )
    ));
}

//Home Video
if(function_exists('vc_map')){
   vc_map( array(
   "name" => __("OT Home Video", 'calliope'),
   "base" => "slidervideo",
   "class" => "",
   "category" => 'Content',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => "Link video mp4",
         "param_name" => "mp4",
         "value" => "",
         "description" => __("Add link video .mp4", 'calliope')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => "Link video webm",
         "param_name" => "webm",
         "value" => "",
         "description" => __("Add link video .webm", 'calliope')
      ), 
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => "Link video ogg",
         "param_name" => "ogg",
         "value" => "",
         "description" => __("Add link video .ogg", 'calliope')
      ),     
      array(
         "type" => "textarea_html",
         "holder" => "div",
         "class" => "",
         "heading" => __("Text Slider", 'calliope'),
         "param_name" => "content",
         "value" => "",
         "description" => __("List text slider.", 'calliope')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Small Text", 'calliope'),
         "param_name" => "stext",
         "value" => "",
         "description" => __("", 'calliope')
      ),
    )
    ));
}


//Home Slider

if(function_exists('vc_map')){
   vc_map( array(
   "name"      => __("OT Home Slider", 'calliope'),
   "base"      => "homeslider",
   "class"     => "",
   "icon" => "icon-st",
   "category"  => 'Content',
   "params"    => array(
      array(
         "type" => "attach_images",
         "holder" => "div",
         "class" => "",
         "heading" => "Background Slider",
         "param_name" => "gallery",
         "value" => "",
         "description" => __("", 'calliope')
      ),
      array(
         "type" => "textarea_html",
         "holder" => "div",
         "class" => "",
         "heading" => __("Text Slider", 'calliope'),
         "param_name" => "content",
         "value" => "",
         "description" => __("List text slider.", 'calliope')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Small Text", 'calliope'),
         "param_name" => "stext",
         "value" => "",
         "description" => __("", 'calliope')
      ),
    )));
}


//Social
if(function_exists('vc_map')){
   vc_map( array(
   "name" => __("OT Socials", 'calliope'),
   "base" => "socslider",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Icon 1", 'calliope'),
         "param_name" => "icon1",
         "value" => "",
         "description" => __("Find here: <a target='_blank' href='http://fontawesome.io/icons/'>http://fontawesome.io/icons/</a>", 'calliope')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Link 1", 'calliope'),
         "param_name" => "link1",
         "value" => "",
         "description" => __("Link Social", 'calliope')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Icon 2", 'calliope'),
         "param_name" => "icon2",
         "value" => "",
         "description" => __("Find here: <a target='_blank' href='http://fontawesome.io/icons/'>http://fontawesome.io/icons/</a>", 'calliope')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Link 2", 'calliope'),
         "param_name" => "link2",
         "value" => "",
         "description" => __("Link Social", 'calliope')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Icon 3", 'calliope'),
         "param_name" => "icon3",
         "value" => "",
         "description" => __("Find here: <a target='_blank' href='http://fontawesome.io/icons/'>http://fontawesome.io/icons/</a>", 'calliope')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Link 3", 'calliope'),
         "param_name" => "link3",
         "value" => "",
         "description" => __("Link Social", 'calliope')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Icon 4", 'calliope'),
         "param_name" => "icon4",
         "value" => "github",
         "description" => __("Find here: <a target='_blank' href='http://fontawesome.io/icons/'>http://fontawesome.io/icons/</a>", 'calliope')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Link 4", 'calliope'),
         "param_name" => "link4",
         "value" => "",
         "description" => __("Link Social", 'calliope')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Icon 5", 'calliope'),
         "param_name" => "icon5",
         "value" => "",
         "description" => __("Find here: <a target='_blank' href='http://fontawesome.io/icons/'>http://fontawesome.io/icons/</a>", 'calliope')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Link 5", 'calliope'),
         "param_name" => "link5",
         "value" => "",
         "description" => __("Link Social", 'calliope')
      ),
    )));
}


//Header Page
if(function_exists('vc_map')){
   vc_map( array(
   "name" => __("OT Header Section", 'calliope'),
   "base" => "headpage",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title Section", 'calliope'),
         "param_name" => "title",
         "value" => "",
         "description" => __("", 'calliope')
      ),
      array(
         "type" => "colorpicker",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title Color", 'calliope'),
         "param_name" => "color1",
         "value" => "",
         "description" => __("", 'calliope')
      ),
      array(
         "type" => "textarea_html",
         "holder" => "div",
         "class" => "",
         "heading" => __("Subtitle Section", 'calliope'),
         "param_name" => "content",
         "value" => "",
         "description" => __("", 'calliope')
      ),
      array(
         "type" => "colorpicker",
         "holder" => "div",
         "class" => "",
         "heading" => __("Subtitle Color", 'calliope'),
         "param_name" => "color2",
         "value" => "",
         "description" => __("", 'calliope')
      ),
    )));
}


// Header Project

if(function_exists('vc_map')){
   vc_map( array(
   "name" => __("OT Header Project", 'calliope'),
   "base" => "headerfolio",
   "class" => "",
   "category" => 'Content',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title Header", 'calliope'),
         "param_name" => "title",
         "value" => "",
         "description" => __("", 'calliope')
      ),
      array(
         "type" => "textarea",
         "holder" => "div",
         "class" => "",
         "heading" => __("Subtitle Header 1", 'calliope'),
         "param_name" => "sub1",
         "value" => "",
         "description" => __("", 'calliope')
      ),
      array(
         "type" => "textarea",
         "holder" => "div",
         "class" => "",
         "heading" => __("Subtitle Header 2", 'calliope'),
         "param_name" => "sub2",
         "value" => "",
         "description" => __("", 'calliope')
      ),
      
    )));
}

//Slider Project

if(function_exists('vc_map')){
   vc_map( array(
   "name"      => __("OT Gallery Project", 'calliope'),
   "base"      => "folioslider",
   "class"     => "",
   "icon" => "icon-st",
   "category"  => 'Content',
   "params"    => array(
      array(
         "type" => "attach_images",
         "holder" => "div",
         "class" => "",
         "heading" => "Images Slider",
         "param_name" => "gallery",
         "value" => "",
         "description" => __("", 'calliope')
      ),
      
    )));
}

//Video Player

if(function_exists('vc_map')){
   vc_map( array(
   "name"      => __("OT Video Project", 'calliope'),
   "base"      => "videoplayer",
   "class"     => "",
   "icon" => "icon-st",
   "category"  => 'Content',
   "params"    => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => "Link Video",
         "param_name" => "video",
         "value" => "",
         "description" => __("Ex: http://player.vimeo.com/video/88883554 or http://www.youtube.com/embed/eP2VWNtU5rw", 'calliope')
      ), 
      
    )));
}



//Our Team
if(function_exists('vc_map')){
   vc_map( array(
   "name" => __("OT Our Team", 'calliope'),
   "base" => "team",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
      array(
         "type" => "attach_image",
         "holder" => "div",
         "class" => "",
         "heading" => "Photo Member",
         "param_name" => "photo",
         "value" => "",
         "description" => __("Avarta of member, Recomended Size: 100 x 100", 'calliope')
      ),
      array(

        "type" => "dropdown",

        "heading" => __('Photo Align', 'calliope'),

        "param_name" => "lor",

        "value" => array(

                     __('Right', 'calliope') => 'right',

                     __('Left', 'calliope') => 'left',
                     
                    ),

        "description" => __("Section Overlay", 'calliope'),      

      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Name", 'calliope'),
         "param_name" => "name",
         "value" => "",
         "description" => __("Member's Name", 'calliope')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Job", 'calliope'),
         "param_name" => "job",
         "value" => "",
         "description" => __("Job's Avarta.", 'calliope')
      ), 
      array(
         "type"      => "textarea_html",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Detail Member", 'calliope'),
         "param_name"=> "content",
         "value"     => "",
         "description" => __("", 'calliope')
      ),
      array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Icon 1", 'calliope'),
         "param_name"=> "icon1",
         "value"     => "",
         "description" => __("Find here: <a target='_blank' href='http://fontawesome.io/icons/'>http://fontawesome.io/icons/</a>", 'calliope')
      ),
     array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => "Url 1",
         "param_name"=> "url1",
         "value"     => "",
         "description" => __("Url.", 'calliope')
      ),
     array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Icon 2", 'calliope'),
         "param_name"=> "icon2",
         "value"     => "",
         "description" => __("Find here: <a target='_blank' href='http://fontawesome.io/icons/'>http://fontawesome.io/icons/</a>", 'calliope')
      ),
     array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => "Url 2",
         "param_name"=> "url2",
         "value"     => "",
         "description" => __("Url.", 'calliope')
      ),
     array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Icon 3", 'calliope'),
         "param_name"=> "icon3",
         "value"     => "",
         "description" => __("Find here: <a target='_blank' href='http://fontawesome.io/icons/'>http://fontawesome.io/icons/</a>", 'calliope')
      ),
     array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => "Url 3",
         "param_name"=> "url3",
         "value"     => "",
         "description" => __("Url.", 'calliope')
      ),
     array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Icon 4", 'calliope'),
         "param_name"=> "icon4",
         "value"     => "",
         "description" => __("Find here: <a target='_blank' href='http://fontawesome.io/icons/'>http://fontawesome.io/icons/</a>", 'calliope')
      ),
     array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => "Url 4",
         "param_name"=> "url4",
         "value"     => "",
         "description" => __("Url.", 'calliope')
      ),
    )));
}


//Skills
if(function_exists('vc_map')){
   vc_map( array(
   "name"      => __("OT Our Skills", 'calliope'),
   "base"      => "skill",
   "class"     => "",
   "icon" => "icon-st",
   "category"  => 'Content',
   "params"    => array(
      array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Skill Name", 'calliope'),
         "param_name"=> "name",
         "value"     => "",
         "description" => __("", 'calliope')
      ),
      array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Skill Percent", 'calliope'),
         "param_name"=> "per",
         "value"     => "",
         "description" => __("Ex: 90%.", 'calliope')
      ),
    )));
}


// Testimonials

if(function_exists('vc_map')){
   vc_map( array(
   "name" => __("OT Testimonials", 'calliope'),
   "base" => "testi",
   "class" => "",
   "category" => 'Content',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Number Post", 'calliope'),
         "param_name" => "number",
         "value" => -1,
         "description" => __("", 'calliope')
      ),
      
    )));
}



// Services Box
if(function_exists('vc_map')){
   vc_map( array(
   "name" => __("OT Services Box", 'calliope'),
   "base" => "servicebox",
   "class" => "",
   "category" => 'Content',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title Service", 'calliope'),
         "param_name" => "title",
         "value" => "",
         "description" => __("Title display in Services box.", 'calliope')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => "Icon Service",
         "param_name" => "icon",
         "value" => "",
         "description" => __("Add class icon. Ex: heart. Find here: <a href='http://fontawesome.io/icons/#currency'>http://fontawesome.io/icons/</a>", 'calliope')
      ),      
      array(
         "type" => "textarea",
         "holder" => "div",
         "class" => "",
         "heading" => __("Description", 'calliope'),
         "param_name" => "des",
         "value" => "",
         "description" => __("Short info.", 'calliope')
      ),
      array(
         "type" => "textarea_html",
         "holder" => "div",
         "class" => "",
         "heading" => __("Content Service", 'calliope'),
         "param_name" => "content",
         "value" => "",
         "description" => __("About your Services.", 'calliope')
      ),      
    )
    ));
}

// Features Box
if(function_exists('vc_map')){
   vc_map( array(
   "name" => __("OT Features Box", 'calliope'),
   "base" => "ourfeatures",
   "class" => "",
   "category" => 'Content',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title Features", 'calliope'),
         "param_name" => "title",
         "value" => "",
         "description" => __("Title display in Features box.", 'calliope')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => "Icon Features",
         "param_name" => "icon",
         "value" => "",
         "description" => __("Add class icon. Ex: heart. Find here: <a href='http://fontawesome.io/icons/#currency'>http://fontawesome.io/icons/</a>", 'calliope')
      ),
      array(
         "type" => "textarea_html",
         "holder" => "div",
         "class" => "",
         "heading" => __("Content Features", 'calliope'),
         "param_name" => "content",
         "value" => "",
         "description" => __("About your Features.", 'calliope')
      ),      
    )
    ));
}

// Blog List
if(function_exists('vc_map')){
   vc_map( array(
   "name" => __("OT Blog List", 'calliope'),
   "base" => "bloglist",
   "class" => "",
   "category" => 'Content',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Number Post", 'calliope'),
         "param_name" => "number",
         "value" => "",
         "description" => __("number post to show.", 'calliope')
      ),
    )));
}


// Work Filter
if(function_exists('vc_map')){
   vc_map( array(
   "name" => __("OT Our Work", 'calliope'),
   "base" => "workfilter",
   "class" => "",
   "category" => 'Content',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Number Post", 'calliope'),
         "param_name" => "number",
         "value" => "",
         "description" => __("Show all or number post.", 'calliope')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Text Show All", 'calliope'),
         "param_name" => "all",
         "value" => "",
         "description" => __("", 'calliope')
      ),
   
    )));
}


//Contact Info
if(function_exists('vc_map')){
   vc_map( array(
   "name"      => __("OT Contact Info", 'calliope'),
   "base"      => "ctinfo",
   "class"     => "",
   "icon" => "icon-st",
   "category"  => 'Content',
   "params"    => array(
      array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Icon", 'calliope'),
         "param_name"=> "icon",
         "value"     => "",
         "description" => __("Add class icon. Ex: heart. Find here: <a href='http://fontawesome.io/icons/'>http://fontawesome.io/icons/</a>", 'calliope')
      ),
      array(
         "type"      => "textarea_html",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Infomation", 'calliope'),
         "param_name"=> "content",
         "value"     => "",
         "description" => __("Details info", 'calliope')
      ),
    )));
}



//Google Map

if(function_exists('vc_map')){
   vc_map( array(
   "name"      => __("OT Google Maps", 'calliope'),
   "base"      => "maps",
   "class"     => "",
   "icon" => "icon-st",
   "category"  => 'Content',
   "params"    => array(
      
      array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Latitude", 'calliope'),
         "param_name"=> "latitude",
         "value"     => 44.789511,
         "description" => __("", 'calliope')
      ),
     array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Longitude", 'calliope'),
         "param_name"=> "longitude",
         "value"     => 20.43633,
         "description" => __("", 'calliope')
      ),     
     array(
         "type"      => "attach_image",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Location Image", 'calliope'),
         "param_name"=> "imgmap",
         "value"     => "",
         "description" => __("Upload Location Image.", 'calliope')
      ),
      array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Tootip Location Click", 'calliope'),
         "param_name"=> "tooltip",
         "value"     => '',
         "description" => __("", 'calliope')
      ),
     array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Zoom map number", 'calliope'),
         "param_name"=> "zoom",
         "value"     => '',
         "description" => __("", 'calliope')
      ),
     array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Height (px)", 'calliope'),
         "param_name"=> "height",
         "value"     => '',
         "description" => __("Ex: 400px.", 'calliope')
      ),
    )));
}
 ?>