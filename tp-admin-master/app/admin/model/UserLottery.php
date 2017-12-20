<?php
namespace app\admin\model;

use think\Config;
use think\Db;
use think\Loader;
use think\Model;
use traits\model\SoftDelete;

class UserLottery extends Admin
{
	use SoftDelete;
    protected $deleteTime = 'delete_time';



    public function getList(  )
    {
        return $this->alias('ul')->join('ta_lottery_winning lw ',' lw.lotteryid = ul.lotteryid','LEFT')->join('ta_user_lottery_winning ulw ',' ulw.userid = ul.userid','LEFT')->join('ta_lottery l ',' l.id = ul.lotteryid','LEFT')->join('ta_user User ',' User.id = ul.userid','LEFT')->order('ul.create_time desc')->field('ul.id as ulid,ulw.*,l.*,lw.*,User.*')->select();  

    }

   

    
    
   

}
