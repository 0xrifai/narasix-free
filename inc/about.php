<?php
/**
 * Narasix Theme page
 *
 * @package Narasix
 */

function narasix_about_admin_style( $hook ) {
	if ( 'appearance_page_narasix-about' === $hook ) {
		wp_enqueue_style( 'narasix-about-admin', get_theme_file_uri( 'assets/css/about-admin.css' ), null, '1.0' );
	}
}
add_action( 'admin_enqueue_scripts', 'narasix_about_admin_style' );

/**
 * Add theme page
 */
function narasix_menu() {
	add_theme_page( esc_html__( 'About Narasix', 'narasix-free' ), esc_html__( 'About Narasix', 'narasix-free' ), 'edit_theme_options', 'narasix-about', 'narasix_about_display' );
}
add_action( 'admin_menu', 'narasix_menu' );

/**
 * Display About page
 */
function narasix_about_display() {
	$theme = wp_get_theme();
	?>
	<div class="wrap about-wrap full-width-layout">
		<h1><?php echo esc_html( $theme ); ?> Premium</h1>
		<div class="about-theme">
			<div class="theme-description">
				<p class="about-text">
					<?php
					echo esc_html_e( 'Narasix is a Premium WordPress theme that has built-in support for popular Page Builders, slider with swipe gestures, and is SEO. The unique system of inheritance and override options allows setting up individual parameters for different sections of your site and supported plugins.', 'narasix-free' )
				?>
        </p>
				<p class="actions">
					<a href="<?php echo esc_url( $theme->get( 'ThemeURI' ) ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Theme Demo', 'narasix-free' ); ?></a>

					<a href="<?php echo esc_url( $theme->get( 'AuthorURI' ) . '/themes' ); ?>" class="button button-primary" target="_blank"><?php esc_html_e( 'More Themes', 'narasix-free' ); ?></a>
				</p>
			</div>

			<div class="theme-screenshot">
				<img src="<?php echo esc_url( $theme->get_screenshot() ); ?>" />
			</div>

		</div>

	</div>
	<?php
}


