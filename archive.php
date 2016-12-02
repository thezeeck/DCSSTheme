<?php get_header(); ?>
<div id="main-content" class="main-content">
  <main>
    <?php
      if ( have_posts() ) : ?>
      <h2><?php
        if (is_category()) {
          single_cat_title();
        } elseif (is_tag()) {
          single_tag_title();
        } elseif (is_author()) {
          the_post();
          echo "Author archives: " . get_the_author();
          rewind_posts();
        } elseif (is_day()) {
          echo "Daily archives: " . get_the_date();
        } elseif (is_month()) {
          echo "Monthly archives: " . get_the_date('F Y');
        } elseif (is_year()) {
          echo "Yearly archives: " . get_the_date('Y');
        } else {
          echo "Archives: ";
        }
      ?></h2>
      <?php
        while ( have_posts() ) : the_post();
          get_template_part('content', get_post_format());
        endwhile; else: ?>
      <p><?php _e('<p>No hay contenido</p>'); ?></p>
    <?php endif; ?>
  </main>
<?php get_footer() ?>
