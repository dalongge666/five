<?php
namespace Company\Model;
use Think\Model;
class CompanyRcdzModel extends Model
{
    protected $tableName = 'company_rcdz';
    //设置验证完所有字段信息
    protected $pacthValidate = true;
    //验证规则
    protected $_validate = array(
        array('major','require','专业不能为空'),
        array('number','require','数量不能为空'),
        array('require','require','要求不能为空'),
        array('price2','require','*'),
        array('linkman','require','联系人不能为空'),
        array('linktel','require','联系电话不能为空'),
        array('linktel','/^1[3,5,6,7,8,9]\d{9}$/','手机号格式不正确'),
        array('linkaddress','require','地址不能为空')
    );

}
