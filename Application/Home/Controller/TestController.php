<?php
namespace Home\Controller;

use AI\Base\Controller;

/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 2016/3/1
 * Time: 14:07
 */
class TestController extends Controller
{

    public function test1()
    {
        echo 'TestController 中的Test1方法';
    }

    public function test2()
    {

        $a = db()->table('user')->select();
        j($a);
    }


    public function test3(){
        db()->table('t')->save( array(
            'id'=>'1',
            'name'=>'1'
        ));
    }

}