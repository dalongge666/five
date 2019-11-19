<?php
namespace Company\Model;
use Think\Model;
class PositionModel extends Model
{
    //指定表前缀，如果和配置文件中一致则无需指定
        protected $tablePrefix = 'my_';
    //指定表名,一般情况下默认和模型名称相同
        protected $tableName = 'position';
    //同时指定表前缀和表名
//        protected $trueTableName = 'my_position';
}
