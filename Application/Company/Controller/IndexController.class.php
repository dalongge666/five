<?php
namespace Company\Controller;
use Think\Controller;
class IndexController extends HSController {
    //首页
    public function list(){

        //求职遍历
        $resume = M()->table('my_resume as r')
            ->join('my_member as m on m.id = r.mid')
            ->field('r.*,m.username,m.sex,m.workYear,m.tel,m.year')
            ->limit(5)
            ->select();
        $this->assign('resume',$resume);
        $this->display('index/index');
    }

}