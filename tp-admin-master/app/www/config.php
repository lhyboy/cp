<?php

return [
    //网站名称
    'website'   =>      [
                            'name'          => '娱乐',
                            'keywords'      =>  '娱乐,娱乐，娱乐',
                            'description'   =>  '娱乐,娱乐，娱乐'
                        ],
    // 默认输出类型
    'default_return_type'               => 'html',
    // 默认跳转页面对应的模板文件
    'dispatch_success_tmpl'             => APP_PATH  . 'www/view/' .DS. 'dispatch_jump.tpl',
    'dispatch_error_tmpl'               => APP_PATH  . 'www/view/' .DS. 'dispatch_jump.tpl',

    //异常页面模板文件
    'exception_tmpl'                    => APP_PATH . 'www/view' .DS. 'think_exception.tpl',

    'http_exception_template'           =>  [
                                                // 定义404错误的重定向页面地址
                                                404 =>  APP_PATH. 'www/view' .DS. '404.html',
                                                // 还可以定义其它的HTTP status
                                                401 =>  APP_PATH. 'www/view' .DS. '401.html',
                                            ],
	
    //模板布局
	'template'                          =>  [
	    'layout_on'    =>  true,
	    'layout_name'  =>  'layout',
        // 模板后缀
        // 'view_suffix'  => 'html',
        'taglib_pre_load'    =>    'think\template\taglib\Cx,app\admin\taglib\Tool',
        'taglib_build_in'    =>    'think\template\taglib\Cx,app\admin\taglib\Tool',
	],
    //缓存
    'cache'                             => [
        // 驱动方式
        'type'   => 'File',
        // 缓存保存目录
        'path'   => RUNTIME_PATH.'system/adminData/',
        // 缓存前缀
        'prefix' => '',
        // 缓存有效期 0表示永久缓存
        'expire' => 0,
    ],

    'app_debug'              => true,
    
    //是否关闭定时脚本
    //'Crontab'              => false,
    'Crontab'              => true,
    
    'session'                => [
        'id'             => '',
        // SESSION_ID的提交变量,解决flash上传跨域
        'var_session_id' => '',
        // SESSION 前缀
        'prefix'         => '',
        // 驱动方式 支持redis memcache memcached
        'type'           => '',
        // 是否自动开启 SESSION
        'auto_start'     => true,
    ],

    // 视图输出字符串内容替换
    'view_replace_str'       => [        
        '__CSS__'    => STATIC_PATH . 'www/css',
        '__JS__'     => STATIC_PATH . 'www/js',
        '__IMG__'    => STATIC_PATH . 'www/img',
        '__HEADIMG__'    => STATIC_PATH . 'www/img2',
        '__LIB__'    => STATIC_PATH . 'www/lib'
    ],

    //验证码

    'captcha'  => [
        // 验证码字符集合
        //'codeSet'  => '2345678abcdefhijkmnpqrstuvwxyzABCDEFGHJKLMNPQRTUVWXY', 
        'codeSet'  => '2345678', 
        // 验证码字体大小(px)
        'fontSize' => 50,
        // 是否画混淆曲线
        'useCurve' => false,
         // 验证码图片高度
        'imageH'   => 30,
        // 验证码图片宽度
        'imageW'   => 120,
        // 验证码位数
        'length'   => 4,
        // 验证成功后是否重置        
        'reset'    => true
    ],

    //伪静态
    'url_html_suffix' => false,
    'user_auth_key'     => 'Astonep@tp-admin!@#$',
];