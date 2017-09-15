<?php
$array=array(1,2,3,4,2,1,5,6,2,1,2,3,7,6,3,2,1,2,3,6);
foreach ($array as $key => $v)
{
    $now=lru($v);
    echo ($v)." ".(implode(" ",$now))."<br/>";
}

function lru($into_data="")
{
    static $array=array();
    $max_length=5;//最大长度
    if(empty($array))
    {
        $array[]=$into_data;
    }else
    {
        //说明不为空 不为空则进行查找
        $find_index=array_search($into_data, $array);
        if($find_index!==false)
        {
            //说明找到了 找到的话就放到第一个来
            unset($array[$find_index]);//去掉这个 拿到第一个去
        }else
        {
            //没找到 判断是否达到最大长度 如果达到 去掉最后一个
            if(count($array)==$max_length-1)
            {
                //到达最大长度
                // 去除最后一个
                array_pop($array);
            }
        }
        array_unshift($array,$into_data);//放到第一个去
        //$array=array_values($array);//数组重置  经lhc提醒这里不用重置 可以注释
    }
    return $array;
}
?>