<?php
namespace Company\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function list(){

        $this->display('index');
    }
}