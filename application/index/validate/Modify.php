<?php
namespace app\index\validate;
use think\Validate;

class Modify extends Validate
{
    // 验证规则
    protected $rule = [
        'email' => 'require|email'
    ];
    // 验证失败msg
    protected $message = [
        'email' => '邮箱为改密码唯一凭证，不能为空',
    ];
    //验证场景
    protected $scene = [
    ];
}


