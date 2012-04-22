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
add_action( 'widgets_init', create_function( '', 'register_widget("UNHYPED_Featured_Event_Widget");' ) );


/**
*
* RVB Stationmap Widget
*/
class UNHYPED_Featured_Event_Widget extends WP_Widget {
  /**
  * Constructor
  *
  * Registers the widget details with the parent class
  */
  function UNHYPED_Featured_Event_Widget() {
    // widget actual processes
    parent::WP_Widget( $id = 'UNHYPED_Featured_Event_Widget', $name = __('Featured Event', 'unhyped'), $options = array( 'description' => __('Displays featured events thumbnail', 'unhyped') ) );
  }

  function form($instance) {
    $instance = wp_parse_args( (array) $instance, array( 'event_id' => '' ) );
    $event_id = strip_tags($instance['event_id']);
    ?>
    <p><label for="<?php echo $this->get_field_id('event_id'); ?>"><?php _e('Event ID:', 'unhyped'); ?>
      <input class="widefat" id="<?php echo $this->get_field_id('event_id'); ?>" name="<?php echo $this->get_field_name('event_id'); ?>" type="text" value="<?php echo esc_attr($event_id); ?>" /></label></p>
    <?php
  }

  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['event_id'] = strip_tags($new_instance['event_id']);
    return $instance;
  }

  function widget($args, $instance) {
    // outputs the content of the widget
    extract( $args );

    if (empty($instance['event_id']))
      return;

    $event_id = apply_filters('widget_post_id', $instance['event_id']);

    echo $before_widget;

    if ( ! empty( $title ) )
      echo $before_title . $title . $after_title;
    ?>
    
    <div class="content event">
      <?php
      $event = get_post($event_id);
      $venue = eo_get_venue_name(intval(eo_get_venue($event_id)));

      // String representations of date
      if ( $event->StartDate == date('Y-m-d') ):
        $datestr = __('Today', 'unhyped');
      elseif ( $event->StartDate == date('Y-m-d', time()+86400) ):
        $datestr = __('Tomorrow', 'unhyped');
      else:
        $date = new DateTime($event->StartDate);
        $datestr = $date->format('M j');
      endif;

      echo '<a href="'.post_permalink($event_id).'">';
      echo '<h2 class="entry-title">'.$event->post_title.'</h2>';
      echo get_the_post_thumbnail($event_id, 'medium');
      echo '<p class="entry-meta"><span class="date">'.$datestr.'</span>';
      if (!empty($venue)) echo ' at <span class="location">'.$venue.'</span>';
      echo '</p>';
      echo '<p class="entry-excerpt">'.$event->post_excerpt.'</p>';
      echo '</a>';
      ?>
    </div>

    <?php
    echo $after_widget;
  }
}
?>