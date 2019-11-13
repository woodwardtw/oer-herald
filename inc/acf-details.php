<?php
/**
 * ACF Details
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


add_filter('acf/settings/save_json', 'herald_acf_json_save_point');
 
function herald_acf_json_save_point( $path ) {
    
    // update path
    $path = get_stylesheet_directory() . '/acf-json';
    
    
    // return
    return $path;
    
}

add_filter('acf/settings/load_json', 'herald_acf_json_load_point');

function herald_acf_json_load_point( $paths ) {
    
    // remove original path (optional)
    unset($paths[0]);
    
    
    // append path
    $paths[] = get_stylesheet_directory() . '/acf-json';
    
    
    // return
    return $paths;
    
}

function herald_get_repeater ($title, $top_field, $sub_field){
	if( have_rows($top_field) ):
	echo '<h2 class="">' . $title . '</h2>';
	echo '<ul>';
 	// loop through the rows of data
    while ( have_rows($top_field) ) : the_row();

        // display a sub field value
       echo '<li>' . get_sub_field($sub_field) . '</li>';

    endwhile;
    echo '</ul>';

	else :

	    // no rows found

	endif;
}

function herald_get_users($title){
	$users = get_field("members");
	if( $users ){ 
	echo '<h2>' . $title . '</h2>';
	echo '<ul class="members-list">';
	     foreach( $users as $user ){
	        echo '<li>';
	        echo '<img src="' . esc_attr(get_avatar_url($user->ID) ) . '" alt="author-avatar">';
	        echo  '<a class="author-link" href="' . get_author_posts_url($user->ID) . '">' . $user->display_name . '</a>';
	        echo '</li>';
	    }
	echo '</ul>';
	}
}

function license_badge(){
	global $post;
	$post_id = $post->ID;
	$badge_state = get_field('license', $post_id);
	if ($badge_state == 'attribution') {
		return '<a rel="license" href="http://creativecommons.org/licenses/by/4.0/"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by/4.0/88x31.png" /></a><br />This project is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by/4.0/">Creative Commons Attribution 4.0 International License</a>.';
	} if ($badge_state == 'attribution-noncommercia') {
		return '<a rel="license" href="http://creativecommons.org/licenses/by-nc/4.0/"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by-nc/4.0/88x31.png" /></a><br />This project is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc/4.0/">Creative Commons Attribution-NonCommercial 4.0 International License</a>.';
	} if ($badge_state == 'attribution-sharealike'){
		return '<a rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by-sa/4.0/88x31.png" /></a><br />This project is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/">Creative Commons Attribution-ShareAlike 4.0 International License</a>.';
	} if ($badge_state == 'attribution-noncommercial-sharealike') {
		return '<a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-sa/4.0/88x31.png" /></a><br />This project is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License</a>.';
	}


}

