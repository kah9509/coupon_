<?php
/*
Plugin Name: Run coupon shortcode
Plugin URI: https://santauniv.com
Description: 
Author: Santa
Version: 1.0
Author URI: https://santauniv.com
*/

function run_coupon_shortcode(){
	//쿠폰번호DB와 비교하고, sale_price 수정하는 코드 작성하는 곳,
	$coupon_number=$_POST['coupon_number']; 
	$post_id = $_POST['post_id'];
	$user_id = $_POST['user_id'];
	$coupon_price = $_POST['counpon_price'];
	echo 'aa';
	
	// echo do_shortcode('[iamport_payment_button title="' . get_the_title() . '" description="Please fill out the following information and proceed with payment." name="' . get_the_title() . '" amount="' . $coupon_price . '" pay_method_list="card,trans,vbank,phone" class="bt_sale2"] 쿠폰결제 [/iamport_payment_button]');

	die();

}

add_action('wp_ajax_run_coupon_shortcode','run_coupon_shortcode');

?>