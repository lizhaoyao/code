<?php
$result = str_count_result("22222222", "22");
var_dump($result);//输出4

function str_count_result($total_string = '', $sub_string = '')
{
    $result = 0;
    $total_length = strlen($total_string);
    $sub_length = strlen($sub_string);
    $max_count = $total_length - $sub_length;
    for ($i = 0; $i <= $max_count; ) { 
        $tmp_string = substr($total_string, $i, $sub_length);
        if($tmp_string == $sub_string) {
            //找到了一样的 则 要移动这个字符串的长度
            $i += $sub_length;
            $result++;
        }else
        {
            $i++;//否则一位一位的移动
        }
    }
    return $result;
}
