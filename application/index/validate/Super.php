<?php
namespace app\index\validate;
use think\Validate;

class Super extends Validate
{
    // 验证规则
    protected $rule = [
        'getId' => 'require',
    ];
    // 验证失败msg
    protected $message = [
        'getId.require' => '未知删除',
    ];
    //验证场景
    protected $scene = [

    ];
}