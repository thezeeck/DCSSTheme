      <footer>
        <?php if (is_active_sidebar('footerleft') OR is_active_sidebar('footerright')) { ?>
          <section class="footer-widgets">
            <div class="column-footer">
              <?php dynamic_sidebar('footerleft'); ?>
            </div>
            <div class="column-footer">
              <?php dynamic_sidebar('footerright'); ?>
            </div>
          </section>
        <?php } ?>
        <nav class="main-nav">
          <?php
            $args = array('theme_location' => 'footer');
          ?>
          <?php
            wp_nav_menu($args);
          ?>
        </nav>
        <p>
          <?php bloginfo("name"); ?>
          - &copy; <?php echo date("Y"); ?>
        </p>
      </footer>
    </div>
    <?php wp_footer(); ?>
  </body>
</html>
