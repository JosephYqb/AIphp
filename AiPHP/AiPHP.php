<?php
namespace AI;

/**
 * 框架入口
 * User: Joseph
 * Date: 2016/2/23
 * Time: 17:15
 */
final class AI
{
    //配置文件夹中的文件数组
    public static $configArray = array(
        'db',
        'route',
        'compile'
    );


    //入口方法
    public static function start()
    {
        self::init();
        self::install();
        self::run();
    }

    public static function  run()
    {
        Base\App::run();
    }


    //加载系统文件
    private static function init()
    {
        // 使用到了 5.6 的新特性
        version_compare(PHP_VERSION ,'5.6','>=') or die('php版本需要大于等于5.6');

        define('AI_PATH', dirname(__FILE__) . '/');
        require AI_PATH . 'Common/ini.config.php';
        //注册自动加载
        spl_autoload_register(array(
            'self',
            'autoload'
        ));

        // 是否开启报错
        if (APP_DEBUG) {
            //error_reporting(E_ALL & ~E_NOTICE);
            error_reporting(E_ALL);
            ini_set("display_errors", 1);
        } else {
            error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT);
            ini_set("display_errors", 0);
        }

        require AI_PATH . 'Common/function.php';

        self::loadConf(AI_PATH . 'Conf/');
    }

    //自动加载
    public static function autoload($class)
    {
        $class = str_replace("\\", '/', $class);
        //框架中的类
        if (substr($class, 0, 2) === 'AI') {
            require AI_PATH . substr($class, 2) . '.php';
        } else {
            //是Controller 或 Model
            if (substr($class, -10) == 'Controller' || substr($class, -5) == 'Model') {
                require APP_PATH . $class . EXT;
            }
        }
    }

    //加载配置
    public static function loadConf($dir)
    {
        foreach (self::$configArray as $v) {
            $confFile = $dir . $v . '.php';
            if (file_exists($confFile)) {
                C(include $confFile);
            }
        }
    }

    // 安装
    private static function install()
    {
        if (is_dir(APP_PATH)) {
            return;
        }
        // todo  从配置读取，同时修改 tpl 中 关键字
        $appList = array('Home/');
        foreach ($appList as $v) {
            is_dir(APP_PATH . $v . 'Controller') or mkdir(APP_PATH . $v . 'Controller', 0777, true);
            is_dir(APP_PATH . $v . 'Model') or mkdir(APP_PATH . $v . 'Model', 0777, true);
            is_dir(APP_PATH . $v . 'Conf') or mkdir(APP_PATH . $v . 'Conf', 0777, true);
            is_dir(APP_PATH . $v . 'Common') or mkdir(APP_PATH . $v . 'Common', 0777, true);
            is_dir(APP_PATH . $v . 'View/Index') or mkdir(APP_PATH . $v . 'View/Index', 0777, true);
            copy(AI_PATH . '/Tpl/IndexController.Tpl', APP_PATH . $v . 'Controller/IndexController' . EXT);
            copy(AI_PATH . '/Tpl/IndexModel.Tpl', APP_PATH . $v . 'Model/IndexModel' . EXT);
            copy(AI_PATH . '/Tpl/Index.html', APP_PATH . $v . 'View/Index/Index.html');
        }
    }
}


try {
    AI::start();
} catch (\Exception $e) {
    if (APP_DEBUG) {
        // 输出错误信息
        //echo '异常名称为: <font color=blue>', get_class($e), '</font><br/><br/>';
        echo '异常消息为: <font color=blue> ', $e->getMessage(), '</font><br/><br/>';
        echo '发生错误的位置为: <font color=red>', $e->getFile(), '</font> 中的第<font color=red>', $e->getLine(), '</font>行<br/><br/>';
        if ($e->getCode() != 0) {
            echo '异常代码为: <font color=red>', $e->getCode(), '</font><br/><br/>';
        }
        echo '异常链: ', str_replace('#', '<br/>#', $e->getTraceAsString()), '<br/>';;
    } else {
        //todo 指向 404 页面
        echo "系统异常，请稍候再试.";
    }
}