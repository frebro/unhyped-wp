<?php
/**
* @Package Wordpress
* @SubPackage Widgets
*
* Plugin Name: unHYPED Featured Events Widget
* Description: Creates a list of the most recent alarms (requires custom post type 'alarm').
* Author: Fredrik Broman
* Author URI: http://syn-ack.se
*/

defined('ABSPATH') or die("Cannot access pages directly.");

/**
* Initializing
*
* The directory separator is different between linux and microsoft servers.
* Thankfully php sets the DIRECTORY_SEPARATOR constant so that we know what
* to use.
*/
defined("DS") or define("DS", DIRECTORY_SEPARATOR);

/**
* Actions and Filters
*
* Register any and all actions here. Nothing should actually be called
* directly, the entire system will be based on these actions and hooks.
*/
add_action( 'widgets_init', create_function( '', 'register_widget("UNHYPED_Staff_Listing_Widget");' ) );


/**
*
* RVB Stationmap Widget
*/
class UNHYPED_Staff_Listing_Widget extends WP_Widget {
  /**
  * Constructor
  *
  * Registers the widget details with the parent class
  */
  function UNHYPED_Staff_Listing_Widget() {
    // widget actual processes
    parent::WP_Widget( $id = 'UNHYPED_Staff_Listing_Widget', $name = __('Staff Listing', 'unhyped'), $options = array( 'description' => __('Displays a list of featured staff members', 'unhyped') ) );
  }

  function form($instance) {
    $instance = wp_parse_args( (array) $instance, array( 'user_id_csv' => '' ) );
    $user_id_csv = strip_tags($instance['user_id_csv']);
    ?>
    <p><label for="<?php echo $this->get_field_id('user_id_csv'); ?>"><?php _e('User IDs (comma separated):', 'unhyped'); ?>
      <input class="widefat" id="<?php echo $this->get_field_id('user_id_csv'); ?>" name="<?php echo $this->get_field_name('user_id_csv'); ?>" type="text" value="<?php echo esc_attr($user_id_csv); ?>" /></label></p>
    <?php
  }

  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['user_id_csv'] = strip_tags($new_instance['user_id_csv']);
    return $instance;
  }

  function widget($args, $instance) {
    // outputs the content of the widget
    extract( $args );

    if (empty($instance['user_id_csv']))
      return;

    $user_id_csv = apply_filters('widget_post_id', $instance['user_id_csv']);

    echo $before_widget;

    if ( ! empty( $title ) )
      echo $before_title . $title . $after_title;
    ?>
    
    <div class="content">
      <?php
        echo $user_id_csv;
      ?>
    </div>

    <?php
    echo $after_widget;
  }
}
?>