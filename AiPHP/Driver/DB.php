<?php
namespace Driver;
/**
 * 数据库工厂模式，支持多驱动，多配置.
 * User: Joseph
 * Date: 2016/2/24
 * Time: 10:20
 */
class DB
{

    //存储驱动
    private static $_driver = array();

    //获取驱动
    public static function getDriver($engine = '', $database = '')
    {

        $engine   = $engine   == '' ? C('DEFAULT_ENGINE')   : ucfirst($engine);
        $database = $database == '' ? C('DEFAULT_DATABASE') : strtoupper($database);

        if (!isset(self::$_driver[$engine])) {
            //加载驱动文件
            require DRIVER_PATH . 'DB/' . $engine . '.php';
        }
        if (!isset(self::$_driver[$engine][$database])) {
            self::$_driver[$engine][$database] = $engine::connect($database);
        }

        return self::$_driver[$engine][$database];
    }
}