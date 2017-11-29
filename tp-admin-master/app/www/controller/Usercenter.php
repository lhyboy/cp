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
    
    public function billrecord(){
        
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

            $ret = Loader::model('User')->Bankadd( $Data );

            if ($ret['code'] !== 1) {
                    return $this->error( $ret['msg'] );
            }
            //return info(lang('Add succeed'), 1, '', 0);		
            return $this->success($ret['msg'], url('www/usercenter/index'));        
        
        
    }
    
    public function plstatement(){
        
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