<?php get_header(); ?>
<div id="main-content" class="main-content">
  <main>
    <?php
      if ( have_posts() ) :
        while ( have_posts() ) : the_post(); ?>
          <article class="post">
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div class="info-post">
              <?php the_time('j / F / Y'); ?>
              <span class="author-separator">| by </span>
              <a class="author-post" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                <?php the_author(); ?>
              </a>
              <span class="cathegory-separator"> | Posted in </span>

              <?php
                $categories = get_the_category();
                $separator = ", ";
                $output = '';

                if ($categories) {
                  foreach ($categories as $category) {
                    $output .= '<a href="' . get_category_link($category->term.id) . '">' . $category->cat_name . '</a>' . $separator;
                  }

                  echo trim($output, $separator);
                }
              ?>

            </div>
            <?php the_post_thumbnail('banner-image'); ?>
            <?php the_content(); ?>
          </article>
    <?php endwhile; else: ?>
      <p><?php _e('<p>No hay contenido</p>'); ?></p>
    <?php
      endif;
      $tags = wp_get_post_tags($post->ID);
      if ($tags) {
        $tag_ids = array();
        foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
          $args=array(
            'tag__in' => $tag_ids,
            'post__not_in' => array($post->ID),
            'showposts'=>3,
            'caller_get_posts'=>1
            );

    $my_query = new wp_query($args);
      if( $my_query->have_posts() ) {
        echo '<h3>Related articles</h3><ul>';
        while ($my_query->have_posts()) {
          $my_query->the_post();
          ?>

          <li><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>

          <?php }
            echo '</ul>';
        }

         wp_reset_query();
	    }

      ?>
  </main>
<?php get_footer() ?>
