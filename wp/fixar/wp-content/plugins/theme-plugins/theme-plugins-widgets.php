<?php

// prevent direct file access
if( ! defined( 'ABSPATH' ) ) {
    header( 'Status: 403 Forbidden' );
    header( 'HTTP/1.1 403 Forbidden' );
    exit;
}



class Tmpl_StaticBlock_Widget extends WP_Widget {


    function __construct() {

        parent::__construct(
            'Tmpl_StaticBlock_Widget',
            __( 'Tmpl Static Block Widget', 'tmpl-staticblock-widget' ),
            array(
                'description' => __( 'Displays your static block in widget', 'tmpl-staticblock-widget' ),
            )
        );
    }

    public function widget( $args, $instance ) {

        $title = isset( $instance['title'] ) ? $instance['title'] : '';
        $blockId = isset( $instance['block_id'] ) ? $instance['block_id'] : 0;
        $title = apply_filters( 'widget_title', $title );

        echo $args['before_widget'];

        /*if ( ! empty( $title ) ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }*/

        $html = '<div class="product-sidebar-block sidebar-product">';

        $html .= tmpl_get_staticblock_content($blockId);

        $html .= '</div>';

        echo $html;

        echo $args['after_widget'];
    }

    public function form( $instance ) {
        $title = isset( $instance['title'] ) ? $instance['title'] : 'Static Block';
        $blockId = isset( $instance['block_id'] ) ? $instance['block_id'] : '';
        $blocks = $this->getBlocksAll();


        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'tmpl-staticblock-widget' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'block_id' ); ?>"><?php _e( 'Static Block:', 'tmpl-staticblock-widget' ); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id( 'block_id' ); ?>" name="<?php echo $this->get_field_name( 'block_id' ); ?>">
                <?php foreach ($blocks as $block):?>
                    <option <?php if ($blockId == $block->ID):?>selected="selected"<?php endif;?> value=<?php echo $block->ID?>""><?php echo $block->post_title?></option>
                <?php endforeach?>
            </select>
        </p>



        <?php
    }


    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
        $instance['block_id'] = ( ! empty( $new_instance['block_id'] ) ) ? sanitize_text_field( $new_instance['block_id'] ) : '';
        return $instance;
    }

    private function getBlocksAll(){
        $args = array(
            'post_type'        => 'staticblocks',
            'post_status'      => 'publish',
        );

        $blocks = get_posts($args);

        return $blocks;
    }

}


class Tmpl_Services_Widget extends WP_Widget {

	// Widget setup.
	function __construct() {

		// Widget settings.
		$widget_ops = array(
			'classname' => 'widget_services_category',
			'description' => esc_html__('Display Services Categories', 'tmpl')
		);

		// Create the widget.
		parent::__construct('tmpl-services-widget', esc_html__('Services Categories', 'tmpl') , $widget_ops);
	}

	// Display the widget on the screen.
	function widget($args, $instance) {
		global $post;
		extract($args);
		$title = apply_filters('widget_title', $instance['serv_title']);
		$terms = wp_get_post_terms( $post->ID, 'services_category' );
		$services_page = fixar_get_option('services_settings_page', '');
		$all_services = '';
		if ( '' != $services_page ) {
			$all_services = get_the_permalink($services_page);
		}

		echo wp_kses_post($before_widget);
		if ($title) echo wp_kses_post($before_title . $title . $after_title);

		$args = array( 'taxonomy' => 'services_category', 'hide_empty' => '0');
		$categories = get_categories($args);
		echo '<div class="sidebar-services"><ul>
				<li><a href="'. esc_url($all_services) .'">'. esc_html__('All services', 'tmpl') .'</a></li>';

		foreach($categories as $category){

			$class = isset($terms[0]->term_id) && ($terms[0]->term_id == $category->term_id) ? 'class="active"' : '';
			?>
			<li <?php echo wp_kses_post($class)?>><a href="<?php echo esc_url(get_category_link( $category->term_id )); ?>"><?php echo wp_kses_post($category->name); ?></a></li>
            <?php
		}
		echo '</ul></div>';
		echo wp_kses_post($after_widget);
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['serv_title'] = strip_tags($new_instance['serv_title']);
		return $instance;
	}

	function form($instance) {
		$defaults = array(
			'serv_title' => esc_html__('Services Categories', 'tmpl'),
		);
		$instance = wp_parse_args((array)$instance, $defaults); ?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('serv_title')); ?>"><?php esc_html_e('Title', 'tmpl'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id('serv_title')); ?>" type="text" name="<?php echo esc_attr($this->get_field_name('serv_title')); ?>" value="<?php echo esc_attr($instance['serv_title']); ?>" class="widefat" />
		</p>

	<?php
	}
}