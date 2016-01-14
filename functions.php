<?php

// =============================================================================
// FUNCTIONS.PHP
// -----------------------------------------------------------------------------
// Overwrite or add your own custom functions to X in this file.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Enqueue Parent Stylesheet
//   02. Additional Functions
// =============================================================================

// Enqueue Parent Stylesheet
// =============================================================================

add_filter( 'x_enqueue_parent_stylesheet', '__return_true' );

// Additional Functions
// =============================================================================

/* for displaying social media share icons on posts */
add_action('x_before_the_content_end', function() {
  echo do_shortcode('[share title="Share this Post" facebook="true" twitter="true"  email="true"]');
});

// Add in JS for flip effect
function vint_scripts() {
	//wp_enqueue_script( 'flip.js', 'https://cdn.rawgit.com/nnattawat/flip/v1.0.18/dist/jquery.flip.min.js', array('jquery'));
  //wp_enqueue_script( 'vintflip.js', '/wp-content/themes/x-child/framework/views/integrity/vintflip.js');
}
add_action( 'wp_enqueue_scripts', 'vint_scripts' );

// Output Portfolio Item Featured Content
// =============================================================================

function vint_portfolio_item_featured_content() {

  if ( x_get_option( 'x_portfolio_enable_cropped_thumbs', '' ) == '1' ) :
    vint_featured_portfolio( 'cropped' );
  else :
    vint_featured_portfolio();
  endif;

}

// Featured Portfolio
// =============================================================================

if ( ! function_exists( 'vint_featured_portfolio' ) ) :
  function vint_featured_portfolio( $cropped = '' ) {

    $entry_id    = get_the_ID();
    $media       = get_post_meta( $entry_id, '_x_portfolio_media', true );
    $index_media = get_post_meta( $entry_id, '_x_portfolio_index_media', true );

    if ( is_singular() ) {
      switch ( $media ) {
        case 'Image' :
          vint_featured_image();
          break;
        case 'Gallery' :
          x_featured_gallery();
          break;
        case 'Video' :
          x_featured_video( 'portfolio' );
          break;
      }
    } else {
      if ( $index_media == 'Media' ) {
        switch ( $media ) {
          case 'Image' :
            ( $cropped == 'cropped' ) ? vint_featured_image( 'cropped' ) : vint_featured_image();
            break;
          case 'Gallery' :
            x_featured_gallery();
            break;
          case 'Video' :
            x_featured_video( 'portfolio' );
            break;
        }
      } else {
        ( $cropped == 'cropped' ) ? vint_featured_image( 'cropped' ) : vint_featured_image();
      }
    }

  }
endif;

//
// Remove the hover link effect from portfolio featured content
//

if ( ! function_exists( 'vint_featured_image' ) ) :
  function vint_featured_image( $cropped = '' ) {

    $stack     = x_get_stack();
    $fullwidth = ( in_array( 'x-full-width-active', get_body_class() ) ) ? true : false;

    if ( has_post_thumbnail() ) {

      if ( $cropped == 'cropped' ) {
        if ( $fullwidth ) {
          $thumb = get_the_post_thumbnail( NULL, 'entry-cropped-fullwidth', NULL );
        } else {
          $thumb = get_the_post_thumbnail( NULL, 'entry-cropped', NULL );
        }
      } else {
        if ( $fullwidth ) {
          $thumb = get_the_post_thumbnail( NULL, 'entry-fullwidth', NULL );
        } else {
          $thumb = get_the_post_thumbnail( NULL, 'entry', NULL );
        }
      }

      switch ( is_singular() ) {
        case true:
          printf( '<div class="truimg">%s</div>', $thumb );
          break;
        case false:
          printf( '<div class="truimg"><a href="%1$s" title="%2$s">%3$s</a></div>',
            esc_url( get_permalink() ),
            esc_attr( sprintf( __( 'Permalink to: "%s"', '__x__' ), the_title_attribute( 'echo=0' ) ) ),
            $thumb
          );
          break;
      }

    }

  }
endif;
