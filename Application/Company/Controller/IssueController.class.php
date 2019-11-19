<?php
namespace Company\Controller;
use Think\Controller;
class IssueController extends Controller {
    //发布
    public function list(){
        $this->display('issue/issue');
    }
}