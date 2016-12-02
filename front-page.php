<?php
/*
Template Name: front-page
*/

get_header();
?>
<div id="main-content" class="main-content">
  <main>
    <?php
      if ( have_posts() ) :
        while ( have_posts() ) : the_post();
          the_content();
        endwhile;

      else: echo "<p>No content</p>";

      endif; ?>
  </main>
<?php get_footer() ?>
