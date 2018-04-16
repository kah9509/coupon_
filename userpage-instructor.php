<?php
/**
 * Template Name: Userpage Instructor
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
get_header('slim');
?>

<div class="bg_grey">
	<div class="center_con">
	
<?php while( have_posts() ) : the_post(); ?>
	<?php get_template_part('page-templates/userpage-header'); ?>
	<div class="mp_contents">

				<h1><?php echo get_the_author_meta( 'display_name' ); ?>이(가) 개설한 강의의 <span>최근 10일간 조회수</span></h1>

				<div class="mp_myclass_list">

				<?php
				$past10days=[date("Ymd",strtotime("-9 day")),
							date("Ymd",strtotime("-8 day")),
							date("Ymd",strtotime("-7 day")),
							date("Ymd",strtotime("-6 day")),
							date("Ymd",strtotime("-5 day")),
							date("Ymd",strtotime("-4 day")),
							date("Ymd",strtotime("-3 day")),
							date("Ymd",strtotime("-2 day")),
							date("Ymd",strtotime("-1 day")),
							date("Ymd") ];

				$view_count=[date("Ymd",strtotime("-9 day")) =>0,
							date("Ymd",strtotime("-8 day"))=>0,
							date("Ymd",strtotime("-7 day"))=>0,
							date("Ymd",strtotime("-6 day"))=>0,
							date("Ymd",strtotime("-5 day"))=>0,
							date("Ymd",strtotime("-4 day"))=>0,
							date("Ymd",strtotime("-3 day"))=>0,
							date("Ymd",strtotime("-2 day"))=>0,
							date("Ymd",strtotime("-1 day"))=>0,
							date("Ymd")=>0 ];
				?>

				<?php
					foreach( $past10days as $day ){ 
						$the_query = new WP_Query( array( 'author' => get_the_author_meta('ID') ) );
						if ( $the_query->have_posts() ) :
						while ( $the_query->have_posts() ) : $the_query->the_post();
						$view_count[$day] = $view_count[$day] + intval(get_post_meta(get_the_ID(), 'view_count_' . $day , true ));
						endwhile;
						wp_reset_postdata();
						else :
						endif;
					 }
				 ?>

					<div class="vGraph">
						<ul>
					<?php foreach( $view_count as $day => $view ){ ?>
						<li><span class="gTerm"><?php echo date("m/d", strtotime($day)); ?></span><span class="gBar" style="height:<?php echo $view; ?>px; max-height:200px;"><span><?php echo $view; ?>회</span></span></li>
					<?php } ?>
						</ul>
					</div>

					
				</div>

				<div class="mp_line"></div><!--경계선-->

				<h1><?php echo get_the_author_meta( 'display_name' ); ?><span>이(가) 개설한 강좌</span></h1>

				<div class="mp_myclass_list">

				<?php $author_id = get_the_author_meta('ID'); ?>
				<?php $the_query = new WP_Query( array( 'posts_per_page' => -1, 'author__in' => array( $author_id ), 'post_status' => 'publish' ) ); ?>
                <?php if ( $the_query->have_posts() ) : ?>
                    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                    <?php $current_category = get_the_category(); ?>
                    	<a href="<?php echo get_permalink(); ?>">
						<div class="mp_mclass_list">
							<div class="classimg" style="background:url(https://d1u6zx0zol0n2d.cloudfront.net/<?php echo urlencode(get_post_meta( get_the_ID(), 'thumbnail', true) ); ?>) center center no-repeat; background-size:cover; height:350px;">
								<div class="darkbar">
									<?php echo get_post_meta( get_the_ID(), 'sale_price', true ); ?>원
									<span>
										<?php the_post_rating( get_the_ID() ); ?>
									</span>
								</div>
							</div>
							<div class="title">
								<div class="profileimg" style="background:url(https://d1u6zx0zol0n2d.cloudfront.net/<?php echo get_the_author_meta( 'user_avatar' ); ?>); background-size:cover;"></div>
								<h1><?php echo get_the_title(); ?></h1><span><?php echo $current_category[0]->name; ?></span>
							</div>
						</div>
						</a>

                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php else : ?>
                	개설한 강좌가 없습니다
                <?php endif; ?>
					
				</div>

				<div class="mp_line"></div><!--경계선-->


				<h1><?php echo get_the_author_meta( 'display_name' ); ?><span>이(가) 개설한 그룹</span></h1>

				<div class="mp_myclass_list">

				<?php $author_id = get_the_author_meta('ID'); ?>
				<?php $the_query = new WP_Query( array( 'posts_per_page' => -1, 'post_type' => 'group', 'author__in' => array( $author_id ), 'post_status' => 'publish' ) ); ?>
                <?php if ( $the_query->have_posts() ) : ?>
                    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                    <?php $current_category = get_the_category(); ?>
                    	<a href="<?php echo get_permalink(); ?>">
						<div class="mp_mclass_list">
							<div class="classimg" style="background:url(https://d1u6zx0zol0n2d.cloudfront.net/<?php echo urlencode(get_post_meta( get_the_ID(), 'thumbnail', true) ); ?>) center center no-repeat; background-size:cover;">
							</div>
							<div class="title">
								<div class="profileimg" style="background:url(https://d1u6zx0zol0n2d.cloudfront.net/<?php echo get_the_author_meta( 'user_avatar' ); ?>); background-size:cover;"></div>
								<h1><?php echo get_the_title(); ?></h1><span><?php echo $current_category[0]->name; ?></span>
							</div>
						</div>
						</a>

                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php else : ?>
                	개설한 그룹이 없습니다
                <?php endif; ?>
					
				</div>

				<div class="mp_line"></div><!--경계선-->

				<h1><?php echo get_the_author_meta( 'display_name' ); ?><span>의 번들 강의</span></h1>

				<div class="mp_mybundle_list">

				<?php $author_id = get_the_author_meta('ID'); ?>
				<?php $the_query = new WP_Query( array( 'posts_per_page' => -1, 'post_type' => 'bundle', 'author__in' => array( $author_id ), 'post_status' => 'publish' ) ); ?>
                <?php if ( $the_query->have_posts() ) : ?>
                    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                    <?php $current_category = get_the_category(); ?>
                    	<a href="<?php echo get_permalink(); ?>">
						<div class="mp_mbundle_list">
							<div class="classimg">
								<?php $bundle_course = get_post_meta(get_the_ID(), 'bundle_course', false); ?>
								<?php foreach ($bundle_course as $value) { ?>
									<img class="bundleimg" src="https://d1u6zx0zol0n2d.cloudfront.net/<?php echo urlencode(get_post_meta( $value, 'thumbnail', true) ); ?>">
								<?php } ?>
								<div class="darkbar">
									<?php echo get_post_meta( get_the_ID(), 'sale_price', true ); ?>원
									<span>
										<?php the_post_rating( get_the_ID() ); ?>
									</span>
								</div>
							</div>
							<div class="title">
								<div class="profileimg" style="background:url(https://d1u6zx0zol0n2d.cloudfront.net/<?php echo get_the_author_meta( 'user_avatar' ); ?>); background-size:cover;"></div>
								<h1><?php echo get_the_title(); ?></h1><span><?php echo $current_category[0]->name; ?></span>
							</div>
						</div>
						</a>

                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php else : ?>
                	개설한 강좌가 없습니다
                <?php endif; ?>
					
				</div>

	</div><!--mp_contents-->


<?php //get_template_part('page-templates/userpage-footer'); ?>

<?php endwhile; ?>
	</div>
</div>




<div class="bg_grey">
<div class="center_con">
	<div class="mp_contents">
<?php
if(is_user_logged_in() && wp_get_current_user()->user_login=='buoasis') {
$args = array( 'role' => 'Subscriber', 'orderby' => 'registered', 'order' => 'DSC' );
$user_query = new WP_User_Query( $args );
?>
    <h1>가입회원목록(총 <?php echo count($user_query->results) ?> 명)</h1><br>
	<table border="0" cellspacing="0" cellpadding="0" class="ms_table">
			<tbody>
				<tr>
					<td>아이디</td>
					<td>이름</td>
					<td>이메일</td>
					<td>가입경로</td>
					<td>가입일</td>
					<td>회원페이지</td>
				</tr>
<?php
if ( ! empty( $user_query->results ) ) {
	foreach ( $user_query->results as $user ) {
?>
		<tr>
			<td><?php echo $user->user_login; ?></td>
			<td><?php echo $user->display_name; ?></td>
			<td><?php echo $user->user_email; ?></td>
			<td><?php echo $user->user_group; ?></td>
			<td><?php echo $user->user_registered ?></td>
			<td><a href="<?php echo home_url($user->user_login); ?>">이동</a></td>
		</tr>	
<?php
	}
} 
}
?>
				</tbody>
		</table>
	</div>
</div>
</div>



<?php get_footer(); ?>