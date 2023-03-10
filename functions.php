<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Narasix
 * @since 1.0.0
 */

/**
 * Theme set up
 */
if ( !function_exists( 'narasix_setup' ) ) {
	function narasix_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'narasix-free', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		add_theme_support( "wp-block-styles" );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// Set content-width.
		global $content_width;
		if ( !isset( $content_width ) ) {
			$content_width = 1200;
		}

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1200, 9999 );

		// Add custom image sizes.

		add_image_size( 'narasix_lg', 1024, 9999, false );
		add_image_size( 'narasix_lg_1_1', 1024, 1024, true );
		add_image_size( 'narasix_lg_16_9', 1024, 576, true );

		add_image_size( 'narasix_md', 900, 9999, false );
		add_image_size( 'narasix_md_1_1', 900, 900, false );
		add_image_size( 'narasix_md_4_3', 900, 675, true );

		add_image_size( 'narasix_sm', 600, 9999, false );
		add_image_size( 'narasix_sm_4_5', 600, 750, true );
		add_image_size( 'narasix_sm_1_1', 600, 600, true );
		add_image_size( 'narasix_sm_4_3', 600, 450, true );

		add_image_size( 'narasix_xs_4_5', 300, 375, true );

		add_image_size( 'narasix_xxs_1_1', 150, 150, true );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets',
			)
		);

		// Add theme support for Custom Logo.
		// Custom logo.
		$logo_width  = 300;
		$logo_height = 70;

		// If the retina setting is active, double the recommended width and height.
		if ( get_theme_mod( 'retina_logo', false ) ) {
			$logo_width  = floor( $logo_width * 2 );
			$logo_height = floor( $logo_height * 2 );
		}

		$args = array(
			'height'      => $logo_height,
			'width'       => $logo_width,
			'flex-height' => true,
			'flex-width'  => true,
		);

		add_theme_support('custom-logo', $args);

		// Add theme support for custom background .
		add_theme_support( 'custom-background', apply_filters( 'narasix_custom_background_args', array(
			'default-color' => '',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );
	}
	add_action( 'after_setup_theme', 'narasix_setup' );
}

/**
 * Register navigation menus uses wp_nav_menu.
 */
if ( !function_exists( 'narasix_menus' ) ) {
	function narasix_menus() {
		$locations = array(
			'site-header'  	=> esc_html__( 'Site Header', 'narasix-free' ),
			'offcanvas'   			=> esc_html__( 'Off Canvas', 'narasix-free' ),
			'footer'   			=> esc_html__( 'Footer', 'narasix-free' ),
		);

		register_nav_menus( $locations );
	}
	add_action( 'init', 'narasix_menus' );
}

/**
 * Include a skip to content link at the top of the page so that users can bypass the menu.
 */
if ( !function_exists( 'narasix_skip_link' ) ) {
	function narasix_skip_link() {
		echo '<a class="skip-link sr-only" href="#site-content">' . esc_html__( 'Skip to the content', 'narasix-free' ) . '</a>';
	}
	add_action( 'wp_body_open', 'narasix_skip_link', 5 );
}

/**
 * Register widget areas.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
if ( !function_exists( 'narasix_sidebar_registration' ) ) {
	function narasix_sidebar_registration() {

		// Arguments used in all register_sidebar() calls.
		$shared_args = array(
			'before_title'  => '<h2>',
			'after_title'   => '</h2>',
			'before_widget' => '<div id="%1$s" class="widget titles %2$s">',
			'after_widget'  => '</div>',
		);

		register_sidebar(
			array_merge(
				$shared_args,
				array(
					'name'          => esc_html__( 'Default Sidebar', 'narasix-free' ),
					'id'          => 'nsix-default',
					'description'   => esc_html__( 'Add widgets here to display them in your sidebar on blog posts and archive pages.', 'narasix-free' ),
				)
			)
		);
	}
	add_action( 'widgets_init', 'narasix_sidebar_registration' );
}

/**
 * Enqueue scripts and styles.
 */
if ( !function_exists( 'narasix_scripts' ) ) {
	function narasix_scripts() {
    $theme_version = wp_get_theme()->get( 'Version' );

		// Theme stylesheet.
		wp_enqueue_style( 'narasix-free', get_template_directory_uri() . '/style.css', array(), $theme_version );

		// Tailwind stylesheet.
		wp_enqueue_style( 'tailwind', get_template_directory_uri() . '/vendors/tailwind/tailwind.css', array(), '4.5.3' );

		// Theia sticky sidebar scripts.
		wp_enqueue_script( 'theia-sticky-sidebar', get_template_directory_uri() . '/vendors/theia-sticky-sidebar/theia-sticky-sidebar.min.js', array('jquery'), '1.7.0', true );

		// Theme scripts.
		wp_enqueue_script( 'nsix-narasix', get_template_directory_uri() . '/assets/js/narasix-scripts.js', array('jquery'), $theme_version, true );

		// Comment reply scripts.
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'narasix_scripts' );
}

/**
 * Enqueue block editor styles.
 */
if ( !function_exists( 'narasix_block_editor_styles' ) ) {
	function narasix_block_editor_styles() {
		wp_enqueue_style( 'narasix-editor-style-block', get_template_directory_uri() . '/assets/css/editor-style-block.css', array(), wp_get_theme()->get( 'Version' ), 'all' );
	}
	add_action( 'enqueue_block_editor_assets', 'narasix_block_editor_styles', 1, 1 );
}

/**
 * Enqueue classic editor styles.
 */
if ( !function_exists( 'narasix_classic_editor_styles' ) ) {
	function narasix_classic_editor_styles() {
		if ( !is_gutenberg_active() ) {
			// Enqueue editor styles.
			add_editor_style( 'assets/css/editor-style-classic.css' );
		}
	}
	add_action( 'init', 'narasix_classic_editor_styles' );
}

/**
 * Enqueue admin styles.
 */
if ( !function_exists( 'narasix_admin_styles' ) ) {
	function narasix_admin_styles() {
		wp_enqueue_style( 'narasix-editor-style-block', get_template_directory_uri() . '/assets/css/admin.css', array(), wp_get_theme()->get( 'Version' ), 'all' );
	}
	add_action( 'admin_enqueue_scripts', 'narasix_admin_styles' );
}

/**
 * Register theme's frontend variable
 */
if ( !function_exists( 'narasix_frontend_variable' ) ) {
	function narasix_frontend_variable() {
		$sticky_header = narasix_get_option( 'sticky_header', 'yes' );
		$sticky_sidebar = narasix_get_option( 'sticky_sidebar', 'yes' );
		$sticky_sidebar_margin_top = 20;

		if ( is_admin_bar_showing() ) {
			$sticky_sidebar_margin_top += 32;
		}

		if ( $sticky_sidebar === 'yes' ) {
			$sticky_sidebar_margin_top += 64;
		}

		$narasix_var = array(
			'stickyHeader' => $sticky_header,
			'stickySidebar' => $sticky_sidebar,
			'stickySidebarMarginTop' => $sticky_sidebar_margin_top,
		);

		wp_localize_script( 'nsix-narasix', 'narasixVar', $narasix_var );
	}
	add_action( 'wp_enqueue_scripts', 'narasix_frontend_variable' );
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Include Block Patterns.
 */
require get_template_directory() . '/inc/block-patterns.php';

/**
 * Include Block Styles.
 */
require get_template_directory() . '/inc/block-styles.php';

/**
 * Load about page.
 */
require get_template_directory() . '/inc/about.php';

/**
 * Create query args for featured block.
 */
if ( ! function_exists( 'narasix_featured_query_args' ) ) {
	function narasix_featured_query_args() {
		$args = array();
		$posts_per_page = 1;
		if ( current_user_can( 'read_private_posts' ) ) {
			$post_status = array( 'publish', 'private' );
		} else {
			$post_status = 'publish';
		}

		// create args base on method
		$args = array(
			'post_status' => $post_status,
			'posts_per_page'      => $posts_per_page,
			'ignore_sticky_posts' => 1,
			'orderby'   => 'date',
		);

		return $args;
	}
}

/**
 * Custom post excerpt words limit, must be used inside loop.
 */
if ( !function_exists( 'narasix_excerpt' ) ) {
	function narasix_excerpt( $limit = 20, $echo = true ) {
		if ( $echo ) {
			echo wp_trim_words( get_the_excerpt(), $limit );
		} else {
			return wp_trim_words( get_the_excerpt(), $limit );
		}
	}
}

/**
 * Display post featured image.
 */
if ( !function_exists( 'narasix_featured_img' ) ){
	function narasix_featured_img( $args ) {
			extract( $args );
			// Setting default values if variables not set.
			( isset( $size ) ) || $size = 'narasix_medium';
			( isset( $barebone ) ) || $barebone = false;
			( isset( $class ) ) || $class = '';
			( isset( $link ) ) || $link = true;
			( isset( $lazyload ) ) || $lazyload = true;

			if ( $lazyload ) {
					$lazyload = 'eager';
			}

			$attr = array(
					'loading' => $lazyload,
			);

			if ( has_post_thumbnail() ) {
				if ( !$barebone ) {
						$post_link = get_permalink();
						$post_format = get_post_format();

						if ( $class !== '' ) {
								echo '<div class="' . esc_attr( $class ) . '">';
						}
								the_post_thumbnail( $size, $attr );

								if ( $link ) {
										echo '<a href="' . esc_url( $post_link ) . '" class="absolute bottom-0 top-0 right-0 left-0"></a>';
								}
						if ( $class !== '' ) {
								echo '</div>';
						}
				}
		}
	}
}

/**
 * Display SVG icon
 */
if ( !function_exists( 'narasix_svg_icon' ) ) {
	function narasix_svg_icon( $args ) {
		extract( $args );
		// Setting default values if variables not set.
		( isset( $icon ) ) || $icon = '';
		( isset( $id ) ) || $id = '';
		( isset( $class ) ) || $class = '';
		$output ='';
		ob_start();

		if ( $class ) { ?>
			<span class="icons <?php echo esc_attr( $class ); ?>" aria-hidden="true" > <?php
		} elseif ( $id ) { ?>
			<span id="<?php echo esc_attr( $id ); ?>" class="icons" aria-hidden="true" > <?php
		} else { ?>
			<span class="icons" aria-hidden="true"><?php
		} 
		include( get_template_directory() . '/assets/svg-icons/' . $icon . '.svg' ); ?></span><?php



		$output = ob_get_clean();
		return $output;
	}
}

/**
 * Display date time in human readable format.
 */
if ( !function_exists( 'narasix_human_datetime' ) ) {
	function narasix_human_datetime( $day_limit = 7 ) {
		$post_time = get_the_time( 'U' );
		$human_time = '';
		$time_now = date( 'U' );

		if ( $post_time > $time_now - ( 60 * 60 * 24 * $day_limit ) ) {
			$human_time = sprintf( esc_html__( '%s ago', 'narasix-free'), human_time_diff( $post_time, current_time( 'timestamp' ) ) );
		} else {
			$human_time = get_the_date();
		}

		return esc_html( $human_time );
	}
}

/**
 * Display updated date time in human readable format.
 */
if ( !function_exists( 'narasix_human_modified_datetime' ) ) {
	function narasix_human_modified_datetime( $day_limit = 7 ) {
		$post_time = get_the_modified_time( 'U' );
		$human_time = '';
		$time_now = date( 'U' );

		if ( $post_time > $time_now - ( 60 * 60 * 24 * $day_limit ) ) {
			$human_time = esc_html__( 'Updated', 'narasix-free' ) . ' ' . sprintf( esc_html__( '%s ago', 'narasix-free'), human_time_diff( $post_time, current_time( 'timestamp' ) ) );
		} else {
			$human_time = esc_html__( 'Updated on', 'narasix-free' ) . ' ' . get_the_modified_date();
		}

		return esc_html( $human_time );
	}
}

/**
 * Display post meta
 */
if ( !function_exists( 'narasix_post_meta' ) ) {
	function narasix_post_meta( $args = array() ) {
		// Default values
		$args = wp_parse_args( $args, array(
			'meta_author' => 'yes',
			'meta_categories' => 'yes',
			'meta_date' => 'yes',
		) );

		if ( $args['meta_author'] === 'yes' ) {
			echo '<span class="author flex items-center space-x-1.5 capitalize whitespace-nowrap">' . narasix_svg_icon( array( 'icon' => 'user', 'class' => 'icons-sm -mt-[2px]' ) ) . get_the_author_posts_link() . '</span>';
		}
		
		if ( $args['meta_categories'] === 'yes' ) { 
			narasix_post_categories();
		}

		if ( $args['meta_date'] === 'yes' ) {
			$post_time_attr = get_the_time( 'c' );
			$post_time = get_the_time( get_option( 'date_format' ) );
			echo '<span class="flex items-center space-x-1.5 whitespace-nowrap" >' . narasix_svg_icon( array( 'icon' => 'clock', 'class' => 'icons-sm' ) ) . ' <time class="published" datetime="' . esc_attr( $post_time_attr ) . '"  title="' . esc_attr( $post_time ) . '">' . narasix_human_datetime() . '</time></span>';
		}
	}
}

/**
 * Display post categories
 */
if ( !function_exists('narasix_post_categories') ) {
	function narasix_post_categories( $post_id = NULL ) {
		$categories = get_the_category( $post_id );

		if ( !empty($categories) ) {
      $categories = array_slice( $categories, 0, 1 );
      foreach ( $categories as $category ) {
        ?>
				<span class="font-meta space-x-1.5 content-category whitespace-nowrap">
					<a class="post-category space-x-0.5 text-[14px]" 
						href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" 
						title="<?php echo esc_attr( sprintf( esc_html__( 'View all posts in %s', 'narasix-free' ), $category->name ) ) ?>" 
						rel="tag" >
						<?php echo esc_html( $category->name ); ?>
					</a>
				</span>
        <?php
      }
    }
	}
}

/**
 * Display post single categories
 */
if ( !function_exists('narasix_post_categories_single') ) {
	function narasix_post_categories_single( $post_id = NULL ) {
		$categories = get_the_category( $post_id );
		
		if ( $categories ) {
			$categories = array_slice( $categories, 0, 3 ); // Display maximum 3 categories.
			?>
			<ul class="inline-flex list-none">
			<?php foreach ( $categories as $category ) { ?>
				<li class="list-category">
					<a class="hover:underline whitespace-nowrap" href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" title="<?php echo esc_attr( sprintf( esc_html__( 'View all posts in %s', 'narasix-free' ), $category->name ) ) ?>" rel="tag">
						<?php echo esc_html( $category->name ); ?>
					</a>
				</li>
			<?php } ?>
			</ul>
			<?php
		}
	}
}

/**
 * Display Post Listing
 */
if ( !function_exists( 'narasix_get_post_listing_args' ) ) {
	function narasix_get_post_listing_args() {
		// Check what archive page current page is.
		if ( is_search() ) {
			$prefix = 'search_';
		} elseif ( is_category() ) {
			$prefix = 'category_';
		} elseif ( is_tag() ) {
			$prefix = 'tag_';
		} elseif ( is_author() ) {
			$prefix = 'author_';
		} else {
			$prefix = 'blog_';
		}

		// Get theme options.
		$post_listing_args = array(
			'ignore_sticky_posts' 		=> 'no',
			'post_layout' 						=> 'list-landscape',
			'pagination' 							=> 'default',
		);

		return $post_listing_args;
	}
}

/**
 * Post Listing.
 */
if ( !function_exists( 'narasix_post_listing' ) ) {
	function narasix_post_listing( $post_listing_args = array() ) {

		// Merge with default value.
		$post_listing_args = wp_parse_args( $post_listing_args, array(
			'post_query' => NULL,
			'query' => [
				'offset' 				 => 0,
				'posts_per_page' => 10,
			],
			'ignore_sticky_posts' => 'yes',
			'post_layout' => 'list-landscape',
			'pagination' => 'default',
		) );

		// Setting up variables
		$section_class = 'section w-full post-listing-section post-listing-section-' . $post_listing_args['post_layout'];
		$section_wrapper_class = 'post-listing-wrapper';
		$section_content_class = 'post-listing-content';

		$template_args = array();

		switch ( $post_listing_args['post_layout'] ) {
			case 'list-landscape':
					$section_content_class .= ' space-y-4 sm:space-y-6';
					$post_item_wrapper_class = 'list-lands-sidebar';
					$post_template = 'landscape';
					break;
		}

		// Setting up query.
		if ( !$post_listing_args['post_query'] ) {
			$post_query = $GLOBALS['wp_query'];

			// Get current page.
			if ( get_query_var( 'paged' ) ) {
			    $paged = get_query_var( 'paged' );
			} elseif ( get_query_var( 'page' ) ) {
			    $paged = get_query_var( 'page' );
			} else {
			    $paged = 1;
			}
		} else {
			$post_query = $post_listing_args['post_query'];

			// Get current page.
			$paged = max( 1, $post_query->query_vars['paged'] );
		}

		$max_pages = $post_query->max_num_pages;
		$query_string = http_build_query( $post_query->query ); // Create query string for AJAX load post.

		$section_wrapper_attrs = array();
		$section_wrapper_attrs['layout'] = $post_listing_args['post_layout'];
		$section_wrapper_attrs['query'] = $query_string;
		$section_wrapper_attrs['current-page'] = $paged;
		$section_wrapper_attrs['max-pages'] = $max_pages;
		$section_wrapper_attrs['posts-per-page'] = $post_listing_args['query']['posts_per_page'];
		$section_wrapper_attrs['offset'] = $post_listing_args['query']['offset'];
		$section_wrapper_attrs['ignore-sticky-posts'] = $post_listing_args['ignore_sticky_posts'];
		$section_wrapper_attrs['post-template'] = $post_template;

		?>
			<div class="<?php echo esc_attr( $section_wrapper_class ); ?>"<?php
				foreach ( $section_wrapper_attrs as $data_attr => $value ) {
					echo ' data-' . esc_attr( $data_attr) . '="' . esc_attr( $value ) . '"'; } ?>>
						<div class="<?php echo esc_attr( $section_content_class ); ?>">
							<?php
								while ( $post_query->have_posts() ) {
										$post_query->the_post();

										echo '<div class="' . esc_attr( $post_item_wrapper_class ) . '">';
											narasix_get_template_part( 'template-parts/content/content-' . $post_template, NULL, $template_args );
										echo '</div>';
             		} 
						 ?>
            </div>

            <?php
            // Reset postdata
            wp_reset_postdata();
            ?>

					<?php
					if ( $post_listing_args['pagination'] !== 'none' ) {
					?>
							<div class="post-listing-pagination mt-6 mb-2">
							<?php
							if ( $post_listing_args['pagination'] !== 'view-more-url' ) {
									narasix_pagination( array(
										'type' => $post_listing_args['pagination'],
										'max_pages' => $max_pages,
									) );
							} elseif ( $post_listing_args['view_more_url'] || $post_listing_args['view_more_url_title'] ) {
							?>
									<div class="text-center">
											<a class="py-3 px-4 bg-slate-400 rounded-xl btn-animation view-more-btn" href="<?php echo esc_url( $post_listing_args['view_more_url']['url'] ); ?>"<?php if ( $post_listing_args['view_more_url']['is_external'] ) { echo ' target="_blank"'; } ?> rel="noopener noreferrer<?php if ( $post_listing_args['view_more_url']['nofollow'] ) { echo ' nofollow'; } ?>"><span><?php
													echo esc_html( $post_listing_args['view_more_url_title'] );
													?></span><?php
													echo narasix_svg_icon( array( 'icon' => 'arrow-right', 'class' => 'icons-last' ) );
											?></a>
									</div>
							<?php
							}
							?>
							</div>
					<?php
					}
					?>
			</div>
    <?php
	}
}

/**
 * Display post comments number bubble.
 */
if ( !function_exists('narasix_post_comments_bubble') ) {
	function narasix_post_comments_bubble( $post_id = NULL ) {
		$link_title = '';
		$comments_number = get_comments_number( $post_id );
		$comments_link = get_comments_link( $post_id );
		if ( $comments_number != '0' ) {
			$link_title = sprintf( _nx( '%1$s comment', '%1$s comments', $comments_number, 'comments title', 'narasix-free' ), number_format_i18n( $comments_number ) );
		} else {
			$link_title = esc_html__('Comment', 'narasix-free');
		} ?>
		<a href="<?php echo esc_url( $comments_link ); ?>" title="<?php echo esc_attr( $link_title ); ?>" class="comments-number-bubble navigation-font">
			<?php echo esc_html( $comments_number ); ?>
		</a>
		<?php
	}
}

/**
 * Theme's pagination.
 */
if ( ! function_exists( 'narasix_pagination' ) ) {
	function narasix_pagination( $args = array() ) {
		// Merge with default value.
		$args = wp_parse_args( $args, array(
			'type' => 'default',
		    'max_pages' => 1,
		) );

		switch ( $args['type'] ) {
			case 'default':
			default:
				if ( $args['max_pages'] > 1 ) {
					// Get current page.
					if ( get_query_var( 'paged' ) ) {
					    $current = get_query_var( 'paged' );
					} elseif ( get_query_var( 'page' ) ) {
					    $current = get_query_var( 'page' );
					} else {
					    $current = 1;
					}

					$big = 999999999;

					$pagination = array(
						'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	          'format' => '?paged=%#%',
						'total' => $args['max_pages'],
						'current' => $current,
						'mid_size' 	=> 1,
						'prev_text' => '<span class="sr-only">' . esc_html__( 'Previous page', 'narasix-free' ) . '</span><span class="nsix-pagination-circle"><svg width="48px" height="48px" viewBox="0 0 100 100"><circle class="anicircle" cx="50" cy="50" r="48"/></svg></span>' . narasix_svg_icon( array( 'icon' => 'arrow-left', 'class' => 'icons-md', 'echo' => false ) ),
				    	'next_text' => '<span class="sr-only">' . esc_html__( 'Next page', 'narasix-free' ) . '</span><span class="nsix-pagination-circle"><svg width="48px" height="48px" viewBox="0 0 100 100"><circle class="anicircle" cx="50" cy="50" r="48"/></svg></span>' . narasix_svg_icon( array( 'icon' => 'arrow-right', 'class' => 'icons-md', 'echo' => false ) ),
					);

					?>
					<nav class="navigation pagination nsix-pagination nsix-pagination-default">
						<div class="nav-links flex items-center justify-center<?php if ( $current == 1 ) { echo ' is-on-first-page'; } if ( $current == $args['max_pages'] ) { echo ' is-on-last-page'; } ?>">
							<?php echo paginate_links( $pagination ); ?>
						</div>
					</nav>
					<?php
				}

			break;
		}
	}
}

/**
 * Get theme option value.
 */
if ( ! function_exists( 'narasix_get_option' ) ) {
	function narasix_get_option( $opt, $default = NULL ) {
		$prefix = 'nsix_narasix_';
		return get_theme_mod( $prefix . $opt, $default );
	}
}

/**
 * Backwards compability for get_template_part()
 */
if ( ! function_exists( 'narasix_get_template_part' ) ) {
	function narasix_get_template_part( $slug, $name = NULL, $args = array() ) {
		// Check if current version of WordPress is later than 5.5
		if ( get_bloginfo( 'version' ) >= '5.5' ) {
			get_template_part( $slug, $name, $args );
		} else {
			set_query_var( 'args', $args );
			get_template_part( $slug, $name, $args );
			set_query_var( 'args', false );
		}
	}
}

/*
 * Breadcrumb.
 */
if ( ! function_exists( 'narasix_breadcrumb' ) ) {
	function narasix_breadcrumb( $style = 'default' ) {
		if ( function_exists('yoast_breadcrumb') ) {
			if ( !is_home() || !is_front_page() ) {
				if ( $style === 'default' ) {
					yoast_breadcrumb();
				} else {
					yoast_breadcrumb();
				}

			}
		}
	}
}

/**
 * Add SVG to wp_kses_post ruleset.
 */
if ( !function_exists( 'nsix_wp_kses_post' ) ) {
	function nsix_wp_kses_post( $html ) {
	    $kses_defaults = wp_kses_allowed_html( 'post' );
	    $svg_args = array(
	        'svg'   => array(
	            'class'           => true,
	            'aria-hidden'     => true,
	            'aria-labelledby' => true,
	            'role'            => true,
	            'xmlns'           => true,
	            'width'           => true,
	            'height'          => true,
	            'viewbox'         => true,
	            'fill'			  => true,
	        ),
	        'g'     => array( 'fill' => true ),
	        'title' => array( 'title' => true ),
	        'path'  => array(
	            'd'    => true,
	            'fill' => true,
	        ),
	    );
	    $allowed_tags = array_merge( $kses_defaults, $svg_args );
	    return wp_kses( $html, $allowed_tags );
	}
}

/**
 * Shim for wp_body_open, ensuring backward compatibility with versions of WordPress older than 5.2.
 */
if ( ! function_exists( 'wp_body_open' ) ) {
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

/**
 * Check if Block Editor is active.
 * Must only be used after plugins_loaded action is fired.
 *
 * @return bool
 */
function is_gutenberg_active() {
    // Gutenberg plugin is installed and activated.
    $gutenberg = ! ( false === has_filter( 'replace_editor', 'gutenberg_init' ) );

    // Block editor since 5.0.
    $block_editor = version_compare( $GLOBALS['wp_version'], '5.0-beta', '>' );

    if ( ! $gutenberg && ! $block_editor ) {
        return false;
    }

    if ( is_classic_editor_plugin_active() ) {
        $editor_option       = get_option( 'classic-editor-replace' );
        $block_editor_active = array( 'no-replace', 'block' );

        return in_array( $editor_option, $block_editor_active, true );
    }

    return true;
}

/**
 * Sticky Header Mobile
 */
function js_sticky_mobile_init() {
	$sticky_header_mobile = narasix_get_option( 'sticky_header_mobile', 'no' );
		if ( $sticky_header_mobile === 'yes' ) { ?>
				<script>
					var lastScroll = 0;
					var isScrolled = false;

					window.addEventListener("scroll", function () {
							var topHeader = document.querySelector(".header-mobile-sticky");
							var currentScroll = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
							var scrollDirection = currentScroll < lastScroll;
							var shouldToggle = isScrolled && scrollDirection;
							isScrolled = currentScroll > 100;
							topHeader.classList.toggle("sticky-active", shouldToggle);
							lastScroll = currentScroll;
					});
				</script>
			<?php
	}
}
add_action('wp_footer', 'js_sticky_mobile_init');

/**
 * Check if Classic Editor plugin is active.
 *
 * @return bool
 */
function is_classic_editor_plugin_active() {
    if ( ! function_exists( 'is_plugin_active' ) ) {
        include_once ABSPATH . 'wp-admin/includes/plugin.php';
    }

    if ( class_exists( 'Classic_Editor' ) ) {
        return true;
    }

    return false;
}

/**
 * Live Search
 */
if ( !function_exists( 'narasix_search_handler' ) ) {
	function narasix_search_handler() {
		// Cek apakah request AJAX dan action yang diminta adalah "search"
		if (isset($_GET['action']) && $_GET['action'] == 'search') {
				// Ambil nilai dari input pencarian
				$s = $_GET['s'];

				// Buat query pencarian
				$query = new WP_Query(array(
						's' => $s,
						'post_type' => 'post', // Tampilkan hanya post, bukan page
						'posts_per_page' => -1
				));
			
				// Jika ada hasil pencarian
				if ($query->have_posts()) {
						// Tampilkan daftar hasil pencarian
						while ($query->have_posts()) {
								$query->the_post();
								?>
								<li class="dark:hover:bg-charcoal-800 text-charcoal-800 group flex items-center space-x-2 rounded-md bg-gray-100 px-2 py-2 hover:bg-sky-700 hover:text-white">
									<span class="dark:group-hover:bg-charcoal-800 dark:hover:bg-charcoal-800 rounded border border-gray-300 bg-gray-200 px-2 group-hover:bg-sky-700">#</span>
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</li>

								<?php
						}
						wp_reset_postdata();
				} else {
						// Tampilkan pesan jika tidak ada hasil pencarian
						echo '<p>No results found.</p>';
				}
				exit;
		}
	}
}
add_action('init', 'narasix_search_handler');

/**
 * Display post tags
 */
if ( !function_exists( 'narasix_post_tags' ) ) {
	function narasix_post_tags( $post_id = NULL ) {
		$tags = get_the_tags( $post_id );
		if ( $tags ) {
			?>
			<ul class="inline-flex meta-scroll flex-nowrap overflow-x-auto space-x-4 list-none py-3">
			<?php
			foreach ( $tags as $tag ) {
			?>
				<li>
					<a class="font-meta inline-block text-sm py-1 px-4 border rounded-xl whitespace-nowrap" href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" title="<?php echo esc_attr( sprintf( esc_html__( 'View all posts in %s', 'narasix-free' ), $tag->name ) ) ?>" rel="tag"><?php echo esc_html( $tag->name ); ?></a>
				</li>
			<?php
			}
			?>
			</ul>
			<?php
		}
	}
}

/**
 * Display Share social
 */
if ( !function_exists( 'narasix_social_share' ) ) {
	function narasix_social_share() {
			global $post;
			if(is_singular()) {
					$urls = urlencode(get_permalink());
					$titles = str_replace(' ', '%20', get_the_title());
					$content = '';

					// Construct social sharing URLs
					$platforms = [
							['icon' => 'twitter', 'url' => 'https://twitter.com/intent/tweet?text=' . $titles . '&url=' . $urls],
							['icon' => 'facebook', 'url' => 'https://www.facebook.com/sharer/sharer.php?u=' . $urls],
							['icon' => 'gmail', 'url' => 'https://mail.google.com/mail/?view=cm&su=' . $urls . '&title=' . $titles],
							['icon' => 'line', 'url' => 'https://lineit.line.me/share/ui?url=' . $urls . '&title=' . $titles],
							['icon' => 'telegram', 'url' => 'https://t.me/share/url?url=' . $urls . '&title=' . $titles],
							['icon' => 'linkedin', 'url' => 'https://www.linkedin.com/shareArticle?mini=true&url=' . $urls . '&title=' . $titles]
					];

					// Add sharing links at the end of page/page content
					foreach ($platforms as $platform) {
							$content .= '<li class="share-to">' .
									'<a class="social-share" href="' . $platform['url'] . '" target="_blank" rel="nofollow">' .
											narasix_svg_icon(array('icon' => $platform['icon'], 'class' => 'icons-md')) .
									'</a>' .
							'</li>';
					}

					return $content;
			} else {
					// if not a post/page then don't include sharing links
					return $content;
			}
	}
}

// Disables the block editor from managing widgets in the Gutenberg plugin.
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false', 100 );

// Disables the block editor from managing widgets. renamed from wp_use_widgets_block_editor
add_filter( 'use_widgets_block_editor', '__return_false' );