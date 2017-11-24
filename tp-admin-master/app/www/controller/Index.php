<?php
namespace app\www\controller;

use app\common\controller\Common;
use think\Controller;
use think\Loader;
use think\Request;
use think\Url;
use think\Session;

class Index extends Checkuser
{
    public function index(){
        $data['ip'] = Loader::model('LogRecord')->UniqueIpCount();
        $this->assign('data', $data);
        return view();
        
    }
}