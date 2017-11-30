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
