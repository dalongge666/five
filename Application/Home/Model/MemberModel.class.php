<?php
namespace Home\Model;
use Think\Model;

class MemberModel extends Model{

//设置表名
    protected $tableName = 'member';
//验证完所有规则
//    protected $patchValidate = true;
//
//    protected $_validate = array(
//        array('username','require','用户名不能为空'),
//        array('username','','用户名已存在',2,'unique',1),
//        array('username','/^[a-z0-9\x{4e00}-\x{9fa5}]{3,15}$/u','用户名格式不正确'),
//        array('password','require','密码不能为空'),
////        array('password','/^\w{3,15}]$/','密码格式不正确'),
//        array('tel','require','手机号不能为空'),
//        array('tel','','手机号已存在',2,'unique',1),
//        array('tel','/^1[3456789]\d{9}$/','手机号格式不正确'),
//        array('msg_code','require','验证码不能为空')
//    );




}