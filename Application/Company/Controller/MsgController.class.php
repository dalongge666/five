<?php
namespace Company\Controller;
use Think\Controller;
class MsgController extends Controller {
    //求职消息
    public function list(){
        //查找求职
        $id = session('mid');
        $res = M()->table('my_resume as r')
            ->join('left join my_company_resume as cr on cr.rid = r.id')
            ->join('left join my_member as m on m.id = r.mid')
            ->join('left join my_company as c on c.id = cr.cmid')
            ->where("c.mid = $id")
            ->field('r.*,m.username')
            ->select();


        $this -> assign('res',$res);
        $this->display('msg/msg');
    }
    //求职消息详情
    public function msg_detail($id){
        $res = M()->table('my_resume as r')
            ->join('left join my_member as m on m.id = r.mid')
            ->join('left join my_company_resume as cr on cr.rid = r.id')
            ->join('left join my_position as p on cr.pid = p.id')
            ->field('m.username,r.companyName,p.positionName,r.id,cr.id as rcid')
            ->where("r.id = $id")
            ->find();


        $this -> assign('res',$res);
        $this -> display('msg/msg_detail');
    }
    //删除收到的求职信息
    public function msg_delete($id){
        if(IS_AJAX){
            if(M('company_resume') -> delete($id)){
                $this -> success('删除成功',U('Company/Msg/list'));
            }else{
                $this -> error('删除失败',U('Company/Msg/list'));
            }
        }

    }
}