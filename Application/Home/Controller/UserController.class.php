<?php
namespace Home\Controller;

use Think\Controller;
use Think\Image;
use Think\Upload;

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
//             dump(I('post.'));
            $member = D('Member');

            $rule = array(
                array('password','require','密码不能为空'),
                array('newPwd','require','新密码不能为空'),
                array('rePwd','require','确认密码不能为空'),
                array('rePwd','newPwd','两次密码不一致',0,'confirm'),
            );
            if($member->validate($rule)->create(I('post.'))){
                $id = session('mid');
                $password = md5(trim(I('post.password')));

                $pwd=M('member')->where("id=$id")->find();
                    if ($pwd['password']==$password){
                        $where['id'] = $id;
                        $where['password'] = $password;
                        if(M('Member')->where($where)->data(array('password'=>md5(I('POST.newPwd'))))->save()){
                            $this->success('更改成功',U('Home/User/user_info'));
                        }else{
                            $this->error('更改失败');
                        }
                    }else{
                        $errors['password'] = '原密码错误';
                        $this->assign('errors',$errors);
                        $this->display('user_info_mima');
                    }

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
        if(IS_POST){

            $config = array(
                'maxSize' => 1048576,
                'rootPath' => C('UPLOAD'),
                'exts' => array('jpg','gif','png','jpeg'),
                'autoSub' => true,
                'subName' => array('date','Ym')
            );
            $upload = new Upload($config);
            //判断目录是否存在
            if(!file_exists($upload->rootPath)){
                mkdir($upload->rootPath,'777');
            }

            //上传
            $info = $upload ->upload();
            //dump($info);
            if($info){
                foreach ($info as $file){
                    $image = new Image();

                    $filepath = $upload->rootPath . $file['savepath'] . $file['savename'];

                    $filepath40 = $upload->rootPath . $file['savepath'] .'40_' . $file['savename'];
                    //缩放
                     $image -> open($filepath) -> thumb(40,40) -> save($filepath40);

                }
            }else{
                $upload->getError();
            }



        }else{
        $this->display('user_info_person');
        }

    }


}