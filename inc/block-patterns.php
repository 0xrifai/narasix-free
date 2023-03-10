<?php
/**
 * Block Patterns
 */

/**
 * Register Block Pattern Category.
 */
if ( function_exists( 'register_block_pattern_category' ) ) {

	register_block_pattern_category(
		'narasix-free',
		array( 'label' => esc_html__( 'narasix-free', 'narasix-free' ) )
	);
}

/**
 * Register Block Patterns.
 */
if ( function_exists( 'register_block_pattern' ) ) {

	// Large Text.
	register_block_pattern(
		'narasix/large-text',
		array(
			'title'         => esc_html__( 'Large text', 'narasix-free' ),
			'categories'    => array( 'narasix-free' ),
			'viewportWidth' => 1440,
			'content'       => '<!-- wp:heading {"align":"none","fontSize":"gigantic","style":{"typography":{"lineHeight":"1.1"}}} --><h2 class="has-gigantic-font-size" style="line-height:1.1">' . esc_html__( 'A new blog theme for WordPress', 'narasix-free' ) . '</h2><!-- /wp:heading -->',
		)
	);
}