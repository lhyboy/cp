<?php
namespace app\www\model;

use think\Config;
use think\Db;
use think\Loader;
use think\Model;
use traits\model\SoftDelete;

class UserLotteryWinning extends Checkuser
{
	use SoftDelete;
    protected $deleteTime = 'delete_time';
  
   
    
    
    //获取用户自己的中奖列表
    public function getmywinninglist($userid )
    {        
        $data=  $this->alias('ulw')->where( array('ulw.userid'=>$userid ))->join( 'lottery_winning Lw ',' ulw.lotteryid=Lw.lotteryid' ,'LEFT' )->join('ta_user_lottery ul ',' ul.userid = ulw.userid','LEFT')->join( 'Lottery Lottery ',' Lottery.id=ulw.lotteryid' ,'LEFT' )->order('ulw.create_time desc')->select();         
        if(empty($data) && is_array($data)) {
                return 0;
        }
         
        foreach ($data as $key => $value) {
            $data[$key]['create_time'] = date('Y/m/d',$value['create_time']);
            
        }

        return $data;
    }

    //中奖列表
    public function getwinninglist( )
    {        
        return $this->alias('ulw')->join('ta_user User ',' User.id = ulw.userid','LEFT')->join( 'Lottery Lottery ',' Lottery.id=ulw.lotteryid' ,'LEFT' )->order('ulw.create_time desc')->select();         
    }
    
    
     //昨天的中奖榜单
    public function getwinningyesterdaylist(  )
    {
        return $this->alias('ulw')->field('sum(ulw.winningmoney) allwinningmoney,User.username ')->join('ta_user User ',' User.id = ulw.userid','LEFT')->order('allwinningmoney desc')->whereTime('ulw.create_time', 'yesterday')->group('User.id')->select();            
   
        
    }
    //今天的中奖金额
    public function getwinning( $userid )
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
                $winningmoney=0;
		foreach ($data as $key => $value) {
                    $winningmoney=$winningmoney+$value['winningmoney'];
			//$data[$key]['create_time'] = date('Y-m-d H:i:s',$value['create_time']);
			//$data[$key]['status'] = $value['status'] == 1 ? lang('Start') : lang('Off');
		}

		return $winningmoney;
	}


        public function adduserLotteryWinning( $data ){

            if( isset( $data['lotteryid']) && !empty($data['lotteryid'])) {
                $UserLotterylist = UserLottery::all(['status'=>0,'lotteryid'=>$data['lotteryid'],'periodsid'=>$data['periodsid']]);
                if(empty($UserLotterylist) && is_array($UserLotterylist)) {
                    return 0;
                }else{
                    foreach ($UserLotterylist as $v){
                        $adddata[]=array('userid'=>$v['userid'],'periodsid'=>$v['periodsid'],'lotteryid'=>$v['lotteryid'],'winningmoney'=>$v['ifwining'],'bettingmoney'=>$v['bettingmoney']);
                    }
                    $this->saveAll( $adddata );
                }

            
            
        }
            

    }



}
