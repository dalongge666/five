<?php
namespace Company\Controller;
use Think\Controller;

class RcController extends Controller {
    //找人才
     public function zrc(){
         $this->display('index/zrc/rc_list');
     }
     //项目合伙人
    public function item(){
        $this->display('index/xmhhr/item');
    }
    //人才定制
    public function rcdz(){
        $this->display('index/rcdz/rc_order');
    }
}