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
    
    //昨日奖金榜
    public function competition(){
        $competitionlist = Loader::model('UserLotteryWinning')->getwinningyesterdaylist() ;
        //var_dump($competitionlist);die;
        //格式化数据
        if(empty($competitionlist) && is_array($competitionlist)) {            
            $competitionlist='';
        }else{
            foreach ($competitionlist as $key => $value) {                
                $competitionlist[$key]['username']  = $this->substr_cut($value['username'])   ;
                $competitionlist[$key]['ranking']  = $key+1;
                
            }
        }
        
        $this->assign('data',$competitionlist);
        return view();
        
    }
    
    function substr_cut($user_name){
        if(empty($user_name)){
              return '';  
        }else{
            $strlen     = mb_strlen($user_name, 'utf-8');
            $firstStr     = mb_substr($user_name, 0, 1, 'utf-8');
            $lastStr     = mb_substr($user_name, -1, 1, 'utf-8');
            return $strlen == 2 ? $firstStr . str_repeat('*', mb_strlen($user_name, 'utf-8') - 1) : $firstStr . str_repeat('*', $strlen - 2) . $lastStr;
    
        }
    }
}