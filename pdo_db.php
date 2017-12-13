<?php
define("DB_DNS","mysql:host=127.0.0.1;dbname=test");
define("DB_USER","root");
define("DB_PASS","");
define("DB_CHARSET","utf8");

$db = PDO_DB::getInstance();//得到实例化的类
var_dump($db);

// 增
// $add_result=$db->add("cat", array("name"=>"test123456789","num"=>6));
// var_dump($add_result);


// 删
// $delete_result=$db->delete("cat", array("name"=>"test1"));
// var_dump($delete_result);


// 改
// $update_result=$db->update("cat", array("id"=>7),array("name"=>"test1"));
// var_dump($update_result);


// 查
// $select_result=$db->select("cat", "*", $_param = array());
// var_dump($select_result);


// 验证是否存在
// $is_one_result=$db->isOne("cat", array("id"=>"6"));
// var_dump($is_one_result);


// 统计次数
// $count_result=$db->count("cat",array("name"=>"test"));
// var_dump($count_result);


class PDO_DB
{
    private $_pdo = null;//pdo对象
    static private $_instance = null;//用于存放实例化的对象
    
    /**
     * 公共静态方法获取实例化的对象
     * @return DB|null  [返回实例化的对象]
     */
    static public function getInstance()
    {
        if (!(self::$_instance instanceof self))
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    }


    /**
     * 私有克隆方法
     */
    private function __clone()
    {
    }

    /**
     * DB constructor [构造一个PDO链接]
     * 构造方法设定为私有 防止new
     */
    private function __construct()
    {
        try {
            $this->_pdo = new PDO(DB_DNS, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES '.DB_CHARSET));
            $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
    
    /**
     * 新增数据
     * @param string $_table   [要增加的表]
     * @param array $_addData  [要增加的数据]
     * @return bool|string     [增加结果]
     */
    public function add($_table="", $_addData=array())
    {
        $_addFields = implode('`,`', array_keys($_addData));
        $_addValues = implode("','", array_values($_addData));
        $_sql = "INSERT INTO $_table (`{$_addFields}`) VALUES ('$_addValues')";
        $res=$this->execute($_sql);
        if($res)
        {
        	return $this->_pdo->lastInsertId();
        }
        return false;
    }
    
    /**
     * 修改数据
     * @param string $_table      [要修改的表]
     * @param array $_param       [设定的查询条件]
     * @param array $_updateData  [要更新的数据键值对]
     * @return int                [修改结果 影响行数]
     */
    public function update($_table="", $_param=array(), $_updateData=array())
    {
        $_where = $_setData = '';
        foreach ($_param as $_key=>$_value)
        {
            $_where .=" AND `{$_key}`='{$_value}' ";
        }
        $_where = 'WHERE 1=1 '.$_where;
        foreach ($_updateData as $k=>$v)
        {
            $_setData .= "$k='$v',";
        }
        $_setData = substr($_setData, 0, -1);
        $_sql = "UPDATE $_table SET $_setData $_where";
        return $this->execute($_sql)->rowCount();
    }
    
    /**
     * 查询验证一条数据
     * @param string $_table [要查询的表]
     * @param array $_param  [查询的参数键值对]
     * @return int           [返回验证结果]
     */
    public function isOne($_table="", $_param=array())
    {
        $_where = ' where 1=1 ';
        foreach ($_param as $_key=>$_value)
        {
            $_where .=" AND `{$_key}`='{$_value}' ";
        }
        $_sql = "SELECT count(*) FROM $_table $_where LIMIT 1";
        return $this->execute($_sql)->rowCount();
    }
    
    /**
     * 删除数据
     * @param string $_table   [要删除的表]
     * @param array $_param    [删除的查询条件]
     * @return int             [返回删除结果]
     */
    public function delete($_table="", $_param=array())
    {
        $_where = ' where 1=1 ';
        foreach ($_param as $_key=>$_value)
        {
            $_where .=" AND `{$_key}`='{$_value}' ";
        }
        $_sql = "DELETE FROM $_table $_where LIMIT 1";
        return $this->execute($_sql)->rowCount();
    }
    
    /**
     * 查询数据
     * @param string $_table   [要查询的表]
     * @param string $_filed   [要查询的字段]
     * @param array $_param    [要查询的条件等键值对]
     * @return mixed           [返回查询结果]
     */
    public function select($_table="", $_filed="", $_param = array())
    {
        $_limit = $_order  = $_like = '';
        $_where=" where 1=1 ";
        if (is_array($_param) && !empty($_param))
        {
            $_limit = isset($_param['limit']) ? 'LIMIT '.$_param['limit'] : '';
            $_order = isset($_param['order']) ? 'ORDER BY '.$_param['order'] : '';
            if (isset($_param['where']))
            {
                foreach ($_param['where'] as $_key=>$_value)
                {
                    $_where .= " AND `{$_key}`='{$_value}' ";
                }
            }
            if (isset($_param['like']))
            {
                foreach ($_param['like'] as $_key=>$_value)
                {
                    $_like = " AND $_key LIKE '%$_value%' ";
                }
            }
        }
        $_sql = "SELECT $_filed FROM $_table $_where $_like $_order $_limit";
        $_stmt = $this->execute($_sql);
        $_result = array();
        while (!!$_objs = $_stmt->fetchObject())
        {
            $_result[] = $_objs;
        }
        return $this->handle_object($_result);
    }
    
    /**
     * 查询统计条数记录
     * @param string $_table    [要查询的表]
     * @param array $condition  [查询统计条件]
     * @return mixed            [返回总记录结果]
     */
    public function count($_table="", $condition = array())
    {
        $_where = '';
        if (is_array($condition) && !empty($condition))
        {
            foreach ($condition as $_key=>$_value)
            {
                $_where .= " and `{$_key}`='{$_value}' ";
            }
            $_where = 'WHERE 1=1 '.$_where;
        }
        $_sql = "SELECT COUNT(*) as count FROM $_table $_where";
        $_stmt = $this->execute($_sql);
        return $_stmt->fetchObject()->count;
    }
    
    /**
     * 查询表当前自增id
     * @param string $_table   [要查询的表]
     * @return mixed           [返回查询结果]
     */
    public function nextId($_table="")
    {
        $_sql = "SHOW TABLE STATUS LIKE '$_table'";
        $_stmt = $this->execute($_sql);
        return $_stmt->fetchObject()->Auto_increment;
    }

    /**
     * 发送查询结果
     * @param $_sql             [查询SQL]
     * @return PDOStatement     [返回执行的对象]
     */
    private function execute($_sql)
    {
        try {
            $_stmt = $this->_pdo->prepare($_sql);
            $_stmt->execute();
        } catch (PDOException  $e) {
            exit('SQL语句：'.$_sql.'<br />错误信息：'.$e->getMessage());
        }
        return $_stmt;
    }

    /**
     * 讲对象处理成数组
     * @param $object   [要处理的object对象]
     * @return mixed    [返回处理结果]
     */
    private function handle_object($object)
    {
    	return json_decode(json_encode($object),true);
    }
}




?>