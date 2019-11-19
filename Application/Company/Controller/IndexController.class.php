<?php
namespace Company\Controller;
use Think\Controller;
class IndexController extends Controller {
    //首页
    public function list(){


        $this->display('index/index');
    }

}