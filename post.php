<article class="post">
  <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
  <h3><?php

    $categories = get_the_category();

    if ( ! empty( $categories ) ) {
      echo esc_html( $categories[0]->name );
    }

  ?></h3>
  <?php the_content();


  //Recent post related
  $newPost = new WP_Query(array_values(get_the_category())[0]));
  if ($newPost->have_posts()) {
    while ($newPost->have_posts()) : $newPost->the_post(); ?>
    <h2><?php the_title(); ?></h2>
    <? php endwhile
  else : ?>
    <span>No content</span>
  <?php
  endif;

  wp_reset_postdata();
  ?>
</article>
