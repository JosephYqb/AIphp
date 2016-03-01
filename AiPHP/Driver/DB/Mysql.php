<?php

/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 2016/2/24
 * Time: 11:15
 */
class Mysql
{
    // todo  提炼 数据库连接类 共有方法
    //存储 sql 记录
    private static $sqlLog = array();


    //每个数据库配置都是单例模式(由DB.php 控制单例)
    public static function run($database)
    {
        return new Mysql($database);
    }

    //存储本次数据库连接
    private $connect;
    //存储链式写法的数据
    private $options = array();

    //禁止直接实例化
    private function __construct($database)
    {
        $databaseConf = C($database);

        $this->connect = @mysql_connect($databaseConf['hostname'] . ':' . $databaseConf['host'], $databaseConf['username'], $databaseConf['password'], true) or E('数据库连接失败,错误信息' . mysql_error() . '连接配置：' . printf($databaseConf, true));
        //表前缀
        $this->options['pre_fix'] = $databaseConf['pre_fix'] ?: '';
        if ($databaseConf['charset'] != '') {
            $this->exec('set names ' . $databaseConf['charset']);
        }

        if ($databaseConf['database'] != '') {
            mysql_select_db($databaseConf['database'], $this->connect);
        }
    }

    public function table($table)
    {
        $this->options['table'] = $table;

        return $this;
    }

    // todo 支持 array
    public function where($where)
    {
        $this->options['where'] = $where;

        return $this;
    }

    public function select($field = '*')
    {
        //组装sql语句
        $sqL = 'SELECT ' . $field . ' FROM ' . $this->options['pre_fix'] . $this->options['table'];
        if ($this->options['where']) {

            $sqL .= ' WHERE ' . $this->options['where'];
        }

        return $this->query($sqL);
    }

    //清理先关信息
    public function flush()
    {
        $this->options = array();
    }

    //直接执行语句 只能用来查询
    public function query($sql)
    {
        $result = $this->exec($sql);

        $list = array();
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            $list[] = $row;
        }

        return $list;
    }

    //todo !!!!!!!!!
    public function save($data)
    {
        if (is_array($data)) {

            if (count($data) > 0) {
                $data_string = ' SET ';
                foreach ($data as $i => $v) {
                    $data_string .= $i . '=' . '`' . $v . '`';
                }
                $data = $data_string;
            }
        }
        $sql = 'INSERT INTO  ' . $this->options['pre_fix'] . $this->options['table'] . $data;
        $this->exec($sql);
    }

    // mysql 执行类
    private function exec($sql)
    {
        self::$sqlLog[] = $sql;
        $this->flush();
        $tmp = @mysql_query($sql, $this->connect);
        if ($tmp !== false) {
            return $tmp;
        } else {
            E(mysql_error());
        }
    }
}