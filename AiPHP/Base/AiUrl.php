<?php
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


//todo  获取 Url 中的 信息 , 3个 函数合并
    public static function getController()
    {
        if (self::$_controller) {
            return self::$_controller;
        }

        return self::$_controller = $_REQUEST['AIC'] != '' ? ucfirst($_REQUEST['AIC']) : C('DEFAULT_CONTROLLER');
    }

    public static function getAction()
    {
        if (self::$_action) {
            return self::$_action;
        }

        return self::$_action = $_REQUEST['AIA'] != '' ? ucfirst($_REQUEST['AIA']) : C('DEFAULT_ACTION');
    }

    public static function getModel()
    {

        if (self::$_model) {
            return self::$_model;
        }

        return self::$_model = $_REQUEST['AIM'] != '' ? ucfirst($_REQUEST['AIM']) : C('DEFAULT_MODULE');
    }
}