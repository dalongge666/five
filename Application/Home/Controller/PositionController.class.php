<?php
namespace Home\Controller;

use Think\Controller;

class PositionController extends Controller
{
    public function list()
    {
        $this -> display('position');
    }
}