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
            $password = md5(trim(I('post.password')));
            $newPwd = md5(trim(I('post.newPwd')));
            $rePwd = md5(trim(I('post.rePwd')));
            $id=session('mid');
            $member = D('Member')->where("id=$id")->find();
            if($password == $member['password']){
                if($newPwd == $rePwd){
                    $where['id'] = $id;
                    $where['password'] = $password;
                    if(M('Member')->where($where)->data(array('password'=>md5(I('POST.newPwd'))))->save()){
                        $this->ajaxReturn(['status'=>'ok','msg'=>'更改成功','url'=>U('Home/User/user_info')]);
                    }else{
                        $this->ajaxReturn(['status'=>'error','msg'=>'更改失败']);
                    }
                }else{
                    $this->ajaxReturn(['status'=>'error','msg'=>'两次密码输入不一致']);
                }
            }else{
                $this->ajaxReturn(['status'=>'error','msg'=>'原密码错误']);
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
    public function resume(){
        $mid = session('mid');
        $resume = M('Resume')->where("mid=$mid")->select();

        $this->assign('resume',$resume);
            $this->display('user_myresume');
    }

    public function createResume(){
        if(IS_AJAX){
            $resume = D('Resume');
            $rule = array(
                array('expectWork','require','请填写期望工作地点'),
                array('tel','require','请填写联系电话'),
                array('workExperience','require','请填写工作经历'),
                array('educationYear','require','请填写教育经历'),
                array('professionalJn','require','请填写专业技能'),
                array('selfDescription','require','请填写自我描述'),
            );
            if($resume->validate($rule)->create(I('post'))){
                $data = I('post.');
                $data['add_time']=time();
                $data['mid'] = session('mid');
//                if($resume = M('Resume')->where("mid={$data['mid']}")->find()){
//                    if(M('Resume')->where("mid={$data["mid"]}")->data($data)->save()){
//                        $this->ajaxReturn(['msg'=>'保存成功','status'=>'ok']);
//                    }else{
//                        $this->ajaxReturn(['msg'=>'保存失败','status'=>'error']);
//                    }
//                }else{
                    if(M('Resume')->add($data)){
                        $this->ajaxReturn(['msg'=>'保存成功','status'=>'ok']);
                    }else{
                        $this->ajaxReturn(['msg'=>'保存失败','status'=>'error']);
                    }
//                }

            }else{
                $errors = $resume->getError();
                $this->assign( 'data',I('post.') );
                $this->assign( 'errors',$errors );
                $this->display('user_myresume_create');
            }
        }else{
            $this->display('user_myresume_create');
        }

    }


    public function edit($id)
    {


        if(IS_POST){
            $id = I('post.id');
            $resume = D('Resume');
            $rule = array(
                array('expectWork','require','请填写期望工作地点'),
                array('tel','require','请填写联系电话'),
                array('workExperience','require','请填写工作经历'),
                array('educationYear','require','请填写教育经历'),
                array('professionalJn','require','请填写专业技能'),
                array('selfDescription','require','请填写自我描述'),

            );
            if($resume->validate($rule)->create(I('post.'))){
//             M('Resume')->where("id=$id")->find();
                $data=I('post.');
                if(M('Resume')->where("id=$id")->data($data)->save()){
                    $this->ajaxReturn(['status'=>'ok','url'=>U('Home/User/resume')]);
                }else{
                    $this->ajaxReturn(['status'=>'error']);
                }


            }else{
                $errors = $resume->getError();
                $this->assign( 'data',I('post.') );
                $this->assign( 'errors',$errors );
                $this->display('user_myresume_edit');
            }
        }else{

            $resume = M('Resume')->where("id=$id")->find();
            $this->assign('resume', $resume);

            $this->display('user_myresume_edit');
        }


    }


        public function delete($id){
                if(IS_AJAX){
                   if(M('Resume')->where("id=$id")->delete()){
                       $this->ajaxReturn(['status'=>'ok']);
                   }else{
                       $this->ajaxReturn(['status'=>'error']);
                   }
                }else{
                    $this->display('user_myresume');
                }
        }




    }


