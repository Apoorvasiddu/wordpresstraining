<?php
class hstngr_widget extends WP_Widget {
    function __construct() {
        parent::__construct(
        // widget ID
        'hstngr_widget',
        // widget name
        __('Hostinger Sample Widget', 'hstngr_widget_domain'),
        // widget description
        array ( 'description' => __( 'Hostinger Widget Tutorial', 'hstngr_widget_domain' ), )
        );
    }
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        echo $args['before widget'];
        //if title is present
        If ( ! empty ( $title ) )
        Echo $args['before_title'] . $title . $args['after_title'];
        //output
        echo __( 'Greetings from Hostinger.com!', 'hstngr_widget_domain' );
        echo $args['after_widget'];
    }
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) )
        $title = $instance[ 'title' ];
        else
        $title = __( 'Default Title', 'hstngr_widget_domain' );
?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
<?php
    }
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['text'] = ( ! empty( $new_instance['text'] ) ) ? strip_tags( $new_instance['text'] ) : '';
        return $instance;
    }
    public function get_field_id( $field_name ) {
        $field_name = str_replace( array( '[]', '[', ']' ), array( '', '-', '' ), $field_name );
        $field_name = trim( $field_name, '-' );
    
        return 'widget-' . $this->id_base . '-' . $this->number . '-' . $field_name;
    }
    public function save_settings( $settings ) {
        $settings['_multiwidget'] = 1;
        update_option( $this->option_name, $settings );
    }
    public function _register() {
        $settings = $this->get_settings();
        $empty    = true;
    
        // When $settings is an array-like object, get an intrinsic array for use with array_keys().
        if ( $settings instanceof ArrayObject || $settings instanceof ArrayIterator ) {
            $settings = $settings->getArrayCopy();
        }
    
        if ( is_array( $settings ) ) {
            foreach ( array_keys( $settings ) as $number ) {
                if ( is_numeric( $number ) ) {
                    $this->_set( $number );
                    $this->_register_one( $number );
                    $empty = false;
                }
            }
        }
    
        if ( $empty ) {
            // If there are none, we register the widget's existence with a generic template.
            $this->_set( 1 );
            $this->_register_one();
        }
    }
    public function get_field_name( $field_name ) {
        $pos = strpos( $field_name, '[' );
    
        if ( false !== $pos ) {
            // Replace the first occurrence of '[' with ']['.
            $field_name = '[' . substr_replace( $field_name, '][', $pos, strlen( '[' ) );
        } else {
            $field_name = '[' . $field_name . ']';
        }
    
        return 'widget-' . $this->id_base . '[' . $this->number . ']' . $field_name;
    }
    
}
function hstngr_register_widget() {
    register_widget( 'hstngr_widget' );
}
add_action( 'widgets_init', 'hstngr_register_widget' );