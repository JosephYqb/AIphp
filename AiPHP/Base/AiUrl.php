<?php
namespace AI\Base;
/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 2016/2/29
 * Time: 16:59
 */

class AiUrl
{
    private static $_controller;
    private static $_action;
    private static $_model;

    //初始化 路由分发（使用了重写规则，暂不写该方法）
    public static function dispatch()
    {

        // $_SERVER['PATH_INFO'] 中获取数据
        //array_shift

    }

    /**
     * 生成 url
     *
     * @param  string|int  $url 0 不重写 ，1带model 的重写，2 不带home 的重写
     * @param  string      $model
     *
     * @return string  生成的url
     */
    public static function create($url, $model = '')
    {
        if ($model === '') {
            $model = C('URl_MODEL');
        }
        switch ($model) {
            case 2:

                break;
            case 1:

                break;
            default:

                break;
        }

        return $url;
    }

    public static function getController()
    {
        if (isset(self::$_controller)) {
            return self::$_controller;
        }

        return self::$_controller = $_REQUEST['AIController'] != '' ? ucfirst($_REQUEST['AIController']) : C('DEFAULT_CONTROLLER');
    }

    public static function getAction()
    {
        if (isset(self::$_action)) {
            return self::$_action;
        }

        return self::$_action = $_REQUEST['AIAction'] != '' ? ucfirst($_REQUEST['AIAction']) : C('DEFAULT_ACTION');
    }

    public static function getModel()
    {

        if (isset(self::$_model)) {
            return self::$_model;
        }

        return self::$_model = $_REQUEST['AIModel'] != '' ? ucfirst($_REQUEST['AIModel']) : C('DEFAULT_MODULE');
    }
}