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
         $postData['lotteryid']=6;
         
         $UserLotterylist = Loader::model('UserLottery')->getullistbylotteryid( $postData['lotteryid'] );
         //计算结果
         if($UserLotterylist){
             //本期号码
             $lotterynumbers=$this->opennember($UserLotterylist);
             //var_dump($lotterynumbers);die;
             //验证不赔钱
             $check=$this->checknember($lotterynumbers,$UserLotterylist);
             if($check){
                 //计算三个骰子的号码
                 $threenumber=$this->getthreenumber($lotterynumbers['lotterynum']);
                  
                 return $this->success($threenumber[array_rand($threenumber)],url('www/index/index'));
             }else{
                 //庄家通吃
                 return $this->error( '庄家通吃！' );
             }
         }else{
             return $this->error( '本期数据有人作弊！' );
         }
        var_dump($UserLotterylist);var_dump($lotterynumbers);die;
        return view('lottery1');
        
    }
    //投注
    public function cathectic(){        
        $postData = input('post.');
        $userinfo=Session::get('userinfo', 'www') ;
                if( !$userinfo['id'] ) {
                return $this->success( lang('Request type error') );
        }
        //var_dump($postData);die;
        if(is_array($postData['lotteryArr']) && !empty($postData['lotteryArr'])){
            foreach ($postData['lotteryArr'] as $v){
                $Data[] = array(
                'lotteryid'=>$postData['cpType'],
                'bettingmoney'=>$postData['Multiple'],
                'lottery_number'=>$v,
                'ifwining'=> $this->beilv($v)*$postData['Multiple'],
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
    
    //倍率
    public function beilv($nember){
        $beilv=array(
            '大'=>1.93,
            '小'=>1.93,
            '单'=>1.93,
            '双'=>1.93,
            '3'=>186.84,
            '4'=>62.28,
            '5'=>31.14,
            '6'=>18.68,
            '7'=>12.45,
            '8'=>8.89,
            '9'=>7.47,
            '10'=>6.92,
            '11'=>6.92,
            '12'=>7.47,
            '13'=>8.89,
            '14'=>12.45,
            '15'=>18.68,
            '16'=>31.14,
            '17'=>62.28,
            '18'=>186.84,
            
        );
        return $beilv["$nember"];
    }
    
    //计算开奖号码
    public function opennember($UserLotterylist){
        $nums=$UserLotterylist['nums'];
        $numsmoneylist=$UserLotterylist['numsmoneylist'];            
        //$opennember=$numsmoneylist[$nums[0]];        
        $sumdan=0;
        $sumshuang=0;
        $sumda=0;
        $sumxiao=0;
        $dan=FALSE;
        $shuang=FALSE;
        $da=FALSE;
        $xiao=FALSE;
        foreach ($UserLotterylist['numsmoneylist'] as $k=>$v){
            if($k=='双' ||$k=='单' ||$k=='大' ||$k=='小'){
                continue;
            }else{
                //判断单，双
                if($k&1){
                    //单数
                    $sumdan=$sumdan+$v;
                }else{
                   //双数
                    $sumshuang=$sumshuang+$v;
                }
                //判断大，小
                if($k>9){
                    //大
                    $sumda=$sumda+$v;
                }else{
                   //小
                    $sumxiao=$sumxiao+$v;
                }
            }
        }
        if($sumdan>$sumshuang){
            $shuang=true;
            
        }else{
            $dan=true;
        }
        
        if($sumda>$sumxiao){
            $xiao=true;
            
        }else{
            $da=true;
        }
        
        
        foreach ($UserLotterylist['numsmoneylist'] as $k=>$v){
            if($k=='双' ||$k=='单' ||$k=='大' ||$k=='小'){
                continue;
            }else{
                if($xiao && $shuang){
                    if($k<=9 && !($k&1)){
                        //$lresult['danshuang']=$sumshuang;
                        //$lresult['daxiao']=$sumxiao;
                        $lresult['lotterynum']=$k;
                        //$lresult['lotterymoney']=$v+$sumxiao+$sumshuang;
                        $lresult['lotterymoney']=$v+$numsmoneylist['小']+$numsmoneylist['双'];
                        return $lresult;
                    }
                }else{
                    if($k<=9 && ($k&1)){
                        //$lresult['danshuang']=$sumdan;
                        //$lresult['daxiao']=$sumxiao;
                        $lresult['lotterynum']=$k;
                        //$lresult['lotterymoney']=$v+$sumdan+$sumxiao;
                        $lresult['lotterymoney']=$v+$numsmoneylist['小']+$numsmoneylist['单'];
                        return $lresult;
                    }
                }
                
                if($da && $shuang){
                    if($k>9 && !($k&1)){
                        //$lresult['danshuang']=$sumshuang;
                        //$lresult['daxiao']=$sumda;
                        $lresult['lotterynum']=$k;
                        //$lresult['lotterymoney']=$v+$sumshuang+$sumda;
                        $lresult['lotterymoney']=$v+$numsmoneylist['大']+$numsmoneylist['双'];
                        return $lresult;
                    }
                }else{
                    if($k>9 && ($k&1)){
                        //$lresult['danshuang']=$sumdan;
                        //$lresult['daxiao']=$sumda;
                        $lresult['lotterynum']=$k;
                        //$lresult['lotterymoney']=$v+$sumda+$sumdan;
                        $lresult['lotterymoney']=$v+$numsmoneylist['大']+$numsmoneylist['单'];
                        return $lresult;
                    }
                }
                 
            }
        }
    }  
    
    public function  checknember($lotterynumbers,$UserLotterylist){
        //收入大于支出
        //if($UserLotterylist['allbettingmoney']>$lotterynumbers['lotterymoney']){
        //支出小于收入的60%
        if(($lotterynumbers['lotterymoney']/$UserLotterylist['allbettingmoney'])<0.6){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function  getthreenumber($lotterynum){
        $threenumber=array(
            '3'=>array([1,1,1]),
            '4'=>array([1,2,1],[2,1,1],[1,1,2]),
            '5'=>array([2,2,1],[1,2,2],[2,1,2],[1,3,1],[3,1,1],[1,1,3]),
            '6'=>array([2,2,2],[2,3,1]),
            '7'=>array([2,3,2],[3,2,2]),
            '8'=>array([2,4,2],[4,2,2]),
            '9'=>array([3,3,3],[3,4,2]),
            '10'=>array([2,7,1],[1,7,2]),
            '11'=>array([5,5,1],[1,5,5]),
            '12'=>array([5,5,2],[2,5,5]),
            '13'=>array([5,5,3],[3,5,5]),            
            '14'=>array([5,5,4],[4,5,5]),
            '15'=>array([5,5,5],[5,6,4]),
            '16'=>array([6,5,5],[5,6,5]),
            '17'=>array([6,6,5],[6,5,6]),
            '18'=>array([6,6,6]),
            
        );
        return $threenumber["$lotterynum"];
    }
    
    
}