<?php

/**
 * 常用方法.
 * User: Joseph
 * Date: 2016/2/23
 * Time: 17:59
 */

/**
 * 打印数据
 *
 * @param        $value
 * @param string $memo
 */
function d($value, $memo = '')
{
    echo '<pre>';

    if ($memo != '') {
        echo $memo . ':<br/>';
    }
    var_dump($value);
    echo '</pre>';
}

/**
 * 获取用户 IP
 *
 * @return string
 */
function GetIP()
{
    if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
        $cip = $_SERVER["HTTP_CLIENT_IP"];
    } elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
        $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    } elseif (!empty($_SERVER["REMOTE_ADDR"])) {
        $cip = $_SERVER["REMOTE_ADDR"];
    } else {
        $cip = "0.0.0.0";
    }

    return $cip;
}

/**
 * 获得数据库连接
 *
 * @param string $engine   连接类型
 * @param string $database 连接的数据库
 *
 * @return mixed
 */
function db($engine = '', $database = '')
{
    return \Driver\DB::getDriver($engine, $database);
}

function E($message = '', $code = 0)
{
    throw new Exception ($message, $code);
}

/**
 * from ThinkPHP
 * 获取和设置配置参数 支持批量定义
 *
 * @param string|array $name    配置变量
 * @param mixed        $value   配置值
 * @param mixed        $default 默认值
 *
 * @return mixed
 */
function C($name = null, $value = null, $default = null)
{
    static $_config = array();
    // 无参数时获取所有
    if (empty($name)) {
        return $_config;
    }
    // 优先执行设置获取或赋值
    if (is_string($name)) {
        if (!strpos($name, '.')) {
            $name = strtoupper($name);
            if (is_null($value)) {
                return isset($_config[$name]) ? $_config[$name] : $default;
            }
            $_config[$name] = $value;

            return null;
        }
        // 二维数组设置和获取支持
        $name    = explode('.', $name);
        $name[0] = strtoupper($name[0]);
        if (is_null($value)) {
            return isset($_config[$name[0]][$name[1]]) ? $_config[$name[0]][$name[1]] : $default;
        }
        $_config[$name[0]][$name[1]] = $value;

        return null;
    }
    // 批量设置
    if (is_array($name)) {
        $_config = array_merge($_config, array_change_key_case($name, CASE_UPPER));

        return null;
    }

    return null; // 避免非法参数
}

// json 格式输出数组
function j($arr)
{
    header("Content-type: application/json");
    echo json_encode($arr);
}

// todo 修改
function __autoload($class)
{
    $class = str_replace("\\", '/', $class);
    if (substr($class, -10) == 'Controller') {

        AiRequire(APP_PATH . $class . EXT);
    } elseif (substr($class, -5) == 'Model') {

        AiRequire(APP_PATH . $class . EXT);
    } else {
        AiRequire(AI_PATH . $class . '.php');
    }
}

// 加载文件前判断文件是否在，不存在抛出异常
function AiRequire($file)
{
    if (file_exists($file)) {
        require $file;
    } else {
        E("无法加载文件： $file");
    }
}

