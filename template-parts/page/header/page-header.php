<?php
/**
 * Display single post header: B.
 */

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$section_heading = narasix_get_option('latest_posts_heading', esc_html__( 'Latest Posts', 'narasix-free' ));
$page_title = '';
$page_subtitle = '';

if ( is_search() ) {
	global $wp_query;

	$page_title = sprintf(
		'%1$s %2$s',
		'<span>' . esc_html__( 'Search:', 'narasix-free' ) . '</span>',
		'&ldquo;' . get_search_query() . '&rdquo;'
	);

	if ( $wp_query->found_posts ) {
		$page_subtitle = sprintf(
			/* translators: %s: Number of search results. */
			_n(
				esc_html__( 'We found %s result for your search.', 'narasix-free' ),
				esc_html__( 'We found %s results for your search.', 'narasix-free' ),
				$wp_query->found_posts,
				'narasix-free'
			),
			number_format_i18n( $wp_query->found_posts )
		);
	} else {
		$page_subtitle = esc_html__( 'We could not find any results for your search.', 'narasix-free' );
	}
} elseif ( is_archive() && !have_posts() ) {
	$page_title = esc_html__( 'Nothing Found', 'narasix-free' );
} elseif ( !is_home() ) {
	$page_title    = get_the_archive_title();
	$page_subtitle = get_the_archive_description();
}

// Setting up variables.
$header_class = 'section w-full my-6';

?>
<header class="<?php echo esc_attr( $header_class ); ?>">
		<?php 
			if ( is_home() && $paged > 1 && $section_heading !== '' ) {
				echo '<h2 class="font-semibold uppercase border-l-8 pl-3 border-charcoal-700/5 dark:border-charcoal-200/5 text-charcoal-700 dark:text-charcoal-200">';
				echo wp_kses_post( $section_heading );
				if ( $paged > 1) {
					esc_html_e(' - Page ', 'narasix-free');
					echo esc_html($paged);
				}
				echo '</h2>';
			} else {
				
			if ( is_archive() ) {
				if ( is_category() ) {
					$category = get_queried_object();
					$category_name = get_category_by_slug($category->slug);
					echo '<div class="px-4 text-center category text-charcoal-700 dark:text-charcoal-200 bg-charcoal-100 dark:bg-charcoal-700/70 space-y-1 rounded-xl py-4 backdrop-blur">';
					echo '<h2 class="text-base font-medium">' . esc_html( 'Category: ', 'narasix-free' ) . ' <span class="text-xl font-semibold uppercase">' . esc_html( $category_name->name, 'narasix-free' ) . '</span></h2>';
					narasix_breadcrumb();
					echo '</div>';
			}
			
				if ( is_tag() ) {
					$tag = get_queried_object();
					echo '<div class="px-4 text-center tag text-charcoal-700 dark:text-charcoal-200 bg-charcoal-100 dark:bg-charcoal-700/70 space-y-1 rounded-xl py-4 backdrop-blur">';
					echo '<h2 class="text-base font-medium">' . esc_html( 'Tags: ', 'narasix-free' ) . ' <span class="text-xl font-semibold uppercase">' . esc_html( $tag->name, 'narasix-free' ) . '</span></h2>';
					narasix_breadcrumb();
					echo '</div>';
				}
			}

			if ( is_page() ) {
				echo '<div class="px-4 text-center page text-charcoal-700 dark:text-charcoal-200 bg-charcoal-100 dark:bg-charcoal-700/70 space-y-1 rounded-xl py-4 backdrop-blur">';
				the_title( '<h2 class="font-semibold uppercase">', '</h2>' );
				narasix_breadcrumb();
				echo '</div>';
			}

			if ( is_search() ) {
				$search_query = get_search_query();
				echo '<div class="px-4 text-center search text-charcoal-700 dark:text-charcoal-200 bg-charcoal-100 dark:bg-charcoal-700/70  mb-6 space-y-1 rounded-xl py-4 backdrop-blur">';
				echo '<h2 class="text-base font-medium">' . esc_html( 'Search: ', 'narasix-free' ) . ' <span class="text-xl font-semibold uppercase">' . esc_html( $search_query, 'narasix-free' ) . '</span></h2>';
				if ( $page_subtitle ) { 
					echo '<div>' . wp_kses_post( wpautop( $page_subtitle ) ) . '</div>';
				}
				echo '</div>';
			}
		}
	?>
</header>