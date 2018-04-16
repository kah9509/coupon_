<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package santa
 */

get_header('slim'); ?>

<?php
if( strpos(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST), 'bizforms.co.kr') ){
	$_SESSION['referer'] = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
}elseif( strpos($_SERVER['QUERY_STRING'], 'bizforms.co.kr') ){
	//$_SESSION['referer'] = '';
	$_SESSION['referer'] = $_SERVER['QUERY_STRING'];
}
?>

<?php
	$current_user = wp_get_current_user();
?>
<div class="bg_grey">
<div class="center_con clear">

<?php while ( have_posts() ) : the_post(); ?>

	<div class="s_title">
		<h1><?php the_title(); ?></h1>
	</div>

	<div class="s_wrap">
		<div class="box">
			<div class="info">
				<span class="service">Sample video</span> This is sample video.
				<?php
					$view_count = get_post_meta( get_the_ID(), 'view_count', true );
					$view_count++;
					update_post_meta( get_the_ID(), 'view_count', $view_count );
					$today = date('Ymd');
					$view_today = get_post_meta( get_the_ID(), 'view_count_' . $today, true );
					$view_today++;
					update_post_meta( get_the_ID(), 'view_count_' . $today, $view_today );
				?>
				<div class="videoinfo">view : <?php echo $view_count; ?> | Date : <?php the_modified_date(); ?></div>
			</div>

			<div class="view">
				<?php the_promotion_video(); ?>
			</div>

			<script>
			$( document ).ready(function() {
				videojs('my-video').ready(function(){
	 				var myPlayer = this;

					setInterval(function() {
						var duration = myPlayer.duration();
						var current_time = myPlayer.currentTime();
						$.ajax({
							url: "<?php echo admin_url( 'admin-ajax.php' )?>",
							type: 'POST',
							data: {
								action : 'update_course_progress',
								post_id : '<?php echo get_the_ID(); ?>',
								duration : duration,
								current_time : current_time,
								user_id : '<?php echo $current_user->ID; ?>'
							},
							success:function(data){ },
							error: function(errorThrown){ }
						});  
					}, 5000);

				});
				// $('#coupon_button').click(function(){
				// 	var confirm='<?php echo get_post_meta(get_the_ID(),'confirm',true);?>';

				// 	if(confirm=='confirmed'){
				// 		alert("쿠폰번호를 적용했습니다. 결제버튼을 눌러주세요.");
				// 	}else{
				// 		alert('쿠폰번호를 다시한번 확인해주세요');
				// 	}
				// });
				/*
				$('#add_coupon').click(function(){
					// var unused_coupon = "abcd";
					var coupon_number = $('input[name=coupon_number]').val();
					// var sale_price = '<?php echo $sale_price; ?>';

			      	// if(unused_coupon==coupon_number) alert("<?php echo wp_hash("abcd"); ?>");
			      	// else alert("취소되었습니다. 다시 시도해주세요.");
			      	
			      	$.ajax({
			      		url: "<?php echo admin_url('admin-ajax.php'); ?>",
			      		// url: "functions.php",
			      		type: 'POST',
			      		data: {
			      			action : 'using_coupon',
			      			coupon_number : coupon_number,
			      			post_id : '<?php echo get_the_ID(); ?>',
			      			user_id : '<?php echo $current_user->ID; ?>'
			      		},
			      		success:function(data){
			      			alert(data);
			      			$.ajax({
					      		url: "<?php echo admin_url('admin-ajax.php'); ?>",
					      		// url: "functions.php",
					      		type: 'POST',
					      		data: {
					      			action : 'run_coupon_shortcode',
					      			coupon_number : coupon_number,
					      			post_id : '<?php echo get_the_ID(); ?>',
					      			user_id : '<?php echo $current_user->ID; ?>',
					      			coupon_price : '<?php echo get_post_meta(get_the_ID(),'coupon_price');?>'
			      				},
			      				success:function(data){
			      					$('.coupon_button').html(data);
			      					location.reload();
			      					// alert(data);
			      				},
			      				error:function(errorThrown){}
			      			});
			      		},
			      		error:function(errorThrown){}
					});
				});
				*/
			});

			</script>

			<script>
			$( document ).ready(function() {
					
					setInterval(function() {	
						//alert( $('[name="order_amount"]').val() );
					}, 1000);

			});

			</script>


		</div>
	</div>

	<div class="s_sidebar">
		<div class="box">
			<div class="s_storeinfo">
				<div class="pic" style="background:url(<?php echo 'https://d1u6zx0zol0n2d.cloudfront.net/' . get_the_author_meta( 'user_avatar' ); ?>) center center; background-size:cover;"></div>
				<div class="name"><h3><a href="<?php echo home_url('/' . get_the_author_meta( 'user_login' )); ?>"><?php echo get_the_author_meta('display_name'); ?></a></h3>
				<?php $current_category = get_the_category(); ?>
				<span><a href="<?php echo get_category_link( get_cat_ID( $current_category[0]->name ) ); ?>"><?php echo $current_category[0]->name; ?></a></span>
				</div>
			</div>

			<div class="s_storeinfo2">
				<?php echo get_the_author_meta( 'description' ); ?>
			</div>
<!--
			<div class="s_storeinfo2">
				<div class="list">
					<div class="left"><img src="../images/store_detail01.png" style="margin-bottom:-3px;">강사명</div>
					<div class="right">방세윤</div>
				</div>
				<div class="list">
					<div class="left"><img src="../images/store_detail02.png">강의수</div>
					<div class="right">9개</div>
				</div>
				<div class="list">
					<div class="left"><img src="../images/store_detail03.png" style="margin-bottom:-2px;">전체강의</div>
					<div class="right">01:20:34</div>
				</div>
			</div>
-->
			<div class="s_paypart">
			<?php $regular_price = get_post_meta( get_the_ID(), 'regular_price', true ); ?>
			<?php $sale_price = get_post_meta( get_the_ID(), 'sale_price', true ); ?>
			<?php //add_post_meta(get_the_ID(), 'confirm', 'false');?>

				<div class="sale">
					<?php echo $regular_price; ?>원
					<div class="percent"><?php echo (1 - round(intval($sale_price) / intval($regular_price), 2))*100; ?>% sale</div>
				</div>
				<?php if( $sale_price == 0 || $sale_price == '' ) : ?>
					<div class="price">It's a free lecture.</div>	
				<?php elseif( strpos($_SESSION['referer'], 'bizforms.co.kr') && get_the_ID() == 718 ) : ?>
					<div class="sale">
						<?php echo $sale_price; ?>won
						<div class="percent">bizform Special discount</div>
					</div>
						<?php
							$sale_price = 0;
							if($sale_price<=0){
								$sale_price = 0;
							}
						?>
					<div class="price"><?php echo $sale_price;?>won</div>

				<?php else : ?>
					<div class="price"><?php echo $sale_price; ?>won</div>
				<?php endif; ?>
				<!--<a href="#" class="bt_sale1">찜하기</a>-->
				<?php
					$wishlist = get_user_meta( $current_user->ID, 'wishlist_course' );
					if( in_array( get_the_ID() , $wishlist) ){
						the_removefromwishlistform();
					}else{
						the_addtowishlistform();
					}
				?>
				<?php $author_id=$post->post_author; ?>
				<!-- <?php if($author_id==get_current_user_id()) : ?> -->
				<!-- <div class="bt_sale2" id=insert_coupon>쿠폰추가하기</div> -->
				<!-- <?php else : ?> -->
				<!-- <?php endif; ?> -->
				
				
				<?php
					$enrolled_course = get_user_meta( $current_user->ID, 'enrolled_course' );
					$enrolled_group = get_user_meta( $current_user->ID, 'enrolled_group' );
					$enrolled_bundle = get_user_meta( $current_user->ID, 'enrolled_bundle' );

					foreach ($enrolled_bundle as $bundle_id ) {
						$bundle_course = get_post_meta( $bundle_id, 'bundle_course', false );

						foreach ($bundle_course as $course_id ) {
							array_push( $enrolled_course, $course_id);
						}
					}
					$coupon_confirm=get_post_meta(get_the_ID(),'confirm',true);

					if( in_array( get_the_ID(), $enrolled_course ) ){

						echo '<div class="bt_sale2">수강중인 강의입니다</div>'; 

					}elseif($sale_price <= 0){
						the_addtoenrolledcourseform();
					}
					else{
						if(strcmp($coupon_confirm,"confirmed")){
							the_usingcouponform();
						}elseif(strcmp($coupon_confirm,"unconfirmed")){
							the_confirmedcouponform();
						}
						echo do_shortcode('[iamport_payment_button title="' . get_the_title() . '" description="Please fill out the following information and proceed with payment." name="' . get_the_title() . '" amount="' . $sale_price . '" pay_method_list="card,trans,vbank,phone" class="bt_sale2"] 일반결제 [/iamport_payment_button]');
					}
				?>
				
			</div>

		</div>

		<div class="box">
			<h2>Curriculum</h2>
			<br>
			<?php $parent_course = get_the_ID(); ?>
			<?php $course_item = get_post_meta( get_the_ID(), 'course_item' ); ?>
			<?php if( !empty($course_item) ) : ?>
				<?php $the_query = new WP_Query( array( 'post__in' => $course_item, 'post_type' => 'course-item', 'posts_per_page' => -1 , 'orderby' => 'post__in' ) ); ?>
				<?php $index = 1; ?>
				<?php if ( $the_query->have_posts() ) : ?>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<a href="<?php echo get_permalink() . '?post_id=' . $parent_course ; ?>"> <?php echo $index; ?>. <?php echo mb_strimwidth(get_the_title(), '0', '30', '...', 'utf-8'); ?> <span><i class="fa fa-play-circle-o" aria-hidden="true"></i></span></a>
					<?php $index++; ?>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				<?php else : ?>
				<?php endif; ?>
			<?php else : echo 'There is no lecture'; ?>
			<?php endif; ?>
		</div>

		<div class="box">
			<h2>Learning Materials/Tasks</h2>
			<br>
			<?php $parent_course = get_the_ID(); ?>
			<?php $handout = get_post_meta( get_the_ID(), 'handout' ); ?>
			<?php if( !empty($handout) ) : ?>
				<?php $the_query = new WP_Query( array( 'post__in' => $handout, 'post_type' => 'handout', 'posts_per_page' => -1 , 'orderby' => 'post__in' ) ); ?>
				<?php $index = 1; ?>
				<?php if ( $the_query->have_posts() ) : ?>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

						<?php
							$enrolled_course = get_user_meta( $current_user->ID, 'enrolled_course' );
							$enrolled_group = get_user_meta( $current_user->ID, 'enrolled_group');
							foreach ($enrolled_group as $group_id ) {
								$group_course = get_post_meta( $group_id, 'group_course' );
								$enrolled_student = get_post_meta( $group_id, 'enrolled_student' );

								if( in_array($current_user->ID, $enrolled_student ) ){
									foreach ($group_course as $course_id ) {
										if( $course_id == get_the_ID() ){
											array_push( $enrolled_course, $course_id);
											break;
										} 
									}
								}
							}

							if( in_array( $parent_course, $enrolled_course ) ){
								echo '<a href="https://d1futmf8skvd6x.cloudfront.net/' . get_the_author_meta( 'user_login' ) . '/' . urlencode( get_post_meta( get_the_ID(), 'file_key', true ) ) . '" download target="_blank">' . $index . '번. ' . mb_strimwidth(get_the_title(), '0', '30', '...', 'utf-8') . '<span><i class="fa fa-cloud-download" aria-hidden="true"></i></span></a>';
							}else{
								echo $index . '번. ' . mb_strimwidth(get_the_title(), '0', '30', '...', 'utf-8') . '<span style="float:right;"><i class="fa fa-cloud-download" aria-hidden="true"></i></span><br><br>';
							}
						?>

					<?php $index++; ?>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				<?php else : ?>
					<?php echo 'There is no Learning Materials/Tasks'; ?>
				<?php endif; ?>
			<?php else : echo 'There is no Learning Materials/Tasks'; ?>
			<?php endif; ?>
		</div>

		<div class="box">
			<h2>Textbook/Preparation</h2>
			<br>
			<?php $parent_course = get_the_ID(); ?>
			<?php $product = get_post_meta( get_the_ID(), 'product' ); ?>
			<?php if( !empty($product) ) : ?>
				<?php $the_query = new WP_Query( array( 'post__in' => $product, 'post_type' => 'product', 'posts_per_page' => -1 , 'orderby' => 'post__in' ) ); ?>
				<?php if ( $the_query->have_posts() ) : ?>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<img src="https://d1u6zx0zol0n2d.cloudfront.net/<?php echo get_post_meta( get_the_ID(), 'thumbnail', true); ?>" style="max-width:100%; margin-bottom: 1em;">
						<a href="<?php echo get_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
						<?php the_content(); ?>
						<br>
						<?php echo get_post_meta(get_the_ID(), 'sale_price', true); ?>won <a href="<?php echo get_permalink(); ?>" style="float: right;">Buying</a>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				<?php else : ?>
					<?php echo 'There is no textbook/preparation'; ?>
				<?php endif; ?>
			<?php else : echo 'There is no textbook/preparation'; ?>
			<?php endif; ?>
		</div>

	</div><!--.s_sidebar-->

	<div class="s_wrap">
		<div class="box">
			<h2>Introduction of Lecture</h2>
			<br>
			<?php the_content(); ?>
		</div>
	</div>

	<div class="s_wrap">
		<div class="box">
			<div class="total-progress">
				<?php $parent_course = get_the_ID(); ?>
				<?php $course_item = get_post_meta( get_the_ID(), 'course_item' ); ?>
				<?php if( !empty($course_item) ) : ?>
					<?php $the_query = new WP_Query( array( 'post__in' => $course_item, 'post_type' => 'course-item', 'posts_per_page' => -1 ) ); ?>
					<?php if ( $the_query->have_posts() ) : ?>
						<?php $duration = 0; $progress=0; ?>
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							<?php $duration = $duration + intval(get_post_meta( get_the_ID(), 'duration', true )); ?>
							<?php $progress = $progress + intval(get_user_meta( $current_user->ID, get_the_ID(), true )); ?>
						<?php endwhile; ?>
							<i class="fa fa-clock-o" aria-hidden="true"></i>Total lecture hours <?php echo round( $duration / 60, 0); ?>minute
							<!--<span><i class="fa fa-caret-square-o-right" aria-hidden="true"></i>강의등록일 2010-01-01 </span>-->
						<?php wp_reset_postdata(); ?>
					<?php else : ?>
					<?php endif; ?>
				<?php else : echo 'There is no lecture'; ?>
				<?php endif; ?>
			</div>

			<?php $parent_course = get_the_ID(); ?>
			<?php $course_item = get_post_meta( get_the_ID(), 'course_item' ); ?>
			<?php if( !empty($course_item) ) : ?>
				<?php $the_query = new WP_Query( array( 'post__in' => $course_item, 'post_type' => 'course-item', 'posts_per_page' => -1, 'order' => 'ASC' ) ); ?>
				<?php if ( $the_query->have_posts() ) : ?>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<div class="single-progress">
								<div class="infonow">
									<?php $duration = get_post_meta( get_the_ID(), 'duration', true ); ?>
									<?php $progress =  get_user_meta( $current_user->ID, get_the_ID(), true ); ?>
									<div><?php the_title(); ?><span><?php echo round( intval($duration) / 60, 0 ) ; ?>분</span></div>
									<div class="bargraph">
										<div class="green" style="width:<?php echo round( intval($progress) / intval($duration), 2 )*100 ; ?>%;"></div>
									</div>
								</div>
								<div class="classlink">
									<a href="<?php echo get_permalink() . '?post_id=' . $parent_course ; ?>">View the lecture</a>
								</div>
						</div>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				<?php else : ?>
				<?php endif; ?>
			<?php else : echo 'There is no lecture'; ?>
			<?php endif; ?>

		</div><!--.box-->
	</div><!--.s_wrap-->

	<div class="s_wrap">
	<div class="box">

	<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
	?>
	</div>
	</div>
		

	<!--<div class="s_wrap">
	<div class="box">

							<div class="s_other_list">
								<div class="classimg" style="background:url(../images/sample_img01.jpg) center center;">
									<div class="darkbar">
										￦ 50,000
										<span>
											<img src="../images/icon_main_star2_on.png" alt=""> (4)
										</span>
									</div>
								</div>
								<div class="title">
									<div class="profileimg" style="background:url(../images/profile2.jpg); background-size:cover;"></div>
									<h1>강의제목 노출되는 곳</h1><span>예현방가</span>
								</div>
							</div>

							<div class="s_other_list">
								<div class="classimg" style="background:url(../images/sample_img01.jpg) center center;">
									<div class="darkbar">
										￦ 50,000
										<span>
											<img src="../images/icon_main_star2_on.png" alt=""> (4)
										</span>
									</div>
								</div>
								<div class="title">
									<div class="profileimg" style="background:url(../images/profile2.jpg); background-size:cover;"></div>
									<h1>강의제목 노출되는 곳</h1><span>예현방가</span>
								</div>
							</div>

							<div class="s_other_list">
								<div class="classimg" style="background:url(../images/sample_img01.jpg) center center;">
									<div class="darkbar">
										￦ 50,000
										<span>
											<img src="../images/icon_main_star2_on.png" alt=""> (4)
										</span>
									</div>
								</div>
								<div class="title">
									<div class="profileimg" style="background:url(../images/profile2.jpg); background-size:cover;"></div>
									<h1>강의제목 노출되는 곳</h1><span>예현방가</span>
								</div>
							</div>

							<div class="s_other_list">
								<div class="classimg" style="background:url(../images/sample_img01.jpg) center center;">
									<div class="darkbar">
										￦ 50,000
										<span>
											<img src="../images/icon_main_star2_on.png" alt=""> (4)
										</span>
									</div>
								</div>
								<div class="title">
									<div class="profileimg" style="background:url(../images/profile2.jpg); background-size:cover;"></div>
									<h1>강의제목 노출되는 곳</h1><span>예현방가</span>
								</div>
							</div>
						</div>
		</div>
	</div>-->


<?php endwhile; ?>
</div>
</div>


<?php get_footer(); ?>
