<?php
namespace app\index\validate;
use think\Validate;

class COSEditor extends Validate
{
    // 验证规则
    protected $rule = [
        'md_content' => 'require|min:150',
        'md_mdcontent' => 'require',
        'md_title' => 'require',
        'getType' => 'require',
        'md_belongsmd' => 'require',
    ];
    // 验证失败msg
    protected $message = [
        'md_content.require' => '内容不能为空',
        'md_content.min' => '是不是写少了点？☹',
        'md_mdcontent.require' => '内容不能为空',
        'md_title.require' => '标题不能为空',
        'getType.require' => '请选择类型',
        'md_belongsmd.require' => '请登陆后操作',
    ];
    //验证场景
    protected $scene = [];
}


