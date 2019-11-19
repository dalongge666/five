<?php
namespace Company\Controller;
use Think\Controller;
class IndexController extends Controller {
    //首页
    public function list(){

        $this->display('index/index');
    }
    //发布
    public function issue(){
        $this->display('issue/issue');
    }
    //消息
    public function msg(){
        $this->display('msg/msg');
    }
    //我的
    public function mine(){
        $this->display('mine/mine');
    }
}