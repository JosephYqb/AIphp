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

    //初始化 todo 是否程序内部实现 类似重新 （/home/model/action）
    public function run(){

    }

    //生成url
    public static  function create($url,$model = ''){
if($model===''){
    $model = C('URl_MODEL');
}
        switch($model){
            case 2:


                break;
            case 1:




                break;
            default:





                break;



        }

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