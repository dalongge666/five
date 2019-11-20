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

    //数据库字段取消转小写

    'DB_PARAMS' => array(\PDO::ATTR_CASE => \PDO::CASE_NATURAL),

    //跟踪查看
    'SHOW_PAGE_TRACE' => true,

    'TMPL_PARSE_STRING'  =>array(
        '__IMAGE__' => 'http://www.wwda.top', // 更改默认的/Public 替换规则

    )

);