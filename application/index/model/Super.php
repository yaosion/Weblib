<?php
namespace app\index\model;

use think\Model;
use think\Db;

class Super extends Model
{
    public function mdDelete($md_id)
    {
        if(!Db::name('md')->where('md_id',$md_id)->find()){
            return '该文已被删除';
        }else if(Db::name('md')->where('md_id',$md_id)->find()){
            $mdTypeId = Db::name('md')->where('md_id',$md_id)->value('md_typeid');
            Db::name('moretype')->where('moretype_id',$mdTypeId)->delete();
            Db::name('casemd')->where('md_belongsmd',$md_id)->delete();
            Db::name('skillmd')->where('md_belongsmd',$md_id)->delete();
            Db::name('md')->where('md_id',$md_id)->delete();
            return 1;
        }else{
            return 0;
        }
    }
}