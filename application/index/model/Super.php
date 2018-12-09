<?php
namespace app\index\model;

use think\Model;
use think\Db;

class Super extends Model
{
    public function mdDelete($md_id)
    {
        if(!Db::name('md')->where('md_id',$md_id)->find()){
            return '该文不存在';
        }else if(Db::table('md')->where('md_id',$md_id)->delete()){
            return 1;
        }else{
            return 0;
        }
    }
}