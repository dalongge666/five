<?php
namespace Company\Controller;
use Think\Controller;
class MineController extends Controller {

    //我的
    public function list(){

        $this->display('mine/mine');
    }
    //资料设置
    public function modifyInfo(){
        $id = session('mid');
        $com = M('company') -> where("mid = $id") ->find();
        $this -> assign('com',$com);

        $this -> display('mine/modifyInfo');
    }
}