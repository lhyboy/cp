<?php
namespace app\www\controller;

use app\common\controller\Common;
use think\Controller;
use think\Loader;
use think\Request;
use think\Url;
use think\Session;

class Index extends Common
{
    public function index(){
 
        
        return view();
        
    }
    
    public function crontab(){
         //die('aaa');
       // ignore_user_abort(TRUE);// 设定关闭浏览器也执行程序
        //set_time_limit(0);      // 设定响应时间不限制，默认为30秒
        //$time=3;
        $timeout=1;
        $nowperiodsid=date('ymdHi',time());
        $url="http://www.yuletest.com/www/lottery/openlottery?lotteryid=1&periodsid=$nowperiodsid";
        //echo $url;die;
        $curlHandle = curl_init(); 
        curl_setopt( $curlHandle , CURLOPT_URL, $url ); 
        curl_setopt( $curlHandle , CURLOPT_RETURNTRANSFER, 1 ); 
        curl_setopt( $curlHandle , CURLOPT_TIMEOUT, $timeout ); 
        $result = curl_exec( $curlHandle ); 
        curl_close( $curlHandle ); 
        var_dump($result); 
        
        
        
        //while(TRUE){
          //  sleep($time);           // 每几秒钟执行一次
             
            
            // 写文件操作开始
            
            die('结束定时脚本运行');
           // if(config('Crontab')){
           //     break;

           // }
        }
      
    
}