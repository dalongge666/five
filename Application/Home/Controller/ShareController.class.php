<?php
namespace Home\Controller;

use Think\Controller;

class ShareController extends Controller
{
    public function __construct(){
        parent::__construct();
        //热搜
        $hotsearch = M('hotsearch') -> order('num desc') -> limit(15) -> select();
        $this -> assign('hotsearch',$hotsearch);

        //热门职位
        $hotPosition = D('Position') -> order('look_num desc') -> limit(15) -> field('id,positionName') -> select();
        $this -> assign('hotposition',$hotPosition);


        //顶级分类
        $cateTree = M('category') -> where('pid=0') -> select();


        $this -> assign('cateTree',$cateTree);
    }
}