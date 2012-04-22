<?php
/**
 * unHYPED functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage UNHYPED
 */


global $post;


/**
 * Imports
 */
if(@file_exists(dirname(__FILE__) . '/inc/unhyped_featured_event_widget.php')) {
  include_once dirname(__FILE__) . '/inc/unhyped_featured_event_widget.php';
}
if(@file_exists(dirname(__FILE__) . '/inc/unhyped_staff_listing_widget.php')) {
  include_once dirname(__FILE__) . '/inc/unhyped_staff_listing_widget.php';
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function unhyped_setup() {

  // Add translation support
  $locale = get_locale();
  if ( !empty( $locale ) ) {
    $mofile = dirname(__FILE__) . "/lang/" .  $locale . ".mo";
    if(@file_exists($mofile) && is_readable($mofile))
      load_textdomain('unhy', $mofile);
  }

  // This theme uses wp_nav_menu() in one location.
  register_nav_menu( 'primary', __( 'Primary Menu', 'unhyped' ) );
}
add_action( 'after_setup_theme', 'unhyped_setup' );

/**
 * Make the front page loop through events instead of posts
 */
function unhyped_pre_get_posts($query){
  global $wp_the_query;
  if(is_front_page()&&$wp_the_query===$query) {
    $query->set('post_type','event');
    $query->set('ignore_sticky_posts','1'); // sticky posts are handled separately
  }
  return $query;
}
add_filter('pre_get_posts', 'unhyped_pre_get_posts');

/**
 * Register our sidebars and widgetized areas.
 */
function unhyped_widgets_init() {
  register_sidebar( array(
    'name' => __( 'Featured Posts Area', 'unhyped' ),
    'id' => 'featured',
    'description' => __( 'The featured sidebar is displayed before the content on the home page', 'unhyped' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h2 class="widget-title">',
    'after_title' => '</h2>',
  ) );
}
add_action( 'widgets_init', 'unhyped_widgets_init' );

/**
 * A prettier excerpt template tag
 * It cuts off at the end of the sentence preceding the cut-off character.
 */
function the_pretty_excerpt($length=128, $allowed_tags='') { // Max excerpt length is set in characters
  global $post;

  $text = $post->post_excerpt;

  if ('' == $text) {
    $text = get_the_content('');
    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]>', $text);
  }
  $text = strip_shortcodes($text); // optional, recommended
  $text = strip_tags($text, $allowed_tags); // use ' $text = strip_tags($text,'<p><a>'); ' if you want to keep some tags

  $text = substr($text, 0, $length);
  $excerpt = reverse_strrchr($text, '.', 1);
  if($excerpt) {
    echo apply_filters('the_excerpt', $excerpt);
  } else {
    echo apply_filters('the_excerpt', $text);
  }
}

// Returns the portion of haystack which goes until the last occurrence of needle
function reverse_strrchr($haystack, $needle, $trail) {
  return strrpos($haystack, $needle) ? substr($haystack, 0, strrpos($haystack, $needle) + $trail) : false;
}

