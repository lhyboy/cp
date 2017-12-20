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
        
        $userinfo=Session::get('userinfo', 'www') ;
        if($userinfo['id'] ) {
            $map = [
			'id' => $userinfo['id']
		];
             $userinfo=Loader::model('User')->getuser($map);
             
             $data['balance']   =$userinfo['balance'];
             //var_dump($data);die;
        }else{
            $data['balance']   =0;
        }
         
        //彩票类型id
        $lotteryid=1;
        
        //上一期的id
        $data['lastperiodsid']=date('ymdHi',strtotime('-1 Minute'));
        
        //获取上11期的开奖号码
        $lotterynumbers = Loader::model('LotteryWinning')->getlastnumbers( $lotteryid );
        // var_dump($lotterynumbers);die;
        //当前期数
        $data['nowperiodsid']=date('ymdHi',time());
        
        //1分钟当前期结束时间
        $data['nowsecond']=60-date('s',time());
        //5分钟当前期结束时间
        $i=date('i',time());
        
        $i=substr($i,-1,1);
        //var_dump($i);die;
        if($i>5){
            $data['nowmin']=10-$i;
        }else{
            $data['nowmin']=5-$i;
        }
        
        
        $lastnumbers['periodsid']=$lotterynumbers[0]['periodsid'];
        $lastnumbers['lotterynumbers']=$lotterynumbers[0]['lotterynumbers'];
        $this->assign('lotterynumbers',$lotterynumbers);
        $this->assign('lastnumbers',$lastnumbers);
        $this->assign('data',$data);
        return view('lottery1');
        
    }
    
    //开奖
    public function openlottery(){   
        
        if (Request::instance()->isGet()){            
            $getData = input('get.');
        }elseif(Request::instance()->isPost()){
            $getData = input('post.');
            //获取开奖结果
            $ret = Loader::model('LotteryWinning')->getnumbers( $getData['lotteryid'], $getData['periodsid']);
            if($ret){
                return $this->success( explode(',',$ret['lotterynumbers'])   );
            }else{
                return $this->success( '开奖结果正在生成中'   );
            }
            
        }else{
            die('缺少参数');           
        }
         
        //获取当前投注记录
        if($getData['lotteryid']){
             
                  
        $UserLotterylist = Loader::model('UserLottery')->getullistbylotteryid( $getData['lotteryid'] );
         
         //计算结果
         if($UserLotterylist){
             //本期号码
             //var_dump($UserLotterylist);die;
             $lotterynumbers=$this->opennember($UserLotterylist);
             //var_dump($lotterynumbers);die;
             //验证不赔钱
             $check=$this->checknember($lotterynumbers,$UserLotterylist);
             if($check){
                 //计算三个骰子的号码
                 $threenumber=$this->getthreenumber($lotterynumbers['lotterynum']);
                 //return $this->success($threenumber[array_rand($threenumber)],url('www/index/index'));
             }else{
                //庄家通吃
                //本期号码
                $lotterynumbers=$this->openallinnember($UserLotterylist);
                
                //计算三个骰子的号码
                 $threenumber=$this->getthreenumber($lotterynumbers['lotterynum']);
                //return $this->success($threenumber[array_rand($threenumber)],url('www/index/index'));                
                
             }
             //更新数据库，把开奖号码写入开奖号码表，
             $data=array();
              $data['lotteryid']=$getData['lotteryid'];
              $data['periodsid']=$getData['periodsid'];   
              
                $lotterynumbers= $threenumber[array_rand($threenumber)];          
              $data['lotterynumbers']= implode(',',$lotterynumbers); 
              //echo $data['lotterynumbers'];die;
              $data['status'] = 1;
                Loader::model('LotteryWinning')->savelotterywinning( $data );
             //更新下注表当前期的的状态，
                $data=array();
              $data['lotteryid']=$getData['lotteryid'];
              $data['periodsid']=$getData['periodsid'];                                    
              $data['status'] = 1;
             Loader::model('UserLottery')->updateuserLottery( $data );
             //获取中奖人员写入中奖者表
             $data=array();
              $data['lotteryid']=$getData['lotteryid'];
              $data['periodsid']=$getData['periodsid'];                                    
              $data['sumlotterynumbers']= array_sum($lotterynumbers); 
              $data['danshuang'] = $data['sumlotterynumbers']&1 ? '单':'双';
              $data['daxiao'] = $data['sumlotterynumbers']>9 ? '大':'小';
                      
             Loader::model('UserLotteryWinning')->adduserLotteryWinning( $data );
             //
             
         }else{
             //return $this->error( '本期数据有人作弊！' );
             //没人下注随便开奖
             //计算三个骰子的号码
                $sumlotterynum=rand(3,18);
                $threenumber=$this->getthreenumber($sumlotterynum);
                
                
              $data=array();
              $data['lotteryid']=$getData['lotteryid'];
              $data['periodsid']=$getData['periodsid'];   
              
              $lotterynumbers= $threenumber[array_rand($threenumber)];          
              $data['lotterynumbers']= implode(',',$lotterynumbers); 
              //echo $data['lotterynumbers'];die;
              $data['status'] = 1;
              Loader::model('LotteryWinning')->savelotterywinning( $data );
              
         }
         }else{
             die('缺少参数');
         }
         //var_dump($threenumber);die;
          die('成功');
         //
        //return view('lottery1');
        //return $this->success($lotterynumbers);
          
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
        //$nums=$UserLotterylist['nums'];
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
        foreach ($numsmoneylist as $k=>$v){
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
        
        if(!isset($numsmoneylist['大'])){
            $numsmoneylist['大']=0;
        }
        if(!isset($numsmoneylist['小'])){
            $numsmoneylist['小']=0;
        }
        if(!isset($numsmoneylist['单'])){
            $numsmoneylist['单']=0;
        }
        if(!isset($numsmoneylist['双'])){
            $numsmoneylist['双']=0;
        }
         $numsmoneylist['双']=0;
         
        foreach ($numsmoneylist as $k=>$v){
            if($k=='双' ||$k=='单' ||$k=='大' ||$k=='小'){
                continue;
            }else{
                if($xiao && $shuang){
                    if($k<=9 && !($k&1)){
                        //die('aaa');
                        //$lresult['danshuang']=$sumshuang;
                        //$lresult['daxiao']=$sumxiao;
                        $lresult['lotterynum']=$k;
                        //$lresult['lotterymoney']=$v+$sumxiao+$sumshuang;
                        $lresult['lotterymoney']=$v+$numsmoneylist['小']+$numsmoneylist['双'];
                        return $lresult;
                    }
                }else{
                    if($k<=9 && ($k&1)){
                        //die('bb');
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
                        //die('cc');
                        //$lresult['danshuang']=$sumshuang;
                        //$lresult['daxiao']=$sumda;
                        $lresult['lotterynum']=$k;
                        //$lresult['lotterymoney']=$v+$sumshuang+$sumda;
                        $lresult['lotterymoney']=$v+$numsmoneylist['大']+$numsmoneylist['双'];
                        return $lresult;
                    }
                }else{
                    if($k>9 && ($k&1)){                        
                        $lresult['lotterynum']=$k;
                        //$lresult['lotterymoney']=$v+$sumda+$sumdan;
                        $lresult['lotterymoney']=$v+$numsmoneylist['大']+$numsmoneylist['单'];
                        return $lresult;
                    }
                }
                 
            }
           
        }       
         return $this->openallinnember($UserLotterylist);
          
          
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
            '4'=>array([1,1,2],[1,2,1],[2,1,1]),
            '5'=>array([1,2,2],[2,2,1],[2,1,2],[1,1,3],[1,3,1],[3,1,1]),
            '6'=>array([2,2,2],[2,3,1],[2,1,3],[1,2,3],[1,3,2],[3,2,1],[3,1,2],[1,1,4],[4,1,1],[1,4,1]),
            '7'=>array([2,2,3],[2,3,2],[3,2,2],[1,1,5],[1,5,1],[5,1,1],[1,2,4],[1,4,2],[2,4,1],[2,1,4],[4,2,1],[4,1,2],[1,3,3],[3,1,3],[3,3,1]),
            '8'=>array([2,2,4],[2,4,2],[4,2,2],[1,1,6],[1,6,1],[6,1,1],[1,2,5],[1,5,2],[2,1,5],[2,5,1],[5,2,1],[5,1,2],[1,3,4],[1,4,3],[3,1,4],[3,4,1],[4,3,1],[4,1,3],[2,3,3],[3,2,3],[3,3,2]),
            '9'=>array([5,2,2],[2,2,5],[2,5,2],[3,3,3],[2,4,3],[2,3,4],[3,4,2],[3,2,4],[4,3,2],[4,2,3],[1,2,6],[1,6,2],[2,1,6],[2,6,1],[6,2,1],[6,1,2],[1,3,5],[1,5,3],[3,1,5],[3,5,1],[5,3,1],[5,1,3],[1,4,4],[4,1,4],[4,4,1]),
            '10'=>array([1,3,6],[1,6,3],[3,1,6],[3,6,1],[6,3,1],[6,1,3],[1,4,5],[1,5,4],[4,1,5],[4,5,1],[5,4,1],[5,1,4],[2,2,6],[2,6,2],[6,2,2],[2,3,5],[2,5,3],[3,2,5],[3,5,2],[5,3,2],[5,2,3],[2,4,4],[4,2,4],[4,4,2]),
            '11'=>array([5,5,1],[1,5,5],[5,1,5],[1,4,6],[1,6,4],[4,1,6],[4,6,1],[6,4,1],[6,1,4],[2,3,6],[2,6,3],[3,2,6],[3,6,2],[6,3,2],[6,2,3],[2,4,5],[2,5,4],[4,2,5],[4,5,2],[5,4,2],[5,2,4],[3,4,4],[4,3,4],[4,4,3]),
            '12'=>array([5,5,2],[5,2,5],[2,5,5],[4,4,4],[1,5,6],[1,6,5],[5,1,6],[5,6,1],[6,5,1],[6,1,5],[2,4,6],[2,6,4],[4,2,6],[4,6,2],[6,4,2],[6,2,4],[3,4,5],[3,5,4],[4,3,5],[4,5,3],[5,4,3],[5,3,4]),
            '13'=>array([5,5,3],[3,5,5],[5,3,5],[1,6,6],[6,1,6],[6,6,1],[2,5,6],[2,6,5],[5,2,6],[5,6,2],[6,5,2],[6,2,5],[3,4,6],[3,6,4],[4,6,3],[4,3,6],[6,4,3],[6,3,4],[5,4,4],[4,5,4],[4,4,5]),            
            '14'=>array([5,5,4],[4,5,5],[5,4,5],[2,6,6],[6,2,6],[6,6,2],[3,5,6],[3,6,5],[5,3,6],[5,6,3],[6,3,5],[6,5,3],[4,6,4],[4,4,6],[6,4,4]),
            '15'=>array([5,5,5],[5,6,4],[5,4,6],[4,5,6],[4,6,5],[6,4,5],[6,5,4],[3,6,6],[6,6,3],[6,3,6]),
            '16'=>array([6,5,5],[5,6,5],[5,5,6],[4,6,6],[6,6,4],[6,4,6]),
            '17'=>array([6,6,5],[5,6,6],[6,5,6]),
            '18'=>array([6,6,6]),
            
        );
        
        return $threenumber["$lotterynum"];
    }
    
      //计算开奖号码,庄家通吃
    public function openallinnember($UserLotterylist){
         
        $allxiaodannumbers=array(
            3,
            5,
            7,
            9
        );
        $allxiaoshuangnumbers=array(
            4,
            6,
            8,
        );
        $alldadannumbers=array(            
            11,
            13,
            15,
            17
        );
        $alldashuangnumbers=array(            
            10,
            12,
            14,
            16,
            18
        );
        //$nums=$UserLotterylist['nums'];
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
        if(!isset($numsmoneylist['大'])){
            $numsmoneylist['大']=0;
        }
        if(!isset($numsmoneylist['小'])){
            $numsmoneylist['小']=0;
        }
        if(!isset($numsmoneylist['单'])){
            $numsmoneylist['单']=0;
        }
        if(!isset($numsmoneylist['双'])){
            $numsmoneylist['双']=0;
        }
        foreach ($numsmoneylist as $k=>$v){
            if($k=='双' ||$k=='单' ||$k=='大' ||$k=='小'){
                if($k=='双'){
                    $sumshuang=$sumshuang+$v;
                }
                if($k=='单'){
                    $sumdan=$sumdan+$v;
                }
                if($k=='大'){
                    $sumda=$sumda+$v;
                }
                if($k=='小'){
                    $sumxiao=$sumxiao+$v;
                }
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
        
        $numbers= array_keys($numsmoneylist);
        
        if($xiao && $shuang){
                $als=array_diff($allxiaoshuangnumbers,$numbers);
                $lresult['lotterynum']= $als[array_rand($als)];
                if(empty($lresult['lotterynum'])){                     
                    $keys=array_rand($allxiaoshuangnumbers);
                    $lresult['lotterynum']= $allxiaoshuangnumbers[$keys]; 
                }
                $lresult['lotterymoney']=$numsmoneylist['小']+$numsmoneylist['双'];
                return $lresult;           
        }elseif($xiao && $dan){   
             
                $als=array_diff($allxiaodannumbers,$numbers);
                $lresult['lotterynum']= $als[array_rand($als)];                  
                
                if(empty($lresult['lotterynum'])){                     
                    $keys=array_rand($allxiaodannumbers);
                    $lresult['lotterynum']= $allxiaodannumbers[$keys]; 
                }
                $lresult['lotterymoney']=$numsmoneylist['小']+$numsmoneylist['单'];                
                return $lresult;            
        }

        if($da && $shuang){ 
                $als=array_diff($alldashuangnumbers,$numbers);
                $lresult['lotterynum']= $als[array_rand($als)];
                if(empty($lresult['lotterynum'])){                     
                    $keys=array_rand($alldashuangnumbers);
                    $lresult['lotterynum']= $alldashuangnumbers[$keys]; 
                }
                $lresult['lotterymoney']=$numsmoneylist['大']+$numsmoneylist['双'];
                return $lresult;           
        }elseif($da && $dan){  
                $als=array_diff($alldadannumbers,$numbers);
                $lresult['lotterynum']= $als[array_rand($als)];
                if(empty($lresult['lotterynum'])){                     
                    $keys=array_rand($alldadannumbers);
                    $lresult['lotterynum']= $alldadannumbers[$keys]; 
                }
                $lresult['lotterymoney']=$numsmoneylist['大']+$numsmoneylist['单'];
                return $lresult;            
        }  
        
    } 
}