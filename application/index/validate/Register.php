<?php
namespace app\index\validate;
use think\Validate;

class Register extends Validate
{
    // 验证规则
    protected $rule = [
        'username' => 'require|max:25',
        'password' => 'require|alphaDash',
        'email' => 'require|email'
    ];
    // 验证失败msg
    protected $message = [
        'username.require' => '请输入账号',
        'username.max' => '账号太长啦',
        'password.require' => '请输入密码',
        'password.alphaDash' => '密码只能为字母和数字，下划线_及破折号-',
        'email' => '请输入正确的邮箱',
    ];
    //验证场景
    protected $scene = [
    ];
}


