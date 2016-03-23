<?php
return array(
    //'配置项'=>'配置值'
    'DEFAULT_MODULE'     => 'Home', //默认模块
    'URL_MODEL'          => '1', //URL模式
    'SESSION_AUTO_START' => true, //是否开启session
    'DEFAULT_CHARSET'       =>  'utf-8', // 默认输出编码
    'DEFAULT_TIMEZONE'      =>  'Asia/Shanghai',  // 默认时区
    'DEFAULT_AJAX_RETURN'   =>  'JSON',  // 默认AJAX 数据返回格式,可选JSON XML ...
    'COOKIE_EXPIRE'         =>  604800,    // Cookie有效期
    'SESSION_PREFIX'        =>  'LYX_', // session 前缀  招商APP管理平台
    //'SESSION_OPTIONS'       =>  array('domain'=>'*.51lick.com'), // 
    'COOKIE_PREFIX'         =>  'LYX_',      // Cookie前缀 招商APP管理平台
    //'COOKIE_DOMAIN'         =>  '*.51lick.com',
    'URL_CASE_INSENSITIVE'  =>  true,  //URL不区分大小写
    'WebUrl'                =>  'http://wisdom.51lick.com',
    /* 模板相关配置 */
    'DEFAULT_THEME'    =>    'Default',//当模块中没有设置主题，则模块主题会设置为此处设置的主题,主题名和模块名不能重复，如不能采用“Home”
    //此处只做模板使用，具体替换在COMMON模块中的set_theme函数,该函数替换MODULE_NAME,DEFAULT_THEME两个值为设置值
    'TMPL_PARSE_STRING' => array(
        '__STATIC__' => __ROOT__ . '/Public/static',
        '__UPFILE__' => __ROOT__ . '/Public/upfile',
        '__IMG__'    => __ROOT__ . '/Public/MODULE_NAME/DEFAULT_THEME/images',
        '__CSS__'    => __ROOT__ . '/Public/MODULE_NAME/DEFAULT_THEME/css',
        '__JS__'     => __ROOT__ . '/Public/MODULE_NAME/DEFAULT_THEME/js',
        '__THEME__'     => __ROOT__ . '/Public/MODULE_NAME/DEFAULT_THEME',
    ),
    
    //数据库    
    'DB_TYPE'      =>  'mysql',     // 数据库类型
    //'DB_HOST'      =>  'iz23mu19naxz',     // 服务器地址
    //'DB_HOST'      =>  'localhost',     // 服务器地址
    'DB_HOST'      =>  '121.40.215.49',     // 服务器地址
    'DB_NAME'      =>  'wisdom',     // 数据库名
    'DB_USER'      =>  'vie',     // 用户名
    'DB_PWD'       =>  'vie',     // 密码
    'DB_PORT'      =>  '3306',     // 端口
    'DB_PREFIX'    =>  't_',     // 数据库表前缀
    'DB_CHARSET'   =>  'utf8', // 数据库的编码 默认为utf8
    
);