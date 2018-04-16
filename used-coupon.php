<?php
/*
Plugin Name: Used coupon
Plugin URI: https://santauniv.com
Description: 
Author: Santa
Version: 1.0
Author URI: https://santauniv.com
*/
//결제 완료되고 난 후


function used_coupon(){
	//사용된 쿠폰번호에 insert,
	//사용하기 전 쿠폰번호에서 delete 해주는 코드 작성하는 곳
	echo("결제 완료 후");
}

add_action('wp_ajax_used_coupon','used_coupon');
?>