<?php
/**
 * The Footer widget areas.
 *
 * @package WordPress
 * @subpackage UNHYPED
 */
?>

<div id="sidebar-footer" class="sidebar" role="banner">
  <div class="widget-area">
  <?php
    // If the sidebar has no widgets, then print default content.
    if ( ! is_active_sidebar( 'footer'  ) )
      return;

    dynamic_sidebar( 'footer' );
  ?>
  </div>
</div><!-- #sidebar-featured -->