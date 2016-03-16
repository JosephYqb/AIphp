<?php
/**
 * 定义系统常量.
 * User: Joseph
 * Date: 2016/2/23
 * Time: 18:08
 */
//version_compare(PHP_VERSION, '5.4', '>=') or die('php 版本 过低，请升级');
defined('APP_DEBUG') || define('APP_DEBUG', true);
defined('APP_PATH') || define('APP_PATH', 'Application/');

define('DRIVER_PATH', AI_PATH . 'Driver/');
define('EXTEND_PATH', AI_PATH . 'Extend/');
//define('RUNTIME_PATH', APP_PATH . '/' . MODEL . '/~runTime');

define('EXT', '.php');


//echo INTERFACE_PATH;


//echo DRIVER_PATH;
