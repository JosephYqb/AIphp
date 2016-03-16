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

        $conf_path = APP_PATH . '/' . MODEL . '/Conf/';
        //加载应用配置 todo common
        AI::loadConf($conf_path);
    }

    // 开始运行
    public static function run()
    {
        self::beforeRun();
        AiUrl::dispatch();


        //todo 优化
        $result = '\\' . MODEL . '\\Controller\\' . CONTROLLER . 'Controller';

        // todo ！！！！！

        (new $result())->ACTION();
    }

    //结束 运行
    public static function afterRun()
    {
    }
}