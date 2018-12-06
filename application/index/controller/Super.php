<?php
namespace app\index\controller;
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
}
