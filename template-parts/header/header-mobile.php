<?php
/**
 * Mobile header
 */

?>
<header id="site-header" class="header-mobile backdrop-blur-[8px] shadow-lg px-4 border-b lg:hidden">
	<div class="flex justify-between items-center py-3">
		<div class="site-header-logo">
			<?php narasix_get_template_part( 'template-parts/header/component/header-branding', NULL, array( 'logo_variant' => 'small' ) ); ?>
		</div>
		<div class="flex items-center space-x-4">
			<button onclick="toggleDarkMode()" class="active:scale-95" aria-label="<?php echo esc_attr( 'Darkmode Toggle Button', 'narasix-free' ) ?>">
				<?php echo narasix_svg_icon( array( 'icon' => 'darkmode' ) ) ;?>
			</button>
			<button class="modal-open" type="button" data-modal="#nsix-search-modal" aria-label="<?php echo esc_attr( 'Search', 'narasix-free' ) ?>">
        <?php echo narasix_svg_icon( array( 'icon' => 'search' ) ) ;?>
      </button>

			<a href="#nsix-offcanvas-primary" class="menu-button py-[3px] px-[7px] bg-yellow-500 rounded-md js-nsix-offcanvas-toggle" role="button" aria-label="<?php echo esc_attr( 'Toggle navigation', 'narasix-free' ) ?>">
				<?php echo narasix_svg_icon( array( 'icon' => 'menu' ) ) ;?>
			</a>
		</div>
	</div>
</header>