<?php

class Studylms_Course_Category extends Apus_Widget {
    public function __construct() {
        parent::__construct(
            'apus_course_category',
            esc_html__('Apus Course Category Widget', 'studylms'),
            array( 'description' => esc_html__( 'Show Course Category', 'studylms' ), )
        );
        $this->widgetName = 'course_category';
    }

    public function getTemplate() {
        $this->template = 'course-category.php';
    }

    public function widget( $args, $instance ) {
        $this->display($args, $instance);
    }
    
    public function form( $instance ) {
        $defaults = array(
            'title' => 'Course Category',
            'post_count' => 'yes'
        );
        $instance = wp_parse_args((array) $instance, $defaults);
        $options = array(
            'no' => esc_html__( 'No', 'studylms' ),
            'yes' => esc_html__( 'Yes', 'studylms' ),
        );
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'studylms' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('post_count')); ?>">
                <?php echo esc_html__('Show Post Count:', 'studylms' ); ?>
            </label>
            <select id="<?php echo esc_attr($this->get_field_id('post_count')); ?>" name="<?php echo esc_attr($this->get_field_name('post_count')); ?>">
                <?php foreach ( $options as $key => $value ) { ?>
                    <option value="<?php echo esc_attr( $key ); ?>" <?php selected($instance['post_count'], $key); ?> ><?php echo esc_html( $value ); ?></option>
                <?php } ?>
            </select>
        </p>
        
<?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['post_count'] = ( ! empty( $new_instance['post_count'] ) ) ? strip_tags( $new_instance['post_count'] ) : '';
        return $instance;

    }
}

register_widget( 'Studylms_Course_Category' );