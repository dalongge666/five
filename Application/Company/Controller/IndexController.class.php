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
        //查未读的数量
        $id = session('mid');
        $cmid = M('company')->where("mid = $id") -> getField('id');
        $where['cmid'] = $cmid;
        $where['active'] = 1;
        $num = M('company_resume') -> where($where) ->count('id');

        $this ->assign('num',$num);
        $this->assign('resume',$resume);

        $this->display('index/index');
    }

}