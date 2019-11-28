<?php
namespace Home\Controller;

use Think\Controller;

class LoginController extends Controller
{
    //登录
    public function login(){

        if(IS_POST){
            $member = D('Member');
            $rule = array(
                array('username','require','用户名不能为空'),
                array('password','require','密码不能为空')
            );

            if($member->validate($rule)->create(I('post.'))){
                //验证通过
                $username = trim(I('post.username'));
                $password = md5(trim(I('post.password')));
                $where['username'] = $username;
                $where['password'] = $password;
                 $user =  M('Member')->where($where)->find();

                if($user){
                    session('mid',$user['id']);
                    session('type',$user['type']);
                    session('mname',$username);
                    if($user['type'] ==1){

                        $this->ajaxReturn(['status'=>'ok']);
                    }elseif($user['type'] ==2){
                        $this->ajaxReturn(['status'=>'ok','url'=>U('Company/Index/list')]);
                    }

                }else{
                    $this->ajaxReturn(['msg'=>'用户名或密码不正确','status'=>'error']);
                }


            }else{
                $errors = $member ->getError();
                $this -> assign('data',I('post.'));
                $this ->assign('errors',$errors);
                $this ->display('login');
            }
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
                $data['username'] = trim(I('post.username'));
                $data['password'] = md5(I('post.password'));
                $data['tel'] = trim(I('post.tel'));
                $data['type'] = I('post.type');
                $data['add_time'] = time();
               if(session('mobile_code') == trim(I('post.msg_code'))){
                   if($id = M('Member')->add($data)){
                        session('mid',$id);
                        session('mname',$data['username']);
                       if($data['type']==1){
                           $this->ajaxReturn(['status'=>'ok','msg'=>'注册成功']);
                       }elseif ($data['type']==2){
                           $this->ajaxReturn(['status'=>'ok','msg'=>'注册成功']);
                       }

                   }else{
                       $this->ajaxReturn(['status'=>'error','msg'=>'注册失败']);
                   }

               }else{
                   $this->ajaxReturn(['status'=>'error','msg'=>'验证码不正确']);
               }
            }

        }else{
            $this -> display('register');
        }

    }


    public function logout(){
            session(null);
        $this->ajaxReturn(['status'=>'ok']);

    }


    //发送短信验证码
    public function sendMsg(){
        Vendor('sms.sms','','.class.php');
        $sms = new \ihuyi_sms(C('msg.appid'),C('msg.appkey'),C('msg.url'));
        $sms -> send_sms( I('post.mobile') );
    }

    //判断短信验证码验证
    public function chkMsg(){

        if( session('mobile_code') == trim( I('post.msg_code') ) ){
            echo 'true';
        }else{
            echo 'false';
        }
    }
    public function chkUsername(){
        $where['username'] = I('post.username');
        if(M('Member')->where($where)->find()
        ){
            return 'false';
        }else{
            return 'true';
        }
    }

    public function chkTel(){
        $where['tel'] = I('post.tel');
        if(M('Member')->where($where)->find()){
            return 'false';
        }else{
            return 'true';
        }
    }


}