<div class="modal" id="sharemodal" aria-hidden="true">
  <div class="modal-dialog md:w-[30rem]">
    <div class="dark:divide-charcoal-800/40 bg-charcoal-100 dark:bg-charcoal-700 h-[11rem] divide-y rounded-t-lg p-0 shadow-lg outline-0 sm:h-auto sm:rounded-xl">
      <div class="text-charcoal-800 dark:text-charcoal-100 flex h-10 items-center justify-start space-x-2 px-4 py-6">
        <input type="text" id="permalink" value="<?php the_permalink(); ?>" class="search-field bg-charcoal-100 dark:bg-charcoal-700 placeholder-charcoal-700/20 h-10 w-full px-2 outline-none"/>
        <button id="copy-button"><?php echo narasix_svg_icon( array( 'icon' => 'copy', 'class' => 'icons-md' ) ) ;?></button>
        <button type="button" class="closemodal dark:bg-charcoal-800 dark:border-charcoal-800 hidden cursor-pointer rounded border bg-gray-100 px-2 text-[14px] active:scale-95 sm:flex">ESC</button>
        <button type="button" class="closemodal dark:bg-charcoal-800 dark:border-charcoal-800 cursor-pointer rounded border bg-gray-100 px-2 text-[14px] active:scale-95 sm:hidden">
          <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="16" height="24" viewBox="0 0 24 24">
            <path d="M 4.9902344 3.9902344 A 1.0001 1.0001 0 0 0 4.2929688 5.7070312 L 10.585938 12 L 4.2929688 18.292969 A 1.0001 1.0001 0 1 0 5.7070312 19.707031 L 12 13.414062 L 18.292969 19.707031 A 1.0001 1.0001 0 1 0 19.707031 18.292969 L 13.414062 12 L 19.707031 5.7070312 A 1.0001 1.0001 0 0 0 18.980469 3.9902344 A 1.0001 1.0001 0 0 0 18.292969 4.2929688 L 12 10.585938 L 5.7070312 4.2929688 A 1.0001 1.0001 0 0 0 4.9902344 3.9902344 z"></path>
          </svg>
        </button>
      </div>

      <div class="py-3 px-4">
        <h3 class="mb-3 text-charcoal-800 dark:text-charcoal-100"><?php echo esc_html__( 'Share', 'narasix-free' ) ?></h3>
  
        <div id="nx_share">
          <ul class="nx-carrousel-flexbox space-x-4">
            <?php echo narasix_social_share(); ?>
          </ul>
        </div>
      </div>

    </div>
  </div>
</div>