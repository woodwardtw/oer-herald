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

function herald_get_users(){
	$users = get_field("members");
	if( $users ){ 
	echo '<h2>Members</h2>';
	echo '<ul class="members-list">';
	     foreach( $users as $user ){
	        echo '<li>';
	        echo '<img src="' . esc_attr(get_avatar_url($user->ID) ) . '" alt="author-avatar">';
	        echo  '<a href="' . esc_attr($user->user_url) . '">' . $user->display_name . '</a>';
	        echo '</li>';
	    }
	echo '</ul>';
	}
}