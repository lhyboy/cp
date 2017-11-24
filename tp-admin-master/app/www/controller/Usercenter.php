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
    public function dosetbankcard(){
        
        		if( !Request::instance()->isAjax() ) {
			return $this->success( lang('Request type error') );
		}

		$postData = input('post.');
                

		$Data = array(
			'BankID'=>$postData['BankID'],
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
        
        return view();
        
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
    
    
    
}