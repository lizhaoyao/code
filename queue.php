<?php
//这是一个队列的类
//该类用来解决进出栈的问题

//栈式队列
class Queue
{
    private $start=1;
    private $end=0;
    private $length=0;
    private $data_list=array();
    public function in($val="")
    {
        //进栈一个数据
        if(!empty($this->data_list))
        {
            //不为空
            for($i=$this->end+1;$i>$this->start;$i--)
            {
                $this->data_list[$i]=$this->data_list[($i-1)];
            }
        }
        $this->data_list[$this->start]=$val;
        $this->end++;
        $this->length++;
    }
    // 堆的出
    public function heap_out()
    {
        //堆的出 先进先出
        unset($this->data_list[$this->end]);
        $this->end--;
        $this->length--;
    }
    // 栈的出
    public function stack_out()
    {
        #栈的出 先进后出
        unset($this->data_list[$this->start]);
        for ($i=1; $i < $this->length; $i++) 
        { 
            $this->data_list[$i]=$this->data_list[($i+1)];
        }
        unset($this->data_list[$this->length]);
        $this->length--;
        $this->end--;
        ksort($this->data_list);
    }
    public function get_list()
    {
        return $this->data_list;
    }
}
$queue=new Queue();
$queue->in("1");
$queue->in("2");
$queue->in("3");
$queue->in("4");
$queue->in("5");
$queue->in("6");
var_dump(implode("-",$queue->get_list()));
$queue->stack_out();//后进先出
var_dump(implode("-",$queue->get_list()));
$queue->in("7");//再进一个放入队列中
var_dump(implode("-",$queue->get_list()));
$queue->heap_out();//先进先出
var_dump(implode("-",$queue->get_list()));

?>
