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
            $this->_compileClass = new $compile_driver();
        } else {
            //暂时只有改编译类
            $this->_compileClass = new View();
        }

        $this->_compileClass->template_dir = APP_PATH . MODEL . '/View/';
        //   echo $this->_compileClass->template_dir;
        //编译目录
        $this->_compileClass->compile_dir = APP_PATH . '/' . MODEL . '/' . '~runTime';
        is_dir($this->_compileClass->compile_dir) or mkdir($this->_compileClass->compile_dir, 0755, true);

        if (method_exists($this, "__init")) {
            $this->__init();
        }
    }

    public function display($file, ...$arr)
    {
        if ($file == '') {
            $file = CONTROLLER . '/' . ACTION;
        } elseif (strpos($file, '/') === false) {
            $file = CONTROLLER .'/'.$file;
        }

        if (strpos($file, '.html') === false) {
            $file .= '.html';
        }
        $this->_compileClass->display($file, ...$arr);
    }


    //存储编译模板类
    private $_compileClass = '';

    public function __call($action, $value)
    {
        $this->_compileClass->$action(...$value);
    }
}