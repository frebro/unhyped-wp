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
 * Tell WordPress to run unhypedsetup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'unhypedsetup' );

if ( ! function_exists( 'unhypedsetup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function unhypedsetup() {

  // Add translation support
  $locale = get_locale();
  if( !empty( $locale ) ) {
    $mofile = dirname(__FILE__) . "/lang/" .  $locale . ".mo";
    if(@file_exists($mofile) && is_readable($mofile))
      load_textdomain('unhy', $mofile);
  }

  // Add default posts and comments RSS feed links to <head>.
  add_theme_support( 'automatic-feed-links' );

  // This theme uses wp_nav_menu() in one location.
  register_nav_menu( 'primary', __( 'Primary Menu', 'unhyped' ) );

  // This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
  add_theme_support( 'post-thumbnails' );
}
endif; // unhypedsetup


/**
 * Set some custom styles for admin
 */
function unhypedadmin_head_styles() {
?>
<style>
  // Hide admin menu items
  #menu-links, #menu-posts {
    display:none;
  }
</style>
<?php
}
add_action('admin_head', 'unhypedadmin_head_styles');


