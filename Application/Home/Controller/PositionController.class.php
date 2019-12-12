<?php
namespace Home\Controller;

use Think\Controller;
use Think\Page;

class PositionController extends ShareController
{
    //职位列表
    public function list()
    {
        //搜索条件
        $name = I('get.search');
        //写入热搜表
        $hot['hotName'] = $name;
        if (M('hotsearch')->find($name)) {
            M('hotsearch')->where($hot)->setInc('num');
        } else {
            M('hotsearch')->add(array('hotName' => $name));
        }

        $where['positionName'] = array('like', "%$name%");
        $where['workAddress'] = array('like', "%$name%");
        $where['_logic'] = 'or';
        $map['_complex'] = $where;
        //有cid条件则查询无则忽略
        if (I('get.cid')) {
            $map['cid'] = I('get.cid');
        } else {
            $map['1'] = '1';
        }
        //有salary条件则查询无则忽略
        if (I('get.salaryMin')) {
            $map['salaryMin'] = array('gt', I('get.salaryMin'));
            $map['salaryMax'] = array('lt', I('get.salaryMax'));
        } else {
            $map['1'] = '1';
        }
        //有education条件则查询无则忽略
        if (I('get.education')) {
            $map['education'] = array('eq', I('get.education'));
        } else {
            $map['1'] = '1';
        }

        //分页
        $count = D('Position')->where($map)->count('id');
        $Page = new Page($count, 4);
        $show = $Page->show();
        if (I('get.type') == 1) {
            //最新发布
            $positions = D('Position')
                ->where($map)
                ->order('add_time desc')
                ->limit($Page->firstRow . ',4')
                ->select();
        } elseif (I('get.type') == 2) {
            //热门职位
            $positions = D('Position')
                ->where($map)
                ->order('look_num desc')
                ->limit($Page->firstRow . ',4')
                ->select();
        } else {
            //查询职位
            $positions = D('Position')
                ->where($map)
                ->limit($Page->firstRow . ',4')
                ->select();
        }


        //暂无数据
        $empty = '<h2 style="color: #444444;text-indent: 1em;padding: 1em;background: #dddddd">没有找到满足条件的数据<h2/>';

        //分配catename
        if ($map['cid']) {
            $catename = M('category')->where("id={$map['cid']}")->getField('catename');
            $this->assign(array('catename' => $catename, 'cid' => $map['cid']));
        }

        //分配salary
        if ($map['salaryMin']) {
            $arr = array('12' => '2k以下', '25' => '2k-5k', '510' => '5k-10k', '1015' => '10k-15k', '1525' => '15k-25k', '2550' => '25k-50k', '50999' => '50k以上');
            $str = I('get.salaryMin') . I('get.salaryMax');
            $salary = $arr[$str];
            $this->assign(array('salary' => $salary, 'salaryMin' => I('get.salaryMin'), 'salaryMax' => I('get.salaryMax')));
        }
        //分配education
        if ($map['education']) {
            $arr1 = array(1 => '大专', 2 => '本科', 3 => '硕士', 4 => '博士');
            $edu = $arr1[I('get.education')];
            $this->assign(array('edu' => $edu, 'education' => I('get.education')));
        }
        //分配order
        if (I('get.type')) {
            $rank = I('get.type') == 1 ? '最新发布' : '热门职位';
            $this->assign(array('type' => I('get.type'), 'rank' => $rank));
        }

        //分配数据
        $this->assign(array('positions' => $positions, 'empty' => $empty, 'name' => $name, 'page' => $show));
        $this->display('position');


    }


    //职位详情
    public function detail()
    {
        $id = I('get.id');
        //增加浏览量
        D('Position')->where("id=$id")->setInc('look_num');
        //查询该职位详情

        $detail = M('position')
            ->alias('p')
            ->join('__COMPANY__ as c on p.cmid=c.id')
            ->field('p.*,c.companyName,c.introduce_detail')
            ->order('add_time', 'desc')
            ->where("p.id=$id")
            ->find();
        $detail['edu'] = array(1 => '大专', 2 => '本科', 3 => '硕士', 4 => '博士', 999 => '不限');
        if(session('?mid')){
            //查询是否被收藏
            $mid = session('mid');
            $where['mid'] = session('mid');
            $where['pid'] = $id;
            $collect = M('collect') -> where($where) -> count('id');

            //我的简历
            $myResume = M('resume') -> where("mid=$mid") -> select();
            $this -> assign(array('collect'=>$collect,'myResume'=>$myResume));
        }

        //分配给视图
        $this->assign('detail', $detail);
        $this->display('detail');
    }

    //二级分类
    public function secondTree()
    {
        $pid = I('get.pid');
        //二级分类
        $secondTree = M('category')->where("pid=$pid")->select();

        $this->assign('secondTree', $secondTree);
        $this->display('secondTree');

    }

    //三级分类
    public function thirdTree()
    {
        $pid = I('get.pid');
        $name = I('get.name');
        $type = I('get.type');
        $salaryMin = I('get.salaryMin');
        $salaryMax = I('get.salaryMax');
        $education = I('get.education');
        //三级分类
        $thirdTree = M('category')->where("pid=$pid")->select();

        $this->assign(array('thirdTree' => $thirdTree, 'name' => $name, 'type' => $type, 'education' => $education, 'salaryMin' => $salaryMin, 'salaryMax' => $salaryMax));
        $this->display('thirdTree');

    }

    //收藏职位
    public function collect($pid)
    {
        $mid = session('mid');

        $cmid = M('position')->where("id=$pid")->getField('cmid');
        //收藏
        if (M('collect')->add(['pid' => $pid, 'cmid' => $cmid, 'mid' => $mid, 'add_time' => time()])) {

            $this->success('收藏成功');
        } else {

            $this->error('收藏失败');
        }


    }

    public function qx_collect($pid)
    {

        //查询
        $where['pid'] = $pid;
        $where['mid'] = session('mid');
        $collect = M('collect')->where($where)->find();

        //取消收藏
        if (M('collect')->delete($collect['id'])) {
            $this->success('取消收藏成功');
        } else {
            $this->error('取消收藏失败');
        }

    }

    //职位收藏列表
    public function myCollect(){
        //合伙人
        $empty1 = '<h2 style="color: #444444;text-indent: 1em;padding: 1em;background: #dddddd">你还没有收藏职位<h2/>';

        $mid = session('mid');
        $myPartnerCollect = M('partnerCollect as pc') -> join('my_partner as p on p.id=pc.pid') ->field('pc.id,p.*') -> where("pc.mid=$mid") -> select();

        $education= array(1 => '大专', 2 => '本科', 3 => '硕士', 4 => '博士', 999 => '不限');

        $this -> assign(array('myPartnerCollect'=>$myPartnerCollect,'empty1'=>$empty1,'education'=>$education));


        //职位
        $empty = '<h2 style="color: #444444;text-indent: 1em;padding: 1em;background: #dddddd">你还没有收藏职位<h2/>';

        $mid = session('mid');
        $myCollect = M('collect as c')
            ->join('my_position as p on p.id=c.pid')
            ->field('c.*,p.id as pid,p.positionName,p.salaryMin,p.salaryMax,p.positionAdvantage')
            ->where("mid=$mid")
            ->select();


        $this -> assign(array('myCollect'=>$myCollect,'empty'=>$empty));

        $this -> display('User/user_mycollect');
    }

    public function sendResume(){

        $data = I('post.');
        $data['mid'] = session('mid');
        $data['add_time'] = time();

        $where['mid'] = session('mid');
        $where['pid'] = I('post.pid');
        if(M('companyResume') -> where($where) -> find()){
            $this -> error('请勿重复求职，耐心等待通知');
        }

        if(M('companyResume')->add($data)){
            $this -> success('求职成功，请等待通知');
        }else{
            $this -> error('求职失败，请稍后再试');
        }
    }

}