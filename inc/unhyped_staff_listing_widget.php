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
    $instance = wp_parse_args( (array) $instance, array( 'user_ids_str' => '' ) );
    $user_ids_str = strip_tags($instance['user_ids_str']);
    ?>
    <p><label for="<?php echo $this->get_field_id('user_ids_str'); ?>"><?php _e('User IDs (comma separated):', 'unhyped'); ?>
      <input class="widefat" id="<?php echo $this->get_field_id('user_ids_str'); ?>" name="<?php echo $this->get_field_name('user_ids_str'); ?>" type="text" value="<?php echo esc_attr($user_ids_str); ?>" /></label></p>
    <?php
  }

  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['user_ids_str'] = strip_tags($new_instance['user_ids_str']);
    return $instance;
  }

  function widget($args, $instance) {
    // outputs the content of the widget
    extract( $args );

    if (empty($instance['user_ids_str']))
      return;

    $user_ids_str = apply_filters('widget_post_id', $instance['user_ids_str']);
    $user_ids = explode(',', $user_ids_str);

    echo $before_widget;

    if ( ! empty( $title ) )
      echo $before_title . $title . $after_title;
    ?>
    
    <div class="content">
      <?php
        if ( !empty($user_ids) ):
          echo '<ul class="staff-listing"><h2 class="list-title">unHYPED staff</h2>';
          foreach( $user_ids as $user_id ):
            echo '<li class="staff-member">'.the_user_bio($user_id).'</li>';
          endforeach;
          echo '</ul>';
        endif;
      ?>
    </div>

    <?php
    echo $after_widget;
  }
}