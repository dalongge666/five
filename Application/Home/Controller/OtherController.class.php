<?php
namespace Home\Controller;

use Think\Controller;

class OtherController extends ShareController
{
    //关于我们
    public function about(){

        $this -> display('about');
    }
    //新闻列表
    public function news(){
        $this -> display('newslist');
    }
    //新闻详情
    public function news_xq(){
        $this -> display('news_xq');
    }

}