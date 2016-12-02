<article class="post <?php if(has_post_thumbnail()) { ?> has-thumbnail <?php } ?>">
  <div class="image_thumbnail">
    <a href="<?php the_permalink(); ?>">
      <?php the_post_thumbnail('small-thumbnail'); ?>
    </a>
  </div>
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

  <?php if (is_search() OR is_archive()) { ?>
    <p>
      <?php echo get_the_excerpt(); ?>
      <a href="<?php the_permalink(); ?>" class="read-more">Read more</a>
    </p>
  <?php } else {
    if ($post->post_excerpt) { ?>
      <p>
        <?php echo get_the_excerpt(); ?>
        <a href="<?php the_permalink(); ?>" class="read-more">Read more</a>
      </p>
    <?php } else {
      the_content();
    }
  } ?>
</article>
