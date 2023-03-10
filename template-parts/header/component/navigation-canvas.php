<?php
/**
 * Menu Canvas Mobile
 */
?>
<div id="nsix-offcanvas-primary" class="js-nsix-offcanvas nsix-offcanvas">
	<header class="flex h-16 items-center justify-between border-b mb-2 py-4 px-4">
		<div class="offcanvas-logo text-center">
			<?php
				narasix_get_template_part( 'template-parts/header/component/header-branding', NULL,
					array(
						'logo_variant' => 'offcanvas',
					)
				);
			?>
		</div>

		<a href="" class="offcanvas-close pb-[5px] pt-[2px] px-[10px] bg-yellow-500 rounded-md js-nsix-offcanvas-close" role="button" aria-label="<?php echo esc_attr( 'Close', 'narasix-free' ); ?>">
			<?php echo narasix_svg_icon( array( 'icon' => 'x-circle', 'class' => 'icons-md' ) ) ;?>
		</a>
	</header>

	<?php
	if ( has_nav_menu( 'mobile' ) || ( ( !has_nav_menu( 'mobile' ) && ( has_nav_menu( 'site-header' ) ) ) ) ) {
	?>
	<div class="offcanvas-navigation px-6 dark:text-charcoal-900">
		<?php
		if ( has_nav_menu( 'offcanvas' ) ) {
			$menu_location = 'offcanvas';
		} else {
			$menu_location = 'site-header';
		}
		wp_nav_menu( array(
			'theme_location' => $menu_location,
			'menu_id'        => 'offcanvas-menu',
			'menu_class'	 => 'offcanvas-menu nsix-navigation navigation',
			'container'		 => false,
			'item_spacing'	 => 'discard',
		) );
		?>
	</div>
	<?php
	}
	?>

	<?php
	if ( is_active_sidebar( 'nsix-offcanvas' ) ) {
	?>
		<div class="offcanvas-widget-area offcanvas-section">
			<?php dynamic_sidebar( 'nsix-offcanvas' ); ?>
		</div>
	<?php
	}
	?>
</div>