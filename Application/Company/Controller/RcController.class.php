<?php
namespace Company\Controller;
use Think\Controller;

class RcController extends Controller {
    //找人才
     public function zrc(){
         $resume = M()->table('my_resume as r')
             ->join('my_member as m on m.id = r.mid')
             ->field('r.*,m.username,m.sex,m.workYear')
             ->select();
//        print_r($resume);
         $this->assign('resume',$resume);
         $this->display('index/zrc/rc_list',['resume']);
     }
     //人才详情
    public function rc_detail($id){
         $res = M('resume')->alias('r')
                          ->join('__MEMBER__ as m on m.id = r.mid')
                          ->where("r.id =$id")
                          ->field('r.*,m.*')
                          ->find();

         $this -> assign('res',$res);
        $this -> display('index/zrc/rc_detail');
    }
    //邀请面试
    public function invite($id){
         if(session('mid')){
             if(IS_POST){
                 $data['content'] = I('content');
                 $data['add_time'] = time();
                 $data['aid'] = session('mid');
                 $data['mid'] = $id;

                 if(M('mail') -> add($data)){
                     $this -> success('发送成功',U('Company/Rc/re_detail'),1);
                 }else{
                     $this -> error('发送失败',U('Company/Rc/rc_detail'),1);
                 }
             }
         }else{
             $this -> error('登录后才可以发送邀请',U('Home/Login/login'),1);
         }

    }

     //项目合伙人
    public function item(){
        $this->display('index/xmhhr/item');
    }
    //人才定制
    public function rcdz(){
        $this->display('index/rcdz/rc_order');
    }
}