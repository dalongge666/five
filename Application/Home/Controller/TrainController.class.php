<?php
namespace Home\Controller;

use Think\Controller;

class TrainController extends Controller
{
    public function list(){


        $this -> display('train');
    }
}