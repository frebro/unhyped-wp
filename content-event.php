<?php
/**
 * The default template for displaying event content
 *
 * @package WordPress
 * @subpackage UNHYPED
 */
?>

  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">

      <?php if ( ! is_singular() ) : // do not make the title and thumbnail a link if post is singular ?>
      <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'synack' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
      <?php endif; ?>

      <?php if ( !is_home() ) : // print title above thumbnail when not on the home page ?>
      <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
      <?php endif; // !is_home() ?>

      <?php if ( has_post_thumbnail() ) : // check if the post has a Post Thumbnail assigned to it. ?>
      <figure class="post-thumbnail">
        <?php
          if ( is_home() ):
            the_post_thumbnail('thumbnail');
          else:
            the_post_thumbnail('large');
          endif;
        ?>
      </figure>
      <?php endif; // has_post_thumbnail() ?>

      <?php if ( is_home() ) : // print title below thumbnail on home page ?>
      <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
      <?php endif; // is_home() ?>

      <?php if ( !is_singular() ) : // close title and thumbnail link ?>
      </a>
      <?php endif; //!is_singular() ?>

      <?php
        // Print the meta info on the home page
        if (is_home()):

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

          echo '<p class="entry-meta"><span class="date">'.$datestr.'</span>';
          if (!empty($venue)) echo ' at <span class="location">'.$venue.'</span>';
          if (!empty($address['address']) && !empty($address['postcode'])) echo ' <a class="address" href="http://maps.google.com/maps?q='.urlencode($address['address'].' '.$address['postcode']).'">'.$address['address'].'</a>';

        endif; // is_home()
      ?>

    </header><!-- .entry-header -->

    <div class="entry-content">
      <?php
        if ( is_singular() ) :
          the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'synack' ) );
        else :
          the_pretty_excerpt();
        endif;
      ?>
    </div><!-- .entry-content -->

    <?php if ( 'post' == get_post_type() && is_singular() ) : ?>
    <footer class="entry-footer">
      <?php
        $categories_list = get_the_category_list( '</li><li>' );
        if ( $categories_list ):
      ?>
      <ul class="inline-list cat-links">
        <h2 class="assistive-text"><?php _e('Categories', 'synack'); ?></h2>
        <li><?php echo $categories_list; ?></li>
      </ul>
      <?php endif; // End if categories ?>

      <?php
        $tags_list = get_the_tag_list( '', '</li><li>' );
        if ( $tags_list ):
      ?>
      <ul class="inline-list tag-links">
        <h2 class="assistive-text"><?php _e('Tags', 'synack'); ?></h2>
      <li><?php echo $tags_list; ?></li>
      </ul>
      <?php endif; // End if $tags_list ?>
    </footer><!-- #entry-footer -->
  <?php endif; // End if 'post' == get_post_type() && is_singular() ?>

  </article><!-- #post-<?php the_ID(); ?> -->
