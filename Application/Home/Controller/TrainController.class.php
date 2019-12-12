<?php
namespace Home\Controller;


use Think\Controller;

class TrainController extends Controller
{

    //培训列表
    public function list(){
        $train = M('train as t') ->join('my_video as v on v.tid=t.id') ->field('v.img,t.*') -> select();

        $empty = '<h2 style="color: #444444;text-indent: 1em;padding: 1em;background: #dddddd">没有找到满足条件的数据<h2/>';


        $this -> assign(array('train'=>$train,'empty'=>$empty));

        $this -> display('train');
    }

    //培训详情
    public function detail($id){
        if(session('?mid')){
            //是否报名
            $where['mid'] = session('mid');
            $where['tid'] = $id;
            $train = M('selftrain') -> where($where) -> count('id');

            $this -> assign('train',$train);
        }

        $detail = M('train') -> where("id=$id") -> find();
        $type = array(1=>'视频培训',2=>'理论操作',3=>'视频培训+理论操作',99=>'其他');
        $this -> assign(array('detail'=>$detail,'type'=>$type));

        $this -> display();
    }
    //支付培训
    public function toPay($id){

        $money = M('train') -> where("id=$id") -> getField('money');
        $order_syn = substr(date('YmdHis').md5(uniqid(mt_rand(),true)),0,36);
        $time = time();
        $this -> assign(array('money'=>$money,'order_syn'=>$order_syn,'time'=>$time,'tid'=>$id));

        $this -> display();
    }

    //生成订单
    public function order(){
        //余额支付
        if(I('post.payType')==2){
            //写入订单表
            $data['order_syn'] = I('post.order_syn');
            $data['tid'] = I('post.tid');
            $data['price'] = I('post.money');
            $data['add_time'] = time();
            $data['mid'] = session('mid');

            if($id = M('orders') -> add($data)){
                $this -> assign(array('id'=>$id,'price'=>$data['price'],'tid'=>$data['tid']));
                $this -> display('paypwd');
            }

        }else{
            $data = I('post.');
            dump($data);
        }

    }

    //密码
    public function orderOk(){
        if(IS_POST){
            $id = I('post.id');
            $tid =I('post.tid');
            $pwd = I('post.password');
            $price = I('post.price');
            //支付密码是否正确
            $mid = session('mid');
            $mem = M('member') -> where("id=$mid") -> find();
            if($pwd == $mem['paypwd']){
                if($price < $mem['money']){
                    //开启事务
                    M()->startTrans();
                    //扣钱
                    $res1 = M('member') -> where("id=$mid") -> setDec('money',$price);
                    //修改订单状态
                    $res2 = M('orders') -> where("id=$id") -> save(array('active'=>2));
                    //写入我的培训表
                    $res3 = M('selftrain') -> add(array('tid'=>$tid,'mid'=>$mid));
                    //增加报名人数
                    M('train') -> where("id=$tid") -> setInc('person_num');

                    if($res1 && $res2 && $res3){
                        M()->commit();//提交
                        $this -> success('支付成功',U(''));
                    }else{
                        M()->rollback();//回滚
                        $this -> error('支付失败');
                    }

                }else{
                    $this -> error('账户余额不足！');
                }
            }else{
                $this -> error('支付密码错误！');
            }

        }
    }

    //免费直接写入我的培训
    public function myTrain(){
        $data['tid'] = I('get.tid');
        $data['mid'] = session('mid');
        if(M('selftrain') -> add($data)){
            M('train') -> where("id={$data['tid']}") -> setInc('person_num');
            $this -> success('报名成功');
        }else{
            $this -> error('报名失败');
        }
    }

    //我的培训
    public function myTrainList(){
        $empty = '<h2 style="color: #444444;text-indent: 1em;padding: 1em;background: #dddddd">你还没有报名培训<h2/>';
        $type = array(1=>'视频培训',2=>'理论操作',3=>'视频培训+理论操作',99=>'其他');
        $mid = session('mid');
        $myTrain = M('selftrain as s') -> join('my_train as t on s.tid=t.id') ->join('my_video as v on v.tid=t.id') -> field('v.img,s.id as sid,t.*') -> where("mid=$mid") -> select();


        $this -> assign(array('myTrain'=>$myTrain,'empty'=>$empty,'type'=>$type));
        $this -> display('User/user_mytrain');
    }

    //删除我的培训
    public function deleteMyTrain($id){
        if(M('selftrain') -> delete($id)){
            $this -> success('删除成功！');
        }else{
            $this -> error('删除失败');
        }
    }

    //培训详情
    public function detail2($id){

        $detail = M('train') -> where("id=$id") -> find();
        $type = array(1=>'视频培训',2=>'理论操作',3=>'视频培训+理论操作',99=>'其他');
        $this -> assign(array('detail'=>$detail,'type'=>$type));

        $this -> display();
    }

    //视频列表
    public function videoList($tid){
        $trainName= M('train') -> where("id=$tid") -> getField('trainName');
        $video = M('video') -> where("tid=$tid") -> order('num') -> select();

        $num = M('video') -> where("tid=$tid") -> count('id');
        $this -> assign(array('trainName'=>$trainName,'video'=>$video,'num'=>$num));

        $this -> display('User/mytrain_video');
    }

    //视频详情
    public function videoDetail($id){

        $detail = M('video as v') -> join('my_train as t on v.tid=t.id') -> field('t.trainName,v.*') -> where("v.id=$id") -> find();

        $this -> assign(array('detail'=>$detail));

        $this -> display('User/mytrain_video_xq');
    }


}