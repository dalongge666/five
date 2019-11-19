<?php
namespace Company\Controller;
use Think\Controller;
class MineController extends Controller {

    //我的
    public function list(){
        $this->display('mine/mine');
    }
}