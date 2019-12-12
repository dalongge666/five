<?php
namespace Home\Controller;

use Think\Controller;
use Think\Page;

class PartnerController extends ShareController
{
    public function list(){

        //搜索条件
        $name = I('get.search');
        //搜索框
        $where['username'] = array('like',"%$name%");
        $where['position'] = array('like',"%$name%");
        $where['_logic'] = 'or';
        $map['_complex'] = $where;

        //有education条件则查询无则忽略
        if(I('get.education')){
            $map['education'] = array('eq',I('get.education'));
        }else{
            $map['1'] = '1';
        }

        //分页
        $count = D('partner') -> where($map)-> count('id');
        $Page = new Page($count,4);
        $show = $Page -> show();

        if(I('get.type')==1){
            //最新发布
            $partners = M('partner')
                ->where($map)
                ->order('add_time desc')
                ->limit($Page->firstRow.',4')
                ->select();
        }elseif(I('get.type')==2){
            //热门合伙人
            $partners = M('partner')
                ->where($map)
                ->order('look_num desc')
                ->limit($Page->firstRow.',4')
                ->select();
        }else{
            //查询合伙人
            $partners = M('partner')
                ->where($map)
                ->limit($Page->firstRow.',4')
                ->select();
        }

        //分配education
        if($map['education']){
            $arr1 = array(1=>'大专',2=>'本科',3=>'硕士',4=>'博士');
            $edu = $arr1[I('get.education')];
            $this -> assign(array('edu'=>$edu,'education'=>I('get.education')));
        }
        //分配order
        if(I('get.type')){
            $rank = I('get.type')==1?'最新发布':'热门职位';
            $this -> assign(array('type'=>I('get.type'),'rank'=>$rank));
        }

        //暂无数据
        $empty = '<h2 style="color: #444444;text-indent: 1em;padding: 1em;background: #dddddd">没有找到满足条件的数据<h2/>';

        $this -> assign(array('partners'=>$partners,'empty'=>$empty,'name'=>$name,'page'=>$show));

        $this -> display('partner');
    }


    //我的合伙信息
    public function mypart(){

        if(IS_AJAX){
            $rule = array(
                array('username','require','请输入您的姓名'),
                array('age','require','请输入您的年龄'),
                array('age','/\d/','年龄必须为数字'),
                array('education','require','请选择您的学历'),
                array('position','require','请输入您的职业'),
                array('workYear','require','请输入您的工作经验'),
                array('address','require','请输入您的现居住地'),
                array('mobile','require','请输入您的联系方式'),
                array('mobile','/^1[3456789]\d{9}$/','联系方式有误'),
                array('keyword','require','请输入您的标签'),
                array('work_experience','require','请输入您的工作经历'),
                array('edu_experience','require','请输入您的教育经历'),
                array('my_skill','require','请输入您的专业技能'),
                array('need_skill','require','请输入需求技能'),
                array('description','require','请输入自我描述')
            );

            $mypart = M('partner');

            if($mypart -> validate($rule) -> create(I('post'))){
                //重复发布
                $mid = session('mid');
                if($mypart -> where("mid=$mid") ->find()){
                    $this -> error('您已发布过合伙信息,请不要重复发布',U('Home/Partner/mypart'));
                }

                //写入数据库
                $data = I('post.');
                $data['mid'] = $mid;
                $data['add_time'] = time();
                $data['avatar']  = M('member') -> where("id=$mid") ->getField('avater');

                if( $mypart -> add($data) ){
                    $this -> success('发布成功',U('Home/User/index'));
                }else{
                    $this -> error('发布失败',U('Home/Partner/mypart'));
                }
            }else{

                $this -> error('表单验证未通过',U('Home/Partner/mypart'));
            }
        }else{
            $member = M('member') -> find(session('mid'));
            $this -> assign('member',$member);
            $this -> display('User/user_mypart');
        }

    }

    //合伙信息详情页
    public function detail($id){

        //浏览次数加一
        M('partner') -> where("id=$id") -> setInc('look_num');
        //查询数据库
        $detail = M('partner') -> find($id);

        //学历数字替换为字符串
        $arr = array(1=>'大专',2=>'本科',3=>'硕士',4=>'博士',999=>'其他');
        $edu = $detail['education'];
        $detail['education'] = $arr[$edu];
        //工作经验
        $arr1 = array('0,1'=>'实习','1,3'=>'1-3年','3,5'=>'3-5年','5,10'=>'5-10','10,999'=>'10年以上');
        $work = $detail['workYear'];
        $detail['workYear'] = $arr1[$work];

        if(session('?mid')){
            //查询是否被收藏
            $where['mid'] = session('mid');
            $where['pid'] = $id;
            $collect = M('partnerCollect') -> where($where) -> count('id');
            $this -> assign('collect',$collect);
        }

        $this -> assign(array('detail'=>$detail));

        $this -> display('detail');
    }

    //收藏合伙人
    public function collect($pid)
    {
        $mid = session('mid');

        //收藏
        if (M('partnerCollect')->add(['pid' => $pid, 'mid' => $mid, 'add_time' => time()])) {

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
        $id = M('partnerCollect')->where($where) -> getField('id');

        //取消收藏
        if (M('partnerCollect')->delete($id)) {
            $this->success('取消收藏成功');
        } else {
            $this->error('取消收藏失败');
        }

    }

    //收藏合伙人列表
    public function myCollect(){

    }

}