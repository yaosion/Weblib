<?php

namespace app\index\controller;

use app\index\model\Super as SuperModel;
use think\Controller;
use think\Db;

class Super extends Controller
{
    public function super()
    {
        $allMd = Db::name('md')->select();
        $valueAssign =[
            'allMd' => $allMd,
        ];
        $this->assign($valueAssign);
        return $this->fetch('Super/super');
    }
    public function mdDelete()
    {
        if(request()->isAjax()){
            $md_id = input('md_id');
            $_model = new SuperModel;
            $result = $_model->mdDelete($md_id);
            return $result;
        }
    }
}
