<?php
namespace app\www\controller;

use app\common\controller\Common;
use think\Controller;
use think\Loader;
use think\Request;
use think\Url;
use think\Session;

class Newwinners extends Checkuser
{
    //中奖信息
    public function index(){
        
        $data = Loader::model('UserLotteryWinning')->getwinninglist() ;
        //var_dump($data);die;
        $this->assign('data',$data);
        return view();
        
    }
    
     public function competition(){
        
        return view();
        
    }
}