<?php
/**
 * Standard header template
 */

?>
<div class="backdrop-blur-[8px] shadow-lg site-header-fixed max-lg:!hidden lg:block js-sticky-header" style="display: none;">
  <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between lg:px-16">
    <div class="site-header-logo flex">
      <?php get_template_part( 'template-parts/header/component/header-branding', NULL, array( 'logo_variant' => 'sticky' ) ); ?>
      <?php
        if ( has_nav_menu( 'site-header' ) ) {
        ?>
          <div class="site-header-navigation flex items-center ml-5">
            <nav class="relative flex items-center content-between justify-between">
              <div class="navbar-nav-wrapper hidden lg:flex">
                <?php
                wp_nav_menu( array(
                  'theme_location' => 'site-header',
                  'menu_id'        => 'top-menu-sticky',
                  'menu_class'	 => 'nsix-navigation nsix-navigation-top navigation flex space-x-5 whitespace-nowrap',
                  'container'		 => false,
                  'item_spacing'	 => 'discard',
                ) );
                ?>
              </div>
            </nav>
          </div>
        <?php
        }
      ?>
    </div>
    <div>
      <div class="flex items-center space-x-4">
        <button onclick="toggleDarkMode()" class="active:scale-95 mt-[3px]" aria-label="<?php echo esc_attr( 'Darkmode Toggle Button', 'narasix-free' ) ?>">
          <?php echo narasix_svg_icon( array( 'icon' => 'darkmode' ) ) ;?>
        </button>
        <button class="modal-open" type="button" data-modal="#nsix-search-modal" aria-label="<?php echo esc_attr( 'Search', 'narasix-free' ) ?>">
          <?php echo narasix_svg_icon( array( 'icon' => 'search' ) ) ;?>
        </button>
      </div>
    </div>
  </div>
</div>


