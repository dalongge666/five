<?php
namespace Home\Controller;

use Think\Controller;

class PositionController extends ShareController
{
    //职位列表
    public function list(){
        //搜索条件
        $name = I('get.search');
        //写入热搜表
        $hot['hotName'] = $name;
        if(M('hotsearch') -> find($name)){
            M('hotsearch')->where($hot) -> setInc('num');
        }else{
            M('hotsearch')->add(array('hotName' => $name));
        }

        $where['positionName'] = array('like',"%$name%");
        $where['workAddress'] = array('like',"%$name%");
        $where['_logic'] = 'or';
        //查询职位
        $positions = D('Position')
            ->order('add_time desc')
            ->where($where)
            ->limit(10)
            ->select();


        //暂无数据
        $empty = '<h2 style="color: #444444;text-indent: 1em;padding: 1em;background: #cccccc">没有找到满足条件的数据<h2/>';
        //分配数据
        $this -> assign(array('positions'=>$positions,'empty'=>$empty,'name'=>$name));
        $this -> display('position');
    }

    //职位详情
    public function detail(){
        $id = I('get.id');
        //增加浏览量
        D('Position') -> where("id=$id") -> setInc('look_num');
        //查询该职位详情
        var_dump($id);
        $detail = M('position')
            ->alias('p')
            ->join('__COMPANY__ as c on p.cmid=c.id')
            ->field('p.*,c.companyName,c.introduce_detail')
            ->order('add_time','desc')
            ->where("p.id=$id")
            ->find();
        $detail['edu'] = array(1=>'大专',2=>'本科',3=>'硕士',4=>'博士',999=>'不限');
        //查询是否被收藏

        //分配给视图
        $this -> assign('detail',$detail);
        $this -> display('detail');
    }

    //二级分类
    public function secondTree(){
        $pid = I('get.pid');
        //二级分类
        $secondTree = M('category') -> where("pid=$pid") -> select();

        $this -> assign('secondTree',$secondTree);
        $this -> display('secondTree');

    }


}