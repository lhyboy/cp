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
  

    //中奖列表
    public function getwinninglist( )
    {        
        return $this->alias('ulw')->join('ta_user User ',' User.id = ulw.userid','LEFT')->join( 'Lottery Lottery ',' Lottery.id=ulw.lotteryid' ,'LEFT' )->order('ulw.create_time desc')->select();         
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


	



}
