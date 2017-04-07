<?php
class MyLink
{
    private $index=0;
    private $list=array();
    private $prev;
    private $next;
    public function __construct($array=array())
    {
        $this->list=$array;
        $this->index=0;
        $this->prev=null;
        $this->next=$this->list[$this->index+1];
    }
    public function forward()
    {
        //前进一格
        if(!is_null($this->next))
        {
            $this->prev=isset($this->list[$this->index])?$this->list[$this->index]:null;
            $this->index++;
            $this->next=isset($this->list[$this->index+1])?$this->list[$this->index+1]:null;
        }
    }
    public function back_off()
    {
        //后退一格
        if(!is_null($this->prev))
        {
            $this->index--;
            $this->prev=isset($this->list[$this->index-1])?$this->list[$this->index-1]:null;
            $this->next=isset($this->list[$this->index+1])?$this->list[$this->index+1]:null;
        }
    }
    public function get_info()
    {
        return array(
            "index"=>$this->index,
            "list"=>$this->list,
            "prev"=>$this->prev,
            "next"=>$this->next,
        );
    }
}

$array=array(243,32,43,5,65,657,67,32,5,8,8);
$link=new MyLink($array);
$link->forward();
$link->forward();
var_dump($link->get_info());
$link->back_off();
var_dump($link->get_info());
?>