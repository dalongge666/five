<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $positions = D('Position') -> order('add_time','desc') -> limit(5) -> select();

        $this -> assign('positions',$positions);
        $this -> display('index');
    }
}