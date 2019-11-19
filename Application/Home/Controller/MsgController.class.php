<?php
namespace Home\Controller;

use Think\Controller;

class MsgController extends Controller
{
    public function index()
    {
        $this -> display('msg');
    }
}