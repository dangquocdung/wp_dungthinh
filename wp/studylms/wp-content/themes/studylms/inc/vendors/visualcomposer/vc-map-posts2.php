<?php

if ( function_exists('vc_map') && class_exists('WPBakeryShortCode') ) {

    function studylms_get_post_categories() {
        $return = array( esc_html__(' --- Choose a Category --- ', 'studylms') => '' );

        $args = array(
            'type' => 'post',
            'child_of' => 0,
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => false,
            'hierarchical' => 1,
            'taxonomy' => 'category'
        );

        $categories = get_categories( $args );
        studylms_get_post_category_childs( $categories, 0, 0, $return );

        return $return;
    }

    function studylms_get_post_category_childs( $categories, $id_parent, $level, &$dropdown ) {
        foreach ( $categories as $key => $category ) {
            if ( $category->category_parent == $id_parent ) {
                $dropdown = array_merge( $dropdown, array( str_repeat( "- ", $level ) . $category->name => $category->slug ) );
                unset($categories[$key]);
                studylms_get_post_category_childs( $categories, $category->term_id, $level + 1, $dropdown );
            }
        }
	}

	function studylms_load_post2_element() {
		$layouts = array(
			esc_html__('Grid', 'studylms') => 'grid',
			esc_html__('List', 'studylms') => 'list',
			esc_html__('Carousel', 'studylms') => 'carousel',
		);
		$columns = array(1,2,3,4,6);
		$categories = array();
		if ( is_admin() ) {
			$categories = studylms_get_post_categories();
		}
		vc_map( array(
			'name' => esc_html__( 'Apus Grid Posts', 'studylms' ),
			'base' => 'apus_gridposts',
			'icon' => 'icon-wpb-news-12',
			"category" => esc_html__('Apus Post', 'studylms'),
			'description' => esc_html__( 'Create Post having blog styles', 'studylms' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title', 'studylms' ),
					'param_name' => 'title',
					'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'studylms' ),
					"admin_label" => true
				),
				array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Category','studylms'),
	                "param_name" => 'category',
	                "value" => $categories
	            ),
	            array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Order By','studylms'),
	                "param_name" => 'orderby',
	                "value" => array(
	                	esc_html__('Date', 'studylms') => 'date',
	                	esc_html__('ID', 'studylms') => 'ID',
	                	esc_html__('Author', 'studylms') => 'author',
	                	esc_html__('Title', 'studylms') => 'title',
	                	esc_html__('Modified', 'studylms') => 'modified',
	                	esc_html__('Parent', 'studylms') => 'parent',
	                	esc_html__('Comment count', 'studylms') => 'comment_count',
	                	esc_html__('Menu order', 'studylms') => 'menu_order',
	                	esc_html__('Random', 'studylms') => 'rand',
	                )
	            ),
	            array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Sort order','studylms'),
	                "param_name" => 'order',
	                "value" => array(
	                	esc_html__('Descending', 'studylms') => 'DESC',
	                	esc_html__('Ascending', 'studylms') => 'ASC',
	                )
	            ),
	            array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Limit', 'studylms' ),
					'param_name' => 'posts_per_page',
					'description' => esc_html__( 'Enter limit posts.', 'studylms' ),
					'std' => 4,
					"admin_label" => true
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Pagination?', 'studylms' ),
					'param_name' => 'show_pagination',
					'description' => esc_html__( 'Enables to show paginations to next new page.', 'studylms' ),
					'value' => array( esc_html__( 'Yes, to show pagination', 'studylms' ) => 'yes' )
				),
				array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Grid Columns','studylms'),
	                "param_name" => 'grid_columns',
	                "value" => $columns
	            ),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Layout Type", 'studylms'),
					"param_name" => "layout_type",
					"value" => $layouts
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Thumbnail size', 'studylms' ),
					'param_name' => 'thumbsize',
					'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'studylms' )
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'studylms' ),
					'param_name' => 'el_class',
					'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'studylms' )
				)
			)
		) );
	}

	add_action( 'vc_after_set_mode', 'studylms_load_post2_element', 99 );

	class WPBakeryShortCode_apus_gridposts extends WPBakeryShortCode {}
}