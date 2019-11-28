<?php
return array(
	//'配置项'=>'配置值'

    'DB_TYPE'                => 'mysql', // 数据库类型
    'DB_HOST'                => '10.50.0.158', // 服务器地址
    'DB_NAME'                => 'five', // 数据库名
    'DB_USER'                => 'five', // 用户名
    'DB_PWD'                 => 'five', // 密码
    'DB_PORT'                => '3306', // 端口
    'DB_PREFIX'              => 'my_', // 数据库表前缀

    'TOKEN_ON'      =>    true,  // 是否开启令牌验证 默认关闭
    'TOKEN_NAME'    =>    '__hash__',    // 令牌验证的表单隐藏字段名称，默认为__hash__
    'TOKEN_TYPE'    =>    'md5',  //令牌哈希验证规则 默认为MD5
    'TOKEN_RESET'   =>    true,  //令牌验证出错后是否重置令牌 默认为true

    //数据库字段取消转小写

    'DB_PARAMS' => array(\PDO::ATTR_CASE => \PDO::CASE_NATURAL),

    //跟踪查看
    'SHOW_PAGE_TRACE' => true,

//网站根目录
    'TMPL_PARSE_STRING'  =>array(
        '__IMAGE__' => 'http://www.wwda.top', // 更改默认的/Public 替换规则
    ),

 //文件上传的目录
        'UPLOAD' => './upload/'
);