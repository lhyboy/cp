<?php
namespace app\www\controller;

use app\common\controller\Common;
use think\Controller;
use think\Loader;
use think\Request;
use think\Url;
use think\Session;

class Usercenter extends Checkuser
{
    public function index(){
        $userinfo=Session::get('userinfo', 'www') ;
        
        $data = model('User')->get(['id'=>$userinfo['id']]);
        $this->assign('data',$data);
        
        //var_dump($data);die;
        return view();
        
    }
    
     public function betrecord(){
        
        return view();
        
    }
    public function rechargeway(){
        
        return view();
        
    }
    
    public function setbankcard(){
        
        return view();
        
    }
    
    public function tixian(){
        
        $userinfo=Session::get('userinfo', 'www') ;
        $ret = Loader::model('Bank')->getuserbankinfo( $userinfo['id'] );
        if($ret){
            return view();
        }else{
            $this->redirect( url('www/usercenter/setbankcard') );
        }
        
        
        
    }
    public function dotixian(){
        
            if( !Request::instance()->isAjax() ) {
                return $this->success( lang('Request type error') );
            }

            $postData = input('post.');

            $userinfo=Session::get('userinfo', 'www') ;
                    if( !$userinfo['id'] ) {
                    return $this->success( lang('Request type error') );
            }
            $Data = array(
                    'Money'=>$postData['Money'],
                    'userid'=>$userinfo['id']
                   
            );

            $ret = Loader::model('Tixian')->Tixianadd( $Data );

            if ($ret['code'] !== 1) {
                    return $this->error( $ret['msg'] );
            }
            //return info(lang('Add succeed'), 1, '', 0);		
            return $this->success($ret['msg'], url('www/usercenter/index'));
        
    }
    public function dosetbankcard(){
        
            if( !Request::instance()->isAjax() ) {
                return $this->success( lang('Request type error') );
            }

            $postData = input('post.');

            $userinfo=Session::get('userinfo', 'www') ;
                    if( !$userinfo['id'] ) {
                    return $this->success( lang('Request type error') );
            }
            $Data = array(
                    'BankID'=>$postData['BankID'],
                    'userid'=>$userinfo['id'],
                    'Address_P'=>$postData['Address_P'],
                    'Address_C'=>$postData['Address_C'],
                    'RealName'=>$postData['RealName'],
                    'checkBankNum'=>$postData['checkBankNum'],
                    'BankNum'=>$postData['BankNum']
            );

            $ret = Loader::model('Bank')->Bankadd( $Data );

            if ($ret['code'] !== 1) {
                    return $this->error( $ret['msg'] );
            }
            //return info(lang('Add succeed'), 1, '', 0);		
            return $this->success($ret['msg'], url('www/usercenter/index'));
        
    }
    
    //交易记录
    public function billrecord(){
        $userinfo=Session::get('userinfo', 'www') ;
            if( !$userinfo['id'] ) {
            return $this->success( lang('Request type error') );
        }
        
        //获取充值记录
        $Rechargelist = Loader::model('Recharge')->getRechargelist( $userinfo['id'] );
        //格式化数据
        if(empty($Rechargelist) && is_array($Rechargelist)) {            
            $Rechargelist='';
        }else{
            foreach ($Rechargelist as $key => $value) {                
                $Recharge[$key]['create_time'] = date('Y-m-d H:i:s',$value['create_time']);
                $Recharge[$key]['playtype']  =  $value['playtype'] == 1 ? '银行卡' : $value['playtype'] == 2 ? '微信' : '支付宝';//1银行卡，2微信，3，支付宝
                $Recharge[$key]['state']  = '充值';
                $Recharge[$key]['money']  = $value['Money'];
                $Recharge[$key]['status']  = $value['status'] == 1 ? '成功' : '失败';//0失败，1成功
            }
        }
        
        //获取提现记录       
        $Tixianlist = Loader::model('Tixian')->getTixianlist( $userinfo['id'] );
        //格式化数据
        if(empty($Tixianlist) && is_array($Tixianlist)) {            
            $Tixianlist='';
        }else{
            foreach ($Tixianlist as $key => $value) {                
                $Tixian[$key]['addtime'] = $value['create_time'];
                $Tixian[$key]['create_time'] = date('Y-m-d H:i:s',$value['create_time']);                
                $Tixian[$key]['playtype']  = $value['playtype'] == 1 ? '银行卡' : $value['playtype'] == 2 ? '微信' : '支付宝';//1银行卡，2微信，3，支付宝
                $Tixian[$key]['state']  = '提现';
                $Tixian[$key]['money']  = $value['Money'];
                $Tixian[$key]['status']  = $value['status'] == 1 ? '成功' : '失败';//0失败，1成功
            }
        }
        
        
        //混合排序
        if($Tixian && $Recharge){
            $all = array_merge($Tixian, $Recharge); 
            //var_dump($all);die;
//            $len=count($all);
//            for($i=1;$i<$len;$i++)
//            { //该层循环用来控制每轮 冒出一个数 需要比较的次数
//              for($k=0;$k<$len-$i;$k++)
//              {
//                  $aa=$all[$k]['addtime'];
//                  $bb=$all[$k+1]['addtime'];
//                 if($aa>$bb)
//                  {
//                      $tmp=$all[$k+1];
//                      $all[$k+1]=$all[$k];
//                      $all[$k]=$tmp;
//                  }
//              }
//            }
            //var_dump($all);die;
        }else if($Tixian){
            $all = $Tixian;
        }else if($Recharge){
            $all = $Recharge;
        }else{
            $all ='';
        }
        
        
        $this->assign('all',$all);
        $this->assign('Tixian',$Tixian);
        $this->assign('Recharge',$Recharge);
        return view();
        
    }
    
    public function contact(){
        
        return view();
        
    }
    public function personalinfo(){
        $userinfo=Session::get('userinfo', 'www') ;
        
        $data = model('User')->get(['id'=>$userinfo['id']]);
        
        $this->assign('data',$data);
        return view();
        
    }
    
    public function savepersonalinfo(){
        $userinfo=Session::get('userinfo', 'www') ;
        
        if(!request()->isAjax()) {
            return info(lang('Request type error'));
        }

        $postData = input('post.');
        $Data = array(
                    'nickname'=>$postData['nickname'],  
                    'id'=>$userinfo['id'],
                    'mobile'=>$postData['mobile'],
                    'email'=>$postData['email'],
                    'Gender'=>$postData['Gender'],
                    'BirthDay'=>$postData['BirthDay']
            );

            $ret = Loader::model('User')->useredit( $Data );

            if ($ret['code'] !== 1) {
                    return $this->error( $ret['msg'] );
            }
            //return info(lang('Add succeed'), 1, '', 0);		
            return $this->success($ret['msg'], url('www/usercenter/index'));        
        
        
    }
    
    //今日盈亏
    public function plstatement(){
        
        $userinfo=Session::get('userinfo', 'www') ;
            if( !$userinfo['id'] ) {
            return $this->success( lang('Request type error') );
        }
       
        
       
        //投注金额     
        $data['bettingmoney'] = Loader::model('UserLottery')->getbettingmoney( $userinfo['id'] );
        
        
        //中奖金额
        $data['winningmoney'] = Loader::model('UserLotteryWinning')->getwinning( $userinfo['id'] );
        
        //var_dump($data['winningmoney']);die;
        
        //活动礼金
        $data['hdlj'] = 0;
        
        
        //充值金额 返点金额
        $result = Loader::model('Recharge')->getRecharge( $userinfo['id'] );
        $data['Rebate']=$result['Rebate'];
        $data['Money']=$result['Money'];
        
                
        //提现金额
        $data['Tixian'] = Loader::model('Tixian')->getTixian( $userinfo['id'] );
        
        //今日盈亏
        $data['allmoney']=$data['winningmoney']-$data['bettingmoney']+$data['hdlj']+$data['Rebate'];
        
        
        $this->assign('data',$data);
        return view();
        
    }
    
    public function notice(){
        
        return view();
        
    }
    
    public function noticedetail(){
        
        return view();
        
    }
    
    public function letter(){
        
        return view();
        
    }
    
    public function personallevel(){
        
        return view();
        
    }
    
    public function bank(){
        
        return view();
        
    }
        
    public function wechat(){
        
        return view();
        
    }   
    public function alipay(){
        
        return view();
        
    }
    
    
        public function dosetrecharge(){
        
        		if( !Request::instance()->isAjax() ) {
			return $this->success( lang('Request type error') );
		}

		$postData = input('post.');
                

		$Data = array(
			'playtype'=>$postData['playtype'],
			'Money'=>$postData['Money'],
			'PayUser'=>$postData['PayUser']			
		);
                
		$ret = Loader::model('recharge')->rechargeadd( $Data );
                
		if ($ret['code'] !== 1) {
			return $this->error( $ret['msg'] );
		}
		//return info(lang('Add succeed'), 1, '', 0);		
		return $this->success($ret['msg'], url('www/usercenter/index'));
        
    }
    
    
}