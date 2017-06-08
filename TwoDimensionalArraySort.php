<?php


//二维数组排序



function TwoDimensionalArraySort($array=array(),$field="id",$sort_rule="asc")
{
	if(!is_array($array))
	{
		return false;
	}
	$key_list_rule=$result=array();
	foreach($array as $key=>$v)
	{
		$key_list_rule[$key]=$v[$field];
	}
	switch($sort_rule)
	{
		case "asc":
			//升序排列
			asort($key_list_rule);
			break;
		case "desc":
			//降序排列
			arsort($key_list_rule);
			break;
		case "nat":
			//自然排序
			natcasesort($key_list_rule);
			break;
		default :
			asort($key_list_rule);
			break;
	}
	foreach($key_list_rule as $k=>$v)
	{
		$result[$k]=$array[$k];
	}
	return $result;
}



$array=array(
    1=>array("id"=>1,"name"=>"元素1","sort_num"=>5),
    2=>array("id"=>2,"name"=>"元素2","sort_num"=>2),
    3=>array("id"=>3,"name"=>"元素3","sort_num"=>3),
    4=>array("id"=>4,"name"=>"元素4","sort_num"=>8),
    5=>array("id"=>5,"name"=>"元素5","sort_num"=>1),
    6=>array("id"=>6,"name"=>"元素6","sort_num"=>0),
    7=>array("id"=>7,"name"=>"元素7","sort_num"=>6),
);

$sort_result=TwoDimensionalArraySort($array,"sort_num","asc");

var_dump($sort_result);
















?>