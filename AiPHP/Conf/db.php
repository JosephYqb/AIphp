<?php
//系统配置文件
return array(
    //默认数据库库连接驱动
    'DEFAULT_ENGINE' => 'Mysql',
    'DEFAULT_DATABASE' => 'DB',
    'DB'=>array(
        'hostname'          =>  '127.0.0.1', // 服务器地址
        'database'          =>  '',          // 数据库名
        'username'          =>  'root',      // 用户名
        'password'          =>  '',          // 密码
        'port'              =>  '3306',      // 端口
        'pre_fix'           =>  'ai_',          //  数据库表前缀
        'charset'           =>  'utf8',      // 数据库编码默认采用utf8
    )
);