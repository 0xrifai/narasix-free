<?php
/**
 * Block Styles
 */

if ( function_exists( 'register_block_style' ) ) {
	/**
	 * Register block styles.
	 */
	function narasix_register_block_styles() {
		// Image: Borders.
		register_block_style(
			'core/image',
			array(
				'name'  => 'narasix-border',
				'label' => esc_html__( 'Borders', 'narasix' ),
			)
		);
	}
	add_action( 'init', 'narasix_register_block_styles' );
}
