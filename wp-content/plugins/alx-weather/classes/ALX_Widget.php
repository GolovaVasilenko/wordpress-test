<?php


class ALX_Widget extends WP_Widget
{
    public function __construct($id = 'alx_widget', $name = 'Weather', $attr = array('description' => 'Description'), $opt = array() )
    {
        parent::__construct($id, $name , $attr, $opt);
    }

    public function widget($args, $instance)
    {
        $title = apply_filters('widget_title', $instance['title']);
        echo $args['before_widget'];

        if (!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];

        echo '<div class="output-weather"></div>';
        echo $args['after_widget'];

    }

    public function form($instance)
    {
        if (isset($instance['title']))
            $title = $instance['title'];
        else
            $title = 'Title Widget';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">Заголовок</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }

}