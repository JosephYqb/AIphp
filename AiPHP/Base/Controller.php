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

    }

    public function display($file= ''){

        // todo
        if($file == ''){

        }
        $this->fetch($file);
    }

    private function fetch($file){

        $filePosition = APP_PATH.'Home/View/'.$file.'.html';
      //  echo $filePosition;
        if(file_exists($filePosition)){
            include $filePosition;
        } else{
            E("模板文件不存在");
        }

    }

    public function __call($action,$value){
        E(__CLASS__."类中方法名:$action 不存在");
    }

}