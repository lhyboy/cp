<?php
namespace app\www\controller;

use app\common\controller\Common;
use think\Controller;
use think\Loader;
use think\Request;
use think\Url;
use think\Session;

class Lottery extends Checkuser
{
    public function index(){
        
        return view();
        
    }
    
    public function lottery1(){
        
        return view('lottery1');
        
    }
}