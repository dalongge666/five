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
    public function news_xq($id){
        $detail = M('news') -> where("id=$id") -> find();
        $this -> assign('detail',$detail);
        $this -> display('news_xq');
    }

}