<?php
namespace Home\Controller;

use Think\Controller;

class PositionController extends Controller
{
    //职位列表
    public function list()
    {
        $this -> display('position');
    }

    //职位详情
    public function detail(){
        //查询该职位详情
        $id = I('get.id');
        var_dump($id);
        $detail = D('Position') -> where("id=$id") -> find();
        $detail['edu'] = array(1=>'大专',2=>'本科',3=>'硕士',4=>'博士');
        //分配给视图
        $this -> assign('detail',$detail);
        $this -> display('detail');
    }
}