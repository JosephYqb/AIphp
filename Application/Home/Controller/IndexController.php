<?php
namespace Home\Controller;

use AI\Base\Controller;

class IndexController extends Controller
{

    public function Index()
    {
        d($_REQUEST);
		d(C());
		//$a  = &C('DEFAULT_M_LAYER');
		//$a = "fasdf";
		//&C('DEFAULT_M_LAYER') = "fdds";
		d(C());
		
		d(C('DEFAULT_M_LAYER'));
       // $this->display('Index/Index');

   //  j(db()->query('show databases'));
     //j(db()->query('show tables'));
        //db()->table
      //  sleep(10);
	  phpinfo();
    }
}