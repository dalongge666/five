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

         $this->assign('res',$res);
        $this->display('index/zrc/rc_detail',['res']);
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