<?php
/**
 * The template for displaying the about page.
 *
 * @package WordPress
 * @subpackage UNHYPED
 */

the_post();

get_header(); ?>

    <div id="main" role="main">

        <?php
        /* Run the loop to output the page.
         */
        get_template_part( 'loop', 'page' );
        ?>

    </div><!-- #main -->

    <aside id="complementary" role="complementary">
      <div id="sidebar-staff" class="sidebar">
        <?php
        if(function_exists('the_widget'))
          the_widget('UNHYPED_Staff_Listing_Widget', 'user_ids_str=2,1,3');
        ?>
      </div>
      <?php get_sidebar(); ?>
    </aside><!-- #complementary -->

<?php get_footer(); ?>