<?php
namespace app\index\validate;
use think\Validate;

class ForgetPWD extends Validate
{
    // 验证规则
    protected $rule = [
        'username' => 'require|max:25',
        'email' => 'require|email',
    ];
    // 验证失败msg
    protected $message = [
        'username.require' => '请输入账号',
        'username.max' => '账号太长啦',
        'email' => '请输入正确的邮箱',
    ];
    //验证场景
    protected $scene = [
    ];
}