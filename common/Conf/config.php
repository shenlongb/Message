<?php
return array(
//    'MULTI_MODULE'          =>  false, // 多模块开关
    'DEFAULT_MODULE'        =>  'Admin',
    'URL_CASE_INSENSITIVE'  =>  true,
    'URL_MODEL'             => 2,

    'USER_ADMINISTRATOR' => 1, //管理员用户ID

    /* 系统数据加密设置 */
    'DATA_AUTH_KEY' => 'ga4]~yZxTW5rEon;_slbY$/v{L%mG9`k-F>}iIB3O', //默认数据加密KEY
    
    /* 数据库配置 */
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => 'localhost', // 服务器地址
    'DB_NAME'   => 'lg01', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => 'root123456',  // 密码
    'DB_PORT'   => '3306',       // 端口
    'DB_PREFIX' => 'one_', // 数据库表前缀


);