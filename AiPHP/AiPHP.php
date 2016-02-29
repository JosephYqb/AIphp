<?php
namespace AI;

/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 2016/2/23
 * Time: 17:15
 */
final class AI
{
    //配置文件夹中的文件数组
    public static $configArray = array(
        'db',
        'route'
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
        $model      = \AiUrl::getModel();
        $action     = \AiUrl::getAction();
        $controller = \AiUrl::getController();
        //todo 优化
        $result = '\\' . $model . '\\Controller\\' . $controller . 'Controller';

        (new $result())->$action();
    }


    //加载系统文件
    private static function init()
    {
        define('AI_PATH', dirname(__FILE__) . '/');
        require AI_PATH . 'Base/ini.config.php';

        // 是否开启报错
        if (APP_DEBUG) {
            error_reporting(E_ALL & ~E_NOTICE);
            ini_set("display_errors", 1);
        } else {
            error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT);
            ini_set("display_errors", 0);
        }

        require AI_PATH . 'Base/function.php';
        require AI_PATH . 'Base/AiUrl.php';

        //todo 是否使用命名空间
        require AI_PATH . 'Base/Controller.php';
        require AI_PATH . 'Base/Model.php';

        self::loadConf(AI_PATH . 'Conf/');
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