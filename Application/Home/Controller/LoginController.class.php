<?php
namespace Home\Controller;

use Think\Controller;

class LoginController extends Controller
{
    //登录
    public function login(){

        if(IS_POST){


        }else{
            $this -> display('login');
        }

    }

    //注册
    public function register(){
        if(IS_POST){
            //接收表单数据
            $data = I('post.');
            //表单验证
            $member = D('Member');
            if(!$member -> create()){
                //错误信息
                $errors = $member -> getError();
                //返回错误信息和数据
                $this -> assign('errors',$errors);
                $this -> assign('data',$data);
                $this -> display('register');
            }else{
                //通过表单验证


            }

        }else{
            $this -> display('register');
        }


    }
}