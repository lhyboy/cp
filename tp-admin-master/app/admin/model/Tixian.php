<?php
namespace app\admin\model;

use think\Config;
use think\Db;
use think\Loader;
use think\Model;
use traits\model\SoftDelete;

class Tixian extends Admin
{
	use SoftDelete;
    protected $deleteTime = 'delete_time';

	
        public function getuserbankinfo( $uid )
            {
                $map = [
			'userid' => $uid
		];
		$bankRow = $this->where($map)->find();
		if( empty($bankRow) ) {
			return FALSE;
                }else{
                    return TRUE;
                }
            }

	public function getList( $request )
	{
		$request = $this->fmtRequest( $request );
		$data = $this->order('create_time desc')->where( $request['map'] )->limit($request['offset'], $request['limit'])->select();
		return $this->_fmtData( $data );
	}

	public function savetixian( $data )
	{
		if( isset( $data['id']) && !empty($data['id'])) {
			$result = $this->edit( $data );
                        
		} else {
			return FALSE;
		}
                
		return $result;
	}




    public function edit(array $data = []){		
        $data['update_time'] = time();
        $res = $this->allowField(true)->save($data,['id'=>$data['id']]);
        if($res == 1){
            return info(lang('Edit succeed'), 1);
        }else{
            return info(lang('Edit failed'), 0);
        }
    }

	public function deleteById($id)
	{
		$result = User::destroy($id);
		if ($result > 0) {
            return info(lang('Delete succeed'), 1);
        }   
	}
        
    //体现记录
    public function Tixianlist()
    {        
        return $this->alias('t')->where( array('t.status'=>0 ))->join('ta_user User ',' User.id = t.userid','LEFT')->join('ta_bank bank ',' bank.userid = t.userid','LEFT')->order('t.create_time desc')->select();
    }

    //今天的提现
    public function getTixian( $userid )
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
            $Tixian=0;
            
            foreach ($data as $key => $value) {
                $Tixian=$Tixian+$value['Money'];
                    //$data[$key]['create_time'] = date('Y-m-d H:i:s',$value['create_time']);
                    //$data[$key]['status'] = $value['status'] == 1 ? lang('Start') : lang('Off');
            }

            return $Tixian;
    }
    
    public function deletetixianById($id)
    {
            $result = Tixian::destroy($id);
            if ($result > 0) {
        return info(lang('Delete succeed'), 1);
    }   
    }

}