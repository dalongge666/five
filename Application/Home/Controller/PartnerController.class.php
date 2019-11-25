<?php
namespace Home\Controller;

use Think\Controller;

class PartnerController extends ShareController
{
    public function list(){


        $this -> display('partner');
    }


    //我的合伙信息
    public function mypart(){

        if(IS_AJAX){
            $rule = array(
                array('username','require','请输入您的姓名'),
                array('age','require','请输入您的年龄'),
                array('age','/\d/','年龄必须为数字'),
                array('education','require','请选择您的学历'),
                array('position','require','请输入您的职业'),
                array('workYear','require','请输入您的工作经验'),
                array('address','require','请输入您的现居住地'),
                array('mobile','require','请输入您的联系方式'),
                array('mobile','/^1[3456789]\d{9}$/','联系方式有误'),
                array('keyword','require','请输入您的标签'),
                array('work_experience','require','请输入您的工作经历'),
                array('edu_experience','require','请输入您的教育经历'),
                array('my_skill','require','请输入您的专业技能'),
                array('need_skill','require','请输入需求技能'),
                array('description','require','请输入自我描述')
            );

            $mypart = M('partner');

            if($mypart -> validate($rule) -> create(I('post'))){
                //重复发布
                $mid = session('mid');
                if($mypart -> where("mid=$mid") ->find()){
                    $this -> error('您已经发布过,请不要重复发布',U('Home/Partner/mypart'));
                }

                //写入数据库
                $data = I('post');
                $data['mid'] = $mid;
                if( $mypart -> add($data) ){
                    $this -> success('发布成功',U('Home/User/index'));
                }else{
                    $this -> error('发布失败',U('Home/Partner/mypart'));
                }
            }else{

                $this -> error('表单验证未通过',U('Home/Partner/mypart'));
            }
        }else{
            $member = M('member') -> find(session('mid'));
            $this -> assign('member',$member);
            $this -> display('user/user_mypart');
        }


    }
}