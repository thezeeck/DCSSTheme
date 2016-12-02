<?php
  // Load resources
  function loadResources() {
    wp_enqueue_style('style', get_stylesheet_uri());
  }

  add_action('wp_enqueue_scripts', 'loadResources');

  // Registro del menú de WordPress
  add_theme_support( 'nav-menus' );

  // Obtiene el ancestro de la pagina
  function get_top_ancestor_id() {

    global $post;

    if ($post->post_parent) {
      $ancestors = array_reverse(get_post_ancestors($post->ID));
      return $ancestors[0];
    }

    return $post->ID;
  }

  // Tiene hijos esta pagina?

  function has_children() {
    global $post;

    $pages = get_pages('child_of=' . $post->ID);
    return count($pages);
  }

  // Modificando el corte de leer mas
  function custom_excerpt_length() {
    return 30;
  }
  add_filter('excerpt_length', 'custom_excerpt_length');

  // Ajustes de inicio
  function decss_setup() {

    // Registra los menus de footer y header
    if ( function_exists( 'register_nav_menus' ) ) {
      register_nav_menus(array(
        'header' => __('Header Menu'),
        'footer' => __('Footer Menu'),
      ));
  	}

    //sopore para imagenes representativas
    add_theme_support('post-thumbnails');
    add_image_size('small-thumbnail', 200, 200, true);
    add_image_size('banner-image', 900, 400, array('left', 'top'));

    // soporte para formatos de los post
    add_theme_support('post-formats', array('aside', 'gallery', 'link'));
  }
  add_action('after_setup_theme', 'decss_setup');

  //Generamos las areas para los widgets
  function widgetsArea() {
    register_sidebar(array(
      'name' => 'Sidebar',
      'id' => 'sidebarprimary'
    ));

    register_sidebar(array(
      'name' => 'Footer left',
      'id' => 'footerleft'
    ));

    register_sidebar(array(
      'name' => 'Footer right',
      'id' => 'footerright'
    ));
  }

  add_action('widgets_init', 'widgetsArea');

  // opciones de apariencia
  function custom_appaearance_options($wp_customize) {
    $wp_customize->add_setting('background_color', array(
      'default' => '#ffffff',
      'transport' => 'refresh',
    ));
    $wp_customize->add_setting('text_color', array(
      'default' => '#666666',
      'transport' => 'refresh',
    ));
    $wp_customize->add_setting('link_color', array(
      'default' => '#666666',
      'transport' => 'refresh',
    ));
    $wp_customize->add_setting('link_color_hover', array(
      'default' => '#000000',
      'transport' => 'refresh',
    ));
    $wp_customize->add_setting('btn_color', array(
      'default' => '#666666',
      'transport' => 'refresh',
    ));
    $wp_customize->add_setting('btn_text_color', array(
      'default' => '#ffffff',
      'transport' => 'refresh',
    ));
    $wp_customize->add_setting('title_color', array(
      'default' => '#000000',
      'transport' => 'refresh',
    ));
    $wp_customize->add_section('standar_colors', array(
      'title' => __('Colors', 'DeCSS'),
      'priority' => 30,
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'background_color_control', array(
      'label' => __('Background Color', 'DeCSS'),
      'section' => 'standar_colors',
      'settings' => 'background_color'
    )));
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'text_color_control', array(
      'label' => __('Text Color', 'DeCSS'),
      'section' => 'standar_colors',
      'settings' => 'text_color'
    )));
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_color_control', array(
      'label' => __('Link Color', 'DeCSS'),
      'section' => 'standar_colors',
      'settings' => 'link_color'
    )));
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_color_hover_control', array(
      'label' => __('Link Hover Color', 'DeCSS'),
      'section' => 'standar_colors',
      'settings' => 'link_color_hover'
    )));
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'btn_color_control', array(
      'label' => __('Button Color', 'DeCSS'),
      'section' => 'standar_colors',
      'settings' => 'btn_color'
    )));
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'btn_text_color_control', array(
      'label' => __('Button Text Color', 'DeCSS'),
      'section' => 'standar_colors',
      'settings' => 'btn_text_color'
    )));
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'title_color_control', array(
      'label' => __('Title Color', 'DeCSS'),
      'section' => 'standar_colors',
      'settings' => 'title_color'
    )));
  }
  add_action( 'customize_register', 'custom_appaearance_options' );

  // imagen apaisada
  function hero_img_custom($wp_customize) {
    $wp_customize->add_section('hero_text_settings', array(
      'title' => 'Hero image'
    ));
    $wp_customize->add_setting('custom_hero_display', array(
      'default' => 'No',
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'custom_hero_display_control', array(
      'label' => 'Display Hero Image',
      'section' => 'hero_text_settings',
      'settings' => 'custom_hero_display',
      'type' => 'select',
      'choices' => array('No' => 'No', 'Yes' => 'Yes')
    )));
    $wp_customize->add_setting('custom_hero_text', array(
      'default' => 'Hero image',
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'custom_hero_text_control', array(
      'label' => 'Alternative text',
      'section' => 'hero_text_settings',
      'settings' => 'custom_hero_text'
    )));
    $wp_customize->add_setting('custom_hero_img');
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'custom_hero_img_control', array(
      'label' => 'Hero image',
      'section' => 'hero_text_settings',
      'settings' => 'custom_hero_img'
    )));
  }
  add_action('customize_register', 'hero_img_custom');

  // imagen de fondo
  function custom_bg_img($wp_customize) {
    $wp_customize->add_section('custom_bg_image_settings', array(
      'title' => 'Background image'
    ));
    $wp_customize->add_setting('custom_bg_img', array(
      'default' => 'none',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'custom_bg_img_control', array(
      'label' => 'Background image',
      'section' => 'custom_bg_image_settings',
      'settings' => 'custom_bg_img'
    )));
    $wp_customize->add_setting('custom_bg_img_repeat', array(
      'default' => 'no-repeat',
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'custom_bg_img_repeat_control', array(
      'label' => 'Background repeat',
      'section' => 'custom_bg_image_settings',
      'settings' => 'custom_bg_img_repeat',
      'type' => 'select',
      'choices' => array(
        'no-repeat' => 'No repeat',
        'repeat' => 'Repeat',
        'repeat-x' => 'Horizontal repeat',
        'repeat-y' => 'Vertical repeat'
      )
    )));
    $wp_customize->add_setting('custom_bg_img_v_position', array(
      'default' => 'center',
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'custom_bg_img_v_position_control', array(
      'label' => 'Vertical position',
      'section' => 'custom_bg_image_settings',
      'settings' => 'custom_bg_img_v_position',
      'type' => 'select',
      'choices' => array(
        'top' => 'Top',
        'center' => 'Center',
        'bottom' => 'Bottom'
      )
    )));
    $wp_customize->add_setting('custom_bg_img_h_position', array(
      'default' => 'center',
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'custom_bg_img_h_position_control', array(
      'label' => 'Vertical position',
      'section' => 'custom_bg_image_settings',
      'settings' => 'custom_bg_img_h_position',
      'type' => 'select',
      'choices' => array(
        'left' => 'Left',
        'center' => 'Center',
        'right' => 'Right'
      )
    )));
    $wp_customize->add_setting('custom_bg_img_att', array(
      'default' => 'scroll',
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'custom_bg_img_att_control', array(
      'label' => 'Background displacement',
      'section' => 'custom_bg_image_settings',
      'settings' => 'custom_bg_img_att',
      'type' => 'select',
      'choices' => array(
        'fixed' => 'Fixed',
        'scroll' => 'Displacement',
      )
    )));
  }
  add_action('customize_register', 'custom_bg_img');

  //  Fuentes de google
  function select_google_fonts($wp_customize) {
    $fonList = array(
      'Abel' => 'Abel',
      'Abhaya+Libre' => 'Abhaya Libre',
      'Abril+Fatface' => 'Abril Fatface',
      'Alfa+Slab+One' => 'Alfa Slab One',
      'Amatic+SC' => 'Amatic SC',
      'Anton' => 'Anton',
      'Architects+Daughter' => 'Architects Daughter',
      'Arvo' => 'Arvo',
      'Cabin' => 'Cabin',
      'Chewy' => 'Chewy',
      'Cinzel' => 'Cinzel',
      'Comfortaa' => 'Comfortaa',
      'Cormorant+Garamond' => 'Cormorant Garamond',
      'Covered+By+Your+Grace' => 'Covered By Your Grace',
      'Crimson+Text' => 'Crimson Text',
      'Cuprum' => 'Cuprum',
      'Dancing+Script' => 'Dancing Script',
      'Delius+Unicase' => 'Delius Unicase',
      'Domine' => 'Domine',
      'Dosis' => 'Dosis',
      'Droid+Serif' => 'Droid Serif',
      'Eczar' => 'Eczar',
      'Exo+2' => 'Exo 2',
      'Fjalla+One' => 'Fjalla One',
      'Francois+One' => 'Francois One',
      'Gloria+Hallelujah' => 'Gloria Hallelujah',
      'Hammersmith+One' => 'Hammersmith One',
      'Inconsolata' => 'Inconsolata',
      'Indie+Flower' => 'Indie Flower',
      'Josefin+Sans' => 'Josefin Sans',
      'Josefin+Slab' => 'Josefin Slab',
      'Lato' => 'Lato',
      'Libre+Baskerville' => 'Libre Baskerville',
      'Lobster' => 'Lobster',
      'Lobster+Two' => 'Lobster Two',
      'Lora' => 'Lora',
      'Maven+Pro' => 'Maven Pro',
      'Merriweather' => 'Merriweather',
      'Monda' => 'Monda',
      'Montserrat' => 'Montserrat',
      'Muli' => 'Muli',
      'News+Cycle' => 'News Cycle',
      'Nunito' => 'Nunito',
      'Old+Standard+TT' => 'Old Standard TT',
      'Open+Sans' => 'Open Sans',
      'Open+Sans+Condensed:300' => 'Open Sans Condensed',
      'Orbitron' => 'Orbitron',
      'Oswald' => 'Oswald',
      'PT+Sans' => 'PT Sans',
      'PT+Sans+Narrow' => 'PT Sans Narrow',
      'PT+Serif' => 'PT Serif',
      'Pacifico' => 'Pacifico',
      'Pathway Gothic One' => 'Pathway+Gothic+One',
      'Patua+One' => 'Patua One',
      'Playfair+Display' => 'Playfair Display',
      'Poiret+One' => 'Poiret One',
      'Prociono' => 'Prociono',
      'Quicksand' => 'Quicksand',
      'Raleway' => 'Raleway',
      'Ranga' => 'Ranga',
      'Righteous' => 'Righteous',
      'Roboto' => 'Roboto',
      'Roboto+Slab' => 'Roboto Slab',
      'Ropa+Sans' => 'Ropa Sans',
      'Russo+One' => 'Russo One',
      'Shadows Into Light' => 'Shadows+Into+Light',
      'Share+Tech+Mono' => 'Share Tech Mono',
      'Shrikhand' => 'Shrikhand',
      'Signika' => 'Signika',
      'Six+Caps' => 'Six Caps',
      'Slabo+27px' => 'Slabo 27px',
      'Source+Sans+Pro' => 'Source Sans Pro',
      'Titillium+Web' => 'Titillium Web',
      'Trirong' => 'Trirong',
      'Ubuntu' => 'Ubuntu',
      'Ubuntu+Condensed' => 'Ubuntu Condensed',
      'Varela+Round' => 'Varela Round',
      'Yanone+Kaffeesatz' => 'Yanone Kaffeesatz',
      'Yellowtail' => 'Yellowtail',
    );
    $wp_customize->add_section('custom_font', array(
      'title' => 'Fonts'
    ));
    $wp_customize->add_setting('custom_font_gral', array(
      'default' => 'Roboto',
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'custom_font_gral_control', array(
      'label' => 'Select a body font',
      'section' => 'custom_font',
      'settings' => 'custom_font_gral',
      'type' => 'select',
      'choices' => $fonList
    )));
    $wp_customize->add_setting('custom_font_title', array(
      'default' => 'Roboto',
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'custom_font_title_control', array(
      'label' => 'Select a title font',
      'section' => 'custom_font',
      'settings' => 'custom_font_title',
      'type' => 'select',
      'choices' => $fonList
    )));
    $wp_customize->add_setting('custom_font_quote', array(
      'default' => 'Roboto',
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'custom_font_quote_control', array(
      'label' => 'Select a quote font',
      'section' => 'custom_font',
      'settings' => 'custom_font_quote',
      'type' => 'select',
      'choices' => $fonList
    )));
  }
  add_action( 'customize_register', 'select_google_fonts' );

  // custom css
  function custom_font_api($wp_customize) { ?>
    <?php if (get_theme_mod('custom_font_gral') == get_theme_mod('custom_font_title')) { ?>
      <link href="https://fonts.googleapis.com/css?family=<?php echo get_theme_mod('custom_font_gral'); ?>" rel="stylesheet">
    <?php } else { ?>
      <link href="https://fonts.googleapis.com/css?family=<?php echo get_theme_mod('custom_font_gral'); ?>" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=<?php echo get_theme_mod('custom_font_title'); ?>" rel="stylesheet">
    <?php } ?>
    <link href="https://fonts.googleapis.com/css?family=<?php echo get_theme_mod('custom_font_quote'); ?>" rel="stylesheet">
    <style>
      body {
        background-attachment: <?php echo get_theme_mod('custom_bg_img_att'); ?>;
        background-color: #<?php echo get_theme_mod('background_color'); ?>;
        background-image: url('<?php echo get_theme_mod('custom_bg_img'); ?>');
        background-position: <?php echo get_theme_mod('custom_bg_img_v_position'); ?> <?php echo get_theme_mod('custom_bg_img_h_position'); ?>;
        background-repeat: <?php echo get_theme_mod('custom_bg_img_repeat'); ?>;
        color: <?php echo get_theme_mod('text_color'); ?>;
        font-family: '<?php echo get_theme_mod('custom_font_gral'); ?>', sans-serif;
      }
      .post-aside {
        font-family: '<?php echo get_theme_mod('custom_font_quote'); ?>', sans-serif;
      }
      a,
      a:link,
      a:visited {
        color: <?php echo get_theme_mod('link_color'); ?>;
      }
      a:hover {
        color: <?php echo get_theme_mod('link_color_hover'); ?>;
      }
      button,
      input[type="submit"] {
        background-color: <?php echo get_theme_mod('btn_color'); ?>;
        border: 1px solid <?php echo get_theme_mod('btn_text_color'); ?>;
        color: <?php echo get_theme_mod('btn_text_color'); ?>;
      }
      button:hover,
      input[type="submit"]:hover {
        background-color: <?php echo get_theme_mod('btn_text_color'); ?>;
        color: <?php echo get_theme_mod('btn_color'); ?>;
      }
      h1,
      h2,
      h3,
      h4,
      h5,
      h6 {
        color: <?php echo get_theme_mod('title_color'); ?>;
        font-family: '<?php echo get_theme_mod('custom_font_title'); ?>', sans-serif;
      }
    </style>
  <?php }
  add_action('wp_head', 'custom_font_api');

  function theme_prefix_setup() {
  	add_theme_support( 'custom-logo', array(
  		'flex-width' => true,
  	));
  }
  add_action( 'after_setup_theme', 'theme_prefix_setup' );

 ?>
