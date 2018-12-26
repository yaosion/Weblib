<?php
namespace app\index\validate;
use think\Validate;

class Editor extends Validate
{
    // 验证规则
    protected $rule = [
        'md_content' => 'require',
        'md_mdcontent' => 'require',
        'md_title' => 'require',
        'typeid' => 'require',
        'md_typename' => 'require',
    ];
    // 验证失败msg
    protected $message = [
        'md_content.require' => '内容不能为空',
        'md_mdcontent.require' => '内容不能为空',
        'md_title.require' => '标题不能为空',
        'typeid.require' => '类型id不能为空',
        'md_typename.require' => '类型内容不能为空',
    ];
    //验证场景
    protected $scene = [];
}


