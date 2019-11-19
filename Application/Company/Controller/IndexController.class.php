<?php
namespace Company\Controller;
use Think\Controller;
class IndexController extends Controller {
    //首页
    public function list(){
        $resume = M()->table('my_resume as r')
            ->join('my_member as m on m.id = r.mid')
            ->field('r.*,m.username,m.sex')
            ->select();
//        print_r($resume);
        $this->assign('resume',$resume);
        $this->display('index/index',['resume']);
    }

}