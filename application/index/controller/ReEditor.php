<?php

namespace app\index\controller;
use app\index\model\ReEditor as ReEditorModel;
use think\Controller;
use think\Db;
use think\Session;
class ReEditor extends Controller
{
    public function  reeditor($md_id)
    {
        //判断Session是否有账号
        //@userInfo 返回‘10’ 没有登陆账号
        if(!Session::get('userInfo')){
            $this->redirect('admin/login');
        }
        $md = Db::name('md')->where('md_id',$md_id)->find();
        $type = Db::name('type')->select();
        $Data = [
            'md' => $md,
            'type' => $type
        ];
        $this->assign($Data);
        return $this->fetch('ReEditor/reeditor');
    }

    public function updateMd()
    {
        if(request()->isAjax()){
            $data = [
                'md_id' => input('md_id'),
                'md_content' => input('md_content'),
                'md_mdcontent' => input('md_mdcontent'),
                'md_time' => input('md_time'),
                'md_title' => input('md_title'),
                'typeid' => input('typeid'),
                'md_typename' => input('md_typename'),
            ];
            $_model = new ReEditorModel;
            $result = $_model->updateMd($data);
            if($result == 1){
                return 1;
            }else{
                return $result;
            };
        }
    }
}
