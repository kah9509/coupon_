<?php
/**
 * Template Name: File Uploader
 *
 * Description: Twenty Twelve loves the no-sidebar look as much as
 * you do. Use this page template to remove the sidebar from any page.
 *
 * Tip: to remove the sidebar from all posts and pages simply remove
 * any active widgets from the Main Sidebar area, and the sidebar will
 * disappear everywhere.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
get_header();
?>
<div class="bg_grey">
	<div class="center_con">
<?php get_template_part('page-templates/userpage-common-header'); ?>
			<div class="ms_contents">

				<h1><span>1.쿠폰추가</span>할 강의를 선택해주세요</h1>
				<form action="<?php echo esc_url(admin_url('/admin-post.php')); ?>" method="POST">
					<div class="ms_form_wrap" style="width:80%;">
						<h2>강의 선택</h2>
						<?php the_courseitmelistforcoupon(); ?>
					</div>
					<br>
					<h1><span>2.쿠폰번호</span> 입력</h1>
					
					<div class="ms_form_wrap" style="width:80%;">
						<h2>번호를 입력해주세요</h2>
						<input type="text" name="coupon_number" style="box-sizing:border-box; width:100%; margin: 5px 0 5px 0;">
					</div>
					<br>
					<h1><span>3.판매가격</span> 입력</h1>

					<div class="ms_form_wrap" style="width:80%;">
						<h2>쿠폰 적용 후 판매가격</h2>
						<input type="text" name="coupon_price" style="box-sizing:border-box; width:20%; margin: 5px 0 5px 0;"> 원
					</div>
					<div class="ms_line"></div>

					<input type="submit" class="bt_sale2" id="register_coupon_submit" value="추가하기">
					<input type="hidden" name="action" value="register_coupon_hook" />

				</form>
			</div>
	</div>
</div>

<?php get_footer(); ?>
