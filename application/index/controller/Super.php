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
    public function delete()
    {
        if(request()->isAjax()){
            $data = [
                'md_id' => input('md_id'),
            ];
            echo $data;
//            $_model = new SuperModel;
//            $result = $_model->delete($data);
//            if($result == 1){
//                return '删除成功';
//            }else{
//                return $result;
//            };
        }
    }
}
