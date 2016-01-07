<?php

// =============================================================================
// VIEWS/INTEGRITY/CONTENT.PHP
// -----------------------------------------------------------------------------
// Standard post output for Integrity.
// =============================================================================

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="entry-featured">
    <?php x_featured_image(); ?>
  </div>
  <div class="entry-wrap">


    <?php x_get_view( 'integrity', '_content', 'post-header' ); ?>

    <?php x_get_view( 'integrity', '_content', 'post-footer' ); /* this has the tags, below the title*/?> 

    <?php x_get_view( 'global', '_content' ); ?>
  </div>
  
  


</article>