<?php
namespace app\index\validate;
use think\Validate;

class Register extends Validate
{
    // 验证规则
    protected $rule = [
        'username' => 'require',
        'password' => 'require',
        'email' => 'require'
    ];
    // 验证失败msg
    protected $message = [
        'username.require' => '请输入账号',
        'password.require' => '请输入密码',
        'email.require' => '邮箱为改密码唯一凭证，不能为空',
    ];
    //验证场景
    protected $scene = [
    ];
}


