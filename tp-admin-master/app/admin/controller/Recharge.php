<?php
namespace app\admin\controller;

use app\common\controller\Common;
use think\Controller;
use think\Loader;
use think\Request;
use think\Url;
use think\Session;
use think\Config;


class Recharge extends Admin
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
        //var_dump($Rechargelist);die;
        if(empty($Rechargelist) && is_array($Rechargelist)) {            
             $Recharge='';
             return $Recharge;
        }else{
            foreach ($Rechargelist as $key => $value) {                
                $Recharge[$key]['create_time'] = date('Y-m-d H:i:s',$value['create_time']);
                //$Recharge[$key]['playtype']  =  $value['playtype'] == 1 ? '银行卡' : $value['playtype'] == 2 ? '微信' : '支付宝';//1银行卡，2微信，3，支付宝
                $Recharge[$key]['playtype']  =  $value['playtype'];
                $Recharge[$key]['Rebate']  = $value['Rebate'];
                $Recharge[$key]['Money']  = $value['Money'];
                $Recharge[$key]['id']  = $value['rid'];
                $Recharge[$key]['PayUser']  = $value['PayUser'];
                $Recharge[$key]['username']  = $value['username'];                
            }
        }
        //var_dump($Recharge);die;
        
        return $Recharge;
        
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
 
        
        //查询充值金额
        //$info=Loader::model('Recharge')->getMoneybyid( $id );
        //$data = ['status' => 1,'id' => $id,'money' => $info['Money']];
        $data = ['status' => 1,'id' => $id];
        //var_dump($data);die;
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
//        
//        return Loader::model('Recharge')->deleterechargeById($id);
        
        
//         if(intval($id) < 0){
//            return info(lang('Data ID exception'), 0);
//        }
//        if(!request()->isAjax()) {
//            return info(lang('Request type error'));
//        }
 
        
        
        $data = ['status' => 2,'id' => $id];
        //var_dump($data);die;
        return Loader::model('Recharge')->saverecharge( $data );
    }
}