<?php
//二维数组排序
/**
 * @param array $array       [要参与排序的数组]
 * @param string $field      [排序字段]
 * @param string $sort_rule  [排序规则 升序|降序|自然序]
 * @return array|bool        [返回排序好的数组]
 */
function TwoDimensionalArraySort($array=array(),$field="id",$sort_rule="asc")
{
	if(!is_array($array))
	{
		return false;//如果不是数组 立即返回false
	}
	$key_list_rule=$result=array();//初始化返回结果和排序键存储的数组
	foreach($array as $key=>$v)
	{
		$key_list_rule[$key]=$v[$field];//遍历数组 把二维数组的key存储下来对应我们要排序的那个字段形成排序规则
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
		$result[$k]=$array[$k];//按照那个字段排序后的数组进行遍历 将原来而数组的元素逐个添加到排序结果中
	}
	return $result;//返回结果
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

$sort_result=TwoDimensionalArraySort($array,"sort_num","asc");//将数组按照 sort_num 字段升序排列
var_dump($sort_result);

?>