<?php
namespace app\www\model;

use think\Config;
use think\Db;
use think\Loader;
use think\Model;
use traits\model\SoftDelete;

class LotteryWinning extends Checkuser
{
	use SoftDelete;
    protected $deleteTime = 'delete_time';

     //获取上期开奖号码
    public function getlastnumbers($lotteryid,$lastperiodsid)
    {      
       
        $data=  $this->where( array('lotteryid'=>$lotteryid,'periodsid'=>$lastperiodsid))->select();         
        if(empty($data) && is_array($data)) {
                return 0;
        }
         
        foreach ($data as $key => $value) {
            $data['lotterynumbers'] = $value['lotterynumbers'];
            
        }

        return $data;
    }
    
     //获取当前期彩票投注记录
    public function getullistbylotteryid( $lotteryid )
    { 
        //$data = $this->alias('u')->join('recharge r ',' u.id = r.userid','LEFT')->join('tixian t ',' u.id = t.userid','LEFT')->join('user_lottery_winning ulw ',' u.id = ulw.userid','LEFT')->where( $request['map'] )->order('u.create_time desc')->field('SUM(t.Money ) as alltixian , SUM(r.Money) as allrecharge ,SUM(ulw.winningmoney) as allwinning ,u.*')->limit($request['offset'], $request['limit'])->group('u.id')->select();
        //本期收入
        $data = $this->where( array('lotteryid'=> $lotteryid ,'status'=> 0 ))->field('SUM(bettingmoney ) as allbettingmoney ')->select();
	//var_dump($data)	;die;
		
        //$data= $this->alias('ul')->where( array('ul.lotteryid'=> $lotteryid ))->select();         
        if(empty($data) && is_array($data)) {
            return FALSE;
        }else{
            $result['allbettingmoney']=$data[0]['allbettingmoney'];
        }
        
        //本期每个号码的支出
        $data = $this->where( array('lotteryid'=> $lotteryid ,'status'=> 0 ))->field('SUM(ifwining ) as numsifwining ,lottery_number')->group('lottery_number')->select();
	if(empty($data) && is_array($data)) {
            return FALSE;
        }else{
            foreach ($data as $key => $value) {                 
                $numslist[$value['lottery_number']]=$value['numsifwining'];
            }
            asort($numslist);
            $result['numsmoneylist']=$numslist;
            //$result['nums']=array_keys($numslist);            
        }
        
         
//        foreach ($data as $key => $value) {
//            $data[$key]['create_time'] =substr(Date("Y",$value['create_time']),-2,2). date('/m/d',$value['create_time']);
//            
//        }

        return $result;
    }
    
     //获取投注记录
    public function getUserLotterylistaaaaa( $userid )
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


    public function UserLotteryadd(array $data = [])
	{
            $result=$this->allowField(true)->saveAll($data);
            
            if($result){
                return info(lang('Add succeed'), 1);
            }else{
                return info(lang('Add failed') ,0);
            }
	}



}
