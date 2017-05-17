<?php
//这是一个队列的类
//该类用来解决进出栈的问题

//数组队列
class ArrayQueue
{
    private $start=1;//初始化的队首索引位置
    private $end=0;//初始化的队首索引位置
    private $length=0;//队列长度
    private $data_list=array();//队列存储数组
    public function in($val="")
    {
        //进栈一个数据
        $this->end++;//队尾索引自增
        $this->data_list[$this->end]=$val;//队尾来存储这个数据
        $this->length++;//长度增加
    }
    // 堆的出
    public function heap_out()
    {
        //堆的出 先进先出 后进后出
        unset($this->data_list[$this->start]);//拿走第一个
        $this->start++;//队首索引自增
        $this->length--;//长度减少
    }
    // 栈的出
    public function stack_out()
    {
        #栈的出 先进后出 后进先出
        unset($this->data_list[$this->end]);//拿走最后一个
        $this->end--;//队尾索引自减
        $this->length--;//长度减少
        ksort($this->data_list);
    }
    public function get_list()
    {
        return $this->data_list;//返回队列
    }
}
$queue=new ArrayQueue();//实例化数组队列
$queue->in("1");//放一个进入队列
$queue->in("2");//放一个进入队列
$queue->in("3");//放一个进入队列
$queue->in("4");//放一个进入队列
$queue->in("5");//放一个进入队列
$queue->in("6");//放一个进入队列
var_dump(implode("-",$queue->get_list()));
$queue->stack_out();//后进先出
var_dump(implode("-",$queue->get_list()));
$queue->in("7");//再进一个放入队列中
var_dump(implode("-",$queue->get_list()));
$queue->heap_out();//先进先出
var_dump(implode("-",$queue->get_list()));
$queue->in("8");//再进一个放入队列中
$queue->heap_out();//先进先出
$queue->in("9");//再进一个放入队列中
$queue->stack_out();//后进先出
$queue->in("10");//再进一个放入队列中
var_dump(implode("-",$queue->get_list()));

?>
