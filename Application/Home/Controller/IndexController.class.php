<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $positions = M('Position')
                ->alias('p')
                ->join('__COMPANY__ as c on p.cmid=c.id')
                ->field('p.*,c.companyName,c.introduce_detail')
                ->order('add_time','desc')
                ->limit(5)
                ->select();

        $this -> assign('positions',$positions);
        $this -> display('index');
    }
}