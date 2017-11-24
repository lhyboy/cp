<?php
namespace app\www\controller;

use app\common\controller\Common;
use think\Controller;
use think\Loader;
use think\Request;
use think\Url;
use think\Session;
use think\Config;


class Login extends Common
{
	
	public function index()
	{
		if( Session::has('userinfo', 'user') ) {
			$this->redirect( url('www/index/index') );
		}
		return view();
	}

	/**
	 * 登录验证
	 */
	public function doLogin()
	{
		if( !Request::instance()->isAjax() ) {
			return $this->success( lang('Request type error') );
		}

		$postData = input('post.');
		//$captcha = $postData['captcha'];
		//if(!captcha_check($captcha)){
			//return $this->error( lang('Captcha error') );
		//};
		$loginData = array(
			'username'=>$postData['username'],
			'password'=>$postData['password']
		);
                
		$ret = Loader::model('User')->userlogin( $loginData );
		if ($ret['code'] !== 1) {
			return $this->error( $ret['msg'] );
		}
		unset($ret['data']['password']);
		Session::set('userinfo', $ret['data'], 'www');
		Loader::model('LogRecord')->record( lang('Login succeed') );
		return $this->success($ret['msg'], url('www/index/index'));
	}
        
        
	public function doRegister()
	{
		if( !Request::instance()->isAjax() ) {
			return $this->success( lang('Request type error') );
		}

		$postData = input('post.');
                
//		$captcha = $postData['captcha'];
//		if(!captcha_check($captcha)){
//			return $this->error( lang('Captcha error') );
//		};
		$loginData = array(
			'username'=>$postData['username'],
			'password'=>$postData['password']
		);
                
		$ret = Loader::model('User')->useradd( $loginData );
                
		if ($ret['code'] !== 1) {
			return $this->error( $ret['msg'] );
		}
		//return info(lang('Add succeed'), 1, '', 0);		
		return $this->success($ret['msg'], url('www/login/index'));
	}
        /**
	 * 注册
	 */
	public function register()
	{
            return view();
	}
        
        
	public function forgetpwd()
	{
            return view();
	}
        

	/**
	 * 退出登录
	 */
	public function out()
	{
		session::clear('www');
		return $this->success('退出成功！', url('www/login/index'));
	}
}