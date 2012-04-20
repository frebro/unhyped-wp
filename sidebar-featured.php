<?php
/**
 * The Featured Posts widget areas.
 *
 * @package WordPress
 * @subpackage UNHYPED
 */
?>

<div id="sidebar-featured" class="sidebar" role="banner">
  <h2 class="section-title">Staff Picks</h2>
  <div class="widget-area">
  <?php
    // If the sidebar has no widgets, then print default content.
    if ( ! is_active_sidebar( 'featured'  ) )
      return;

    dynamic_sidebar( 'featured' );
  ?>
  </div>
</div><!-- #sidebar-featured -->