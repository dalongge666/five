<?php
namespace Home\Controller;

use Think\Controller;

class MsgController extends Controller
{
    //消息列表
    public function index()
    {
        $empty = '<h2 style="color: #444444;text-indent: 1em;padding: 1em;background: #dddddd">你还没有收到消息哦<h2/>';

        $mid = session('mid');

        $msg = M('mail as m') ->join('my_company as cm on m.aid=cm.id') ->field('m.id,m.add_time,m.active,cm.companyName')-> where("m.mid=$mid") -> select();

        $this -> assign(array('msg'=>$msg,'empty'=>$empty));
        $this -> display('msg');
    }


    //消息详情
    public function msg_xq($id){
        //状态已读
        M('mail') -> where("id=$id") -> save(array('active'=>2));

        $detail = M('mail as m') ->join('my_company as cm on m.aid=cm.id') -> join('my_resume as r on m.rid=r.id') ->field('m.id,m.content,m.add_time,m.rcid,cm.companyName,r.expectPosition')-> where("m.id=$id") -> find();

        $rcid= $detail['rcid'];
        $pid = M('company_resume') -> where("id=$rcid") -> getField('pid');

        $detail['pid'] = $pid;
        $this -> assign('detail',$detail);
        $this -> display();
    }

    //删除消息
    public function deleteMsg($id){
        if(M('mail') -> delete($id)){
            $this -> success('删除成功',U('Home/Msg/index'));
        }else{
            $this -> error('删除失败');
        }
    }
}