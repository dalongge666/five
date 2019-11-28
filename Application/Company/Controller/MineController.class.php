<?php
namespace Company\Controller;
use Think\Controller;
use Think\Image;
use Think\Upload;
class MineController extends Controller {

    //我的
    public function list(){
        if($id = session('mid')){
            $com = M('company') ->where("mid = $id") ->find();
            $this -> assign('com',$com);
        }
        $this->display('mine/mine');
    }
    //资料设置
    public function modifyInfo(){
        //接收数据
        if(IS_AJAX){

//            $config = array(
//                'maxSize'    =>    1048576,
//                'rootPath'   =>    C('UPLOAD'),   //注意此目录不会自动创建
//                'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
//                'autoSub'    =>    true,
//                'subName'    =>    array('date','Ym'),
//            );
//
//            $upload = new Upload($config);
//
//            //判断目录是否存在
//            if(!file_exists($upload->rootPath)){
//                mkdir($upload->rootPath,'777');
//            }
//
//            //上传
//            $info = $upload ->upload();

            $data = I('post.');
//            $data['logo'] =  $upload->rootPath.$info['logo']['savepath'].$info['logo']['savename'];




            $id = session('mid');


            if(M('company') -> where("mid = $id") ->save($data)){
                $this -> success('修改成功');
            }else{
                $this -> error('修改失败');
            }


        }else{
            $id = session('mid');
            $com = M('company') -> where("mid = $id") ->find();
            $this -> assign('com',$com);

            $this -> display('mine/modifyInfo');
        }
    }
}