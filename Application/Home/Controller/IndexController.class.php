<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends ShareController
{
    //首页
    public function index(){
        //职位
        $positions = D('Position') -> limit(8) -> select();
        //

        $this -> assign('positions',$positions);
        $this -> display('index');
    }
}