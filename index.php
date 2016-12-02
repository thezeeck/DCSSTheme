<?php get_header(); ?>
<div id="main-content" class="main-content">
  <main>
    <?php
      if ( have_posts() ) :
        while ( have_posts() ) : the_post();
          get_template_part('content', get_post_format());
        endwhile;

      else: echo "<p>No content</p>";

      endif; ?>
  </main>
  <?php get_sidebar(); ?>
<?php get_footer() ?>
