<?php

namespace app\index\controller;
use app\index\model\Editor as EditorModel;
use think\Controller;
use think\Db;
use think\Session;
class Editor extends Controller
{
    public function  editor()
    {
        //判断Session是否有账号
        //@userInfo 返回‘10’ 没有登陆账号
        if(!Session::get('userInfo')){
            $this->redirect('admin/login');
        };
        $type = Db::name('type')->select();
        $typeData = [
            'type' => $type
        ];
        $this->assign($typeData);
        return $this->fetch('Editor/editor');
    }

    public function add()
    {
        if(request()->isAjax()){
            $data = [
                'md_content' => input('md_content'),
                'md_mdcontent' => input('md_mdcontent'),
                'md_time' => input('md_time'),
                'md_title' => input('md_title'),
                'typeid' => input('typeid'),
                'md_typename' => input('md_typename'),
            ];
            $_model = new EditorModel;
            $result = $_model->add($data);
            if($result == 1){
                return '添加成功';
            }else{
                return $result;
            };
        }
    }
}
