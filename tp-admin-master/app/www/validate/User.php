<?php
namespace app\www\validate;

use think\Validate;

class User extends Validate
{

//    protected $rule =   [
//        'mobile'              => 'require|length:11',
//        'password'              => 'length:6,16',
//        'role_id' => 'require',
//    ];
//        protected $message  =   [
//        'mobile.require'      => 'Mobile require',
//        'mobile.length'       => 'Please enter a correct mobile',
//        'password.length'       => 'Please enter a correct password',
//    ];
    
//        protected $scene = [
//        'add' => ['mobile','password', 'role_id'],
//        'login' =>  ['mobile','password'],
//        'edit' => ['mobile', 'password', 'role_id']
//    ];
    
    protected $rule =   [
        'username'              => 'length:3,16',
        'password'              => 'length:6,16',
    ];

    protected $message  =   [
        'username.require'      => 'Mobile require',
        'username.length'       => 'Please enter a correct mobile',
        'password.length'       => 'Please enter a correct password',
    ];

    protected $scene = [
        'add' => ['username','password'],
        'login' =>  ['username','password'],
        'edit' => ['username', 'password']
    ];

}


