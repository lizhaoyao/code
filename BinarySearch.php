<?php

/**
 * 递归二分查找
 * @param array $array       [要查找的数组]
 * @param string $target     [目标数据]
 * @param int $start         [查找起始位置]
 * @param int $end           [查找终止位置]
 * @return bool|float        [返回查找结果]
 */
function recursion_binary_search($array=array(),$target='',$start=0,$end=1)
{
    $middle_index = intval(($start+$end)/2); // 定位中间位置的索引
    $middle_value = $array[$middle_index];//取得中间项的值
    if($middle_value == $target)
    {
        return $middle_index;//找到了目标位置 立即返回
    }else if($middle_value >$target)
    {
        if($start > $middle_index-1)//如果开始位置都比结束位置大了，表示肯定找不到了
        {
            return false;
        }
        //中间项比要找的目标大 就去左边找吧
        $re = recursion_binary_search($array,$target,$start,$middle_index-1);
    }else
    {
        if($middle_index+1 > $end)//如果开始位置比结束位置大了，表示肯定找不到了
        {
            return false;
        }
        //中间项比要找的目标小 就去右边找吧
        $re = recursion_binary_search($array,$target,$middle_index+1,$end);
    }
    return $re;
}

/**
 * 迭代二分查找
 * @param array $array       [要查找的数组]
 * @param string $target     [目标数据]
 * @param int $start         [查找起始位置]
 * @param int $end           [查找终止位置]
 * @return bool|float        [返回查找结果]
 */
function iteration_binary_search($array=array(),$target='',$start=0,$end=1)
{
    $middle_index=intval(($start+$end)/2);
    while($start<=$end)
    {
        //说明还能继续寻找
        if($array[$middle_index]==$target)
        {
            //找到了
            return $middle_index;
        }elseif($array[$middle_index]>$target)
        {
            //说明中间元素大于目标元素 在前半部分
            $end=$middle_index-1;//终止位置从刚刚找到的中间位置的左边那个位置结束
            $middle_index=intval(($start+$end)/2);//重新计算中间位置
        }else
        {
            //说明中间元素小于目标元素 在前半部分
            $start=$middle_index+1;//起始位置中刚刚找到的中间位置的右边那个位置开始
            $middle_index=intval(($start+$end)/2);//重新计算中间位置
        }
    }
    return false;//找不到 返回false
}
$array = array(1,3,5,7,9,10);
$search = 9;//要找的数
$index = recursion_binary_search($array,$search,0,count($array)-1);
// $index = iteration_binary_search($array,$search,0,count($array)-1);
var_dump($index);
exit();
?>