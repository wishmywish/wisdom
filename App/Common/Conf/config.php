<?php
return array(
    //'配置项'=>'配置值'
    'DEFAULT_MODULE'     => 'Home', //默认模块
    'URL_MODEL'          => '1', //URL模式
    'SESSION_AUTO_START' => true, //是否开启session
    'DEFAULT_CHARSET'       =>  'utf-8', // 默认输出编码
    'DEFAULT_TIMEZONE'      =>  'Asia/Shanghai',  // 默认时区
    'DEFAULT_AJAX_RETURN'   =>  'JSON',  // 默认AJAX 数据返回格式,可选JSON XML ...
    'COOKIE_EXPIRE'         =>  604800,    // Cookie有效期,七天
    'SESSION_PREFIX'        =>  'LYX_', // session 前缀  招商APP管理平台
    //'SESSION_OPTIONS'       =>  array('domain'=>'*.51lick.com'), //
    'COOKIE_PREFIX'         =>  'LYX_',      // Cookie前缀 招商APP管理平台
    'URL_CASE_INSENSITIVE'  =>  true,  //URL不区分大小写
    'WebUrl'                =>  'http://dvpt.51lick.cn/',//WEB
    'JhttpUrl'              =>  'http://japi.51lick.cn/HttpApiServlet',//用户中心
//        'JhttpUrl'              =>  'http://10.10.10.104:8080/uCenter/HttpApiServlet',//用户中心
//    'JhttpUrl'              =>  'http://10.10.10.104:8080/uCenter/HttpApiServlet',//用户中心
    'EasemobUrl'            =>  'https://a1.easemob.com/4008813609/wisdom/',//环信
    'appId'                 => "768ab4cb9d6a4f5a89cfff4150872b11",//招商APP云之讯应用ID
   // 'YYJhttpUrl'            =>  'http://localhost:8080/zServer/',//智慧运营JAVA接口
    'YYJhttpUrl'            =>  'http://121.40.215.49:9090/zServer/',//智慧运营JAVA接口,先调用周的电脑接口
//    'YYOmsUrl'            =>  'http://svn.hzkting.com:8088/orderManager/api/',//智慧运营OMS，江波电脑
    'YYOmsUrl'            =>  'http://121.40.215.49:8088/orderManager/api/',//智慧运营OMS

    'OperatehttpUrl'   =>  'http://localhost/wisdom/index.php/Api/YYInfo/conf/',//智慧运营JAVA接口
    /* 模板相关配置 */
    'DEFAULT_THEME'    =>    'Default',//当模块中没有设置主题，则模块主题会设置为此处设置的主题,主题名和模块名不能重复，如不能采用“Home”

    'LOG_RECORD' => true, // 开启日志记录
    'LOG_LEVEL'  =>'EMERG,ALERT,CRIT,ERR', // 只记录EMERG ALERT CRIT ERR 错误


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
//    'DB_HOST'      =>  '121.40.215.49',     // 服务器地址
    'DB_HOST'      =>  '218.75.77.125',     // 服务器地址
    'DB_NAME'      =>  'wisdom',     // 数据库名
//    'DB_USER'      =>  'vie',     // 用户名
    'DB_USER'      =>  'root',     // 用户名
//    'DB_PWD'       =>  'vie',     // 密码
    'DB_PWD'       =>  'aXJ80g5D',     // 密码
    'DB_PORT'      =>  '3306',     // 端口
    'DB_PREFIX'    =>  't_',     // 数据库表前缀
    'DB_CHARSET'   =>  'utf8', // 数据库的编码 默认为utf8

    //支付宝批量付款配置
    'alipay_config' => array(
        'partner' => '2088021113858733',
        'key' => 'g65gd0up1mgsl4or3j9gvdcm7rk7cm8x',
        'sign_type' => strtoupper('MD5'),
        'input_charset' => strtolower('utf-8'),
        'cacert' => getcwd().'/Public/Api/cacert.pem',
        'transport' => 'http',
    ),
    //支付宝网关
    'alipay_gateway_new' => 'https://mapi.alipay.com/gateway.do?',
    //付款帐号
    'WIDemail' => 'zhouyc@51lick.com',
    //付款名称
    'WIDaccount_name' => '杭州日思夜享数据科技有限公司',
    //批量付款回调地址
    'notify_url' => '',
    
);