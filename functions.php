<?php
/**
 * Understrap functions and definitions
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/jetpack.php',                         // Load Jetpack compatibility file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker. Trying to get deeper navigation? Check out: https://github.com/understrap/understrap/issues/567
	'/woocommerce.php',                     // Load WooCommerce functions.
	'/editor.php',                          // Load Editor functions.
	'/wp-admin.php',                        // /wp-admin/ related functions
	'/deprecated.php',                      // Load deprecated functions.
	'/custom-post-type.php',                // Load custom post types
	'/acf-details.php',                     // Load acf functions etc.
);

foreach ( $understrap_includes as $file ) {
	$filepath = locate_template( 'inc' . $file );
	if ( ! $filepath ) {
		trigger_error( sprintf( 'Error locating /inc%s for inclusion', $file ), E_USER_ERROR );
	}
	require_once $filepath;
}

//remove block editor from projects from https://github.com/AdvancedCustomFields/acf/issues/112
add_filter('allowed_block_types', 'my_allowed_block_types', 10, 2);
function my_allowed_block_types($allowed_blocks, $post) {
  if( $post->post_type === 'project' ) {
     return array();
    }
}



//SOCIAL SHARING BUTTONS
function herald_social_share($title, $url, $hashtag){
	$safe_url = urlencode($url);
	$safe_title = urlencode($title);
	$safe_hashtag = urlencode($hashtag);

	$twitter = '<div class="twitter social"><a class="twitter-hashtag-button"  href="http://twitter.com/intent/tweet?url='.$safe_url.'&amp;text='.$safe_title.'&amp;button_hashtag='.$safe_hashtag.'">Share on Twitter</a></div>';

	$linked_in = '<div class="li social"><a href="http://www.linkedin.com/sharing/share-offsite?url='.$safe_url.'&title='.$safe_title.'">Share on LinkedIn</a></div>';

	$facebook = '<div class="fb social"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u='.$safe_url.'%2F&amp;src=sdkpreparse">Share on Facebook</a></div>';
	return $twitter . $linked_in . $facebook;
}


//ADD TO ARCHIVES & SEARCH
//from https://thomasgriffin.io/how-to-include-custom-post-types-in-wordpress-search-results/

add_filter( 'pre_get_posts', 'herald_cpt_search' );
/**
 * This function modifies the main WordPress query to include an array of 
 * post types instead of the default 'post' post type.
 *
 * @param object $query  The original query.
 * @return object $query The amended query.
 */
function herald_cpt_search( $query ) {
	
    if ( $query->is_search ) {
	$query->set( 'post_type', array( 'post', 'project' ) );
    }
    
    return $query;
    
}
