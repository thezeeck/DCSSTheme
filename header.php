<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php wp_title(); ?></title>
    <meta name="viewport" content="width=device-width, minimum-scale=1">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <div class="container">
      <header>
        <?php if (get_theme_mod('custom_hero_display') == 'Yes'): ?>
          <figure class="hero-image">
            <img src="<?php echo get_theme_mod('custom_hero_img') ?>" alt="<?php echo get_theme_mod('custom_hero_text') ?>" />
          </figure>
        <?php endif; ?>
        <div class="header-nav">
          <div class="brand-name">
            <h1>
              <?php if ( function_exists( 'the_custom_logo' ) ) {
                 the_custom_logo();
                } else { ?>
                  <a href="<?php echo home_url(); ?>">
                    <?php bloginfo( "name" ); ?>
                  </a>
              <?php } ?>
            </h1>
          </div>
          <div class="header-search">
            <?php get_search_form(); ?>
          </div>
          <nav class="main-nav">
            <?php
              wp_nav_menu(
                array('theme_location' => 'header')
              );
            ?>
          </nav>
          <section class="description-area">
            <?php bloginfo( "description" ); ?>
          </section>
        </div>
      </header>
