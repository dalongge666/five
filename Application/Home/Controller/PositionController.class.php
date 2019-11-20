<?php
namespace Home\Controller;

use Think\Controller;

class PositionController extends Controller
{
    //职位列表
    public function list(){
        $name = I('get.search');
        $where['positionName'] = array('like',"%$name%");
        $where['workAddress'] = array('like',"%$name%");
        $where['_logic'] = 'or';
        //查询职位
        $positions = D('Position')
            ->order('add_time desc')
            ->where($where)
            ->limit(10)
            ->select();
        //分配数据
        $this -> assign('positions',$positions);
        $this -> display('position');
    }

    //职位详情
    public function detail(){
        //查询该职位详情
        $id = I('get.id');
        var_dump($id);
        $detail = M('Position')
            ->alias('p')
            ->join('__COMPANY__ as c on p.cmid=c.id')
            ->field('p.*,c.companyName,c.introduce_detail')
            ->order('add_time','desc')
            ->where("p.id=$id")
            ->find();
        $detail['edu'] = array(1=>'大专',2=>'本科',3=>'硕士',4=>'博士',5=>'不限');
        //查询是否被收藏

        //分配给视图
        $this -> assign('detail',$detail);
        $this -> display('detail');
    }
}