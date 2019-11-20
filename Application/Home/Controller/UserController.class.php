<?php
namespace Home\Controller;

use Think\Controller;

class UserController extends Controller
{
    public function index()
    {
        $this -> display('user');
    }
    public function userinfo(){

        $this->display('user_info');
    }
    public function changePwd(){
        if(IS_POST){
            $member = D('Member');
            $rule = array(
                array('password','required','密码不能为空'),
                array('newPwd','required','新密码不能为空'),
                array('rePwd','required','确认密码不能为空'),
                array('rePwd','password','两次密码不一致',0,'confirm'),
            );
            if($member->validate($rule)->create(I('post.'))){

            }else{
                $errors = $member->getError();
                $this->assign('data',I('post'));
                $this->assign('errors',$errors);
                $this->display('user_info_mima');
            }
        }else{
            $this->display('user_info_mima');
        }


    }

    public function changeInfo(){

        $this->display('user_info_person');
    }


}