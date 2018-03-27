<?php

/**
 * Add by lizhaoyao
 * Add at 2018-03-27
 * 从二维数组中根据某个字段查出某一行一维数组
 * @param array $array        [需要查找的数组]
 * @param string $column      [根据字段查找]
 * @param string $find_value  [需要查找的值]
 * @return array              [返回数组]
 */
function get_array_by_column_find_one($array=array(),$column='',$find_value='')
{
    foreach ($array as $value)
    {
        if($value[$column]===$find_value)
        {
            return $value;//如果找到了这个字段等于这个值 立即返回
        }
    }
    return array();//啥也没找到 返回空数组
}
$array=array(
    array("name"=>"王五","birth"=>"1996-08-07","subject"=>"PHP",'snum'=>'0150427001'),
    array("name"=>"张三","birth"=>"1997-12-07","subject"=>"PHP",'snum'=>'0150427002'),
    array("name"=>"赵四","birth"=>"1996-02-07","subject"=>"PHP",'snum'=>'0150427003'),
);
$result=get_array_by_column_find_one($array,'snum','0150427002');
var_dump($result);exit();



?>
