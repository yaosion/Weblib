<?php

namespace app\index\controller;
use app\index\model\ReEditor as ReEditorModel;
use think\Controller;
use think\Db;
use think\Session;
class reeditor extends Controller
{
    public function  reeditor($md_id)
    {
        //判断Session是否有账号
        //@userInfo 返回‘10’ 没有登陆账号
        if(!Session::get('userInfo')){
            $this->redirect('admin/login');
        }
        $md = Db::name('md')->where('md_id',$md_id)->find();
        $moreType = Db::name('moretype')->where('moretype_id',$md['md_typeid'])->find();
        $typeName = Db::name('type')->where('type_id',$moreType['type_id'])->value('type_name');
        $type = Db::name('type')->select();
        $Data = [
            'md' => $md,
            'type' => $type,
            'moreType' => $moreType,
            'typeName' => $typeName
        ];
        $this->assign($Data);
        return $this->fetch('reeditor/reeditor');
    }

    public function updateMd()
    {
        if(request()->isAjax()){
            $data = [
                'md_id' => input('md_id'),
                'md_content' => input('md_content'),
                'md_mdcontent' => input('md_mdcontent'),
                'md_time' => request()->time(),
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
