<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends ShareController
{
    //首页
    public function index(){
        //职位
        $positions = D('Position') -> limit(8) -> select();
        //公告
        $news = M('news') -> where('active=1') -> select();

        $this -> assign(array('positions'=>$positions,'news'=>$news));
        $this -> display('index');
    }
}