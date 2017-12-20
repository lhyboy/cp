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
    
    //投注记录
    public function betrecord(){
        
        return view();
        
    }
    
     //获取投注记录
    public function getbetrecord(){
        //获取投注记录
        
        
        $betrecordlist = Loader::model('UserLottery')->getList();
        if(empty($betrecordlist) && is_array($betrecordlist)) {            
            $betrecordlist='';
        }else{
            foreach ($betrecordlist as $key => $value) {                
                $betrecord[$key]['create_time'] = date('Y-m-d H:i:s',$value['create_time']);
                $betrecord[$key]['nickname']  =  $value['nickname'] ;
                $betrecord[$key]['lotteryname']  = $value['lotteryname'];
                $betrecord[$key]['bettingmoney']  = $value['bettingmoney'];
                $betrecord[$key]['winningmoney']  = $value['winningmoney'];
                $betrecord[$key]['lotteryid']  = $value['lotteryid'];
                $betrecord[$key]['lotterynumbers']  = is_array($value['lotterynumbers']) ? implode(',',$value['lotterynumbers']):'';  
            }
        }
        //var_dump($Recharge);die;
        
        return $betrecord;
        
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
        //var_dump($Tixianlist);die;
        if(empty($Tixianlist) && is_array($Tixianlist)) {            
            $Tixianlist='';
        }else{
            foreach ($Tixianlist as $key => $value) {                
                $Tixian[$key]['create_time'] = date('Y-m-d H:i:s',$value['create_time']);
                $Tixian[$key]['Money']  = $value['Money'];                
                $Tixian[$key]['balance']  = $value['balance'];                
                $Tixian[$key]['username']  = $value['username'];                
                $Tixian[$key]['BankID']  = $value['BankID'];                
                $Tixian[$key]['id']  = $value['tid'];                
                $Tixian[$key]['Address_P']  = $value['Address_P'];                
                $Tixian[$key]['Address_C']  = $value['Address_C'];                
                $Tixian[$key]['RealName']  = $value['RealName'];                
                $Tixian[$key]['BankNum']  = $value['BankNum'];                
                
            }
        }
        //var_dump($Recharge);die;
        
        return $Tixian;
        
    }
    
        /**
     * 编辑
     * @param  string $id 数据ID（主键）
     */
    public function edittixian($id = 0)
    {   
        if(intval($id) < 0){
            return info(lang('Data ID exception'), 0);
        }
        if(!request()->isAjax()) {
            return info(lang('Request type error'));
        }
 
        $data = ['status' => 1,'id' => $id];
        return Loader::model('Tixian')->savetixian( $data );
    }
    
  
 
    
            /**
     * 编辑
     * @param  string $id 数据ID（主键）
     */
    public function editrecharge($id = 0)
    {   
        if(intval($id) < 0){
            return info(lang('Data ID exception'), 0);
        }
        if(!request()->isAjax()) {
            return info(lang('Request type error'));
        }
 
        $data = ['status' => 1,'id' => $id];
        return Loader::model('Recharge')->saverecharge( $data );
    }
    
    
        /**
     * 删除
     * @param  string $id 数据ID（主键）
     */
    public function delete($id = 0){
        if(empty($id)){
            return info(lang('Data ID exception'), 0);
        }
        if (intval($id == 1 || in_array(1, explode(',', $id)))) {
            return info(lang('Delete without authorization'), 0);
        }
        return Loader::model('Tixian')->deletetixianById($id);
    }
    
}