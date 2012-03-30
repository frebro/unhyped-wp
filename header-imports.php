<?php
/**
 * Script imports placed in header.php
 * Create your own header-imports.php to override these imports with your own
 *
 * @package WordPress
 * @subpackage UNHYPED
 */

wp_enqueue_script( 'jquery' );
wp_enqueue_script( 'google_maps', 'http://maps.googleapis.com/maps/api/js?key=AIzaSyCj-k2B1M2m2EASadn0uVXyaPr_AOR8RHE&sensor=true', false, false, true );
wp_enqueue_script( 'unhyped_script', get_bloginfo('stylesheet_directory').'/js/script.js', array('modernizr', 'jquery', 'google_maps'), false, true );

?>