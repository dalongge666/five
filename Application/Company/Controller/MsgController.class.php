<?php
namespace Company\Controller;
use Think\Controller;
class MsgController extends Controller {
    //消息
    public function list(){
        $this->display('msg/msg');
    }
}