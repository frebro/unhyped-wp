<?php
/**
 * @package WordPress
 * @subpackage UNHYPED
 */

load_theme_textdomain('unhyped', get_stylesheet_directory() . '/lang');

require_once get_template_directory() . '/inc/jw_custom_posts.php';


// Custom event post type
$event = new JW_Post_Type(
  'Event',
  array(
    'supports' => array(
      'title',
      'editor',
      'author',
      'thumbnail',
      'comments',
      'revisions'
    ),
    'labels' => array(
      'name' => __('Events', 'unhyped'),
      'singular_name' => __('Event', 'unhyped'),
      'add_new' => __('Register', 'unhyped'),
      'add_new_item' => __('Register event', 'unhyped'),
    )
  )
);
$event->add_taxonomy(__('Type', 'unhyped'));


// Custom HTML5 Comment Markup
function unhyped_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li>
     <article <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
       <header class="comment-author vcard">
          <?php echo get_avatar($comment,$size='48',$default='<path_to_url>' ); ?>
          <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
          <time><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a></time>
          <?php edit_comment_link(__('(Edit)'),'  ','') ?>
       </header>
       <?php if ($comment->comment_approved == '0') : ?>
          <em><?php _e('Your comment is awaiting moderation.') ?></em>
          <br />
       <?php endif; ?>

       <?php comment_text() ?>

       <nav>
         <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
       </nav>
     </article>
    <!-- </li> is added by wordpress automatically -->
<?php
}


// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
add_theme_support( 'post-thumbnails' );


// Add default posts and comments RSS feed links to <head>.
add_theme_support( 'automatic-feed-links' );


// This theme uses wp_nav_menu() in one location.
register_nav_menu( 'primary', __( 'Primary Menu', 'unhyped' ) );


// Widgetized Sidebar HTML5 Markup
if ( function_exists('register_sidebar') ) {
  register_sidebar(array(
    'before_widget' => '<section>',
    'after_widget' => '</section>',
    'before_title' => '<h2 class="widgettitle">',
    'after_title' => '</h2>',
  ));
}


// Add ?v=[last modified time] to style sheets
function versioned_stylesheet($relative_url, $add_attributes=""){
  echo '<link rel="stylesheet" href="'.versioned_resource($relative_url).'" '.$add_attributes.'>'."\n";
}

// Add ?v=[last modified time] to javascripts
function versioned_javascript($relative_url, $add_attributes=""){
  echo '<script src="'.versioned_resource($relative_url).'" '.$add_attributes.'></script>'."\n";
}

// Add ?v=[last modified time] to a file url
function versioned_resource($relative_url){
  $file = $_SERVER["DOCUMENT_ROOT"].$relative_url;
  $file_version = "";

  if(file_exists($file)) {
    $file_version = "?v=".filemtime($file);
  }

  return $relative_url.$file_version;
}


// Remove the editor menu item in admin
function remove_editor_menu_item() {
  remove_action('admin_menu', '_add_themes_utility_last', 101);
}
add_action('_admin_menu', 'remove_editor_menu_item', 1);