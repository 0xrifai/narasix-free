<?php
/**
 * Footer Layout C
 */
$footer_social_switch = narasix_get_option( 'footer_social_media_switch', 'yes' );
$footer_copyright = narasix_get_option( 'footer_copyright', '' );
$menu_class = 'flex flex-wrap space-x-4 text-center';
?>

<div class="mt-6 py-6 flex flex-col items-center justify-between space-y-3 md:flex-row">
  <?php get_template_part( 'template-parts/footer/component/footer-branding' ); ?>
  <nav aria-label="<?php esc_attr_e( 'Footer Menu', 'narasix-free' ); ?>">
      <?php
      wp_nav_menu( array(
      'theme_location' => 'footer',
      'menu_class'     => $menu_class,
      'container' 	 => false,
      ) );
      ?>
  </nav>
  <!-- #footer-navigation -->
</div>
<div class="flex justify-between items-center border-t py-5 justify-items-center mt-3 text-center max-sm:flex-col">
  <div class="site-info">
    <?php
      $narasix_theme = wp_get_theme();
    ?>

    &copy; <?php echo esc_html( date("o") ); ?> <a href="<?php echo esc_url( home_url() ); ?>"><?php echo esc_html( get_bloginfo('name') ); ?></a> - <a target="_blank" href="<?php echo esc_url( $narasix_theme->get( 'AuthorURI' ) ); ?>"><?php esc_html_e('WordPress Theme', 'narasix-free'); ?></a> <?php esc_html_e('by', 'narasix-free'); ?> <a target="_blank" href="<?php echo esc_url( $narasix_theme->get( 'AuthorURI' ) ); ?>"><?php esc_html_e('Hidunks', 'narasix-free'); ?></a>
  </div><!-- .site-info -->
</div>
