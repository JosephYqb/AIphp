<?php
namespace AI\Base;

use AI\AI;

/**
 * 应用代理
 * User: Joseph
 * Date: 2016/3/1
 * Time: 10:25
 */
class App
{

    // 开始应用前
    public static function beforeRun()
    {
        AiUrl::dispatch();

        $conf_path = APP_PATH . '/' . MODEL . '/Conf/';
        //加载应用配置 todo common
        AI::loadConf($conf_path);
    }

    // 开始运行
    public static function run()
    {
        self::beforeRun();

        //todo 优化
        $controller = '\\' . MODEL . '\\Controller\\' . CONTROLLER . 'Controller';

        if(method_exists($controller,ACTION) ){
            $controller_class = new $controller;
            call_user_func(array($controller_class,ACTION));
        }else{
           E('控制器'.$controller.'中'. ACTION .'方法存在');
        }


    }

    //结束 运行
    public static function afterRun()
    {
    }
}