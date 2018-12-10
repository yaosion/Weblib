<?php

namespace app\index\controller;
use app\index\model\ReEditor as ReEditorModel;
use think\Controller;
use think\Db;
class ReEditor extends Controller
{
    public function  reeditor($md_id)
    {
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
                'md_typeid' => input('md_typeid'),
                'md_typename' => input('md_typename'),
            ];
            $_model = new ReEditorModel;
            $result = $_model->updateMd($data);
            if($result == 1){
                return '修改成功';
            }else{
                return $result;
            };
        }
    }
}
