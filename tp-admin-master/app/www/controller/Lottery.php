<?php
namespace app\www\controller;

use app\common\controller\Common;
use think\Controller;
use think\Loader;
use think\Request;
use think\Url;
use think\Session;

class Lottery extends Checkuser
{
    public function index(){
        
        return view();
        
    }
    
    public function lottery1(){
        
        return view('lottery1');
        
    }
    
    //开奖
    public function openlottery(){
         $data = input('post.');
         //获取当前投注记录
         $UserLotterylist = Loader::model('UserLottery')->getullistbylotteryid( $postData['lotteryid'] );
         ;
        var_dump($data);die;
        return view('lottery1');
        
    }
    //投注
    public function cathectic(){        
        $postData = input('post.');
        $userinfo=Session::get('userinfo', 'www') ;
                if( !$userinfo['id'] ) {
                return $this->success( lang('Request type error') );
        }
        if(is_array($postData['lotteryArr']) && !empty($postData['lotteryArr'])){
            foreach ($postData['lotteryArr'] as $v){
                $Data[] = array(
                'lotteryid'=>$postData['cpType'],
                'bettingmoney'=>$postData['Multiple'],
                'lottery_number'=>$v,
                'userid'=>$userinfo['id'],
                'status'=>0,
                'create_time' => time()

                );
            }
            $ret = Loader::model('UserLottery')->UserLotteryadd( $Data );
            return $this->success($ret['msg'], url('www/index/index'));
        }else{
            return $this->error( '数据异常' );
        }   
        
        
    }
    
    
}