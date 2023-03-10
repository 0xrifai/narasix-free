<?php
/**
 * The template for displaying all single posts
 */

// Setting up variables.
$post_url =  get_permalink();
$post_format = get_post_format();
$post_image = NULL;

$classes = array(
	'wysiwyg',
	'wysiwyg-slate',
	'max-w-full',
	'space-y-4',
	'sm:space-y-6',
	'dark:wysiwyg-invert',
);

?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
 

    <?php  the_content(); ?>
    

      <?php
      wp_link_pages( array(
        'before'      		  => '<div class="nsix-post-pagination font-meta">' . '<span class="nsix-post-pagination-heading">' . esc_html__( 'Pages:', 'narasix' ) . '</span>',
        'after'       		  => '</div>',
        'linkbefore'      	=> '<span class="nsix-post-pagination-item">' . esc_html__( 'Pages:', 'narasix' ),
        'linkafter'       	=> '</span>',
        'next_or_number'	  => 'next_and_number',
        'nextpagelink'     	=> esc_html__( 'Next page', 'narasix' ),
        'previouspagelink' 	=> esc_html__( 'Previous page', 'narasix' ),
      ) );
    ?>
    
    <div class="relative not-wysiwyg border-t pt-4">

        <?php
          $post_tags = get_the_tags();
          if ( $post_tags ) {
          ?>
          <div class="flex items-center space-x-3">
            <h5 class="font-heading !text-lg whitespace-nowrap"><?php echo esc_html__( 'Tags :', 'narasix' ) ?></h5>
            <?php
              narasix_post_tags();
            ?>
          </div>
          <?php
          }
        ?>

    </div>
        
    <div class="mt-6">
      <?php
      the_post_navigation( array(
        'prev_text' => '<div aria-hidden="true" class="nav-subtitle font-meta">' . esc_html__( 'Previous', 'narasix' ) . '</div><h4 class="nav-title">%title</h4>',
        'next_text' => '<div aria-hidden="true" class="nav-subtitle font-meta">' . esc_html__( 'Next', 'narasix' ) . '</div><h4 class="nav-title">%title</h4>',
      ) );
      ?>
    </div>
	</article>



