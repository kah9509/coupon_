<?php

$fp = fopen("/var/www/html/wp-content/themes/santa/coupon.txt","r");
/*
if(!$fp) {  // $fp파일이 없으면 에러 출력 
	echo "error"; 
}else{
	echo "fopen success\n";
}
*/
while( !feof($fp) ) {
	$doc_data = fgets($fp); 
	$arr[]=$doc_data;
}

for($i=0;$i<1;$i++){
	
	$new_post = array(
	            'post_title' => $arr[$i],
	            'post_content' => '',
	            'post_status' => 'private',
	            'post_author' => $user_ID,
	            'post_category' => array('coupon');
	);

	wp_insert_post($new_post)

}
fclose($fp); 




?>