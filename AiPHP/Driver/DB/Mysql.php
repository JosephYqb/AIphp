<?php

/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 2016/2/24
 * Time: 11:15
 */
class Mysql
{
    //存储 sql 记录
    private static $sqlLog = array();


    private function __construct($database)
    {
        $databaseConf = C($database);
        @mysql_connect($databaseConf['hostname'], $databaseConf['username'], $databaseConf['password']) or E('数据库连接失败错误信息'.mysql_error().'连接配置：' . printf($databaseConf, true));

        if ($databaseConf['charset'] != '') {
            $this->exec('set names' . $databaseConf['charset']);
        }

        if ($databaseConf['database'] != '') {
            $this->exec('use ' . $databaseConf['database']);
        }
    }

    private function exec($sql)
    {
        self::$sqlLog[] = $sql;

        return @mysql_query($sql);
    }

    //每个数据库配置都是单例模式
    public static function connect($database)
    {
        return new Mysql($database);
    }


    public function query()
    {
    }
}