<?php
 
/**
 * 计算获取两个数组对应交叉相乘后求和的结果
 * @param array $key_array   [基数数组]
 * @param array $value_array [熵数组]
 * @return bool|int          [返回结果]
 */
function array_product_sum($key_array=array(),$value_array=array())
{
	//数组交叉相乘后再相加
	$sum=0;//定义初始化返回值
	if(count($key_array)!=count($value_array))
	{
		//说明两个数组的数量不等
		return false;
	}
	$key_array=array_values($key_array);//转为索引数组
	$value_array=array_values($value_array);//转为索引数组
	foreach($key_array as $k=>$v)
	{
		$sum+=$v*$value_array[$k];//两个数组元素对应相乘 然后相加
	}
	return $sum;//返回计算结果
}
$key_array=explode(":",date("H:i:s"));//获取时分秒
$value_array=array(3600,60,1);//定义时分秒的换算等级单位
$result=array_product_sum($key_array,$value_array);//得到总结果
var_dump($result);




?>