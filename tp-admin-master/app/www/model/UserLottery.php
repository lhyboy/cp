<?php
namespace app\www\model;

use think\Config;
use think\Db;
use think\Loader;
use think\Model;
use traits\model\SoftDelete;

class UserLottery extends Checkuser
{
	use SoftDelete;
    protected $deleteTime = 'delete_time';

     //获取用户未中奖列表
    public function getmynowinninglist($userid )
    {        
        $data=  $this->alias('ul')->where( array('ulw.userid'=>1))->join('ta_user_lottery_winning ulw ',' ul.userid = ulw.userid','LEFT')->join( 'Lottery Lottery ',' Lottery.id=ulw.lotteryid' ,'LEFT' )->order('ulw.create_time desc')->select();         
        if(empty($data) && is_array($data)) {
                return 0;
        }
         
        foreach ($data as $key => $value) {
            $data[$key]['create_time'] = date('Y/m/d',$value['create_time']);
            
        }

        return $data;
    }
    
    
     //获取投注记录
    public function getUserLotterylist( $userid )
    { 
        $data= $this->alias('ul')->where( array('ul.userid'=>1 ))->join('ta_user_lottery_winning ulw ',' ul.userid = ulw.userid','LEFT')->join( 'Lottery Lottery ',' Lottery.id=ul.lotteryid' ,'LEFT' )->join( 'lottery_winning Lw ',' Lottery.id=Lw.lotteryid' ,'LEFT' )->order('ul.create_time desc')->select();         
        if(empty($data) && is_array($data)) {
                return 0;
        }
         
        foreach ($data as $key => $value) {
            $data[$key]['create_time'] =substr(Date("Y",$value['create_time']),-2,2). date('/m/d',$value['create_time']);
            
        }

        return $data;
    }
 
    
    //今天的投注金额
    public function getbettingmoney( $userid )
    {
        
        $data = $this->where( array('userid'=>1 ))->whereTime('create_time', 'today')->select();
        return $this->_fmtData( $data );
    }
    
    
    	//格式化数据
	private function _fmtData( $data )
	{
		if(empty($data) && is_array($data)) {
			return 0;
		}
                $bettingmoney=0;
		foreach ($data as $key => $value) {
                    $bettingmoney=$bettingmoney+$value['bettingmoney'];
			//$data[$key]['create_time'] = date('Y-m-d H:i:s',$value['create_time']);
			//$data[$key]['status'] = $value['status'] == 1 ? lang('Start') : lang('Off');
		}

		return $bettingmoney;
	}


	



}
