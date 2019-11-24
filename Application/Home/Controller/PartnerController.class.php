<?php
namespace Home\Controller;

use Think\Controller;

class PartnerController extends ShareController
{
    public function index(){


        $positions = D('Position') -> limit(8) -> select();

        $this -> assign('positions',$positions);
        $this -> display('index');
    }
}