<?php
namespace app\www\controller;

use app\common\controller\Common;
use think\Controller;
use think\Loader;
use think\Session;
use think\Request;
use think\Url;
use app\common\tools;

class Checkuser extends Common
{
	protected $uid = 0;
	protected $role_id = 0;

	function _initialize()
	{
		parent::_initialize();
		//判断是否已经登录

		if( !Session::has('userinfo', 'www') ) {                   
                    $this->error('Please login first', url('www/Login/index'));
		}
		$userRow = Session::get('userinfo', 'www');
		//验证权限
		$request = Request::instance();
		$rule_val = $request->module().'/'.$request->controller().'/'.$request->action();
		$this->uid = $userRow['id'];
		$this->role_id = $userRow['role_id'];
		if($userRow['administrator']!=1 && !$this->checkRule($this->uid, $rule_val)) {
			$this->error(lang('Without the permissions page'));
		}
	}

	public function goLogin()
	{
		Session::clear();
		$this->redirect( url('www/login/') );
	}

	public function checkRule($uid, $rule_val)
	{
		$authRule = Loader::model('AuthRule');
		if(!$authRule->isCheck($rule_val)) {
			return true;
		}
		$authAccess = Loader::model('AuthAccess');
		if(in_array($rule_val, $authAccess->getRuleVals($uid))){
			return true;
		}
		return false;
	}

	//执行该动作必须验证权限，否则抛出异常
	public function mustCheckRule( $rule_val = '' )
	{
		$userRow = Session::get('userinfo', 'www');
		if( $userRow['administrator'] == 1 ) {
			return true;
		}
		if( empty($rule_val) ) {
			$request = Request::instance();
			$rule_val = $request->module().'/'.$request->controller().'/'.$request->action();
		}

		if(!model('AuthRule')->isCheck($rule_val)) {
			$this->error(lang('This action must be rule'));
		}
	}
}

