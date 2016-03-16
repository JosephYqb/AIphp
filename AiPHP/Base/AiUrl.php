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
    //初始化 路由分发 主要支持不使
    public static function dispatch()
    {

        // $_SERVER['PATH_INFO'] 中获取数据
        //array_shift

        if (defined('CONTROLLER')) {
        } else {
            $controller = @$_REQUEST['AIController'] != '' ? ucfirst($_REQUEST['AIController']) : C('DEFAULT_CONTROLLER');

            define('CONTROLLER', $controller);
        }

        if (defined('ACTION')) {
        } else {
            $action = @$_REQUEST['AIAction'] != '' ? $_REQUEST['AIAction'] : C('DEFAULT_ACTION');
            define('ACTION', $action);
        }

        if (defined('MODEL')) {
        } else {

            $model = @$_REQUEST['AIModel'] != '' ? ucfirst($_REQUEST['AIModel']) : C('DEFAULT_MODULE');

            define('MODEL', $model);
        }





    }

    /**
     * 生成 url
     *
     * @param  string|int $url 0 不重写 ，
     *                         1   带model 的重写，
     *                         2 不带home 的重写
     *                         3 带index.php 的重写
     * @param  string     $model
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
}