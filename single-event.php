<?php
/**
 * The Template for displaying all single events.
 *
 * @package WordPress
 * @subpackage UNHYPED
 */

get_header(); ?>

    <div id="main" role="main">

      <?php
      /* Run the loop to output the post.
       * If you want to overload this in a child theme then include a file
       * called loop-single.php and that will be used instead.
       */
       get_template_part( 'loop', 'event' );
      ?>

      <?php //comments_template( '', true ); ?>

    </div><!-- #main -->

    <aside id="complementary" role="complementary">
      <div class="meta">
        <h2>Hyped by</h2>
        <p>Marek Wolski</p>
        <p><a href="#">Add to Google Calendar</a></p>
      </div>
      <?php get_sidebar(); ?>
    </aside><!-- #complementary -->

<?php get_footer(); ?>