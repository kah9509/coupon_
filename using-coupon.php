<?php
/*
Plugin Name: Using coupon
Plugin URI: https://santauniv.com
Description: 
Author: Santa
Version: 1.0
Author URI: https://santauniv.com
*/
//add_action('wp_ajax_using_coupon','using_coupon');
add_action('admin_post_using_coupon_hook','using_coupon');

function using_coupon(){

	$coupon_number=$_POST['coupon_number']; 
	$post_id = (int)$_POST['post_id'];
	$user_id = $_POST['user_id'];

	//@hash change
	//$hash_coupon_number = wp_hash($coupon_number);
	$key='unused_coupon';
	$get_unused_coupon=get_post_meta($post_id, $key);
	$confirm=get_post_meta($post_id,'confirm');
	//쿠폰번호 비교하는 코드 
	foreach ($get_unused_coupon as $key => $value) {
		if($coupon_number==$value){
			update_post_meta($post_id, 'confirm','confirmed');	
			add_post_meta( $post_id, 'coupon_price',500);	
		}
	}
	$confirm=get_post_meta($post_id,'confirm',true);
	if(strcmp($confirm,"unconfirmed")){
		wp_redirect( home_url( '/' . $post_id ) );

	}elseif(strcmp($confirm,"confirmed")){
		update_post_meta( $post_id, 'confirm','unconfirmed');
		wp_redirect( home_url( '/' . $post_id ) );

	}
	
	die();
}
function the_usingcouponform(){
?>
<form action="<?php echo esc_url(admin_url('/admin-post.php'));?>" method="POST">
	<input type="hidden" name="action" value="using_coupon_hook">
	<input type="hidden" name="post_id" value="<?php echo get_the_ID();?>">
	<input type="hidden" name="user_id" value="<?php echo $current_user->ID;?>">
	쿠폰 번호 입력 <input type="text" style="box-sizing:border-box; width:100%; margin: 5px 0 5px 0;" name="coupon_number">
	<input type="submit" class="bt_sale2" value="쿠폰적용하기" id='coupon_button'>
</form>
<?php
}

function the_confirmedcouponform(){
	$coupon_price=get_post_meta(get_the_ID(),'coupon_price',true);
	echo '<br>';
	echo do_shortcode('[iamport_payment_button title="' . get_the_title() . '" description="Please fill out the following information and proceed with payment." name="' . get_the_title() . '" amount="' . $coupon_price . '" pay_method_list="card,trans,vbank,phone" class="bt_sale2" redirect_after="'.home_url('/'.get_the_ID());.'"] 쿠폰결제 [/iamport_payment_button]');

	update_post_meta($post_id, 'confirm','unconfirmed');	
}

?>