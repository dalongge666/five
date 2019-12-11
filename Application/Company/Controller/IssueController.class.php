<?php
namespace Company\Controller;
use Think\Controller;
class IssueController extends Controller {
    //发布
    public function list(){
        $this->display('issue/issue');
    }
    //完善发布信息
    public function issue()
    {
        if (request()->isMethod('IS_POST')) {
        } else {
            session(['page' => 2]);
            return view('home.company.issue');
        }
    }



    //表单验证
    public function position(){
        if(IS_POST){
            $rule = array(
                array('positionName','require','请输入招聘标题'),
                array('Numbers','require','请输入招聘人数'),
                array('Numbers','/\d/','招聘人数必须为数字'),
                array('workAddress','require','请输入工作地址'),
                array('Contact','require','请输入联系人'),
                array('phone','require','请输入联系电话'),
                array('phone','/^1[3456789]\d{9}$/','联系电话有误'),
                array('cmid','require','请输入企业名称'),
//                array('project','require','请输入项目名称'),
//                array('projectSubject','require','请输入项目主体'),
//                array('projectFund','require','请输入项目资金'),
//                array('projectSite','require','请输入项目地址'),
//                array('columnName','require','请输入栏目名称'),
            );

            $issue = M('position');

            if($issue -> validate($rule) -> create(I('post.'))){

                $mid = session('mid');
                //写入数据库
                $data = I('post.');
                $data['mid'] = $mid;
                $data['add_time'] = time();
                if( $issue -> add($data) ){
                    $this -> success('发布成功');
                }else{
                    $this -> error('发布失败');
                }
            }else{

                    ECHO $issue-> getError();

                $this -> error('表单验证未通过',U('Home/Partner/issue'));
            }
        }else{
            $position = M('position') -> find(session('mid'));
            $this -> assign('position',$position);
            $this -> display('user/user_issue');
        }

    }


}