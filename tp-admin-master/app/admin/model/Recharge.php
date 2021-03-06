<?php
namespace app\admin\model;

use think\Config;
use think\Db;
use think\Loader;
use think\Model;
use traits\model\SoftDelete;

class Recharge extends Admin
{
	use SoftDelete;
        protected $deleteTime = 'delete_time';


	public function getList( $request )
	{
		$request = $this->fmtRequest( $request );
		$data = $this->order('create_time desc')->where( $request['map'] )->limit($request['offset'], $request['limit'])->select();
		return $this->_fmtData( $data );
	}

	public function saveData( $data )
	{
		if( isset( $data['id']) && !empty($data['id'])) {
			$result = $this->edit( $data );
		} else {
			$result = $this->add( $data );
		}
		return $result;
	}

	public function rechargeadd(array $data = [])
	{ 		
				
		$data['create_time'] = time();
		$this->allowField(true)->save($data);
		if($this->id > 0){
            return info(lang('Add succeed'), 1, '', $this->id);
            }else{
                return info(lang('Add failed') ,0);
            }
	}


    public function edit(array $data = [])	{
        $data['update_time'] = time();
        $res = $this->save($data,['id'=>$data['id']]);
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
      	public function saverecharge( $data )
	{
            Db::startTrans();
            try{
                //充值金额入库
                if( isset( $data['id']) && !empty($data['id'])) {
			$result = $this->edit( $data );
                        
		} else {
			return FALSE;
		}
                
                //获取本次用户的充值金额
                $map = [
			'id' => $data['id']
		];
                $MoneyRow = $this->where($map)->find();
                if( empty($MoneyRow) ) {
			return info('金额异常');
		}
                //修改用户余额
                if( isset( $MoneyRow['userid']) && !empty($MoneyRow['userid'])) {
                        $user = User::get($MoneyRow['userid']);
                        $user->balance     = $user->balance+$MoneyRow['Money'];
			$user->save();
                        
		} else {
			return info('异常');
		}
		
                // 提交事务
               Db::commit(); 
               return $result;
            }catch (\Exception $e) {
                // 回滚事务
                Db::rollback();
                return info('异常');
           }
		
	}  
        
          public function deleterechargeById($id)
    {
            $result = Recharge::destroy($id);
            return info($result);
            if ($result > 0) {
        return info(lang('Delete succeed'), 1);
            }   
    }

    //获取充值记录  
    public function Rechargelist()
    {        
        return $this->alias('r')->where( array('r.status'=>0 ))->join('ta_user User ',' User.id = r.userid','LEFT')->order('r.create_time desc')->field('r.id as rid,r.*,User.*')->select();
       
    }    
    //今天的充值金额 返点金额
    public function getRecharge( $userid )
    {
        
        $data = $this->where( array('userid'=>1 ))->whereTime('create_time', 'today')->select();
        return $this->_fmtData( $data );
    }
    
    //格式化数据
    private function _fmtData( $data )
    {
            if(empty($data) && is_array($data)) {
                    return array('Rebate'=>0,'Money'=>0);
            }
            $Rebate=0;
            $Money=0;
            foreach ($data as $key => $value) {
                $Rebate=$Rebate+$value['Rebate'];
                $Money=$Money+$value['Money'];
                    //$data[$key]['create_time'] = date('Y-m-d H:i:s',$value['create_time']);
                    //$data[$key]['status'] = $value['status'] == 1 ? lang('Start') : lang('Off');
            }

            return array('Rebate'=>$Rebate,'Money'=>$Money);
    }
    
    	public function getMoneybyid($id)
	{
		
		$info = User::get(['id' =>$id]);
		if (empty($info)) {
			return FALSE;
                }else{
                    return $info;
                }
	
	}

}
