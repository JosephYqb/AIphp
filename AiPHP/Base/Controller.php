<?php
namespace AI\Base;
/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 2016/2/24
 * Time: 16:18
 */

class Controller
{

    public function __construct()
    {
        // 如不使用 模板引擎，请用空数据覆盖掉
        $compile_driver = C('COMPILE_DRIVER');
        if ($compile_driver != '') {

            AiRequire(C('COMPILE_CLASS'));
            $this->_compileClass = new $compile_driver;
        } else{
            $this->_compileClass = $this;
        }

        $this->_compileClass->template_dir =  VIEW_PATH.'/'.CONTROLLER;
        //编译目录
        $this->_compileClass->compile_dir = APP_PATH.'/'.MODEL.'/'.'~runTime';
        is_dir($this->_compileClass->compile_dir) or mkdir($this->_compileClass->compile_dir,0755,true);

        if (method_exists($this, "__init")) {
            $this->__init();
        }
    }

    //存储编译模板类
    private  $_compileClass = '';


    public function display($file = '')
    {
        // echo C('COMPILE_DRIVER');
        // echo get_called_class();

        // todo
        if ($file == '') {
            $file = AiUrl::getController() . '/' . AiUrl::getAction() . $file;
        } elseif (strpos($file, '/') === false) {
            $file = AiUrl::getController() . '/' . $file;
        }
        echo $file;

        $this->_compileClass->fetch($file);
    }

    private function fetch($file)
    {

        $filePosition = APP_PATH . 'Home/View/' . $file . '.html';
        //  echo $filePosition;
        if (file_exists($filePosition)) {
            include $filePosition;
        } else {
            E("模板文件：{$filePosition}不存在");
        }
    }

    public function __call($action, $value)
    {
        /*
        var_dump($this->_compileClass);
        var_dump($action);
var_dump($value);
        */
        //指向模板类
        $this->_compileClass->$action(...$value);
        //E(__CLASS__ . "类中方法名:$action 不存在");
    }
}