<?php

if ( !function_exists( 'studylms_educator_metaboxes' ) ) {
	function studylms_educator_metaboxes(array $metaboxes) {
		$prefix = 'apus_educator_';
		$post_author = '';
		if ( isset( $_GET['post'] ) && isset( get_post( $_GET['post'] )->post_author ) ) {
			$post_author = get_post( $_GET['post'] )->post_author;
			if ( $post_author != get_current_user_id() && !current_user_can( 'manage_options' ) ) {
				$class = 'hidden';
			}
		}
		$instructors = array();
		if ( function_exists('studylms_educator_get_lecturers') ) {
			$users = studylms_educator_get_lecturers();
			
			if ( $users ) {
				foreach ($users as $user) {
					if ( $user->ID != $post_author ) {
						$instructors[$user->ID] = $user->data->display_name;
					}
				}
			}
		}
	    $fields = array(
	    	array(
				'name' => esc_html__( 'Course Location', 'studylms' ),
				'id'   => $prefix.'location',
				'type' => 'text',
			),
	    	array(
				'name' => esc_html__( 'Start Course', 'studylms' ),
				'id'   => $prefix.'startcourse',
				'type' => 'text_date',
			),
	    	array(
				'name' => esc_html__( 'Course Duration', 'studylms' ),
				'id'   => $prefix.'duration',
				'type' => 'text',
				'description' => esc_html__( 'Enter duration time', 'studylms' ),
			),
			array(
			    'name' => esc_html__( 'Language', 'studylms' ),
			    'id'   => $prefix.'langauge',
			    'type' => 'text'
			),
			array(
				'name' => esc_html__( 'Course Capacity', 'studylms' ),
				'id'   => $prefix.'capacity',
				'type' => 'text',
				'default' => 50
			),
			array(
				'name' => esc_html__( 'Certificate', 'studylms' ),
				'id'   => $prefix.'certificate',
				'type' => 'select',
			    'options' => array(
			        0 => esc_html__( 'No', 'studylms' ),
			        1 => esc_html__( 'Yes', 'studylms' )
			    ),
			)
    	);
		if (!isset($class) || $class != 'hidden') {
			$fields[] = array(
				'name' => esc_html__( 'Co-Instructors', 'studylms' ),
				'id'   => $prefix.'instructors',
				'type' => 'multicheck_inline',
			    'options' => $instructors
			);
		}
	    $metaboxes[$prefix . 'display_setting'] = array(
			'id'                        => $prefix . 'display_setting',
			'title'                     => esc_html__( 'More Information', 'studylms' ),
			'object_types'              => array( EDR_PT_COURSE ),
			'context'                   => 'normal',
			'priority'                  => 'low',
			'show_names'                => true,
			'fields'                    => $fields
		);

	    $prefix = 'apus_lesson_';
	    $fields = array(
	    	array(
				'name' => esc_html__( 'Lesson Duration', 'studylms' ),
				'id'   => $prefix.'duration',
				'type' => 'text',
				'description' => esc_html__( 'Enter duration time', 'studylms' ),
			),
    	);
	    $metaboxes[$prefix . 'display_setting'] = array(
			'id'                        => $prefix . 'display_setting',
			'title'                     => esc_html__( 'Lesson Options', 'studylms' ),
			'object_types'              => array( EDR_PT_LESSON ),
			'context'                   => 'normal',
			'priority'                  => 'low',
			'show_names'                => true,
			'fields'                    => $fields
		);
	    return $metaboxes;
	}
}
add_filter( 'cmb2_meta_boxes', 'studylms_educator_metaboxes' );
