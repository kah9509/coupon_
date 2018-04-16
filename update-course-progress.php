<?php
/*
Plugin Name: Update Course Progress
Plugin URI: https://santauniv.com
Description: 
Author: Santa
Version: 1.0
Author URI: https://santauniv.com
*/


function update_course_progress() {
	$post_id = $_POST['post_id'];
	$duration = $_POST['duration'];
	$current_time = $_POST['current_time'];
	$user_id = $_POST['user_id'];

	update_post_meta( $post_id, 'duration', $duration );

	$progress = get_user_meta( $user_id, $post_id, true );

	if( $current_time > $progress ){
		update_user_meta( $user_id, $post_id, $current_time );
	}

	die();
}

add_action( 'wp_ajax_update_course_progress', 'update_course_progress' );
//add_action( 'wp_ajax_nopriv_update_course_progress', 'update_course_progress' );

?>