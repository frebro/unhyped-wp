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

        <?php if ( !is_home() && has_post_thumbnail() ) : // check if the post has a Post Thumbnail assigned to it. ?>
        <figure class="post-thumbnail">
          <?php
            if ( is_singular() ) : // large thumbnails for singular posts
              the_post_thumbnail('large');

              // print thumbnail title and/or description, if available
              $thumbnail = get_post( get_post_thumbnail_id( $post->ID ) );
              if ( $thumbnail->post_excerpt || $thumbnail->post_content ) :
          ?>
          <figcaption class="post-thumbnail-caption">
          <?php
            if ( $thumbnail->post_excerpt )
              echo '<span class="post-thumbnail-title">'.$thumbnail->post_excerpt.'</span>';

            if ( $thumbnail->post_excerpt && $thumbnail->post_content )
              echo '<span class="sep">&rsaquo;</span>';

            if ( $thumbnail->post_content )
              echo '<span class="post-thumbnail-description">'.$thumbnail->post_content.'</span>';
          ?>
          </figcaption>
          <?php endif; // $thumbnail->post_excerpt || $thumbnail->post_content ?>

          <?php
            else : // medium thumbnails for non-singular posts
              the_post_thumbnail('medium');
            endif; // is_singular()
          ?>
        </figure>
        <?php endif; // is_home() && has_post_thumbnail() ?>

        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>

      <?php if ( !is_singular() ) : // close title and thumbnail link ?>
      </a>
      <?php endif; ?>

      <?php if ( 'post' == get_post_type() ) : // print publish info ?>
      <p class="pub-info">
        <?php synack_posted_on(); ?>
      </p>
      <?php endif; // 'post' == get_post_type() ?>

    </header><!-- .entry-header -->

    <div class="entry-content">
      <?php
        if ( is_singular() ) :
          the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'synack' ) );
        else :
          the_excerpt();
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
