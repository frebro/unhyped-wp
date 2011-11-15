<?php
/**
 * @package WordPress
 * @subpackage UNHYPED
 */

// Overide default loop with custom posts of type 'event'
$loop = new WP_Query( array( 'post_type' => 'event', 'posts_per_page' => 10 ) );

get_header(); ?>

<div id="main" role="main">
  <?php if ($loop->have_posts()) : ?>
    <?php while ($loop->have_posts()) : $loop->the_post(); ?>

      <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
        <header>
          <h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'unhyped') ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
          <time datetime="<?php the_time('Y-m-d')?>"><?php the_time('F jS, Y') ?></time>
          <span class="author"><?php _e('by', 'unhyped') ?> <?php the_author() ?></span>
        </header>
        <?php the_content(__('Read the rest of this entry &raquo;', 'unhyped')); ?>
        <footer>
          <?php the_tags(__('Tags: ', 'unhyped'), ', ', '<br />'); ?>
          Posted in <?php the_category(', ') ?>
          | <?php edit_post_link(__('Edit', 'unhyped'), '', ' | '); ?>
          <?php comments_popup_link(__('No comments &#187;', 'unhyped'), __('One comment &#187;', 'unhyped'), __('% comments &#187;', 'unhyped')); ?>
        </footer>
      </article>

    <?php endwhile; ?>

    <nav>
      <div><?php next_posts_link(__('&laquo; Older Entries', 'unhyped')) ?></div>
      <div><?php previous_posts_link(__('Newer Entries &raquo;', 'unhyped')) ?></div>
    </nav>

  <?php else : ?>

    <h2><?php _e('Not Found', 'unhyped') ?></h2>
    <p><?php _e('Sorry, but you are looking for something that isn&#x27;t here.', 'unhyped') ?></p>
    <?php get_search_form(); ?>

  <?php endif; ?>
</div>

<?php get_footer(); ?>


