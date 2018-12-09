<?php

namespace app\index\model;

use think\Model;

class Super extends Model
{
    public function delete($data)
    {
        $validate = \think\Loader::validate('Super');
        if(!$validate->check($data)){
            return $validate->getError();
        }
        if(!Db::name('md')->where('md_id',$data.getId)->find()){
            return '该文不存在';
        }else if(Db::table('md')->where('md_id',$data.getId)->delete()){
            return 1;
        }else{
            return 0;
        }
    }
}