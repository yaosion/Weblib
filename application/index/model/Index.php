<?php
namespace app\index\model;
use think\Model;
use think\Db;

class Index extends Model
{
    public function search($data)
    {
        //去除搜索内容里所有空格
        $_data = preg_replace('# #','',$data);
        $validate = \think\Loader::validate('Index');
        if(!$validate -> check($_data)){
            return $validate->getError();
        }else{
            return 1;
        }
    }
}


