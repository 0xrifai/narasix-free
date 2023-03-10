<?php
/**
 * Standard header template
 */

$show_login = narasix_get_option( 'header_show_login', 'yes' );
$header_class = '';
$content_layout_width = narasix_get_option( 'content_layout_width', 'default' );
$social_sortable = narasix_get_option( 'social_media_sites' );
$darkmode_mode_switch = narasix_get_option( 'darkmode_mode_switch', 'no' );

if ($content_layout_width === 'default' ) {
	$header_class = 'max-w-7xl';
} else {
	$header_class = 'max-w-' . $content_layout_width;
}

?>

<div class="border-b">
  <?php
			the_custom_header_markup();
	?>
  <div class="max-w-7xl mx-auto px-4 py-4 hidden lg:px-16 lg:block">
    <div class="flex items-center justify-between relative z-10">
      <div class="site-header-logo flex">
        <?php get_template_part( 'template-parts/header/component/header-branding' ); ?>
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
            </div><!-- .navigation-top -->
          <?php
          }
        ?>
      </div>
      <div>
        <div class="flex items-center space-x-4">
          <button class="modal-open" type="button" data-modal="#nsix-search-modal" aria-label="">
            <?php echo narasix_svg_icon( array( 'icon' => 'search' ) ) ;?>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<?php get_template_part( 'template-parts/header/header-mobile' ); ?>