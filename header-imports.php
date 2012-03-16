<?php
/**
 * Script imports placed in header.php
 * Create your own header-imports.php to override these imports with your own
 *
 * @package WordPress
 * @subpackage UNHYPED
 */

wp_enqueue_script( 'jquery' );

wp_enqueue_script( 'unhyped_script', get_bloginfo('stylesheet_directory').'/js/script.js', array('modernizr', 'jquery'), false, true );

?>