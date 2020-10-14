<?php

class Edr_Admin_PostTypes {
	/**
	 * Initialize.
	 */
	public static function init() {
		add_filter( 'manage_' . EDR_PT_LESSON . '_posts_columns', array( __CLASS__, 'lessons_columns' ) );
		add_filter( 'manage_' . EDR_PT_LESSON . '_posts_custom_column', array( __CLASS__, 'lessons_column_output' ), 10, 2 );
		add_filter( 'restrict_manage_posts', array( __CLASS__, 'lessons_add_filters' ) );
		add_filter( 'pre_get_posts', array( __CLASS__, 'lessons_parse_filters' ) );
		add_action( 'pre_get_posts', array( __CLASS__, 'lessons_menu_order' ) );
	}

	/**
	 * Add course column to the lessons list in admin.
	 *
	 * @param array $collumns
	 *
	 * @return array 
	 */
	public static function lessons_columns( $columns ) {
		$new_columns = array();

		foreach ( $columns as $key => $value ) {
			$new_columns[ $key ] = $value;

			if ( 'title' == $key ) {
				$new_columns['course'] = __( 'Course', 'educator' );
			}
		}

		return $new_columns;
	}

	/**
	 * Output column content to the lessons list in admin.
	 *
	 * @param string $column_name
	 * @param int $post_id
	 */
	public static function lessons_column_output( $column_name, $post_id ) {
		if ( 'course' == $column_name ) {
			$course_id = Edr_Courses::get_instance()->get_course_id( $post_id );

			if ( $course_id && ( $course = get_post( $course_id ) ) ) {
				echo '<a href="' . esc_url( get_permalink( $course->ID ) ) . '" target="_blank">' . esc_html( $course->post_title ) . '</a>';
			}
		}
	}

	/**
	 * Add courses filter select box to the lessons list in admin.
	 */
	public static function lessons_add_filters() {
		$screen = get_current_screen();

		if ( EDR_PT_LESSON == $screen->post_type ) {
			$args = array(
				'post_type'      => EDR_PT_COURSE,
				'posts_per_page' => -1,
			);

			if ( ! current_user_can( 'edit_others_' . EDR_PT_LESSON . 's' ) ) {
				$args['author'] = get_current_user_id();
			}

			$courses = get_posts( $args );

			if ( $courses ) {
				$selected_course = isset( $_GET['edr_course'] ) ? intval( $_GET['edr_course'] ) : 0;
				echo '<select name="edr_course">';
				echo '<option value="0">' . __( 'All courses', 'educator' ) . '</option>';
				foreach ( $courses as $course ) {
					echo '<option value="' . absint( $course->ID ) . '"' . ( $course->ID == $selected_course ? ' selected="selected"' : '' )
						 . '>' . esc_html( $course->post_title ) . '</option>';
				}
				echo '</select>';
			}
		}
	}

	/**
	 * Filter lessons output in the lessons list.
	 *
	 * @param WP_Query $query
	 */
	public static function lessons_parse_filters( $query ) {
		if ( is_admin() && $query->is_main_query() && EDR_PT_LESSON == $query->query['post_type'] ) {
			$selected_course = isset( $_GET['edr_course'] ) ? intval( $_GET['edr_course'] ) : 0;

			if ( $selected_course ) {
				$query->set( 'meta_query', array(
					array(
						'key'     => '_edr_course_id',
						'value'   => $selected_course,
						'compare' => '=',
						'type'    => 'UNSIGNED'
					)
				) );
			}
		}
	}

	/**
	 * Order the lessons on the lessons admin screen by menu_order.
	 *
	 * @param WP_Query $query
	 */
	public static function lessons_menu_order( $query ) {
		if ( $query->is_main_query() && EDR_PT_LESSON == $query->query['post_type'] ) {
			$query->set( 'orderby', 'menu_order' );
			$query->set( 'order', 'ASC' );
		}
	}
}
