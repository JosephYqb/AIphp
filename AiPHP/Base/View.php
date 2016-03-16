<?php
/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 16/03/16
 * Time: 22:58
 */

namespace AI\Base;

class View
{
    // View 层地址
    public $template_dir;
    // 编译后文件存储位置
    public $compile_dir;
    // 存储 变量
    private $tem_var = array();
    public function assign($name, $value)
    {
        $this->tem_var[$name] = $value;
    }

    public function display($file)
    {
        $this->fetch($file);
    }

    //使用 php原生模板
    private function fetch($file)
    {
        $filePosition = $this->template_dir . $file;
        echo $filePosition;
        //  echo $filePosition;
        if (file_exists($filePosition)) {
            // 模板阵列变量分解成为独立变量
            extract($this->tem_var, EXTR_OVERWRITE);
            include $filePosition;
        } else {
            E("模板文件：{$filePosition}不存在");
        }
    }

}