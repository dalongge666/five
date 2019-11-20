<?php
namespace Company\Controller;
use Think\Controller;

class RcController extends HSController {
    //找人才
     public function zrc(){
         $search = I('search');

         //插入热搜
         $hot['name'] = $search;
         if(M('company_hotsearch')->find($search)){
             M('company_hotsearch')->where($hot) -> setInc('num');
         }else{
             M('company_hotsearch') -> add($hot);
         }

             //人才搜索
             $where['expectPosition'] = array('like',"%$search%");
             $where['expectCity'] = array('like',"$search");
             $where['sex'] = array('like',"$search");
             $where['_logic'] = 'or';

             $resume = M()->table('my_resume as r')
                 ->join('my_member as m on m.id = r.mid')
                 ->field('r.*,m.username,m.sex,m.workYear,m.tel,m.year')
                 ->order('add_time desc')
                 ->where($where)
                 ->select();

         $empty = '<h2 style="color: #444444;text-indent: 1em;padding: 1em;background: #cccccc">没有找到满足条件的数据<h2/>';

             $this->assign(array('resume'=>$resume,'empty'=>$empty,'search'=>$search));
             $this->display('index/zrc/rc_list');


     }
     //人才详情
    public function rc_detail($id){
         //浏览次数
        M('resume')->where("id = $id")->setInc('look_num');

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