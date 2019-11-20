<?php
namespace Company\Controller;
use Think\Controller;

class HSController extends Controller {
    public function __construct()
    {
        parent::__construct();
        //热搜
        $hotsearch = M('company_hotsearch') -> order('num desc') -> limit(5) -> select();
        $this -> assign('hotsearch',$hotsearch);
        //浏览霸王
        $hotresume = M('resume') -> order('look_num desc') -> limit(5) ->select();
        $this -> assign('hotresume',$hotresume);
    }

}