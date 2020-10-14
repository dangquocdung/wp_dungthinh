<?php
/* add_ons_php */
azp_add_element(
    'filter_rating',
    array(
        'name'                    => __('Filter by Rating', 'townhub-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','townhub-add-ons'),
        'category'                => __("Filter", 'townhub-add-ons'),
        'icon'                    => ESB_DIR_URL . 'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create' => true,
        'showStyleTab'            => true,
        'showTypographyTab'       => true,
        'showAnimationTab'        => true,
        'template_folder'         => 'filter/',
        'attrs'                   => array(
            array(
                'type'                  => 'text', 
                'param_name'            => 'title',
                'show_in_admin'         => true,
                'label'                 => __('Title','townhub-add-ons'),
                'desc'                  => '',
                'default'               => 'Filter By Rating'
            ),
            array(
                'type'                  => 'repeater',
                'param_name'            => 'filed_rate',
                'show_in_admin'         => true,
                'label'                 => __('Repeater Field','townhub-add-ons'),
                'desc'                  => '',
                'title_field'           => 'rp_text',
                'fields'                => array(
                    array(
                        'type'                  => 'text',
                        'param_name'            => 'star',
                        'show_in_admin'         => true,
                        'label'                 => __('Stars Value','townhub-add-ons'),
                        'desc'                  => '',
                        'default'               => '5'
                    ),
                    array(
                        'type'                  => 'text',
                        'param_name'            => 'label',
                        'show_in_admin'         => true,
                        'label'                 => __('Label','townhub-add-ons'),
                        'desc'                  => '',
                        'default'               => '5 STARS'
                    ),
                ),
                'default'               => array(
                    // array('rp_text'=>'rp_text','rp_textarea'=>'rp_textarea') -> Objects are not valid as a React child (found: object with keys {rp_text, rp_textarea}).
                )
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','townhub-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','townhub-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'townhub-add-ons'),
                'default'               => ''
            ), 

        ),
    )
);
