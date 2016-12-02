<?php get_header(); ?>
<div id="main-content" class="main-content">
  <main>
    <h2>Search results for: <strong id="searchNameQuery"><?php the_search_query(); ?></strong></h2>
    <?php
      if ( have_posts() ) {
        while ( have_posts() ) : the_post();
          get_template_part('content', get_post_format());
        endwhile;
      } else { ?>
      <p><?php _e('<p>Sorry, no content found</p>'); ?></p>
    <?php } ?>
  </main>
<?php get_footer() ?>
