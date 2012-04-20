<?php
/**
 * The home template file.
 *
 * @package WordPress
 * @subpackage UNHYPED
 */

get_header(); ?>

    <section id="featured" role="banner">
      <h1 class="section-title">Staff Picks</h1>
      <?php
      /* Output a sidebar
       */
      get_sidebar( 'featured' );
      ?>
    </section><!-- #featured -->

    <section id="main" role="main">

      <?php
      /* Run the loop to output the posts.
       */
      get_template_part( 'loop', 'home' );
      ?>

    </section><!-- #main -->

<?php get_footer(); ?>