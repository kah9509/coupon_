<?php

//error_reporting(E_ALL);
//ini_set("display_errors", 1);





//필요한 자바스크립트, CSS를 로드한다 (수정:2017-01-02)
function add_theme_scripts() {
	wp_enqueue_style( 'fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' ); /* https://www.bootstrapcdn.com/fontawesome/ */
	wp_enqueue_style( 'videojscss', '//vjs.zencdn.net/5.8.8/video-js.css' ); /* http://videojs.com/getting-started/ */

	wp_enqueue_script( 'jQuery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js' ); /* https://developers.google.com/speed/libraries/ */
	wp_enqueue_script( 'videojs', '//vjs.zencdn.net/5.8.8/video.js' ); /* http://videojs.com/getting-started/ */
	wp_enqueue_script( 'videojs-ie8', '//vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js' ); /* http://videojs.com/getting-started/ */
	wp_enqueue_script( 'masonry', '//unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js' ); /* http://masonry.desandro.com/#cdn */
}
add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

add_theme_support( 'menus' );


function santa_scripts() {



	// Theme stylesheet.
	wp_enqueue_style( 'santa', get_stylesheet_uri() );

}
add_action( 'wp_enqueue_scripts', 'santa_scripts' );

function prefix_send_email_to_admin() {
 	$email = $_POST['email'];
	//echo $email;
	wp_die();
}


//add_action( 'admin_post_nopriv_contact_form', 'prefix_send_email_to_admin' );
//add_action( 'admin_post_contact_form', 'prefix_send_email_to_admin' );

add_action( 'wp_ajax_contact_form', 'prefix_send_email_to_admin' );
add_action( 'wp_ajax_nopriv_contact_form', 'prefix_send_email_to_admin' );

add_theme_support( 'post-thumbnails' );

?>
