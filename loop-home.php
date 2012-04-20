<?php
/**
 * The loop that displays posts on the home page.
 *
 * @package WordPress
 * @subpackage UNHYPED
 */
?>

  <?php have_posts(); // empty call to have_posts required to make it return true in the next call (bug?) ?>

  <?php if ( have_posts() ) : ?>

    <h2 class="page-title upcoming">Upcoming</h2>

    <?php /* Start the Loop */ ?>
    <?php while ( have_posts() ) : the_post(); ?>

      <?php get_template_part( 'content', 'event' ); ?>

    <?php endwhile; ?>

  <?php else : ?>

    <article id="post-0" class="post no-results not-found">
      <header class="entry-header">
        <h1 class="entry-title"><?php _e( 'Uh oh!', 'synack' ); ?></h1>
      </header><!-- .entry-header -->

      <div class="entry-content">
        <p><?php _e( 'We could not find what you were looking for. Try performing a search.', 'synack' ); ?></p>
        <?php get_search_form(); ?>
      </div><!-- .entry-content -->
    </article><!-- #post-0 -->

  <?php endif; ?>
