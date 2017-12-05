<?php
namespace app\admin\controller;

use app\common\controller\Common;
use think\Controller;
use think\Loader;
use think\Request;
use think\Url;
use think\Session;
use think\Config;


class Index extends Admin
{
    /**
     * 后台登录首页
     */
    public function index()
    {

            return view();
    }
      
    //获取充值记录
    public function recharge(){
        
        return view();
        
    }
    //获取充值记录
    public function getrecharge(){
        //获取充值记录
        $Rechargelist = Loader::model('Recharge')->Rechargelist();
        if(empty($Rechargelist) && is_array($Rechargelist)) {            
            $Rechargelist='';
        }else{
            foreach ($Rechargelist as $key => $value) {                
                $Recharge[$key]['create_time'] = date('Y-m-d H:i:s',$value['create_time']);
                $Recharge[$key]['playtype']  =  $value['playtype'] == 1 ? '银行卡' : $value['playtype'] == 2 ? '微信' : '支付宝';//1银行卡，2微信，3，支付宝
                $Recharge[$key]['Rebate']  = $value['Rebate'];
                $Recharge[$key]['Money']  = $value['Money'];
                $Recharge[$key]['PayUser']  = $value['PayUser'];
                $Recharge[$key]['username']  = $value['username'];                
            }
        }
        //var_dump($Recharge);die;
        
        return $Recharge;
        
    }
    
    //获取体现记录
    public function tixian(){
        
        return view();
        
    }
    //获取体现记录
    public function gettixian(){
        //获取提现记录       
        $Tixianlist = Loader::model('Tixian')->Tixianlist();
        if(empty($Tixianlist) && is_array($Tixianlist)) {            
            $Tixianlist='';
        }else{
            foreach ($Tixianlist as $key => $value) {                
                $Tixian[$key]['create_time'] = date('Y-m-d H:i:s',$value['create_time']);
                $Tixian[$key]['Money']  = $value['Money'];                
                $Tixian[$key]['username']  = $value['username'];                
                $Tixian[$key]['BankID']  = $value['BankID'];                
                $Tixian[$key]['Address_P']  = $value['Address_P'];                
                $Tixian[$key]['Address_C']  = $value['Address_C'];                
                $Tixian[$key]['RealName']  = $value['RealName'];                
                $Tixian[$key]['BankNum']  = $value['BankNum'];                
                
            }
        }
        //var_dump($Recharge);die;
        
        return $Tixian;
        
    }
}