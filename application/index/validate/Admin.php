<?php
namespace app\index\validate;
use think\Validate;

class Admin extends Validate
{
    // 验证规则
    protected $rule = [
        'username' => 'require',
        'password' => 'require',
    ];
    // 验证失败msg
    protected $message = [
        'username.require' => '请输入账号',
        'password.require' => '请输入密码',
    ];
    //验证场景
    protected $scene = [
    ];
}


