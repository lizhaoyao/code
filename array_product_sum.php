<?php
 
function array_product_sum($key_array=array(),$value_array=array())
{
    //数组交叉相乘后再相加
    $sum=0;
    if(count($key_array)!=count($value_array))
    {
        //说明两个数组的数量不等
        return false;
    }
    $key_array=array_values($key_array);
    $value_array=array_values($value_array);
    foreach($key_array as $k=>$v)
    {
        $sum+=$v*$value_array[$k];
    }
    return $sum;
}
$key_array=explode(":",date("H:i:s"));//获取时分秒
$value_array=array(3600,60,1);//定义时分秒的换算等级单位
$result=array_product_sum($key_array,$value_array);//得到总结果
var_dump($result);




?>