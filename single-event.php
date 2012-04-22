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
        <?php
        // The date strings
        if ( eo_get_the_start('Y-m-d') == date('Y-m-d') ):
          $datestr = __('Today', 'unhyped');
        elseif ( eo_get_the_start('Y-m-d') == date('Y-m-d', time()+86400) ):
          $datestr = __('Tomorrow', 'unhyped');
        else:
          $datestr = eo_get_the_start('Y-m-d');
        endif;

        // The venue strings
        $venue = eo_get_venue_name();
        $address = eo_get_venue_address();

        if (!empty($address['address']) && !empty($address['postcode'])) echo '<img class="gmap" src="http://maps.googleapis.com/maps/api/staticmap?maptype=roadmap&zoom=14&size=300x300&markers=color:0xFF0033|'.urlencode($address['address'].' '.$address['postcode']).'&sensor=false">';

        // Event and venue meta
        echo '<p class="entry-meta"><span class="date">'.$datestr.'</span>';
        if (!empty($venue)) echo ' at <span class="location">'.$venue.'</span>';
        if (!empty($address['address']) && !empty($address['postcode'])) echo '<br><a class="address" href="http://maps.google.com/maps?q='.urlencode($address['address'].' '.$address['postcode']).'">'.$address['address'].'</a>';
        echo '</p>';

        // Google calendar link
        echo '<p><a class="gcal" href="'.eo_get_the_GoogleLink().'">Add to Google Calendar</a></p>';
        ?>
      </div>
      <?php get_sidebar(); ?>
    </aside><!-- #complementary -->

<?php get_footer(); ?>