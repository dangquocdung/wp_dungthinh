<?php

if ( !function_exists( 'studylms_event_metaboxes' ) ) {
	function studylms_event_metaboxes(array $metaboxes) {
        $roles = array( 'administrator', 'lecturer', 'author' );
        $users = get_users( array( 'role__in' => $roles ) );
        $authors = array();
        if ( $users ) {
            foreach ($users as $user) {
                $authors[$user->ID] = $user->data->display_name;
            }
        }
		$prefix = 'apus_event_';
        // Featured
        $fields = array(
            array(
                'id' => $prefix.'featured',
                'type' => 'checkbox',
                'name' => esc_html__('Featured Event', 'studylms')
            )
        );
        
        $metaboxes[$prefix . 'event_setting'] = array(
            'id'                        => $prefix . 'event_setting',
            'title'                     => esc_html__( 'Event Settings', 'studylms' ),
            'object_types'              => array( 'tribe_events' ),
            'context'                   => 'normal',
            'priority'                  => 'high',
            'show_names'                => true,
            'fields'                    => $fields
        );
        // speaker description
	    $fields = array(
            array(
                'id' => $prefix.'speaker_desc',
                'type' => 'textarea',
                'name' => esc_html__('Speaker Descriprtion', 'studylms')
            ),
            array(
                'id' => $prefix.'speakers',
                'type' => 'multicheck',
                'name' => esc_html__('Speakers', 'studylms'),
                'description' => esc_html__('Choose user from "Author" role.', 'studylms'),
                'options' => $authors
            )
    	);
		
	    $metaboxes[$prefix . 'speakers_setting'] = array(
			'id'                        => $prefix . 'speakers_setting',
			'title'                     => esc_html__( 'Speakers Settings', 'studylms' ),
			'object_types'              => array( 'tribe_events' ),
			'context'                   => 'normal',
			'priority'                  => 'high',
			'show_names'                => true,
			'fields'                    => $fields
		);
        
	    return $metaboxes;
	}
}
add_filter( 'cmb2_meta_boxes', 'studylms_event_metaboxes' );
