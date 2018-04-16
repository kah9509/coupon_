<?php
function random_str($type = 'alphanum', $length = 8)
{
    switch($type)
    {
        case 'basic'    : return mt_rand();
            break;
        case 'alpha'    :
        case 'alphanum' :
        case 'num'      :
        case 'nozero'   :
                $seedings             = array();
                $seedings['alpha']    = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $seedings['alphanum'] = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $seedings['num']      = '0123456789';
                $seedings['nozero']   = '123456789';
                
                $pool = $seedings[$type];
                
                $str = '';
                for ($i=0; $i < $length; $i++)
                {
                    $str .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
                }
                return $str;
            break;
        case 'unique'   :
        case 'md5'      :
                    return md5(uniqid(mt_rand()));
            break;
    }
}

// echo "Alpha-Numeric: " . random_str('alphanum', 12) . "\n";

//0.variable create
$myfile = fopen("C:\Users\admin\Desktop\iamport\coupon.txt", "w") or die("Unable to open file!");
//1. create

for($i=0;$i<5000;$i++){
    $coupon[$i]=random_str('alphanum', 12);

    $txt = $coupon[$i].chr(13).chr(10);
    fwrite($myfile, $txt);


}
fclose($myfile);    
$unique_coupon=array_unique($coupon);
echo count($unique_coupon);

?>