<?php

namespace app\index\model;

use think\Model;
use think\Db;

class Editor extends Model
{
    public function add($data){
        $validate = \think\Loader::validate('Editor');
        if(!$validate->check($data)){
            return $validate->getError();
        }
        $result=Db::name('md')->insert($data,true);
        if($result){
            return 1;
        }else{
            return '添加失败';
        }
    }
}
