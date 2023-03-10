<?php
/**
 * Display single post header: Default.
 */

if ( isset( $args ) ) extract( $args ); // extract passed variables.

// Setting up variables.
$thumb_size = 'narasix_md_4_3';
$post_time_attr = get_the_time( 'c' );
$post_time = get_the_time( get_option( 'date_format' ) );

?>
<header class="single-header">
	<?php
	if ( has_post_thumbnail() ) {
		?>
			<?php
				echo '<div class="aspect-w-s aspect-w-16 max-lg:aspect-h-9">';
					narasix_featured_img( array(
						'size' => $thumb_size,
						'link'=> false,
					) );
				echo '</div>';
			?>
		<?php
	}
	?>

	<div class="post-meta relative space-y-3 max-w-7xl mx-auto mt-4 max-lg:px-4">

		<?php narasix_breadcrumb(); ?>

		<?php
		the_title( '<h1 class="font-heading sm:text-2xl md:text-3xl lg:text-4xl">', '</h1>' );
		?>

		<div class="text-limit opacity-50 text-base font-serif tracking-wide">
			<?php the_excerpt(); ?>
		</div>

		<div class="flex flex-wrap items-center justify-between border-y mt-4 py-4">
			<div class="font-meta inline-flex w-[70%] items-center">
				<span class="inline-flex items-center space-x-3 whitespace-nowrap dot-s">
					<span class="author-avatar">
						<?php echo get_avatar( get_the_author_meta( 'ID' ), '32', '', esc_html__( 'avatar', 'narasix' ) ); ?>
					</span>
					<?php the_author_posts_link(); ?>
				</span>
				<div class="inline-flex items-center flex-nowrap overflow-x-auto meta-scroll md:w-full">
					<?php 
							echo '<span class="whitespace-nowrap dot-s">';
							echo '<time class="published" datetime="' . esc_attr( $post_time_attr ) . '"  title="' . esc_attr( $post_time ) . '">' . narasix_human_datetime() . '</time>';
							echo '</span>';
						?>
					<?php
					$display_modified_date = narasix_get_option( 'single_post_modified_date_toggle', 'no' );
					if ( $display_modified_date === 'yes' ) {
						$post_modified_date_format = get_the_modified_date( get_option( 'date_format' ) );
						$post_modified_time = get_the_modified_time( 'U' );
						$post_modified_time_attr = get_the_modified_time( 'c' );
						$post_published_time = get_the_time( 'U' );
						// Display modified time if enabled
						if ( ( $post_modified_time !== $post_published_time ) && ( $post_modified_time > $post_published_time - ( 60 * 60 * 24 ) ) ) { ?>
						<time class="updated whitespace-nowrap" datetime="<?php echo esc_attr( $post_modified_time_attr ); ?>" title="<?php echo esc_attr( $post_modified_date_format ); ?>">
							<?php echo narasix_human_modified_datetime(); ?>
						</time>
						<?php }
					}
					?>
				</div>
			</div>

			<div class="inline-flex items-center">
				<div class="inline-flex items-center">
					<?php 
					if ( function_exists('wpp_get_views') ) {
						$post_views = wpp_get_views( get_the_ID() );
						if ( $post_views > 0 ) { ?>
							<div class="inline-flex items-center space-x-1 cursor-none select-none lines">
								<span><?php echo esc_html( $post_views ); ?></span>
								<?php echo narasix_svg_icon( [ 'icon' => 'eye', 'class' => 'icons-md' ] ); ?>
							</div>
						<?php
						}
					}
					?>
					<button class="modal-open" data-modal="#sharemodal">
					<?php echo narasix_svg_icon( [ 'icon' => 'share', 'class' => 'icons-md' ] ); ?>
					</button>
				</div>
			</div>
		</div>
	</div>
</header>
