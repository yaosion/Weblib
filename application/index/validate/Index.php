<?php
namespace app\index\validate;
use think\Validate;

class Index extends Validate
{
        // 验证规则
        protected $rule = [
            'searchValue' => 'require',
            ];
        // 验证失败msg
        protected $message = [
            'searchValue.require' => '搜索内容不能为空',
            ];
        //验证场景
        protected $scene = [
            'search' => ['searchValue'],
        ];
}


