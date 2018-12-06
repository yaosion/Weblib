<?php
namespace app\index\controller;
use think\Controller;
use think\Db;

class Super extends Controller
{
    public function super()
    {

        $valueAssign =[
            'typeName' => '',
        ];
        $this->assign($valueAssign);
        return $this->fetch('Super/super');
    }
}
