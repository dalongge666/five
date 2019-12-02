<?php
namespace Company\Controller;
use Think\Controller;
class MsgController extends Controller {
    //消息
    public function list(){
        //查找求职


//        $this -> assign('member',$member);
//        $this -> assign('cr',$cr);
        $this->display('msg/msg');
    }
}