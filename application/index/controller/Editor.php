<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Db;
class Editor extends Controller
{
    public function  editor()
    {
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
                'md_typeid' => input('md_typeid'),
                'md_typename' => input('md_typename'),
            ];
            if(Db::name('md')->insert($data,true)){
                return 1;
            }
        }
    }
}
